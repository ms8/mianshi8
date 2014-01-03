<?php
/* @var $this MsJianliController */
/* @var $model MsJianli */

$this->breadcrumbs=array(
	'Ms Jianlis'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MsJianli', 'url'=>array('index')),
	array('label'=>'Create MsJianli', 'url'=>array('create')),
	array('label'=>'View MsJianli', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MsJianli', 'url'=>array('admin')),
);
?>

<h1>Update MsJianli <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>