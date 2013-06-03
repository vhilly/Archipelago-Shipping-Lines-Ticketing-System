<?php

class TransactionController extends Controller
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
'actions'=>array(''),
'users'=>array('*'),
),
array('allow', // allow authenticated user to perform 'create' and 'update' actions
'actions'=>array('create','update','view','index'),
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
  $this->layout = 'none';
  $trans = $this->loadModel($id);
  $Cargos = array();
  $Tickets = array();
  $transType = TransactionType::model()->findByPk($trans->type);
  if($transType->cargo =='Y'){
    $sql = "SELECT c.id,c.shipper,c.company,c.contact,cl.class,cl.proposed_tariff amount,c.article_no,c.article_desc,c.weight,c.length FROM booking_cargo b,cargo c,cargo_class cl WHERE b.transaction={$trans->id} AND b.cargo=c.id AND cl.id=c.cargo_class";
    $Cargos = Yii::app()->db->createCommand($sql)->queryAll();
  }
  if($transType->passenger =='Y'){
    $sql = "SELECT t.id tktno,p.first_name,p.last_name,r.type,c.name class, r.price FROM booking b,passenger p,
           ticket t,passage_fare_rates r,seating_class c WHERE b.transaction={$trans->id} 
           AND b.passenger=p.id AND b.ticket=t.id AND t.rate=r.id AND r.class = c.id";
    $Tickets = Yii::app()->db->createCommand($sql)->queryAll();
  }

   if( Yii::app()->request->isAjaxRequest )
   {
      $this->renderPartial('view',array(
         'trans'=>$trans,'Cargos'=>$Cargos,'Tickets'=>$Tickets
        ), false, false);
    }
    else
    {
      $this->render('view',array(
        'trans'=>$trans,'Cargos'=>$Cargos,'Tickets'=>$Tickets
      ));
    }

}

/**
* Creates a new model.
* If creation is successful, the browser will be redirected to the 'view' page.
*/
public function actionCreate()
{
$model=new Transaction;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

if(isset($_POST['Transaction']))
{
$model->attributes=$_POST['Transaction'];
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

if(isset($_POST['Transaction']))
{
$model->attributes=$_POST['Transaction'];
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

		$model=new Transaction('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Transaction'])){
			$model->attributes=$_GET['Transaction']; 
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
$model=new Transaction('search');
$model->unsetAttributes();  // clear any default values
if(isset($_GET['Transaction']))
$model->attributes=$_GET['Transaction'];

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
$model=Transaction::model()->findByPk($id);
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
if(isset($_POST['ajax']) && $_POST['ajax']==='transaction-form')
{
echo CActiveForm::validate($model);
Yii::app()->end();
}
}

  public function getTN($id){
    return str_pad($id,11,'0',STR_PAD_LEFT);
  }
}

