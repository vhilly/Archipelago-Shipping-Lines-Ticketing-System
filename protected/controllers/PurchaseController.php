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
          'actions'=>array('index'),
          'users'=>array('admin'),
        ),
        array('deny',  // deny all users
          'users'=>array('*'),
        ),
      );
    }

    public function numberGenerator($name){
      $count = file_get_contents("$name.txt");
      $count = trim($count);
      $count = $count + 1;
      $fl = fopen("$name.txt","w+");
      fwrite($fl,$count);
      fclose($fl);
      return $count;
    }

    public function actionIndex($type){

      if(isset($_POST['Purchase']) && $_SESSION['nonce'] == $_POST['nonce']){
        $purchaseType=$_SESSION['PurchaseType'];
        $purchaseFrm=new Purchase($purchaseType->passenger,$purchaseType->minimum_passenger,$purchaseType->maximum_passenger,$purchaseType->bundled_passenger);
        $purchaseFrm->attributes=$_POST['Purchase'];

        if($purchaseFrm->validate()){
          $purchase = $_SESSION['Purchase'];

          if(isset($_POST['back']))
            $purchase->current_step  --;
          if(isset($_POST['next']))
            $purchase->current_step ++;

          $purchase->clearErrors();

          if($purchase->current_step ==1){
            $purchase->passengerModels=array();
          }

          if($purchase->current_step ==2){
            $purchase->passengerTotal = $purchaseFrm->passengerTotal;
            $purchase->voyage = $purchaseFrm->voyage;
            $purchase->class = $purchaseFrm->class;
            $route = Voyage::model()->find(array(
              'select'=>'route',
              'condition'=>'id=:vid',
              'params'=>array(':vid'=>"$purchaseFrm->voyage"),)
            );
            $purchase->route = $route->route;

            if($purchase->passenger){

              $fares = PassageFareRates::model()->findAll(array(
                'condition'=>'class=:cl AND route=:rt AND active="Y"',
                'params'=>array(':cl'=>$purchase->class,':rt'=> $purchase->route),
              ));
              if(!$fares)
                throw new CHttpException('','Setup Passenger Fare Rate First! (under admin/settings/Passage Fare Rates)');
              $purchase->fares = $fares;
              if(!count($purchase->passengerModels)){
                for($count = 0;$count < $purchase->passengerTotal;$count++){
                  $purchase->passengerModels[] = new Passenger;
                  $purchase->seatModels[] = new Seat('id');
                  $purchase->fareModels[] = new PassageFareRates('id');
                }
              }
            }
            if($purchase->cargo){
              $cargoFares =array();
              $cargoFareSql =  Yii::app()->db->createCommand("SELECT f.id,c.name FROM  cargo_fare_rates f ,cargo_class c WHERE f.route={$purchase->route} AND f.class=c.id")->queryAll();
              if(!$cargoFareSql)
                throw new CHttpException('','Setup Cargo Fare Rate First! (under admin/settings/Cargo Setup)');
              foreach($cargoFareSql as $cFares){
                $cargoFares[$cFares['id']] = $cFares['name'];
              }
              $purchase->cargoFares = $cargoFares;
              if(!count($purchase->cargoModel)){
                $purchase->cargoModel[] = new Cargo;
                $purchase->stowage[] = new Stowage();
                $purchase->cargoFareModels[] = new CargoFareRates;
              }
            }
          }
          if($purchase->current_step ==3){
            $passengerList = isset($_POST['Passenger']) ? $_POST['Passenger'] : array();
            $seatList = isset($_POST['Seat']) ? $_POST['Seat'] : array();
            $stowageList = isset($_POST['Stowage']) ? $_POST['Stowage'] : array();
            $fareList = isset($_POST['PassageFareRates']) ? $_POST['PassageFareRates'] : array();
            $cargoFareList = isset($_POST['CargoFareRates']) ? $_POST['CargoFareRates'] : array();
            $cargoList = isset($_POST['Cargo']) ? $_POST['Cargo'] : array();
            $cargoAmnt =0;
            $fareAmnt =0;
            $bundledFare = new PassageFareRates;
            if(count($passengerList)){
              $discount = 0;
              $purchase->passengerModels=array();
              $purchase->seatModels=array();
              $purchase->fareModels=array();
              if($purchase->bundledPassenger)
                $bundledFare = PassageFareRates::model()->findByAttributes(array('route'=>$purchase->route,'class'=>$purchase->class,'type'=>$purchaseType->bundled_passenger_rate));
              foreach($passengerList as $key=>$p){
                $pass = new Passenger;
                $fare = new PassageFareRates('id');
                $seat = new Seat('id');


                $pass->attributes = $p;
                if((!$purchase->bundledPassenger && $purchase->bundledPassenger < $key) || !$purchase->bundledPassenger){
                  $fare->attributes = $fareList[$key];
                }else{
                  $discount += $bundledFare->price;$fare->id =$bundledFare->id;$fare->price =$bundledFare->price;
                }
                $seat->attributes = $seatList[$key];
                $purchase->passengerModels[]=$pass;
                $purchase->fareModels[]=$fare;
                $purchase->seatModels[]=$seat;

                if(!$pass->validate())
                 $purchase->current_step =2;

                if(!$fare->validate())
                 $purchase->current_step =2;
               
                if(!$seat->validate())
                  $purchase->current_step =2;


              }
              $purchase->discount += $discount;
              $prices = array_map(function ($ar) {return $ar['price'];},$fareList);
              $fareAmnt += array_sum($prices);
            }
            if(count($cargoList)){
              $purchase->stowage=array();
              $purchase->cargoModel=array();
              $purchase->cargoFareModels=array();
              foreach($cargoList as $key2=>$c){
                $cargoFare = new CargoFareRates;
                $cargo = new Cargo;
                $stowage = new Stowage;
                $stowage->attributes = $stowageList[$key2];
                $cargoFare->attributes = $cargoFareList[$key2];
                $cargo->attributes = $c;
                $purchase->stowage[] = $stowage;
                $purchase->cargoModel[] = $cargo;
                $purchase->cargoFareModels[] = $cargoFare;
                if(!$cargoFare->validate())
                  $purchase->current_step =2;

                if(!$cargo->validate())
                  $purchase->current_step =2;
              }
              $prices2 = array_map(function ($ar) {return $ar['proposed_tariff'];},$cargoFareList);
              $cargoAmnt += array_sum($prices2);

            }

            $purchase->payment_total = $fareAmnt+$cargoAmnt;
            $purchase->payment_method = 1;//default is cash
          }
          if($purchase->current_step ==4){
            $passengerList = isset($_POST['Passenger']) ? $_POST['Passenger'] : array();
            $fareList = isset($_POST['PassageFareRates']) ? $_POST['PassageFareRates'] : array();
            $seatList = isset($_POST['Seat']) ? $_POST['Seat'] : array();
            $stowageList = isset($_POST['Stowage']) ? $_POST['Stowage'] : array();
            $cargoList = isset($_POST['Cargo']) ? $_POST['Cargo'] : array();
            $cargoFareList = isset($_POST['CargoFareRates']) ? $_POST['CargoFareRates'] : array();

            $purchase->payment_status = $purchaseFrm->payment_status;
            $transaction = Yii::app()->db->beginTransaction();
            try{
              $newTransaction = new Transaction;
              $newTransaction->payment_method = $purchase->payment_method;
              $newTransaction->payment_status = $purchase->payment_status;
              $newTransaction->type   = $purchase->transaction_type;
              $newTransaction->uid =1;
              $curDate = date('Y-m-d H:i:s');
              $newTransaction->trans_date = $curDate;
              $newTransaction->input_date = $curDate;
              $newTransaction->ovamount =$purchase->payment_total;
              $newTransaction->ovdiscount =$purchase->discount;

              if(!$newTransaction->save())
                throw new Exception('Cannot save transaction');


              if(count($passengerList)){
		$bookCounter = $this->numberGenerator('book');
                foreach($passengerList as $key=>$passenger){
                  $newPassenger   = new Passenger;
                  $newBooking = new Booking;
                  $newSeat = new Seat;
                  $newFare = new PassageFareRates;
                  $purchase->transaction_no = $newTransaction->id;
                  $newSeat->attributes=$seatList[$key];
                  $newFare->attributes=$fareList[$key];
                  //passenger
                  $newPassenger->attributes=$passenger;
                  if(!$newPassenger->save())
                    throw new Exception('Cannot save passanger');
                  //booking
		  $counter = $this->numberGenerator('count');
		  $newBooking->tkt_no = str_pad($counter,10,'0',STR_PAD_LEFT);
		  $newBooking->booking_no = str_pad($bookCounter,10,'0',STR_PAD_LEFT);
                  $newBooking->transaction = $newTransaction->id;
                  $newBooking->passenger = $newPassenger->id;
                  $newBooking->seat = $newSeat->id;
                  $newBooking->voyage = $purchase->voyage;
                  $newBooking->rate = $newFare->id;
                  $newBooking->status = $purchase->payment_status == 1? 2 : 1;//set booking status to paid if payment is completed else reserved
                  if(!$newBooking->save())
                    throw new Exception('Cannot save Booking');
                }
              }
              if(count($cargoList)){
		$bookingCounter = $this->numberGenerator('book');
                foreach($cargoList as $key2=>$c){
                  $cargo = new Cargo;
                  $cargoFare = new CargoFareRates;
                  $newStowage = new Stowage;
                  $cargo->attributes = $c;
                  $newStowage->attributes=$stowageList[$key2];
                  $cargoFare->attributes = $cargoFareList[$key2];
                  $newCargoBooking = new BookingCargo;
		  $lading = $this->numberGenerator('lading');
		  $newCargoBooking->lading_no = str_pad($lading,10,'0',STR_PAD_LEFT);
		  $newCargoBooking->booking_no = str_pad($bookingCounter,10,'0',STR_PAD_LEFT);
                  $newCargoBooking->transaction = $newTransaction->id;
                  $newCargoBooking->voyage = $purchase->voyage;
                  $newCargoBooking->stowage = $newStowage->id;
                  $newCargoBooking->rate = $cargoFare->id;
                  $newCargoBooking->status = $purchase->payment_status == 1? 2 : 1;
                  if(!$cargo->save())
                    throw new Exception('Cannot save Cargo');

                  $newCargoBooking->cargo = $cargo->id;
                  if(!$newCargoBooking->save())
                    throw new Exception('Cannot save Cargo Booking');

                }
              }
              $transaction->commit();
              Yii::app()->user->setFlash('success', 'Transaction Complete!');
            }catch(Exception $e){
              $transaction->rollback();
              throw new CHttpException(400,$e);
              $this->refresh();
            }


          }

          $_SESSION['POST'] = $purchase;

        }else{
          $purchase = $_SESSION['Purchase'];
          if(!count($purchase->getErrors()))
            $purchase->addErrors($purchaseFrm->getErrors());
        }
        unset($_POST['Purchase']);

      }else{
        $purchaseType = TransactionType::model()->findByPk($type);
        if(!$purchaseType)
          throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');

        $purchase=new Purchase($purchaseType->passenger,$purchaseType->minimum_passenger,$purchaseType->maximum_passenger,$purchaseType->bundled_passenger);
        $purchase->current_step=1;
        $purchase->setCargo($purchaseType->cargo);
        $purchase->transaction_type = $purchaseType->id;
        $_SESSION['Purchase'] = $purchase;
        $_SESSION['PurchaseType'] = $purchaseType;

      }
      unset($_SESSION['nonce']);
      $this->render('index',array('purchase'=>$purchase));
    }
  }
