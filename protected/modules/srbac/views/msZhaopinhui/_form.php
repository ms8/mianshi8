<?php
/* @var $this MsZhaopinhuiController */
/* @var $model MsZhaopinhui */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ms-zhaopinhui-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

<!--	<div class="row">-->
<!--		--><?php ////echo $form->labelEx($model,'activity_date'); ?>
		<?php //echo $form->textField($model,'activity_date'); ?>
<!--		--><?php ////echo $form->error($model,'activity_date'); ?>
<!--	</div>-->
    <?php echo $form->labelEx($model,'activity_date');
    $this->widget('application.extensions.timepicker.timepicker', array(
        'model'=>$model,
        'name'=>'activity_date',
    ));
    ?>


    <div class="row">
		<?php echo $form->labelEx($model,'activity_address'); ?>
		<?php echo $form->textField($model,'activity_address',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'activity_address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

<!--    --><?php //echo $form->labelEx($model,'createtime');
//    $this->widget('application.extensions.timepicker.timepicker', array(
//        'model'=>$model,
//        'name'=>'createtime',
//    ));
//    ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->