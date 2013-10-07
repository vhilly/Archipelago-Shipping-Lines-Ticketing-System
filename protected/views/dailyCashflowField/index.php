<?php
  $fields=array();
  foreach($data as $v){
    if($v->parent)
      $fields['child'][$v->parent][]=$v->name;
    else
      $fields['parent'][$v->id]=$v->name;
  }
?>
<table>
  <?php foreach($fields['parent'] as $k=>$v):?>
    <tr>
      <th><?=$v?></th>
    </tr>
    <tr><td><?= @implode('</td></tr><tr><td>',$fields['child'][$k]);?></td></tr>
  <?php endforeach;?>
</table>


<?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'inverse','buttonType'=>'link','icon'=>'plus',
  'url'=>Yii::app()->createUrl('dailyCashflowField/create'),'label'=>'Add Field')) ?>;
<?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'primary','buttonType'=>'link','icon'=>'',
  'url'=>Yii::app()->createUrl('dailyCashflowField/admin'),'label'=>'Manage Fields')) ?>;
