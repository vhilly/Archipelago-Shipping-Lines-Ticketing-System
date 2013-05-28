<?php
$this->breadcrumbs=array(
	'Seating Classes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SeatingClass','url'=>array('index')),
	array('label'=>'Manage SeatingClass','url'=>array('admin')),
);
?>

<h1>Create SeatingClass</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>