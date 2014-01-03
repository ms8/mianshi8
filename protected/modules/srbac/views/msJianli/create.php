<?php
/* @var $this MsJianliController */
/* @var $model MsJianli */

$this->breadcrumbs=array(
	'Ms Jianlis'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MsJianli', 'url'=>array('index')),
	array('label'=>'Manage MsJianli', 'url'=>array('admin')),
);
?>

<h1>Create MsJianli</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>