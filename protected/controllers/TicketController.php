<?php

  class TicketController extends Controller
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
          'actions'=>array('create','update','admin','index'),
          'users'=>array('@'),
        ),
        array('allow', // allow admin user to perform 'admin' and 'delete' actions
          'actions'=>array('delete','setup'),
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
    public function actionView($id)
    {
      if( Yii::app()->request->isAjaxRequest )
      {
        $this->renderPartial('view',array(
          'ticket'=>$this->loadModel($id),
        ), false, false);
      }
      else
      {
        $this->render('view',array(
          'ticket'=>$this->loadModel($id),
        ));
      }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
      $model=new Ticket;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

      if(isset($_POST['Ticket']))
      {
        $model->attributes=$_POST['Ticket'];
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

      if(isset($_POST['Ticket']))
      {
        $model->attributes=$_POST['Ticket'];
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
    public function actionIndex()
    {
      $model=new Report;
      if(isset($_POST['Report'])){
        $model->attributes=$_POST['Report'];

        if($model->validate()){

          $ticketView = array();
          $sql = "SELECT b.tkt_no tktNo,p.first_name,p.last_name,r.type,c.name class, r.price,b.status,
	v.name voy,rt.name rou,v.departure_time vdt,v.arrival_time vat,s.name sea
        FROM booking b,passenger p,passage_fare_rates r,seating_class c,
	voyage v, route rt,seat s
        WHERE b.passenger=p.id AND b.rate=r.id AND b.seat=s.id AND r.class=c.id ";
          if($model->voyage) $sql .=" AND v.id='{$model->voyage}'";
          if($model->departure_date) $sql .=" AND v.departure_date='{$model->departure_date}'";
          if($model->tktNo) $sql .=" AND b.tkt_no='{$model->tktNo}'";

         // $sql .=" ORDER BY tktno";
          $ticketView = Yii::app()->db->createCommand($sql)->queryAll();
          $this->render('index',array('ticketView'=>$ticketView,'model'=>$model,'is_empty'=>0));
        }
        else{
          $this->render('index',array('is_empty'=>1,'model'=>$model));
        }
      }
      else{
        $this->render('index',array('is_empty'=>1,'model'=>$model));
      }
    }
    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
      $model=new Ticket('search');
      $model->unsetAttributes();  // clear any default values
      if(isset($_GET['Ticket']))
        $model->attributes=$_GET['Ticket'];

      $this->render('admin',array(
        'model'=>$model,
      ));
    }
  public function actionSetup(){
   $fares = new PassageFareRates();
   $fares->makeRequired('active,class,type,route');
   $fareTypes = new PassageFareTypes;

   $faresTable = new PassageFareRates('search');
   $faresTable->unsetAttributes();  // clear any default values
   if(isset($_GET['PassageFareRates'])){
     $faresTable->attributes=$_GET['PassageFareRates'];
   }

   $fareTypesTable = new PassageFareTypes('search');
   $fareTypesTable->unsetAttributes();  // clear any default values
   if(isset($_GET['PassageFareTypes'])){
     $fareTypesTable->attributes=$_GET['PassageFareTypes'];
   }

   if(isset($_POST['PassageFareRates'])){
     $fares->attributes=$_POST['PassageFareRates'];
     if($fares->save())
          $this->redirect(array('setup'));
   }

   if(isset($_POST['PassageFareTypes'])){
     $fareTypes->attributes=$_POST['PassageFareTypes'];
     if($fareTypes->save())
          $this->redirect(array('setup'));
   }
   $this->render('setup',array(
     'fare'=>$fares,
     'faresTable'=>$faresTable,
     'fareTypes'=>$fareTypes,
     'fareTypesTable'=>$fareTypesTable,
   ));
  }

/**

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
      $model=Ticket::model()->findByPk($id);
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
      if(isset($_POST['ajax']) && $_POST['ajax']==='ticket-form')
      {
        echo CActiveForm::validate($model);
        Yii::app()->end();
      }
    }
  }
