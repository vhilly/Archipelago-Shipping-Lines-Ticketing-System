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

    public function actionIndex()
    {

# mPDF
	    $mPDF1 = Yii::app()->ePdf->mpdf();

# You can easily override default constructor's params
	    $mPDF1 = Yii::app()->ePdf->mpdf('', 'A5');

# render (full page)
	    $mPDF1->WriteHTML($this->render('index', array(), true));

# Load a stylesheet
	    $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
	    $mPDF1->WriteHTML($stylesheet, 1);

# renderPartial (only 'view' of current controller)
	    $mPDF1->WriteHTML($this->renderPartial('index', array(), true));

# Renders image
	    $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));

# Outputs ready PDF
	    $mPDF1->Output();

    }
