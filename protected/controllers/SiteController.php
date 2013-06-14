<?php

  class SiteController extends Controller
  {
    /**
     * Declares class-based actions.
     */
    public function actions()
    {
      return array(
        // captcha action renders the CAPTCHA image displayed on the contact page
        'captcha'=>array(
          'class'=>'CCaptchaAction',
          'backColor'=>0xFFFFFF,
        ),
        // page action renders "static" pages stored under 'protected/views/site/pages'
        // They can be accessed via: index.php?r=site/page&view=FileName
        'page'=>array(
          'class'=>'CViewAction',
        ),
      );
    }

    public function filters()
    {
      return array(
        'accessControl', // perform access control for CRUD operations
        'postOnly + delete', // we only allow deletion via POST request
      );
    }
    public function accessRules()
    {
      return array(
        array('allow',  // allow all users to perform 'index' and 'view' actions
          'actions'=>array('index'),
          'users'=>array('*'),
        ),
        array('allow', // allow authenticated user to perform 'create' and 'update' actions
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
    public function actionIndex()
    {
		if(Yii::app()->user->isGuest){
			$this->layout = 'main';
			$this->render('index');
		}else{
                        $sql = "SELECT v.id voyid,b.status, s.name,s.color,count(*) count FROM booking b,booking_status s,voyage v WHERE b.status = s.id AND v.departure_date = CURDATE() AND s.active='Y' AND b.voyage=v.id GROUP BY b.status ";
	                $booked = Yii::app()->db->createCommand($sql)->queryAll();
                        $this->render('home',array('booked'=>$booked,'voy'=>Voyage::model()->findAll(array('condition'=>'departure_date = CURDATE()')),'bs'=>BookingStatus::model()->findAll()));
			$this->layout = 'column3';
		}
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
      if($error=Yii::app()->errorHandler->error)
      {
        if(Yii::app()->request->isAjaxRequest)
          echo $error['message'];
        else
          $this->render('error', $error);
      }
    }

    public function actionLogin()
    {
      $model=new LoginForm;

      // if it is ajax validation request
      if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
      {
        echo CActiveForm::validate($model);
        Yii::app()->end();
      }

      // collect user input data
      if(isset($_POST['LoginForm']))
      {
        $model->attributes=$_POST['LoginForm'];
        // validate user input and redirect to the previous page if valid
        if($model->validate() && $model->login())
          $this->redirect(Yii::app()->user->returnUrl);
      }
      // display the login form
      $this->render('login',array('model'=>$model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
      Yii::app()->user->logout();
      $this->redirect(Yii::app()->homeUrl);
    }



  }
