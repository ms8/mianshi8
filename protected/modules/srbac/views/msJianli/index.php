<?php
/* @var $this MsJianliController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ms Jianlis',
);

$this->menu=array(
	array('label'=>'Create MsJianli', 'url'=>array('create')),
	array('label'=>'Manage MsJianli', 'url'=>array('admin')),
);
?>

<h1>Ms Jianlis</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
