<?php

  class BookingController extends Controller
  {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
      return array(
        'accessControl', // perform access control for CRUD operations
      );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
      return array(
        array('allow',  // allow all users to perform 'index' and 'view' actions
          'actions'=>array('index','view'),
          'users'=>array('*'),
        ),
        array('allow', // allow authenticated user to perform 'create' and 'update' actions
          'actions'=>array('editableSaver','transfer','transferForm','bpass','checkIn','board','checkInBoardForm','relational','tkt','manifest','reader','admin','refund','quickBoard','cancel'),
          'users'=>array('@'),
        ),
        array('allow', // allow admin user to perform 'admin' and 'delete' actions
          'actions'=>array('admin','delete','create','update'),
          'users'=>array('admin'),
        ),
        array('deny',  // deny all users
          'users'=>array('*'),
        ),
      );
    }
    
    public function actionView($id){
      if( Yii::app()->request->isAjaxRequest ){
        $this->renderPartial('view',array(
          'booking'=>$this->loadModel($id),
        ), false,false);
      }else{
        $this->render('view',array(
          'booking'=>$this->loadModel($id),
        ));
      }
    }
    public function actionBpass()
    {
      $model=new Booking('printSearch');
      $model->unsetAttributes();  // clear any default values
      $model->first_name = isset($_GET['Booking']['first_name']) ? $_GET['Booking']['first_name'] : '';
      $model->last_name = isset($_GET['Booking']['last_name']) ? $_GET['Booking']['last_name'] : '';
      $model->voyage=0;
      $model->status=3;
      if(isset($_GET['Booking'])){
        $model->attributes=$_GET['Booking'];
      }
      if(isset($_GET['Booking']) && $_GET['print']){
	//$mPDF1 = Yii::app()->ePdf->mpdf();
	//$mPDF1 = Yii::app()->ePdf->mpdf('', 'A5');
        // $mPDF1->WriteHTML($this->renderPartial('bpass',array(
        // 'model'=>$model,
        // 'print'=>1,
        //),true,true));
        $this->renderPartial('bpass',array(
          'model'=>$model,
          'print'=>1,
        ));
      }else{
        $this->render('bpass',array(
          'model'=>$model,
        ));
      }
    }
   
    public function actionTkt()
    {
      $model=new Booking('printSearch');
      $model->unsetAttributes();  // clear any default values
      $model->first_name = isset($_GET['Booking']['first_name']) ? $_GET['Booking']['first_name'] : '';
      $model->last_name = isset($_GET['Booking']['last_name']) ? $_GET['Booking']['last_name'] : '';
      $model->voyage=0;
      if(isset($_GET['Booking'])){
        $model->attributes=$_GET['Booking'];
      }
      if(isset($_GET['Booking']) && $_GET['print']){
        $this->renderPartial('tkt',array(
          'model'=>$model,
          'print'=>1,
        ));
      }else{
        $this->render('tkt',array(
          'model'=>$model,
        ));
      }
    }
   
    public function actionManifest()
    {
      $model=new Booking('printSearch');
      $model->unsetAttributes();  // clear any default values
      $model->voyage=0;
      $model->status<5;
      if(isset($_GET['Booking'])){
        $model->attributes=$_GET['Booking'];
      }
      if(isset($_GET['Booking']) && $_GET['print']){
/*
	$mPDF1 = Yii::app()->ePdf->mpdf();
	$mPDF1 = Yii::app()->ePdf->mpdf('', 'Legal');
        $mPDF1->WriteHTML($this->renderPartial('mfst',array(
          'model'=>$model,
          'print'=>1,
        ),true,true));
	$mPDF1->Output();
*/
        $this->renderPartial('mfst',array(
          'model'=>$model,
          'print'=>1,
        ));
      }else{
        $this->render('mfst',array(
          'model'=>$model,
        ));
      }
    }
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
      $model=new Booking;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

      if(isset($_POST['Booking']))
      {
        $model->attributes=$_POST['Booking'];
        if($model->save())
          $this->redirect(array('view','id'=>$model->id));
      }

      $this->render('create',array(
        'model'=>$model,
      ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
      $model=$this->loadModel($id);

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

      if(isset($_POST['Booking']))
      {
        $model->attributes=$_POST['Booking'];
        if($model->save())
          $this->redirect(array('view','id'=>$model->id));
      }

      $this->renderPartial('update',array(
        'model'=>$model,
      ),false,true);
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
      if(Yii::app()->request->isPostRequest)
      {
// we only allow deletion via POST request
        $this->loadModel($id)->delete();

// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
          $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
      }
      else
        throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }
    public function actionRefund($id)
    {
        $booking = $this->loadModel($id);
        $booking->status=6;
        $booking->seat=NULL;
        $refund = new RefundedTkts;
        $refund->attributes = $booking->attributes;
        if($booking->save()){ 
          $refund->save();
            Yii::app()->user->setFlash('success', 'Ticket Refunded!');
        }
        $this->redirect(array('index'));
    }
    public function actionCancel($id)
    {
        $booking = $this->loadModel($id);
        $booking->status=7;
        $booking->seat=NULL;
        if($booking->save()){ 
            Yii::app()->user->setFlash('success', 'Booking Canceled');
        }
        $this->redirect(array('index'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {

      $model=new Booking('search');
      $model->unsetAttributes();  // clear any default values
      if(isset($_GET['Booking'])){
        $model->attributes=$_GET['Booking'];
      }
      $this->render('index',array(
        'model'=>$model,
      ));
    }

    public function actionTransfer($booking_no=null)
    {
       $model = new Booking;
       $forTransfer ='';
       if($booking_no && !isset($_POST['Booking']))
         $_POST['Booking']['booking_no'] = $booking_no;
       if(isset($_POST['Booking'])){
        $model->attributes = $_POST['Booking'];
        if($model->booking_no || $model->tkt_no)
         $forTransfer =  $model->findAllByAttributes(
           array(),
           $condition  = 'booking_no = :bn',
           $params     = array(
             ':bn' => $model->booking_no, 
           )
         );
       }
       $this->render('transfer',array('model'=>$model,'forTransfer'=>$forTransfer));
    }

  public function actionQuickBoard(){
      $model=new Booking;
      if(isset($_GET['Booking'])){
        $tkt_no = isset($_GET['Booking']['tkt_no']) ? $_GET['Booking']['tkt_no'] : null;
        if($tkt_no){
          $booking = Booking::model()->findByAttributes(array('tkt_no'=>$tkt_no));
          if($booking && $booking->status == 3){
            $booking->status=4;
            if($booking->save()){
              Yii::app()->user->setFlash('success', "<b>{$booking->passenger0->first_name} {$booking->passenger0->last_name} with Ticket No. {$booking->tkt_no}<br> </b>Successfully Boarded!");
            }else{
              Yii::app()->user->setFlash('error', "Fatal Error! Please Contact Your Administrator");
            }
          }else{
            $status = isset($booking->status) ? $booking->status : 0;
            $msg = $status == 4 ? " {$booking->passenger0->first_name} {$booking->passenger0->last_name} with Ticket No. {$booking->tkt_no}<br>is already boarded" :
             "Unable to board passenger! <br> Make sure Ticket No. is valid and the passenger already checked-in!";
            Yii::app()->user->setFlash('error', $msg);
          }
        }
          $this->redirect(array('booking/quickBoard'));
      }
      $this->render('quickBoard',array('model'=>$model));
  }



public function actionAdmin()
{
$model=new Booking('search');
$model->unsetAttributes();  // clear any default values
if(isset($_GET['Booking']))
$model->attributes=$_GET['Booking'];

$this->render('admin',array(
'model'=>$model,
));
}

    public function actionReader()
    {
      //$this->layout = 'kios';
      if(isset($_GET['Booking'])){
        $pass = isset($_SESSION['checklist']) ? $_SESSION['checklist'] : Array();
        $add = isset($_GET['Booking']['tkt_no']) ? $_GET['Booking']['tkt_no'] : "";
        array_push($pass,$add);
        $_SESSION['checklist'] = $pass;
        $ids = implode("','",$pass);
      }else{
        $pass = Array();
        unset($_SESSION['checklist']);
        $ids = "";
      }

      $model=new Booking;
      if(isset($_GET['print'])){
        $ids = isset($_GET['ids']) ? $_GET['ids'] : null;
      }
      if(isset($_GET['Booking']) || isset($_GET['print'])){
        $sql = "SELECT cs.name as class,r.name as route,v.departure_date,v.departure_time,v.arrival_time,b.voyage,b.tkt_no,b.tkt_no,p.first_name, p.last_name, v.name as voyage, s.name as seat FROM booking b, passenger p, voyage v, seat s, route r,seating_class cs WHERE cs.id=s.seating_class AND r.id=v.route AND p.id=b.passenger AND b.tkt_no IN ('{$ids}') AND b.voyage=v.id AND b.seat=s.id";
        $data = Yii::app()->db->createCommand($sql);
        $pass = $data->queryAll();
      }
      if(isset($_GET['success'])){      
	Yii::app()->user->setFlash('success', "Check-In Successful!");
      }
      if(isset($_GET['print'])){
        $sql = "UPDATE booking SET status=3 WHERE tkt_no IN ('{$ids}')";
        $cin = Yii::app()->db->createCommand($sql);
	$chk = $cin->query();
        
/*	$mPDF1 = Yii::app()->ePdf->mpdf('',array(50.8,101.6));
	$mPDF1->WriteHTML($this->render('reader',array('model'=>$model,'passenger'=>$pass,'ids'=>$ids, "imageProvider"=>$arrayImage),true));
	$content_PDF = $mPDF1->Output('',EYiiPdf::OUTPUT_TO_STRING);
	$im = new Imagick();
	$im->readImageBlob($content_pdf);
	//$im->setIteratorIndex(0);
	$im->setResolution(800,600);
	$im->setImageFormat("jpeg");
	header("Content-Type: image/jpeg");
	echo $im->getImage();
*/
/*
        $mPDF1 = Yii::app()->ePdf->mpdf('',array(50.8,101.6));
        //$mPDF1 = Yii::app()->ePdf->mpdf('',array(100.8,151.6));
        $mPDF1->WriteHTML($this->renderPartial('reader',array(
          'passenger'=>$pass,
          'print'=>1,
	  'ids'=>$ids,
        ),true,true));
        $mPDF1->Output();
*/
	      $this->renderPartial('reader',array('passenger'=>$pass,'print'=>1,'ids'=>$ids,));
}
      else
        $this->render('reader',array('model'=>$model,'passenger'=>$pass,'ids'=>$ids,));
    }
    public function actionCheckIn()
    {
      $model=new Booking('printSearch');
      $model->unsetAttributes();  // clear any default values
      $model->voyage=0;
      if(isset($_POST['Booking'])){
        $model->attributes=$_POST['Booking'];
        $model->first_name = isset($_POST['Booking']['first_name']) ? $_POST['Booking']['first_name'] : '';
        $model->last_name = isset($_POST['Booking']['last_name']) ? $_POST['Booking']['last_name'] : '';
      }
      $this->render('check-in',array(
        'model'=>$model,
      ));
    }
    public function actionBoard()
    {
      $model=new Booking('printSearch');
      $model->unsetAttributes();  // clear any default values
      $model->first_name = isset($_POST['Booking']['first_name']) ? $_POST['Booking']['first_name'] : '';
      $model->last_name = isset($_POST['Booking']['last_name']) ? $_POST['Booking']['last_name'] : '';
      $model->voyage=0;
      if(isset($_POST['Booking'])){
        $model->attributes=$_POST['Booking'];
      }
      $this->render('board',array(
        'model'=>$model,
      ));
    }
    public function actionCheckInBoardForm(){
      $id = isset($_POST['id']) ? $_POST['id'] : '';
      $action = isset($_POST['action']) ? $_POST['action'] : '';
      $error=array();
      if($id){
        $booking = Booking::model()->findByPk($id);
        $passenger = Passenger::model()->findByPk($booking->passenger);
        if($passenger->validate()){
           if($action==1)
             $booking->status = 3;
           if($action==2)
             $booking->status = 4;
           if(!$booking->save())
             $error[] =1;
        }else{
            $error = array_values($passenger->getErrors());
        }
      }


      if( Yii::app()->request->isAjaxRequest ){
        echo json_encode(array('error'=>count($error) ? $error: null));
      }else{
        $this->render('_formCheckIn',array(
          'error'=>$error,
          'booking'=>$booking,
        ));
      }
    }
    public function actionTransferForm($id,$ref=null){
      $model=$this->loadModel($id);
      
      if(isset($_POST['Booking'])){
          $model->attributes = $_POST['Booking'];
          $model->status=1;
          if($model->save()){
            if($ref=='cIN'){
              Yii::app()->user->setFlash('success', "Seat Transfer Successful!");
              $this->redirect(array('booking/checkin','booking_no'=>$model->booking_no));
            }else{
              Yii::app()->user->setFlash('success', 'Booking Transfer Successful!');
              $this->redirect(array('booking/transfer','booking_no'=>$model->booking_no));
            }
          }
      }
      
      if( Yii::app()->request->isAjaxRequest )
       $this->renderPartial('_transferForm',array('model'=>$model,'ref'=>$ref),false,false);
      else
       $this->render('_transferForm',array('model'=>$model,'ref'=>$ref));
    }
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
      $model=Booking::model()->findByPk($id);
      if($model===null)
        throw new CHttpException(404,'The requested page does not exist.');
      return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
      if(isset($_POST['ajax']) && $_POST['ajax']==='booking-form')
      {
        echo CActiveForm::validate($model);
        Yii::app()->end();
      }
    }
    public function actionEditableSaver(){
      Yii::import('bootstrap.widgets.TbEditableSaver');
      $es = new TbEditableSaver('Booking');
      $es->update();
    }

  }
