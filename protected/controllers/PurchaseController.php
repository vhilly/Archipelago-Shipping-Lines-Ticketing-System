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


    public function actionIndex($type){

      $purchaseType = TransactionType::model()->findByPk($type);
      if(!$purchaseType)
        throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
 
      $requiredFields=array();
      $purchase=new Purchase;
      //add required field
      $purchase->addRequiredField('departureDate');
      //setup passenger
      $purchase->setPassenger($purchaseType->passenger,$purchaseType->minimum_passenger,$purchaseType->maximum_passenger);
      $purchase->setCargo($purchaseType->cargo);
      $purchase->transaction_type = $purchaseType->id;
      $purchase->payment_method = 1;
      $purchase->payment_status = 1;
      $passengers=array();
      $cargo=new Cargo;
      $fares=null;
      $tickets=array();
      $purchase->passengerTotal=$purchase->passengerMin;
      $purchase->step = isset($_POST['Purchase']['step']) ? $_POST['Purchase']['step'] : '1';


      if(isset($_POST['Purchase'])){
        $purchase->attributes=$_POST['Purchase'];
        if($purchase->validate()){
 
          if($purchase->step == 1){
            if($purchase->passenger){
              $fares = PassageFareRates::model()->findAll(array(
                'condition'=>'class=:cl',
                'params'=>array(':cl'=>$purchase->class),
              ));
              if(!$fares)
                throw new CHttpException('','Setup Passenger Fare Rate First! (under admin/settings/Passage Fare Rates)');
              
              for($count = 0;$count < $purchase->passengerTotal;$count++){
                $passengers[]= new Passenger;
                $tickets[]= new Ticket;
              }
            }
            if($purchase->cargo){
              $cargo=new Cargo;
            }
          }
          if($purchase->step==2){
              if($purchase->passenger){
                $purchase->passengerList = isset($_POST['Passenger']) ?  json_encode($_POST['Passenger']) : '';
                $purchase->ticketList    = isset($_POST['Ticket']) ?  json_encode($_POST['Ticket']) : '';
              }
              if($purchase->cargo){
                $cargo->attributes =$_POST['Cargo'];
              }
          }

          if($purchase->step==3 && ($purchase->passenger || $purchase->cargo)){
            $purchaseToken = isset($_SESSION['purchase_token']) ? $_SESSION['purchase_token']: '';
            if($purchase->hash == $purchaseToken){
              $ovamount = 0;
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
                $newTransaction->ovamount =$ovamount;
                if(!$newTransaction->save())
                  throw new Exception('Cannot save transaction');
                if($purchase->passenger){
                  $passengersList = json_decode($purchase->passengerList,1);
                  $ticketsList = json_decode($purchase->ticketList,1);
                  foreach($passengersList as $key=>$passenger){

                    $newPassenger   = new Passenger;
                    $newTicket = new Ticket;
                    $newBooking = new Booking;
                    $newPassenger->attributes=$passenger;
                    $newTicket->attributes=$ticketsList[$key];
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
                     //update overall amount
                     // $ovamount += $newTicket->price;
                  }
                }
                if($purchase->cargo){
                  $newCargoBooking = new BookingCargo;
                  $newCargoBooking->departure_date = $purchase->departureDate;
                  $newCargoBooking->transaction = $newTransaction->id;
                  $cargo->attributes =$_POST['Cargo'];
                  $cargo->voyage = $purchase->voyage;
                  if(!$cargo->save())  
                      throw new Exception('Cannot save Cargo');
                  $newCargoBooking->status = 2;
                  $newCargoBooking->cargo = $cargo->id;
                 if(!$newCargoBooking->save())  
                   throw new Exception('Cannot save Booking');


               }
               // $newTransaction->ovamount =$ovamount;
               // if(!$newTransaction->save())
                 // throw new Exception('Cannot save Booking');
                $transaction->commit();
              }catch(Exception $e){
                $transaction->rollback();
              throw new CHttpException(400,$e);
                $this->refresh();
              }
              unset($_SESSION['purchase_token']);
            }else{
              throw new CHttpException(400,'Invalid Session!');
            }
          }

          $purchase->step ++;

        }//endvalidate

      }else{
        $token = uniqid();
        $_SESSION['purchase_token'] = $token;
        $purchase->hash=$token;

      }
      $this->render('index',array('purchase'=>$purchase,'passengers'=>$passengers,'fares'=>$fares,'tickets'=>$tickets,'cargo'=>$cargo));
    }

  }
