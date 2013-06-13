<?php
  $this->renderPartial('_fareTypeForm',array('fareTypes'=>$fareTypes,'fareTypesTable'=>$fareTypesTable));
  $this->renderPartial('_fareForm',array('fare'=>$fare,'faresTable'=>$faresTable));
?>
