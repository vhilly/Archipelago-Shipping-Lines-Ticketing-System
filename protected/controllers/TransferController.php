<?php
  class TransferController extends Controller{

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
          'actions'=>array('index',),
          'users'=>array('admin'),
        ),
        array('deny',  // deny all users
          'users'=>array('*'),
        ),
      );
    }
    public function actionIndex(){
      
      $voyage = new Voyage;
      $bookingFrom = array();

      if(isset($_POST['Voyage'])){
        $voyageFrom = Voyage::model()->findByPk($_POST['Voyage']['id']);
        $sql = "SELECT count(id) totalPass FROM booking b WHERE b.voyage = {$voyageFrom->id}  AND b.seat IS NOT NULL";
        $bookingFrom = Yii::app()->db->createCommand($sql)->queryAll();
      }
      $this->render('index',array('voyage'=>$voyage));
    }
  }
