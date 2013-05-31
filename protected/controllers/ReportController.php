<?php
  class ReportController extends Controller{

    public function filters(){
      return array(
        'accessControl',
        'postOnly + delete',
      );
    }
    public function accessRules(){
      return array(
        array('allow',
          'actions'=>array(''),
          'users'=>array('*'),
        ),
        array('allow',
          'actions'=>array(''),
          'users'=>array('@'),
        ),
        array('allow', // allow admin user to perform 'admin' and 'delete' actions
          'actions'=>array('index','admin','create','edit','update'),
          'users'=>array('admin'),
        ),
        array('deny',  // deny all users
          'users'=>array('*'),
        ),
      );
    }
    public function actionIndex(){

          $this->render('index');
    }
  }
