
        <div class="right5">
        	<div class="right51">


            	<a href="<?php echo Yii::app()->createUrl('xiaozu'); ?>"   <?php if($this->getAction()->getId()=='index'){?> class="a2" <?php }else{?> class="a3"<?php } ?>>我的话题</a>
                <a href="<?php echo Yii::app()->createUrl('xiaozu/mytopic'); ?>"  <?php if($this->getAction()->getId()=='mytopic'){?> class="a2" <?php }else{?> class="a3"<?php } ?>>我发起的话题</a>
                <a href="<?php echo Yii::app()->createUrl('xiaozu/repliedtopics'); ?>"  <?php if($this->getAction()->getId()=='repliedtopics'){?> class="a2" <?php }else{?> class="a3"<?php } ?> >我回应的话题</a>
                <a href="<?php echo Yii::app()->createUrl('xiaozu/mine'); ?>" <?php if($this->getAction()->getId()=='mine'){?> class="a2" <?php }else{?> class="a3"<?php } ?> >我<?php if(XiaozuController::$member->groupCount>0){?>管理/<?php }?>加入的小组</a>
            </div>
            <div class="right52">
            	常去的小组
            </div>
            <div class="right53">
                <?php foreach ( XiaozuController::oftenGo() as $key => $value) {?>
                     <a title="<?php echo $value->name ?>" href="<?php echo Yii::app()->createUrl('xiaozu/detail',array('id'=>$value->id)); ?>"><img style="width:48px; height:48px;" src="<?php echo $value->imgLink; ?>" /></a>
                <?php } ?>
               
            </div>
            <div class="right54">
            	<a href="<?php echo Yii::app()->createUrl('xiaozu/apply'); ?>">+申请创建小组</a>
               
            </div>
        </div>
