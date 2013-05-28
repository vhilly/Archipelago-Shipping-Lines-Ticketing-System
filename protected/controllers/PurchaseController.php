<?php
  class PurchaseController extends Controller{

    public function filters(){
      return array(
        'accessControl',
        'postOnly + delete',
      );
    }
    public function accessRules(){
      return array(
        array('allow',
          'actions'=>array('index'),
          'users'=>array('*'),
        ),
      );
    }
    public function actionIndex(){

      $purchase=new Purchase;
      $passengers=array();
      $forTransact=array();
      $JSONforTransact='';
      $fares=null;
      $tickets=array();
      $purchase->passengerTotal=0;
      $purchase->step = isset($_POST['Purchase']['step']) ? $_POST['Purchase']['step'] : '1';



      if(isset($_POST['Purchase'])){

        $purchase->attributes=$_POST['Purchase'];
        if($purchase->validate()){
          if($purchase->step == 1){
            $fares = PassageFareRates::model()->findAll(array(
              //'select'=>'title',
              'condition'=>'class=:cl',
              'params'=>array(':cl'=>$purchase->class),
            ));
            if($purchase->passengerTotal && $fares){
              for($count = 0;$count < $purchase->passengerTotal;$count++){
                $passengers[]= new Passenger;
                $tickets[]= new Ticket;
              }
            }
          }

          if($purchase->step==2){
              $forTransact['passenger'] = isset($_POST['Passenger']) ?  $_POST['Passenger'] : '';
              $forTransact['ticket']    = isset($_POST['Ticket']) ?  $_POST['Ticket'] : '';
              $JSONforTransact = json_encode($forTransact);
          }
          if($purchase->step==3){
            $purchaseToken = isset($_SESSION['purchase_token']) ? $_SESSION['purchase_token']: '';
            if($purchase->hash == $purchaseToken){
              $data = json_decode($_POST['forTransact'],1);
              $transaction = Yii::app()->db->beginTransaction();
              try{
                   $newTransaction = new Transaction;
                   $newTransaction->payment_method =1;
                   $newTransaction->payment_status =1;
                   $newTransaction->uid =1;
                   $newTransaction->type =1;
                   $curDate = date('Y-m-d H:i:s');
                   $newTransaction->trans_date = $curDate;
                   $newTransaction->input_date = $curDate;
                   $newTransaction->ovamount =100;
                   try{
                     $newTransaction->save();
                   }catch(Exception $e){
                      throw new Exception($e);
                   }
                foreach($data['passenger'] as $key=>$passenger){
                   $newPassenger   = new Passenger;
                   $newTicket = new Ticket;
                   $newBooking = new Booking;
                   $newPassenger->attributes=$passenger;
                   $newTicket->attributes=$data['ticket'][$key];
                   $newTicket->voyage = $purchase->voyage;
                   $newBooking->departure_date = $purchase->departureDate;
                   $newBooking->transaction = $newTransaction->id;
                 //saving
                   if(!$newPassenger->save())
                    throw new Exception('Cannot save passanger');
                   if(!$newTicket->save())
                    throw new Exception('Cannot save ticket');
                   $newBooking->ticket = $newTicket->id;
                   $newBooking->passenger = $newPassenger->id;
                   $newBooking->status = 2;
                   if(!$newBooking->save())
                    throw new Exception('Cannot save Booking');
                }
                $transaction->commit();
              }catch(Exception $e){
                $transaction->rollback();
                $this->refresh();
              }
              unset($_SESSION['purchase_token']);
            }else{
              die();
            }
          }
          $purchase->step ++;
        }
      }else{
        $token = uniqid();
        $_SESSION['purchase_token'] = $token;
        $purchase->hash=$token;

      }
          $this->render('index',array('purchase'=>$purchase,'passengers'=>$passengers,'fares'=>$fares,'tickets'=>$tickets,'JSONforTransact'=>$JSONforTransact));
    }
  }
