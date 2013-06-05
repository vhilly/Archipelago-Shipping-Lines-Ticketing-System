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
          'actions'=>array('index','admin','create','edit','update','dailyRevenue'),
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
    public function actionDailyRevenue(){
      $model=new Report;
      $model->addRequiredField(array('departure_date','vessel'));
      if(isset($_POST['Report'])){
        $model->attributes=$_POST['Report'];
        if($model->validate()){
          $sql = "SELECT ves.name vessel,ves.id vesid, voy.name voyage,voy.id voyeid,voy.departure_date,s.name classname,s.id sclassid,count(*) count,rt.name routname,SUM(r.price) amount  FROM booking b,ticket t,voyage voy,vessel ves, passage_fare_rates r,seating_class s,route rt WHERE b.ticket = t.id AND t.voyage = voy.id AND voy.vessel = ves.id AND t.rate =r.id  AND r.class = s.id  AND voy.route=rt.id AND ves.id={$model->vessel} AND voy.departure_date = '{$model->departure_date}'  GROUP BY ves.id,voy.id,s.id ";
	  $dR = Yii::app()->db->createCommand($sql)->queryAll();
          $this->render('dailyRevenue',array('dR'=>$dR,'sc'=>SeatingClass::model()->findAll(),'voy'=>Voyage::model()->findAll(array('condition'=>'vessel=:v','params'=>array(':v'=>$model->vessel))),'model'=>$model,'is_empty'=>0));
        }else{
         $this->render('dailyRevenue',array('is_empty'=>1,'model'=>$model));
        }
       
      }else{
        $this->render('dailyRevenue',array('is_empty'=>1,'model'=>$model));
      }
    }
  }
