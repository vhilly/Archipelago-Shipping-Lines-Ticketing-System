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
          'actions'=>array('index','admin','create','edit','update','dailyRevenue','inspection'),
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
      if(isset($_POST['Report'])){
        $model->attributes=$_POST['Report'];
        if($model->validate()){
          $sql = "SELECT ves.name vessel,ves.id vesid, voy.name voyage,voy.id voyeid,voy.departure_date,s.name classname,s.id sclassid,count(*) count,rt.name routname,SUM(r.price) amount  FROM booking b,voyage voy,vessel ves, passage_fare_rates r,seating_class s,route rt WHERE  b.voyage=voy.id  AND b.rate=r.id AND b.seat=s.id AND  voy.vessel=ves.id AND ves.id={$model->vessel}";
          if($model->departure_date)
            $sql .= " AND voy.departure_date = '{$model->departure_date}'" ;
          else
            $sql .= " AND voy.departure_date = CURDATE()" ;
          $dR = Yii::app()->db->createCommand($sql)->queryAll();
          $this->render('dailyRevenue',array('dR'=>$dR,'sc'=>SeatingClass::model()->findAll(),'voy'=>Voyage::model()->findAll(array('condition'=>'vessel=:v','params'=>array(':v'=>$model->vessel))),'model'=>$model,'is_empty'=>0));
        }else{
          $this->render('dailyRevenue',array('is_empty'=>1,'model'=>$model));
        }

      }else{
        $this->render('dailyRevenue',array('is_empty'=>1,'model'=>$model));
      }
    }
    public function actionInspection(){
      $model=new Report;
      $voyage=new Voyage;
      $pass ='';
      $cargo ='';
      if(isset($_POST['Report'])){
        $model->attributes=$_POST['Report'];
        $voyage = Voyage::model()->findByPk($model->voyage);
        //$result = Booking::model()->findAllByAttributes(array('voyage'=>$voyage->id));
        $sql = "SELECT count(b.id) count, c.name FROM booking b,passage_fare_rates r,seating_class c where b.voyage = $voyage->id  AND r.class = c.id AND  b.rate = r.id GROUP BY r.class " ;
        $pass = Yii::app()->db->createCommand($sql)->queryAll();
        $cargo = BookingCargo::model()->findAll(array('condition'=>"voyage={$voyage->id}"));
       

      }
      $this->render('inspection',array('model'=>$model,'pass'=>$pass,'voyage'=>$voyage,'cargo'=>$cargo));
    }
  }
