    <div class="top3">
    	我发起的小组话题
    </div>
	<div class="con clear">
    	<div class="left2">
        	<div class="ad1">
            	<a href="http://www.mianshi8.com"><img src="<?php echo  Yii::app()->baseUrl.IMAGES_PATH; ?>ad1.jpg" /></a>
            </div>
            <div class="left3">
               <?php foreach ($model as $key => $value) {?>
                   <div class="left31">
                    <div class="left32"><a href="<?php echo $value->link; ?>"><?php  echo $value->title ?></a></div>
                    <div class="left33"><?php echo $value->response_num  ?>回应</div>
                    <div class="left34"><?php echo Helper::getTime($value->create_time)  ?></div>
                    <div class="left35"><a href="<?php echo Yii::app()->createUrl('xiaozu/detail',array('id'=>$value->gid)); ?>"><?php echo $value->groupOne->name ?></a></div>
                   </div>        
               <?php } ?>

          
            	
               
            </div>
        </div>
        <!-- 我的小组右侧 -->
        <?php $this->renderPartial('_group_right'); ?>
    </div>