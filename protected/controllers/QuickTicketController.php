<?php 
  class QuickTicketController extends Controller {
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
          'actions'=>array('index','seriesNumber'),
          'users'=>array('@'),
        ),
        array('allow', // allow admin user to perform 'admin' and 'delete' actions
          'actions'=>array(''),
          //'users'=>array('admin'),
          'users'=>array('admin'),
        ),
        array('deny',  // deny all users
          'users'=>array('*'),
        ),
      );
     }
     public function actionIndex(){
       $sn = Counter::model()->findByPk(4)->counter;
       $bs_per_class= array();
       $voyage='';
       $voyages='';
       $booking='';
       $vid='';

       $bn = isset($_GET['bn']) ?  $_GET['bn'] : '';
       if(isset($_GET['id'])){
          $_SESSION['voyage'] = $_GET['id'];
       }
       if(isset($_GET['reset'])){
          unset($_SESSION['voyage']);
       }
       $vid = isset($_SESSION['voyage']) ? $_SESSION['voyage'] : null;
       
       if(isset($_POST['Booking'])){
         $fares = PassageFareRates::model()->findAll(array(
           'condition'=>'class=:cl AND route=:rt AND active="Y"',
           'params'=>array(':cl'=>$_POST['Booking']['class'],':rt'=> $_POST['Booking']['route']),
         ));
         $rate = CHtml::listData($fares,'type','id');
         $amt = CHtml::listData($fares,'type','price');

         foreach($_POST['Booking']['ptype'] as $p){
          $amts[] = $amt[$p];
         }
         $total_amt = array_sum($amts);
         $sql = "SELECT s.id  FROM booking b,seat s WHERE s.id=b.seat AND b.voyage  ={$_POST['Booking']['voyage']} ";
         $bookedSeats= Yii::app()->db->createCommand($sql)->queryAll();
         $sids = array_map(function($s){return $s['id'];},$bookedSeats);
         $booked = implode(',',$sids);
	 $skp = array('45E','45F','45G','29A','29B','29C','29D','30A','30B','30C','30D');
        for($n="A";$n<="F";$n++){
        	for($m=10;$m<=17;$m++){
                	$ap = "$m$n";
                        array_push($skp,$ap);
                }
        }
        //filter for H line
        for($m=1;$m<=45;$m++){
          if($m<=9 || $m>=18){
            $sh = "{$m}H";
            array_push($skp,$sh);
          }
         }
	 $skip ='\''.implode('\',\'', $skp).'\'';
         $sql = "SELECT id,name FROM seat WHERE seating_class={$_POST['Booking']['class']}";
         if($booked)
           $sql .=  " AND id NOT IN ($booked)"; 
         if($skip)
           $sql .=  " AND name NOT IN ($skip)"; 
         $sql .= " ORDER BY name+1,name ";
         $seatList= Yii::app()->db->createCommand($sql)->queryAll();
         
         $available_seats = array_map(function($as){return $as['id'];},$seatList);
         if(count($available_seats) < count($_POST['Booking']['ptype'] )){
              Yii::app()->user->setFlash('info', count($available_seats)." Seats Available!");
              $this->redirect(array("QuickTicket/"));
         }
         $transaction = Yii::app()->db->beginTransaction();
            try{
              $tr = new Transaction;
              $tr->ovamount = $total_amt;
              $tr->type = 1;
              $curDate = date('Y-m-d H:i:s');
              $tr->trans_date = $curDate;
              $tr->input_date = $curDate;
              $tr->created_by =Yii::app()->user->name;
              $tr->payment_method = 1;
              $tr->payment_status = 1;
              $tr->validate();
              if(!$tr->save())
                throw new Exception('Cannot save transaction');
              $bookCounter = numberGenerator(1);
              $infant=0;
              foreach($_POST['Booking']['ptype'] as $key=>$p){
                $pass = new Passenger;
                $pass->first_name = isset($_POST['Booking']['first_name'][$key]) ? $_POST['Booking']['first_name'][$key]: '';
                $pass->last_name = isset($_POST['Booking']['last_name'][$key]) ? $_POST['Booking']['last_name'][$key] :'';
                $pass->age = isset($_POST['Booking']['age'][$key]) ? $_POST['Booking']['age'][$key]:'';
                if(!$pass->save())
                  throw new Exception('Cannot save passanger');
                $nb = new Booking;
	        $counter =  numberGenerator(2);
	        $series =   numberGenerator(4,0);
                $nb->tkt_no = $counter;
                $nb->booking_no = $bookCounter;
                $nb->voyage = $_POST['Booking']['voyage'];
                $nb->status = 2;
                $nb->rate = $rate[$p];
                $nb->transaction = $tr->id;
                $nb->type = 2;
                if($p==5)
                  $infant++;
                else
                  $nb->seat =  $available_seats[$key-$infant];
                $nb->passenger = $pass->id;
                $nb->tkt_serial = $series-1;
                if(!$nb->save())
                  throw new Exception('Cannot save Booking');

              }
              $transaction->commit();
              Yii::app()->user->setFlash('info', "Transaction Complete! <br>Total Amount: $total_amt ");
              $this->redirect(array("QuickTicket/index&bn=$nb->booking_no"));
            }catch(Exception $e){
              $transaction->rollback();
              throw new CHttpException(400,$e);
              $this->refresh();
            }
         
       }

       if($vid){
         $sql = "SELECT count(*) cnt,s.seating_class FROM booking b,seat s,booking_status bs WHERE s.id=b.seat AND b.voyage  ={$vid} AND b.status=bs.id GROUP BY s.seating_class";
         $bs_per_class= Yii::app()->db->createCommand($sql)->queryAll();
         $voyage = Voyage::model()->findByPk($vid);
         $booking = new Booking;
       }else{
         $voyages = Voyage::model()->findAll(array('condition'=>"departure_date = CURDATE() AND status < 3"));
       }
       $this->render('index',array('data'=>array('voyages'=>$voyages,'voyage'=>$voyage,'booking'=>$booking,'bn'=>$bn,'bs_pc'=>$bs_per_class,'sn'=>$sn)));
     }
    public function actionSeriesNumber(){
       $value=isset($_POST['value']) ? $_POST['value'] :'';
       $series = Counter::model()->findByPk(4);
       $old = $series->counter;
       $series->counter=$value;
       $error;
       if($series->save()){
         $value = $series->counter;
       }else{
         $value = $old;
         $error=1;
       }
       echo json_encode(compact('value','error'));
    }
  }
