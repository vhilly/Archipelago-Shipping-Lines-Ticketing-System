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
    public function actionDailyRevenue($date=null){
          $date = $date ? "'$date'" : 'CURDATE()';
          $sql = "SELECT ves.name vessel,ves.id vesid, voy.name voyage,voy.id voyeid,b.departure_date,s.name classname,s.id sclassid,count(*) count,rt.name routname,SUM(r.price) FROM booking b,ticket t,voyage voy,vessel ves, passage_fare_rates r,seating_class s,route rt WHERE b.ticket = t.id AND t.voyage = voy.id AND voy.vessel = ves.id AND t.rate =r.id  AND r.class = s.id  AND voy.route=rt.id AND b.departure_date = {$date}  GROUP BY ves.id,voy.id,s.id ";
	  $dR = Yii::app()->db->createCommand($sql)->queryAll();
          $this->render('dailyRevenue',array('dR'=>$dR));
    }
  }
