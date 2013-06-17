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
          'actions'=>array('create','update','editableSaver','transfer','transferForm','bpass','checkin'),
          'users'=>array('@'),
        ),
        array('allow', // allow admin user to perform 'admin' and 'delete' actions
          'actions'=>array('admin','delete'),
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
      $model=new Report;
      if(isset($_POST['Report'])){
        $model->attributes=$_POST['Report'];

        if($model->validate()){
          $boardingPassView = array();
          $sql = "SELECT b.booking_no,b.tkt_no tktNo,CONCAT(p.first_name, ' ',p.last_name) as name,c.name class,
	v.name voy,v.departure_date FROM booking b,passenger p,passage_fare_rates r,seating_class c,
	voyage v
        WHERE b.passenger=p.id AND b.rate=r.id  AND r.class=c.id AND b.voyage=v.id  AND b.status=3 ";
          if($model->voyage) 
            $sql .=" AND v.id='{$model->voyage}'";
          if($model->departure_date) 
            $sql .=" AND v.departure_date='{$model->departure_date}'";
          if($model->tktNo) 
            $sql .=" AND b.tkt_no='{$model->tktNo}'";
         // $sql .=" ORDER BY tktno";
          $boardingPassView = Yii::app()->db->createCommand($sql)->queryAll();
          $this->render('bpass',array('boardingPassView'=>$boardingPassView,'model'=>$model,'is_empty'=>0));
        }
        else{
          $this->render('bpass',array('is_empty'=>1,'model'=>$model));
        }
      }
      else{
        $this->render('bpass',array('is_empty'=>1,'model'=>$model));
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

    public function actionCheckin()
    {
       $model = new Booking;
       $passenger='';
       $error = array();
       if(isset($_POST['Booking'])){
         $model->attributes = $_POST['Booking'];
         $forCheckin = $model->findByAttributes(
           array(),
           $condition  = 'tkt_no = :tn',
           $params     = array(
             ':tn' => $model->tkt_no,
           )
         );
         if(isset($forCheckin->passenger) && $forCheckin->status != 3){
           $passenger = Passenger::model()->findByPk($forCheckin->passenger);
           if(!$passenger->first_name)
             $error[] = 'First Name';
           if(!$passenger->last_name)
             $error[] = 'Last Name';
           if(!$passenger->address)
             $error[] = 'Address';
           if(!$passenger->birth_date)
             $error[] = 'Birth Date';
           if(!$passenger->contact)
             $error[] = 'Contact No.';
           
           if(count($error))
            Yii::app()->user->setFlash('error', 'Please complete the following details: <br>'.implode(',',$error));

           if(isset($_POST['check']) && !count($error)){
             $forCheckin->status =3;
             if($forCheckin->save()){
               Yii::app()->user->setFlash('success', 'Check-In Successful!');
             }
           }
         }else{
               Yii::app()->user->setFlash('info', 'Already Checked In!');
         }
       }
       $this->render('checkin',array('model'=>$model,'passenger'=>$passenger,'error'=>count($error)));
    }
    public function actionTransferForm($id){
      $model=$this->loadModel($id);
      
      if(isset($_POST['Booking'])){
          $model->attributes = $_POST['Booking'];
          if($model->save()){
            Yii::app()->user->setFlash('success', 'Booking Transfer Successful!');
            $this->redirect(array('booking/transfer','booking_no'=>$model->booking_no));
          }
      }
          
      if( Yii::app()->request->isAjaxRequest )
       $this->renderPartial('_transferForm',array('model'=>$model),false,false);
      else
       $this->render('_transferForm',array('model'=>$model));
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
