<?php

  class BookingCargoController extends Controller
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
          'actions'=>array('index','view','map'),
          'users'=>array('*'),
        ),
        array('allow', // allow authenticated user to perform 'create' and 'update' actions
          'actions'=>array('create','update'),
          'users'=>array('@'),
        ),
        array('allow', // allow admin user to perform 'admin' and 'delete' actions
          'actions'=>array('admin','delete','editableSaver','wBill','checkIn','board','checkInBoardForm','view'),
          'users'=>array('admin'),
        ),
        array('deny',  // deny all users
          'users'=>array('*'),
        ),
      );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id){
      if( Yii::app()->request->isAjaxRequest ){
        $this->renderPartial('view',array(
          'bookingCargo'=>$this->loadModel($id),
        ), false,false);
      }else{
        $this->render('view',array(
          'bookingCargo'=>$this->loadModel($id),
        ));
      }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
      $model=new BookingCargo;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

      if(isset($_POST['BookingCargo']))
      {
        $model->attributes=$_POST['BookingCargo'];
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

      if(isset($_POST['BookingCargo']))
      {
        $model->attributes=$_POST['BookingCargo'];
        if($model->save())
          $this->redirect(array('view','id'=>$model->id));
      }

      $this->render('update',array(
        'model'=>$model,
      ));
    }
    public function actionMap($voyage=null){
      $sql = "SELECT s.stowage, c.plate_num FROM booking_cargo s, cargo c WHERE s.cargo=c.id AND s.voyage='{$voyage}'";
      $bookedStowage = Yii::app()->db->createCommand($sql)->queryAll();
	$active = Array();
	$plate = Array();
	foreach($bookedStowage as $bst){
		$active[] = $bst['stowage'];
		$plate[$bst['stowage']]= $bst['plate_num'];
	}
	$this->render('stowage',array('active'=>$active,'plate'=>$plate));	
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

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
      $model=new BookingCargo('search');
      $model->unsetAttributes();  // clear any default values
      if(isset($_GET['BookingCargo'])){
        $model->attributes=$_GET['BookingCargo'];
      }
      $this->render('index',array(
        'model'=>$model,
      ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
      $model=new BookingCargo('search');
      $model->unsetAttributes();  // clear any default values
      if(isset($_GET['BookingCargo']))
        $model->attributes=$_GET['BookingCargo'];

      $this->render('admin',array(
        'model'=>$model,
      ));
    }
    public function actionCheckIn()
    {
      $model=new BookingCargo('search');
      $model->unsetAttributes();  // clear any default values
      $model->voyage=0;
      if(isset($_POST['BookingCargo'])){
        $model->attributes=$_POST['BookingCargo'];
      }
      $this->render('check-in',array(
        'model'=>$model,
      ));
    }
    public function actionBoard()
    {
      $model=new BookingCargo('search');
      $model->unsetAttributes();  // clear any default values
      $model->voyage=0;
      if(isset($_POST['BookingCargo'])){
        $model->attributes=$_POST['BookingCargo'];
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
        $booking = BookingCargo::model()->findByPk($id);
        $cargo = Cargo::model()->findByPk($booking->cargo);
        if($action==1)
          $booking->status = 3;
        if($action==2)
          $booking->status = 4;
        if(!$booking->save())
          $error[] =1;
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
    
    public function actionWBill()
    {
      $model=new BookingCargo('search');
      $model->unsetAttributes();  // clear any default values
      $model->voyage=0;
      if(isset($_GET['BookingCargo'])){
        $model->attributes=$_GET['BookingCargo'];
      }
      if(isset($_GET['BookingCargo']) && $_GET['print']){
        $mPDF1 = Yii::app()->ePdf->mpdf();
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A5');
        $mPDF1->WriteHTML($this->renderPartial('wbill',array(
          'model'=>$model,
          'print'=>1,
        ),true,true));
        $mPDF1->Output();
      }else{
        $this->render('wbill',array(
          'model'=>$model,
        ));
      }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
      $model=BookingCargo::model()->findByPk($id);
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
      if(isset($_POST['ajax']) && $_POST['ajax']==='booking-cargo-form')
      {
        echo CActiveForm::validate($model);
        Yii::app()->end();
      }
    }
    public function actionEditableSaver(){
      Yii::import('bootstrap.widgets.TbEditableSaver');
      $es = new TbEditableSaver('BookingCargo');
      $es->update();
    }
  }
