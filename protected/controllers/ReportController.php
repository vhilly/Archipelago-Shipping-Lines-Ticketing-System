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
          'actions'=>array('index','dailyRevenue','dailyRevenueBdown','inspection'),
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
    public function actionDailyRevenue($graph=null){
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
              $bsql = "
                SELECT b.rate rate,SUM(pr.price) amt,COUNT(b.id) count FROM booking b,passage_fare_rates pr WHERE  b.voyage={$r['id']} AND b.rate=pr.id AND pr.class=1  AND b.status BETWEEN 1 AND 5 GROUP BY b.rate
              ";
              $bs = Yii::app()->db->createCommand($bsql)->queryAll();
              if(count($bs)){
               $amt =array_sum(array_map(function($amts){return $amts['amt'];},$bs));
              }
              else{
               $amt =0;
              }
              $class[1][] =$amt; 

              $esql = "
                SELECT b.rate rate,SUM(pr.price) amt,COUNT(b.id) count FROM booking b,passage_fare_rates pr WHERE  b.voyage={$r['id']} AND b.rate=pr.id AND pr.class=2  AND b.status BETWEEN 1 AND 5 GROUP BY b.rate
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

          $this->render('dailyRevenue',array('model'=>$model,'res'=>$res,'class'=>$class,'all'=>$all,'is_empty'=>0,'graph'=>$graph,'bdown'=>false));
        }else{
          $this->render('dailyRevenue',array('is_empty'=>1,'model'=>$model));
        }

      }else{
        $this->render('dailyRevenue',array('is_empty'=>1,'model'=>$model));
      }
    }
    public function actionDailyRevenueBdown($graph=null){
      $model=new Report;
      $dR=array();
      $voy=array();
      $total=array();
      $vname=array();
      $class=array();
      $type=array();
      $type1=array();
      $perType=array();
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
            $ft = CHtml::listData(PassageFareTypes::model()->findAll(),'id','name');
            foreach($res as $r){
              $amt = 0;
              $amt1 = 0;
              $bsql = "
                SELECT pr.type type,b.rate rate,SUM(pr.price) amt,COUNT(b.id) count FROM booking b,passage_fare_rates pr WHERE  b.voyage={$r['id']} AND b.rate=pr.id AND pr.class=1  AND b.status BETWEEN 1 AND 5 GROUP BY pr.type,b.rate
              ";
              $bs = Yii::app()->db->createCommand($bsql)->queryAll();
              if(count($bs)){
                foreach($bs as $b){
                  $amt += $b['amt'];
                  foreach($ft as $key=>$k){
                    if($key==$b['type'])
                     $type[$key]=$b['amt'];
                    else
                     $type[$key]=isset($type[$key])?$type[$key]:0;
                  }
                }
              }else{
               $amt =0;
              }

              $class[1][] =$amt; 
              foreach($type as $key=>$t){
                $perType[1][$key][] = $t;
              }

              $esql = "
                SELECT pr.type type,b.rate rate,SUM(pr.price) amt,COUNT(b.id) count FROM booking b,passage_fare_rates pr WHERE  b.voyage={$r['id']} AND b.rate=pr.id AND pr.class=2  AND b.status BETWEEN 1 AND 5 GROUP BY pr.type,b.rate
              ";
              $ec = Yii::app()->db->createCommand($esql)->queryAll();
              if(count($ec)){
                foreach($ec as $c){
                  $amt1 += $c['amt'];
                  foreach($ft as $key1=>$k1){
                    if($key1==$c['type'])
                     $type[$key1]=$c['amt'];
                    else
                     $type[$key1]=isset($type[$key1])?$type[$key1]:0;
                  }
                }
              }else{
               $amt1 =0;
              }
              $class[2][] =$amt1; 


              $all[] = $amt+$amt1;
            }
           
          }

          $this->render('dailyRevenue',array('model'=>$model,'res'=>$res,'class'=>$class,'all'=>$all,'is_empty'=>0,'graph'=>$graph,'perType'=>$perType,'bdown'=>true));
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
