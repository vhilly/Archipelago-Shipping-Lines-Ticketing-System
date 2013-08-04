<?php

class FeesController extends Controller
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
'actions'=>array('create','update','pay'),
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
public function actionPay($type){
  $fee = MiscFees::model()->findByPk($type);
  $model = new PaidMiscFees;
  if(isset($_POST['PaidMiscFees']) && $_POST['type']){
    $model->misc_fee = $fee->id;
    $model->amt = $fee->amt;
    $model->type = $fee->type;
    if($model->save()){
      Yii::app()->user->setFlash('success', 'Transaction Complete!');
      $this->redirect(array('pay','type'=>$type));
    }
  }
  $this->render('pay',array('fee'=>$fee,'type'=>$type,'model'=>$model));
}

/**
* Performs the AJAX validation.
* @param CModel the model to be validated
*/
protected function performAjaxValidation($model)
{
if(isset($_POST['ajax']) && $_POST['ajax']==='fee-form')
{
echo CActiveForm::validate($model);
Yii::app()->end();
}
}
}
