
<div class="top3">
    我的简历
</div>
<div class="mynav">
    <a <?php if($this->action->id == 'info'){ ?>class="bai"<?php } ?> href="<?php echo $this->createUrl('/kongjian/info'); ?>">基本设置</a>
    <a <?php if($this->action->id == 'changepwd'){ ?>class="bai"<?php } ?> href="<?php echo $this->createUrl('/kongjian/changepwd'); ?>">修改密码</a>
    <a <?php if($this->action->id == 'jianli'){ ?>class="bai"<?php } ?> href="<?php echo $this->createUrl('/kongjian/jianli'); ?>">我的简历</a>
    <a <?php if($this->action->id == 'myscore'){ ?>class="bai"<?php } ?> href="<?php echo $this->createUrl('/kongjian/myscore'); ?>">我的积分</a>
</div>


    <div class="con clear">
        <?php if($jianlis != null && count($jianlis)>0){?>
        <div class="left2">
            <div class="huatilist" style="margin-top: 30px;">
                <div class="huatilist1">
                        <div class="huatilist2" style="width: 280px">简历</div>
                        <div class="huatilist3" style="width: 170px">修改时间</div>
                        <div class="huatilist4" style="width: 240px">备注</div>
                </div>
                <?php foreach ($jianlis as $key => $value) {?>
                    <div class="huatilist1">
                        <div class="huatilist2" style="width: 280px">
                            <a href="<?php echo Yii::app()->createUrl('kongjian/jianlidownload',array('id'=>$value->id)); ?>">
                                <?php  echo $value->name ?>
                            </a>
                        </div>
                        <div class="huatilist3"  style="width: 170px">
                            <?php  echo $value->updatetime ?>
                        </div>
                        <div class="huatilist4"  style="width: 240px">
                            <?php  echo $value->description ?>
                        </div>
                    </div>
                <?php  }  ?>
            </div>
        </div>

        <?php }else{?>
            <div class="top3">
                你还没上传简历哦~速度上传简历吧~我们免费帮您投递~
            </div>
        <?php
        } if($message != null && $message != ''){ ?>
            <h3 style="color:red"><?php echo $message?></h3>
        <?php
          }?>
        <form action="?r=kongjian/jianliupload" method="post" enctype="multipart/form-data">
            <label for="jianlifile">上传简历</label><input type="file" name="jianlifile">
            <input id="jianliSubmit" type="submit" value="上传简历">
        </form>
        <!-- 发现小组右侧 -->
        <?php //$this->renderPartial('_explore_right',array('tagSelected'=>$tagSelected)); ?>
        
    </div>

<?php if(Yii::app()->user->isGuest){?>
<script>
    $('.addGroup').click(function(){
        var r=confirm("您尚未登陆，是否登陆？");
        if(r){
            location.href = "<?php echo Yii::app()->createUrl('public/login'); ?>"; 
        }else{
            return false;
        }
        return false;
    });
</script>

<?php }else{?>
<script>
    $('.addGroup').click(function(){
       var gid  = $.trim($(this).attr('id'));
       var mid  = <?php echo Yii::app()->user->id; ?>;
       var node =$(this);
           if(gid!='' && mid!=''){
                $.ajax({
                type: "POST",
                url: "<?php echo Yii::app()->createUrl('/group/add'); ?>",
                dataType:'json',
                data: "gid="+gid+"&mid="+mid,
                success: function(data){
                  if(data.status==1){
                    node.parent().html(' √已加入');
                    return false;
                  }else{
                    alert(data.info);
                    return false;
                  }
                }
              });
           }else{
                return false;
           }


    });
</script>

<?php } ?>