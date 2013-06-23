<?php


  class PrintController extends Controller{

    public function filters(){
      return array(
        'accessControl',
        'postOnly + delete',
      );
    }
    public function accessRules(){
      return array(
        array('allow',
          'actions'=>array('index'),
          'users'=>array('*'),
        ),
      );
    }

    public function actionIndex($type=null,$id=null)
    {
      switch($type){
        case 'ticket':
         if($id)
           $url = Yii::app()->createUrl('booking/view', array('type'=>$type ,'id' => $id));
           $html = $this->ticketPrint($id);
        break;
        default:
          $html = 'No Result Found!';
        break;
      }
# mPDF
	    $mPDF1 = Yii::app()->ePdf->mpdf();

# You can easily override default constructor's params
	    $mPDF1 = Yii::app()->ePdf->mpdf('', 'A5');

# render (full page)
	 //   $mPDF1->WriteHTML($this->render('index', array(), true));

# Load a stylesheet
	    $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
	    $mPDF1->WriteHTML($stylesheet, 1);

# renderPaartial (only 'view' of current controller)
	   // $mPDF1->WriteHTML($this->renderPartial('index', array('html'=>$html), true));
             
	   // $mPDF1->WriteHTML($this->renderPartial('index', array('html'=>$html), true));

# Renders image
//	    $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));

# Outputs ready PDF
	    $mPDF1->Output();

    }
    private function ticketPrint($id=null){
      $html ='';
      if($id){
        $tkt = Booking::model()->findByPk($id);
        if($tkt){
          $html = "
            {$tkt->passenger0->first_name}
            {$tkt->passenger0->last_name}
            {$tkt->rate0->price}
            {$tkt->voyage0->route0->name}
          ";
        }
      }else{
        $tkts = Booking::model()->findAll();
        foreach($tkts as $tkt){

          $html .= "
            {$tkt->passenger0->first_name}
            {$tkt->passenger0->last_name}
            {$tkt->rate0->price}
            {$tkt->voyage0->route0->name}
          ";
        }
      }
      return $html;
    }
}
