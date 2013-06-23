<?php

  class WaybillController extends Controller
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
          'actions'=>array('create','update'),
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

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
      if( Yii::app()->request->isAjaxRequest )
      {
        $this->renderPartial('view',array(
          'wayBill'=>$this->loadModel($id),
        ), false, false);
      }
      else
      {
        $this->render('view',array(
          'wayBill'=>$this->loadModel($id),
        ));
      }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
      $model=new Waybill;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

      if(isset($_POST['Waybill']))
      {
        $model->attributes=$_POST['Waybill'];
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

      if(isset($_POST['Waybill']))
      {
        $model->attributes=$_POST['Waybill'];
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

          $wayBillView = array();
          $sql = "SELECT bc.booking_no bkNo,bc.lading_no wbNo,c.shipper,c.company,c.destination,c.address,cc.name class,c.article_no,c.article_desc,c.weight,c.length,c.contact, ves.name vname, r.from loading ,r.to discharge, cf.lane_meter_rate rate,cf.proposed_tariff fcharge FROM booking_cargo bc,cargo c,voyage v,cargo_fare_rates cf,cargo_class cc,vessel ves,route r  WHERE bc.cargo=c.id AND bc.voyage=v.id AND bc.rate=cf.id  AND c.cargo_class=cc.id AND v.vessel=ves.id AND v.route=r.id";
          if($model->voyage) $sql .=" AND v.id='{$model->voyage}'";
          if($model->departure_date) $sql .=" AND v.departure_date='{$model->departure_date}'";
          if($model->wbNo) $sql .=" AND bc.lading_no LIKE '%{$model->wbNo}'";

         // $sql .=" ORDER BY tktno";
          $wayBillView = Yii::app()->db->createCommand($sql)->queryAll();
          $this->render('index',array('wayBillView'=>$wayBillView,'model'=>$model,'is_empty'=>0));
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
      $model=new Waybill('search');
      $model->unsetAttributes();  // clear any default values
      if(isset($_GET['Waybill']))
        $model->attributes=$_GET['Waybill'];

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
      $model=Waybill::model()->findByPk($id);
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
      if(isset($_POST['ajax']) && $_POST['ajax']==='wayBill-form')
      {
        echo CActiveForm::validate($model);
        Yii::app()->end();
      }
    }
  }
