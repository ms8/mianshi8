<?php
/* @var $this MsJianliController */
/* @var $model MsJianli */

$this->breadcrumbs=array(
	'Ms Jianlis'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List MsJianli', 'url'=>array('index')),
	array('label'=>'Create MsJianli', 'url'=>array('create')),
	array('label'=>'Update MsJianli', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MsJianli', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MsJianli', 'url'=>array('admin')),
);
?>

<h1>View MsJianli #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'userId',
		'filepath',
		'description',
		'createtime',
		'updatetime',
	),
)); ?>
