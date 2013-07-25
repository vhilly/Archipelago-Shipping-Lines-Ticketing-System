<?php

  class SeatController extends Controller
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
          'actions'=>array('admin','delete','editableSaver','setup','lock'),
          //'users'=>array('admin'),
          'users'=>array('@'),
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
    public function actionView($id)
    {
      $this->render('view',array(
        'model'=>$this->loadModel($id),
      ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
      $model=new Seat;

      // Uncomment the following line if AJAX validation is needed
      // $this->performAjaxValidation($model);

      if(isset($_POST['Seat']))
      {
        $model->attributes=$_POST['Seat'];
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

      if(isset($_POST['Seat']))
      {
        $model->attributes=$_POST['Seat'];
        if($model->save())
          $this->redirect(array('view','id'=>$model->id));
      }

      $this->render('update',array(
        'model'=>$model,
      ));
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

    public function actionMap($voyage=null)
    {
	//comment
      $list= Seat::model()->findAll();
      //$sql = "SELECT s.name FROM booking b, seat s WHERE s.id=b.seat AND b.voyage='{$voyage}'";
      //$bookedSeats = Yii::app()->db->createCommand($sql)->queryAll();
      $bookedSeats = Booking::model()->findAll(array('condition'=>"voyage = $voyage AND seat IS NOT NULL"));
      $lockedSeats = SeatLock::model()->findAll(array('condition'=>"voyage = {$voyage}"));
      $apr = Array();
      $pl = Array();
      foreach($bookedSeats as $bs){
        $apr[] = $bs->seat0->name;
      }
      foreach($lockedSeats as $ls){
        $apr[] = $ls->seat0->name;
      }
      foreach($list as $bl){
        $pl[$bl['name']] = $bl['id'];
      }
      $pres = Array();
      $this->render('map',array('apr'=>$apr,'pres'=>$pres,'id'=>$pl,'voyage'=>$voyage));
    }
    public function actionLock($sid,$voyage,$index){
      $cBy = Yii::app()->user->name;
      $sl =  SeatLock::model()->findByAttributes(array('vsid'=>$voyage.'-'.$sid));
      if($sl)
        die();
      $sql = "INSERT INTO seat_lock (voyage,seat,vsid,row_index,created_by) VALUES ('{$voyage}', '{$sid}', '{$voyage}-{$sid}','{$index}','$cBy') on duplicate key update seat={$sid},vsid='{$voyage}-{$sid}'";
      try{
        Yii::app()->db->createCommand($sql)->query();
        echo true;
      }catch(Exception $e){
        echo false;
      }
      
    }
    public function actionIndex()
    {
      $model=new Report;
      $model->addRequiredField(array('voyage'));
      if(isset($_POST['Booking'])){
        $booking =  Booking::model()->findByPk($_POST['Booking']['id']);
        $seatNo = $booking->seat0->name;
        $booking->seat =NULL;
        $booking->status =5;
        if($booking->save())
          Yii::app()->user->setFlash('success', "Seat No. $seatNo is now available!");
        else
          Yii::app()->user->setFlash('error', 'Unable to make seat available! Please contact your administrator.');
        $_POST['Report']['voyage']=$booking->voyage;
      }
      if(isset($_POST['Report'])){
        $model->attributes=$_POST['Report'];
        if($model->validate()){
          $booking = new Booking;
          $seatList= Seat::model()->findAll();
          $sql = "SELECT s.id,bs.color, b.id bookid,s.name FROM booking b,seat s,booking_status bs WHERE s.id=b.seat AND b.voyage  ={$model->voyage} AND b.status=bs.id";
          $bookedSeats= Yii::app()->db->createCommand($sql)->queryAll();
          $this->render('index',array('seatList'=>$seatList,'bookedSeats'=>$bookedSeats,'booking'=>$booking,'model'=>$model,'is_empty'=>0));
        }else{
          $this->render('index',array('is_empty'=>1,'model'=>$model));
        }
      }else{
        $this->render('index',array('is_empty'=>1,'model'=>$model));
      }
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
      $model=new Seat('search');
      $model->unsetAttributes();  // clear any default values
      if(isset($_GET['Seat']))
        $model->attributes=$_GET['Seat'];

      $this->render('admin',array(
        'model'=>$model,
      ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
      $model=Seat::model()->findByPk($id);
      if($model===null)
        throw new CHttpException(404,'The requested page does not exist.');
      return $model;
    }

  public function actionSetup(){
   $seat = new Seat;
   $seatClass = new SeatingClass;

   $seatsTable=new Seat('search');
   $seatClassTable=new SeatingClass('search');

   $seatsTable->unsetAttributes();  // clear any default values
   $seatClassTable->unsetAttributes();  // clear any default values

   if(isset($_GET['Seat'])){
     $seatsTable->attributes=$_GET['Seat'];
   }


   if(isset($_GET['SeatingClass'])){
     $seatClassTable->attributes=$_GET['SeatingClass'];
   }

   if(isset($_POST['Seat'])){
     $seat->attributes=$_POST['Seat'];
     if($seat->save())
          $this->redirect(array('setup'));
   }

   if(isset($_POST['SeatingClass'])){
     $seatClass->attributes=$_POST['SeatingClass'];
     if($seatClass->save())
        $this->redirect(array('setup'));
   }

   $this->render('setup',array(
     'seatClass'=>$seatClass,
     'seatClassTable'=>$seatClassTable,
     'seat'=>$seat,
     'seatsTable'=>$seatsTable,
   ));
  }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
      if(isset($_POST['ajax']) && $_POST['ajax']==='seat-form')
      {
        echo CActiveForm::validate($model);
        Yii::app()->end();
      }
    }

    public function actionEditableSaver(){
      Yii::import('bootstrap.widgets.TbEditableSaver');
      $es = new TbEditableSaver('Seat');
      $es->update();
    }

    public function seatMapAjaxLink($name,$id){
      return CHtml::ajaxLink($name,array('booking/view','id'=>$id),
        array('type'=>'POST','success'=>'function(data){ $("#ticketModal .modal-body p").html(data); $("#ticketModal").modal();  }')
      );
    }
  }
