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
          'actions'=>array('index','dailyRevenue','dailyRevenueBdown','inspection','tellers'),
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


          $sql = "SELECT id,name,IFNULL((SELECT SUM(amt) FROM upgrades WHERE voyage=voy.id),0) as ups from voyage voy  WHERE voy.vessel={$model->vessel}";


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

              $csql = "
                SELECT SUM(b.amt) amt FROM booking_cargo b WHERE b.voyage={$r['id']} 
              ";
              $cargo = Yii::app()->db->createCommand($csql)->queryAll();
              if(count($cargo))
               $amt3 =array_sum(array_map(function($amts3){return $amts3['amt'];},$cargo));
              else
               $amt3 =0;
              $class[3][] =$amt3; 
              $all[] = $amt+$amt1+$r['ups']+$amt3;
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
      $cntPerType=array();
      $all=array();
      if(isset($_POST['Report'])){
        $model->attributes=$_POST['Report'];
        if($model->validate()){

          $sql = "SELECT id,name,IFNULL((SELECT SUM(amt) FROM upgrades WHERE voyage=voy.id),0) as ups from voyage voy  WHERE voy.vessel={$model->vessel}";


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
              $type = array();
              $type2 = array();
              $count = array();
              $count2 = array();
              $bsql = "
                SELECT pr.type type,b.rate rate,SUM(pr.price) amt,COUNT(b.id) count FROM booking b,passage_fare_rates pr WHERE  b.voyage={$r['id']} AND b.rate=pr.id AND pr.class=1  AND b.status BETWEEN 1 AND 5 GROUP BY pr.type,b.rate
              ";
              $bs = Yii::app()->db->createCommand($bsql)->queryAll();
              if(count($bs)){
                foreach($bs as $b){
                  $amt += $b['amt'];
                  foreach($ft as $key=>$k){
                    if($key==$b['type']){
                     $type[$key]=$b['amt'];
                     $count[$key]=$b['count'];
                    }else{
                     $type[$key]=isset($type[$key])?$type[$key]:0;
                     $count[$key]=isset($count[$key])?$count[$key]:0;
                    }
                  }
                }
              }else{
               foreach($ft as $key=>$k){
                 $type[$key]=0;
                 $count[$key]=0;
               }
               $amt =0;
              }

              $class[1][] =$amt; 
              foreach($type as $key=>$t){
                $perType[1][$key][] = $t;
                $cntPerType[1][$key][] = $count[$key];
              }

              $esql = "
                SELECT pr.type type,b.rate rate,SUM(pr.price) amt,COUNT(b.id) count FROM booking b,passage_fare_rates pr WHERE  b.voyage={$r['id']} AND b.rate=pr.id AND pr.class=2  AND b.status BETWEEN 1 AND 5 GROUP BY pr.type,b.rate
              ";
              $ec = Yii::app()->db->createCommand($esql)->queryAll();
              if(count($ec)){
                foreach($ec as $c){
                  $amt1 += $c['amt'];
                  foreach($ft as $key=>$k){
                    if($key==$c['type']){
                     $type2[$key]=$c['amt'];
                     $count2[$key]=$c['count'];
                    }else{
                     $type2[$key]=isset($type2[$key])?$type2[$key]:0;
                     $count2[$key]=isset($count2[$key])?$count2[$key]:0;
                    }
                  }
                }
              }else{
               foreach($ft as $key=>$k){
                 $type2[$key]=0;
                 $count2[$key]=0;
               }
               $amt1 =0;
              }
              $class[2][] =$amt1; 
              foreach($type2 as $key=>$t){
                $perType[2][$key][] = $t;
                $cntPerType[2][$key][] = $count2[$key];
              }

              $all[] = $amt+$amt1+$r['ups'];
            }
           
          }

          $this->render('dailyRevenue',array('model'=>$model,'res'=>$res,'class'=>$class,'all'=>$all,'is_empty'=>0,'graph'=>$graph,'perType'=>$perType,'cntPerType'=>$cntPerType,'bdown'=>true));
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
    public function actionTellers($excel=null){
      $rf = new Report;
      $sc = array(1=>'BC',2=>'PE');
      $pt = array(1=>'FF',2=>'SF',3=>'SC',4=>'CHILD',5=>'INFANT',6=>'PWD',7=>'W/PASS','8'=>'Weekday',9=>'Weekday');
      $output = array();
      $total=0;
      $totalPerVoyage=array();
      if(isset($_GET['Report'])){
        $rf->attributes = $_GET['Report'];
        $rf->departure_date = $rf->departure_date ? $rf->departure_date : date('Y-m-d');
        $sql = "SELECT b.tkt_serial,r.type passenger_type,r.class seating_class,r.price amt,v.name voyage FROM booking b,voyage v,passage_fare_rates r WHERE b.voyage=v.id AND v.route=2 AND b.status < 6 AND v.departure_date ='{$rf->departure_date}'
                AND b.rate=r.id";
        $bh = Yii::app()->db->createCommand($sql)->queryAll();
        if(count($bh)){
          $i = 0;
          $tmp = null;
          $tmp2 = null;
          $cnt=1;
          $cnt2=array();
          foreach($bh as $b){
            if(is_numeric($b['tkt_serial'])){
             if($tmp2 != $b['voyage']){
               $tmp = null;
               $i=0;
             }
             $tmp2=$b['voyage'];
             $kor=$sc[$b['seating_class']].'-'.$pt[$b['passenger_type']];
             if($tmp != $kor){
               $cnt=1;
               $i++;
               $output[$b['voyage']][$i][0] = $kor;
               $output[$b['voyage']][$i][1] = $b['tkt_serial'];
               $output[$b['voyage']][$i][2] = '-';
               $output[$b['voyage']][$i][3] = '';
               $output[$b['voyage']][$i][4] = $cnt.'x';
               $output[$b['voyage']][$i][5] = $b['amt'];
               $output[$b['voyage']][$i][6] = number_format($b['amt']*$cnt);
             }else{
               $output[$b['voyage']][$i][3] = $b['tkt_serial'];
               $cnt++;
               $output[$b['voyage']][$i][4] = $cnt.'x';
               $output[$b['voyage']][$i][6] = number_format($b['amt']*$cnt);
             }
             $tmp = $kor;
           }else{
               $kor2=$sc[$b['seating_class']].'-'.$pt[$b['passenger_type']];
               @$cnt2[$kor2]++;
               $output[$b['voyage']][$kor2][0] = $kor2;
               $output[$b['voyage']][$kor2][1] = '';
               $output[$b['voyage']][$kor2][2] = '-';
               $output[$b['voyage']][$kor2][3] = '';
               $output[$b['voyage']][$kor2][4] = $cnt2[$kor2].'x';
               $output[$b['voyage']][$kor2][5] = $b['amt'];
               $output[$b['voyage']][$kor2][6] = number_format($b['amt']*$cnt2[$kor2]);
           }
           @$totalPerVoyage[$b['voyage']]+=$b['amt'];;
           $total+=$b['amt'];
          }
        }
      }
      if($excel)
        $this->renderPartial('tellers',array('data'=>compact('total','output','rf','excel','totalPerVoyage')));
      else
        $this->render('tellers',array('data'=>compact('total','output','rf','excel','totalPerVoyage')));

    }
  }
