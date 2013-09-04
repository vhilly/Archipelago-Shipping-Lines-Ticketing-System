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
          'actions'=>array('index'),
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
              $bookCounter = $this->numberGenerator(1);
              foreach($_POST['Booking']['ptype'] as $p){
                $pass = new Passenger;
                if(!$pass->save())
                  throw new Exception('Cannot save passanger');
                $nb = new Booking;
	        $counter = $this->numberGenerator(2);
                $nb->tkt_no = str_pad($counter,6,'0',STR_PAD_LEFT);
                $nb->booking_no = str_pad($bookCounter,6,'0',STR_PAD_LEFT);
                $nb->voyage = $_POST['Booking']['voyage'];
                $nb->status = 1;//set booking status to paid if payment is completed else reserved
                $nb->rate = $rate[$p];
                $nb->transaction = $tr->id;
                $nb->type = 1;
                $nb->passenger = $pass->id;
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
         $voyage = Voyage::model()->findByPk($vid);
         $booking = new Booking;
       }else{
         $voyages = Voyage::model()->findAll(array('condition'=>"departure_date = CURDATE() AND status < 3"));
       }
       $this->render('index',array('data'=>array('voyages'=>$voyages,'voyage'=>$voyage,'booking'=>$booking,'bn'=>$bn)));
     }
    public function numberGenerator($type){
      $countBooking = Counter::model()->findByPk($type);
      $countBooking->saveCounters(array('counter'=>1));
      $countBooking->save();
      return $countBooking->counter;
    }
  }
