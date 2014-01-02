
    <div class="con clear">
        <div class="top3a" style="height: 55px;">
            <h1 class="fl">招聘会详情</h1>
        </div>
        <div class="left2">
            <div class="leftxa">
                <div class="lxat">
                    招聘会时间：<?php echo $this->zph->activity_date ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    地址： <?php echo $this->zph->activity_address?>
                </div>
            </div>

            <div class="huatilist" style="margin-top: 30px;">

                <div class="huatilist1">
                    <div class="huatilist2">招聘职位详情</div>
                </div>

                <?php echo $this->zph->description; ?>
            </div>
      
        </div>
        <!-- 发现小组右侧 -->
        <?php $this->renderPartial('_explore_right',array('tagSelected'=>$tagSelected)); ?>
        
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