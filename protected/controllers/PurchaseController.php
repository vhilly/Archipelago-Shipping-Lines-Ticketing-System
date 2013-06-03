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
      $passengers=array();
      $cargo=new Cargo;
      $fares=null;
      $tickets=array();
      $seatings=array();
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
                $passengers[]=new Passenger;
                $tickets[]=new Ticket;
                $seatings[]=new SeatTicketMap;
              }
            }
            if($purchase->cargo){
              $cargo=new Cargo;
            }
          }
          if($purchase->step==2){
              $purchase->payment_method = 1;
              if($purchase->passenger){
                $purchase->passengerList = isset($_POST['Passenger']) ?  json_encode($_POST['Passenger']) : '';
                $purchase->ticketList    = isset($_POST['Ticket']) ?  json_encode($_POST['Ticket']) : '';
                $purchase->seatingList    = isset($_POST['SeatTicketMap']) ?  json_encode($_POST['SeatTicketMap']) : '';
                $prices = array_map(function ($ar) {return $ar['price'];},$_POST['Ticket']);
                $purchase->payment_total = array_sum($prices);
              }
              if($purchase->cargo){
                $cargo->attributes =$_POST['Cargo'];
                $purchase->payment_total += $purchase->cargoPrice;
              }
          }

          if($purchase->step==3 && ($purchase->passenger || $purchase->cargo)){
            $purchaseToken = isset($_SESSION['purchase_token']) ? $_SESSION['purchase_token']: '';
            if($purchase->hash == $purchaseToken){
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
                if(!$newTransaction->save())
                  throw new Exception('Cannot save transaction');
                if($purchase->passenger){
                  $passengersList = json_decode($purchase->passengerList,1);
                  $ticketsList = json_decode($purchase->ticketList,1);
                  $seatingList = json_decode($purchase->seatingList,1);
                  foreach($passengersList as $key=>$passenger){

                    $newPassenger   = new Passenger;
                    $newTicket = new Ticket;
                    $newBooking = new Booking;
                    $newSeatMap = new SeatTicketMap;
                    $newPassenger->attributes=$passenger;
                    $newTicket->attributes=$ticketsList[$key];
                    $newSeatMap->attributes=$seatingList[$key];
                    $newTicket->voyage = $purchase->voyage;
                    $newBooking->departure_date = $purchase->departureDate;
                    $newBooking->transaction = $newTransaction->id;
                    $purchase->trNo = $newTransaction->id;
                    //saving
                    if(!$newPassenger->save())
                      throw new Exception('Cannot save passanger');
                    if(!$newTicket->save())
                      throw new Exception('Cannot save ticket');
                    $newSeatMap->ticket = $newTicket->id;
                    $newBooking->ticket = $newTicket->id;
                    $newBooking->passenger = $newPassenger->id;
                    $newBooking->status = $purchase->payment_status == 1? 2 : 1;//set booking status to paid if payment is completed else reserved
                    if(!$newBooking->save())  
                      throw new Exception('Cannot save Booking');
                    if(!$newSeatMap->save())  
                      throw new Exception('Cannot save Seating');
                     //update overall amount
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
                $transaction->commit();
                Yii::app()->user->setFlash('success', 'Transaction Complete!');
		//$this->redirect(array('transaction/view','id'=>$newTransaction->id));
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
      $this->render('index',array('purchase'=>$purchase,'passengers'=>$passengers,'fares'=>$fares,'tickets'=>$tickets,'cargo'=>$cargo,'seatings'=>$seatings));
    }

  }
