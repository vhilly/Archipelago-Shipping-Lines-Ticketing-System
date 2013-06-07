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

      if(isset($_POST['Purchase']) && $_SESSION['nonce'] == $_POST['nonce']){

        $purchaseFrm=new Purchase;
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
            $purchase->seatTicketMapModels=array();
            $purchase->ticketModels=array();
          }
          if($purchase->current_step ==2){

            $purchase->passengerTotal = $purchaseFrm->passengerTotal;
            $purchase->voyage = $purchaseFrm->voyage;
            $purchase->class = $purchaseFrm->class;

            if($purchase->passenger){

              $fares = PassageFareRates::model()->findAll(array(
                'condition'=>'class=:cl',
                'params'=>array(':cl'=>$purchase->class),
              ));
              if(!$fares)
                throw new CHttpException('','Setup Passenger Fare Rate First! (under admin/settings/Passage Fare Rates)');
              $purchase->fares = $fares;
              if(!count($purchase->passengerModels)){
                for($count = 0;$count < $purchase->passengerTotal;$count++){
                  $purchase->passengerModels[] = new Passenger;
                  $purchase->seatTicketMapModels[] = new SeatTicketMap;
                  $purchase->ticketModels[] = new Ticket;
                }
              }
            }
            if($purchase->cargo){
              if(!count($purchase->cargoModel))
                $purchase->cargoModel[] = new Cargo;
            }
          }
          if($purchase->current_step ==3){
            $passengerList = isset($_POST['Passenger']) ? $_POST['Passenger'] : array();
            $ticketList = isset($_POST['Ticket']) ? $_POST['Ticket'] : array();
            $seatList = isset($_POST['SeatTicketMap']) ? $_POST['SeatTicketMap'] : array();
            $cargoList = isset($_POST['Cargo']) ? $_POST['Cargo'] : array();
            $cargoAmnt =0;
            $tktAmnt =0;
            if(count($passengerList)){
              $purchase->passengerModels=array();
              $purchase->seatTicketMapModels=array();
              $purchase->ticketModels=array();

              foreach($passengerList as $key=>$p){
                $pass = new Passenger;
                $tkt = new Ticket;
                $seatMap = new SeatTicketMap;

                $tkt->voyage =$purchase->voyage;
                $seatMap->ticket = 1; //dummy tkt id

                $pass->attributes = $p;
                $tkt->attributes = $ticketList[$key];
                $seatMap->attributes = $seatList[$key];
                $purchase->passengerModels[]=$pass;
                $purchase->ticketModels[]=$tkt;
                $purchase->seatTicketMapModels[]=$seatMap;

                if(!$tkt->validate())
                  $purchase->current_step =2;

                if(!$seatMap->validate())
                  $purchase->current_step =2;


              }
              $prices = array_map(function ($ar) {return $ar['price'];},$ticketList);
              $tktAmnt += array_sum($prices);
            }
            if(count($cargoList)){
              $purchase->cargoModel=array();
              foreach($cargoList as $c){
                $cargo = new Cargo;
                $cargo->attributes = $c;
                $cargo->voyage = $purchase->voyage;
                $purchase->cargoModel[] = $cargo;
                if(!$cargo->validate())
                  $purchase->current_step =2;

              }
              $prices2 = array_map(function ($ar) {return $ar['cargoPrice'];},$cargoList);
              $cargoAmnt += array_sum($prices2);

            }

            $purchase->payment_total = $tktAmnt+$cargoAmnt;
            $purchase->payment_method = 1;//default is cash
          }
          if($purchase->current_step ==4){
            $passengerList = isset($_POST['Passenger']) ? $_POST['Passenger'] : array();
            $ticketList = isset($_POST['Ticket']) ? $_POST['Ticket'] : array();
            $seatList = isset($_POST['SeatTicketMap']) ? $_POST['SeatTicketMap'] : array();
            $cargoList = isset($_POST['Cargo']) ? $_POST['Cargo'] : array();
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

              if(!$newTransaction->save())
                throw new Exception('Cannot save transaction');
              if(count($passengerList)){

                foreach($passengerList as $key=>$passenger){
                  $newPassenger   = new Passenger;
                  $newTicket = new Ticket;
                  $newBooking = new Booking;
                  $newSeatMap = new SeatTicketMap;
                  $newPassenger->attributes=$passenger;
                  $newTicket->attributes=$ticketList[$key];
                  $newSeatMap->attributes=$seatList[$key];
                  $newTicket->voyage = $purchase->voyage;
                  $newBooking->transaction = $newTransaction->id;
                  $purchase->transaction_no = $newTransaction->id;
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
              if(count($cargoList)){
                foreach($cargoList as $c){
                  $cargo = new Cargo;
                  $cargo->attributes = $c;
                  $newCargoBooking = new BookingCargo;
                  $newCargoBooking->transaction = $newTransaction->id;
                  $newCargoBooking->status = $purchase->payment_status == 1? 2 : 1;
                  $cargo->voyage = $purchase->voyage;
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

        $purchase=new Purchase;
        $purchase->current_step=1;
        $purchase->setPassenger($purchaseType->passenger,$purchaseType->minimum_passenger,$purchaseType->maximum_passenger);
        $purchase->setCargo($purchaseType->cargo);
        $purchase->transaction_type = $purchaseType->id;
        $_SESSION['Purchase'] = $purchase;

      }
      unset($_SESSION['nonce']);
      $this->render('index',array('purchase'=>$purchase));
    }
  }