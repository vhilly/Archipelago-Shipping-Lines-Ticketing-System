<?php


  class PurchaseController extends Controller{

    public function filters(){
      return array(
        'accessControl',
        'postOnly + delete',
      );
    }
    public function accessRules()
    {
      return array(
        array('allow',  // allow all users to perform 'index' and 'view' actions
          'actions'=>array(''),
          'users'=>array('*'),
        ),
        array('allow', // allow authenticated user to perform 'create' and 'update' actions
          'actions'=>array(''),
          'users'=>array('@'),
        ),
        array('allow', // allow admin user to perform 'admin' and 'delete' actions
          'actions'=>array('index','getCargoRate','dynamicShippers','accountToForm'),
          //'users'=>array('admin'),
          'users'=>array('@'),
        ),
        array('deny',  // deny all users
          'users'=>array('*'),
        ),
      );
    }


    public function actionIndex($type){

       
      if(isset($_POST['Purchase']) && $_SESSION['nonce'] == $_POST['nonce']){
        $error=0;
        $transaction_type     = $_SESSION['Trans']['Type'];
        $purchase            = $_SESSION['Trans']['Purchase'];
        $cargo                = $_SESSION['Trans']['Cargo'];
        $stowage                = $_SESSION['Trans']['Stowage'];
        $passengers            = $_SESSION['Trans']['Passenger'];
        $seats            = $_SESSION['Trans']['Seat'];
        $fares            = $_SESSION['Trans']['Fare'];
        $purchase->attributes = $_POST['Purchase'];
        $cargo->attributes    = $_POST['Cargo'];
        $stowage->attributes    = $_POST['Stowage'];
        
        if(isset($_POST['back']))
          $purchase->current_step--;

        if($purchase->validate()){

          if($purchase->current_step ==1){

            $rt = Voyage::model()->find(array(
              'select'=>'route',
              'condition'=>'id=:vid',
              'params'=>array(':vid'=>"$purchase->voyage"),)
            );
            $purchase->route = $rt->route;
            $purchase->fares = PassageFareRates::model()->findAll(array(
                'condition'=>'class=:cl AND route=:rt AND active="Y"',
                'params'=>array(':cl'=>$purchase->class,':rt'=> $purchase->route),
            ));
            if($transaction_type->cargo == 'Y'){
                if(!$stowage->validate())
                  $error ++;
                if($cargo->validate()){
                  $c = CargoClass::model()->findByPk($cargo->cargo_class);
                  $purchase->passenger_total = $c->bundled_passenger;
                  $purchase->passenger_max = $c->bundled_passenger;
                  $bundledFare  = PassageFareRates::model()->findByAttributes(array('route'=>$purchase->route,'class'=>$purchase->class,'type'=>$transaction_type->bundled_passenger_rate));
                  $cargoFareSql = CargoFareRates::model()->findByAttributes(array('route'=>$purchase->route,'class'=>$cargo->cargo_class));
                  $purchase->bundled_rate = $bundledFare;
                  $purchase->cargo_rate = $cargoFareSql->id;
                  $purchase->cargo_cost = $_POST['cargo_cost'];
                }else{
                  $error++;
                };
            }
            if((!count($passengers) || (count($passengers) != $purchase->passenger_total)) && !$error){
              $pass_details = $this->createPassengerField($purchase->passenger_total,$passengers,$seats,$fares,$purchase->class,$purchase->bundled_rate);
              $passengers = $_SESSION['Trans']['Passenger'] = $pass_details[0];
              $seats = $_SESSION['Trans']['Seat'] = $pass_details[1];
              $fares = $_SESSION['Trans']['Fare'] = $pass_details[2];
            }
          }
          
          if($purchase->current_step ==2){
            $total_amount = 0;
            $total_fares = 0;
            $discount = 0;
            $freight_cost = 0;
            $pass_details = $this->createPassengerField($purchase->passenger_total,$_POST['Passenger'],$_POST['Seat'],$_POST['PassageFareRates'],$purchase->class,$purchase->bundled_rate);
            $passengers = $_SESSION['Trans']['Passenger']= $pass_details[0];
            $seats = $_SESSION['Trans']['Seat']= $pass_details[1];
            $fares = $_SESSION['Trans']['Fare']= $pass_details[2];

            foreach($fares as $fare){
              $total_fares += $fare->price;
            }

            $purchase->total_fares = $total_fares;
            if($transaction_type->cargo == 'Y')
              $discount += $purchase->total_fares;  
            $purchase->payment_discount = $discount;
            $purchase->payment_total = $purchase->total_fares + $purchase->cargo_cost;
            $error += $this->validatePassengersField($passengers,$seats,$fares);           
          }
          if($purchase->current_step ==3){
            $b_type = 2;
            $transaction = Yii::app()->db->beginTransaction();
            try{
              $tr = new Transaction;
              $tr->ovamount = $purchase->payment_total;
              $tr->ovdiscount = $purchase->payment_discount;
              $tr->type = $transaction_type->id;
              $tr->payment_method = $purchase->payment_method;
              $tr->payment_status = $purchase->payment_status;
              $tr->account_to = $purchase->account_to;
              $curDate = date('Y-m-d H:i:s');
              $tr->trans_date = $curDate;
              $tr->input_date = $curDate;
              $tr->created_by =Yii::app()->user->name;
              if(!$tr->save())
                throw new Exception('Cannot save transaction');
              $purchase->tr_no = $tr->id;
              $bookCounter = numberGenerator(1);
              foreach($passengers as $key=>$p){
                if(!$p->save())
                  throw new Exception('Cannot save passanger');

                $nb = new Booking;
	        $counter = numberGenerator(2);
	        $series =   numberGenerator(4,0);
                $nb->tkt_no = $counter;
                $nb->booking_no = $bookCounter;
                $nb->voyage = $purchase->voyage;
                $nb->status = $purchase->payment_status == 1? 2 : 1;//set booking status to paid if payment is completed else reserved
                $nb->seat = $seats[$key]->id;
                $nb->rate = $fares[$key]->id;
                $nb->transaction = $tr->id;
                $nb->passenger = $p->id;
                $nb->tkt_serial = $series-1;
                $nb->type = $b_type;
                if(!$nb->save())
                  throw new Exception('Cannot save Booking');
              }
              if($transaction_type->cargo == 'Y'){
                if(!$cargo->save())
                  throw new Exception('Cannot save passanger');

		$bookingCounter = numberGenerator(1);
                $nc = new BookingCargo;
		$lading = numberGenerator(3);
		$nc->lading_no = $lading;
		$nc->booking_no = $bookingCounter;
                $nc->transaction = $tr->id;
                $nc->voyage = $purchase->voyage;
                $nc->status = $purchase->payment_status == 1? 2 : 1;
                $nc->rate = $purchase->cargo_rate;
                $nc->cargo = $cargo->id;
                $nc->stowage = $stowage->id;
                $nc->type = $b_type;
                if(!$nc->save())
                  throw new Exception('Cannot save Cargo Booking');
              }
              $transaction->commit();
              Yii::app()->user->setFlash('success', 'Transaction Complete!');

            }catch(Exception $e){
              $transaction->rollback();
              throw new CHttpException(400,$e);
              $this->refresh();
            }
          }

        }else{
         $error++;
        }    
        if(isset($_POST['next']) && !$error)
          $purchase->current_step++;

      }else{
        unset($_SESSION['Trans']);
        SeatLock::model()->deleteAllByAttributes(array('created_by'=>Yii::app()->user->name));
        $transaction_type = $_SESSION['Trans']['Type'] = TransactionType::model()->findByPk($type);
        $cargo = $_SESSION['Trans']['Cargo'] = new Cargo;
        $stowage = $_SESSION['Trans']['Stowage'] = new Stowage;
        $passengers = $_SESSION['Trans']['Passenger'] = array();
        $seats = $_SESSION['Trans']['Seat'] = array();
        $fares = $_SESSION['Trans']['Fare'] = array();

        if($transaction_type->cargo!='Y'){
          $purchase = $_SESSION['Trans']['Purchase'] = new Purchase($transaction_type->id,$transaction_type->minimum_passenger,$transaction_type->maximum_passenger);
        }else{
          $purchase = new Purchase($transaction_type->id,1,5);
          $purchase->class=2;
          $_SESSION['Trans']['Purchase'] = $purchase;
        }
      }
      unset($_SESSION['nonce']);
      $this->render('index',array('purchase'=>$purchase,'transaction_type'=>$transaction_type,'cargo'=>$cargo,'stowage'=>$stowage,'passengers'=>$passengers,'seats'=>$seats,'fares'=>$fares));
    }

    public function actionGetCargoRate($id=null,$voyage=null){
      $cargoFare =  Yii::app()->db->createCommand("SELECT f.proposed_tariff,c.name FROM  cargo_fare_rates f ,cargo_class c,voyage v WHERE f.route=v.route AND  v.id = '{$voyage}' AND f.class='$id'")->queryAll();
      if($cargoFare)
        echo $cargoFare[0]['proposed_tariff'];
      else
        echo 0;
      Yii::app()->end(); 
    }
    private function createPassengerField($i,$pass=null,$seats=null,$fares=null,$class=null,$rate=null){
      $passenger_list =array();
      for($counter =0; $counter < $i;$counter++){
        $passenger = new Passenger;
        $seat = new Seat('id');
        $seat->seating_class = $class;
        $fare = new PassageFareRates;
        if($rate){
          $fare->id = $rate->id;
          $fare->price = $rate->price;
        }
        $fare->makeRequired('id');
        if($pass && isset($pass[$counter])){
          if(is_array($pass[$counter])){
            $passenger->attributes = $pass[$counter]; 
            $seat->attributes = $seats[$counter]; 
            $fare->attributes = $fares[$counter]; 
          }
          else{
            $passenger = $pass[$counter]; 
            $seat = $seats[$counter]; 
            $fare = $fares[$counter]; 
          }
        }
        $passenger_list[0][] = $passenger;
        $passenger_list[1][] = $seat;
        $passenger_list[2][] = $fare;
      }
      return $passenger_list;
    }
    private function validatePassengersField($pass=null,$seat,$fare){
      $error =0;
      foreach($pass as $key=>$p){
        if(!$p->validate())
         $error++;
        if(!$seat[$key]->validate())
         $error++;
        if(!$fare[$key]->validate())
         $error++;
      } 
      return $error;
    }

   public function actionAccountToForm(){
     $company =isset($_GET['company']) ? $_GET['company'] :'';
     $model = Customer::model()->findByPk($company);
     $this->renderPartial('accountToForm',array('model'=>$model));
   }
  }
