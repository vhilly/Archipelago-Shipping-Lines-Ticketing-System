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
          'actions'=>array('index','dailyRevenue','inspection'),
          'users'=>array('@'),
        ),
        array('allow', // allow admin user to perform 'admin' and 'delete' actions
          'actions'=>array('admin','create','edit','update'),
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
      $class=array();
      $all=array();
      if(isset($_POST['Report'])){
        $model->attributes=$_POST['Report'];
        if($model->validate()){





          $sql = "SELECT id,name from voyage voy  WHERE voy.vessel={$model->vessel}";


          if($model->departure_date)
            $sql .= " AND voy.departure_date = '{$model->departure_date}'" ;
          else
            $sql .= " AND voy.departure_date = CURDATE() " ;



          $res = Yii::app()->db->createCommand($sql)->queryAll();

          if(count($res)){
            foreach($res as $r){
              $bsql = "SELECT tr.ovamount amt
                FROM booking b,transaction tr,passage_fare_rates pr
                WHERE tr.id=b.transaction AND b.voyage={$r['id']} AND b.rate=pr.id AND pr.class=1
                GROUP BY tr.id,tr.ovamount
              ";
              $bs = Yii::app()->db->createCommand($bsql)->queryAll();
              if(count($bs))
               $amt =array_sum(array_map(function($amts){return $amts['amt'];},$bs));
              else
               $amt =0;
              $class[1][] =$amt; 

              $esql = "SELECT tr.ovamount amt
                FROM booking b,transaction tr,passage_fare_rates pr
                WHERE tr.id=b.transaction AND b.voyage={$r['id']} AND b.rate=pr.id AND pr.class=2
                GROUP BY tr.id,tr.ovamount
              ";
              $ec = Yii::app()->db->createCommand($esql)->queryAll();
              if(count($ec))
               $amt1 =array_sum(array_map(function($amts1){return $amts1['amt'];},$ec));
              else
               $amt1 =0;
              $class[2][] =$amt1; 
              $all[] = $amt+$amt1;
            }
          }

          $this->render('dailyRevenue',array('model'=>$model,'res'=>$res,'class'=>$class,'all'=>$all,'is_empty'=>0));
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
