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
      $dR=array();
      $voy=array();
      $total=array();
      $vname=array();
      if(isset($_POST['Report'])){
        $model->attributes=$_POST['Report'];
        if($model->validate()){

          $sql ="SELECT sc.name,sc.id as class, voy.name as vname,ves.name vessel, b.voyage,SUM(IF(sc.id=1,1,0)) as bus,SUM(t.ovamount) ovamt,SUM(t.ovdiscount) ovdscnt ,SUM(IF(b.status=6,1,0)) refund
            FROM booking as b,transaction  as t,voyage as voy,vessel as ves ,passage_fare_rates as r,seating_class as sc
            WHERE t.id = b.transaction AND voy.id=b.voyage AND ves.id=voy.vessel AND b.rate=r.id AND sc.id=r.class AND voy.vessel={$model->vessel}";

          if($model->departure_date)
            $sql .= " AND voy.departure_date = '{$model->departure_date}'" ;
          else
            $sql .= " AND voy.departure_date = CURDATE()" ;

          $sql .= " GROUP BY b.voyage,sc.name ORDER BY b.voyage,sc.name";
          $res = Yii::app()->db->createCommand($sql)->queryAll();
          if(count($res)){
            foreach($res as $r){
              $dR[$r['class']][$r['vname']]=isset($r['ovamt']) ? $r['ovamt']:0;
              $vname[$r['vname']]=$r['vname'];
              
              $total[$r['vname']] =  isset($total[$r['vname']]) ? $total[$r['vname']]: 0;
              $total[$r['vname']]+=isset($r['ovamt'])? $r['ovamt']:0;
            }
          }
          $this->render('dailyRevenue',array('dR'=>$dR,'vname'=>$vname,'total'=>$total,'sc'=>SeatingClass::model()->findAll(),'voy'=>Voyage::model()->findAll(array('condition'=>'vessel=:v','params'=>array(':v'=>$model->vessel))),'model'=>$model,'is_empty'=>0));
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
        $sql = "SELECT SUM(IF(r.type !=7,1,0)) paying,SUM(IF(r.type =7,1,0)) pass, c.name FROM booking b,passage_fare_rates r,seating_class c where b.voyage = $voyage->id AND b.status=4 AND r.class = c.id AND  b.rate = r.id GROUP BY r.class " ;
        $pass = Yii::app()->db->createCommand($sql)->queryAll();
        $cargo = BookingCargo::model()->findAll(array('condition'=>"voyage={$voyage->id}"));
       

      }
      $this->render('inspection',array('model'=>$model,'pass'=>$pass,'voyage'=>$voyage,'cargo'=>$cargo));
    }
  }
