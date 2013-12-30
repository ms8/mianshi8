<style type="text/css">
    #wrapper {
        clear: both;
        background-color: #fff;
        height: 280px;
        overflow: hidden;
        position: relative;
    }
    .wrapperIn{
        float: left;
        width: 320px;;
    }
    #carousel img {
        display: block;
        float: left;
    }
    #prev, #next {
        background-color: rgba(255, 255, 255, 0.7);
        display: block;
        height: 450px;
        width: 50%;
        top: 0;
        position: absolute;
    }
    #prev:hover, #next:hover {
        background-color: #fff;
        background-color: rgba(255, 255, 255, 0.8);
    }
    #prev {
        left: -250px;
    }
    #next {
        right: -250px;
    }
    #pager {
        margin-left: 0px;
        position: absolute;
        top: 200px;
        bottom: 10px;
        width:640px;
        /*background-color: #95a5a6;*/
        /*background-image: linear-gradient(30deg, #dce6d2, #003333 );*/
        /*opacity: 0.7;*/
        padding: 10px 0 ;;
    }
    #pager a {
        border: 3px solid #5c809c;
        border-radius: 10px;
        display: inline-block;
        width: 10px;
        height: 10px;
        margin: 0 5px 0 0;
        background-color: #dce6d2;
    }
    #pager a:hover {
        background-color: rgba(244, 244, 244, 0.48);
    }
    #pager a span {
        display: none;
    }
        /*#pager a.selected span {*/
        /*display: inline-block;*/
        /*color: #E9E9E9;*/
        /*position: absolute;*/
        /*top:30px;*/
        /*left: 20px;*/
        /*font-size: 15px;;*/
        /*}*/
    #pager a.selected {
        background-color: #59aa1b;
    }
    .article{
        clear: both;;
        width:640px;
        margin-bottom: 18px;
    }

    #donate-spacer {
        height: 100%;
    }
    #donate {
        border-top: 1px solid #999;
        width: 750px;
        padding: 50px 75px;
        margin: 0 auto;
        overflow: hidden;
    }
    #donate p, #donate form {
        margin: 0;
        float: left;
    }
    #donate p {
        width: 650px;
    }
    #donate form {
        width: 100px;
    }
    #article ul li h3 {
        color: #666666;
        font-size: 14px;
        font-weight: 100;
        line-height: 30px;
        text-align: left;;
    }
</style>
<?php if(Yii::app()->user->isGuest){?>
  <div class="top">
      <div class="topInner">
        <div class="top1">
<!--          <div class="top11">--><?php //echo  Helper::siteConfig()->site_name; ?><!--</div>-->
          <div class="top12">
<!--            <div class="top122"><i class="icon-emo-shoot"></i><i class="icon-dot-3"></i><i class="icon-dot-3"></i><i class="icon-target"></i></div>-->
            <div class="top121"><?php echo  Helper::siteConfig()->site_slogan; ?></div>
<!--            <div class="top122">欢迎光临，已有<b style="color:red;">--><?php //echo $mcount = Member::model()->count(); ?><!--</b>位<b style="color:red;">成员</b>入驻！</div>-->
            <div class="top123">
              <a class="btn" href="<?php echo Yii::app()->
                createUrl('public/register'); ?> ">
                加入我们(注册)</a>
            </div>
          </div>
        </div>
    
    <!--<div class="top123">
          <a href="<?php echo Yii::app()->
            createUrl('public/register'); ?> ">
            <img src="<?php echo  IMAGES_PATH; ?>zhuce.jpg" /></a>
          <a href="<?php echo Yii::app()->
            createUrl('site/down'); ?> ">
            <img src="<?php echo  IMAGES_PATH; ?>xiazai.jpg" /></a>
        </div>-->
    
        <div class="top2">

          <?php  if(Yii::app()->user->isGuest){?>
          <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'login-form',
                        'enableAjaxValidation'=>false,
                        'action'=>Yii::app()->baseUrl.'/public/login',
                        'htmlOptions'=>array('class'=>'login'),
                        )); ?>
          <div class="login1">
            <?php echo $form->
            textField($model,'username',array('class'=>'inp1','value'=>'','placeholder'=>'用户名')); ?>
              <i class="icon-user"></i>
          </div>
          <div class="login1">
            <?php echo $form->
            passwordField($model,'password',array('class'=>'inp1','placeholder'=>'密码')); ?>
            <i class="icon-lock"></i>
            <!-- <a href="#">忘记密码？</a> -->
          </div>
          <div class="login2">
            <?php echo $form->
            checkBox($model,'rememberMe',array()); ?>
            <span>记住我</span>
            <button  type="submit" class="btn">登陆</button>
            <a style="margin:5px 0 0 10px; background:none;" href="
            <?php
              $this->widget('ext.oauthlogin.OauthLogin',array(
                'itemView'=>'qqurl', //效果样式
              ));
            ?>
            "><img src="images/connect_qq.png" /></a>
            <a style="margin:5px 0 0 10px; background:none;" href="
            <?php
              $this->widget('ext.oauthlogin.OauthLogin',array(
                'itemView'=>'sinaurl', //效果样式
              ));
            ?>
            "><img src="images/connect_sina_weibo.png" /></a>
          </div>
          <?php $this->
          endWidget(); ?>
          <?php }else{?>

          <!-- 欢迎:
          <?php echo Yii::app()->
          user->nickname; ?>
          <br />
          <a href="<?php echo Yii::app()->createUrl('public/logout'); ?>">退出</a> -->

            <div style="padding:7px;">
              <div style="clear:both; overflow:hidden;">
                <a style="float:left;" href="<?php echo $this->createUrl('/kongjian/info'); ?>"><img width="50" height="50" alt="<?php echo Yii::app()->user->nickname; ?>" src="<?php echo IMAGES_USER_PHOTO.Yii::app()->user->photo;?>" /></a>
                <div style="float:left; padding-left:20px; line-height:18px;">
                  <a href="<?php echo $this->createUrl('/kongjian/info'); ?>"><?php echo Yii::app()->user->nickname; ?></a> <b style="color:red; font-weight:100;">恭喜您成为第<?php echo Yii::app()->user->id; ?>位<?php if(Yii::app()->user->id <= 100){ ?>尊贵VIP<?php }else{ ?>成员<?php } ?></b>
                  <div>
                    <a href="<?php echo $this->createUrl('/kongjian/info'); ?>">我的信息</a>
                    <a href="<?php echo $this->createUrl('/kongjian/index',array('uid'=>Yii::app()->user->id)); ?>">我的空间</a>
                    <a href="<?php echo $this->createUrl('group/mine'); ?>">我的公司、小组</a>
                    <a href="<?php echo $this->createUrl('group/mytopic'); ?>">我的话题</a></br>
                    <a href="<?php echo Yii::app()->createUrl('public/logout'); ?>">退出</a>
                  </div>
                </div>
              </div>
              <div style="clear:both; overflow:hidden;border-top:1px solid #cccccc; border-bottom:1px solid #cccccc;margin:7px 0 5px 0; padding:5px 0;">
                <div style="float:left; width:70px; height:50px; border-right:1px solid #cccccc; text-align:center; line-height:20px;">
                  <?php echo Yii::app()->user->groupCount; ?><br />
                  <a href="<?php echo $this->createUrl('group/mine'); ?>">创建的公司、小组</a>
                </div>
                <div style="float:left; width:70px; height:50px; border-right:1px solid #cccccc; text-align:center; line-height:20px;">
                  <?php echo Yii::app()->user->topicCount; ?><br />
                  <a href="<?php echo $this->createUrl('group/mytopic'); ?>">发起的话题</a>
                </div>
              </div>
            </div>

          <?php } ?></div>
      </div>
  </div>
<?php }?>
  <div class="wz1">
    <!--这里正在流行······--> </div>
  <div class="con1">
    <div class="left1">


       <h2>
            最新推荐
            <span>
              <a href="<?php echo Yii::app()->createUrl('/article'); ?>" title="全部" target="_self">（全部）</a>
            </span>
      </h2>
      <div class="xiaozu">
            <?php foreach ($articleSortList as $key => $v) {?>
                <div class="xiaozu_dl">
                    <div class="xiaozu_dl_first">
                        <a href="<?php echo $this->createUrl('article/index',array('cateId'=>$v['id'])); ?>" title="<?php echo $v['name']; ?>" target="_self">
                            <img alt="<?php echo $v['name']; ?>" src="<?php echo $this->createUrl(IMAGES_FENLEI_PHOTO.$v['img']); ?>" /></a>
                        <div class="xiaozu_dt">
                            <a href="<?php echo $this->createUrl('group/detail',array('id'=>$v['id'])); ?>" title="<?php echo $v['name']; ?>" target="_self"><?php echo $v['name']; ?></a>
<!--                            （<font>--><?php //echo $v->topicCount; ?><!--</font>）-->
                        </div>
                        <div class="xiaozu_dd"><?php echo Helper::truncate_utf8_string($v['des'],20); ?></div>
                    </div>
                    <div class="xiaozu_dl_list">
                        <ul>
                            <?php foreach ($v['data'] as $key => $value) {?>
                               <li>
                                    <h3><a target="_self" title="<?php echo $value->title; ?>" href="<?php echo $this->createUrl('/article/show/'.$value->id); ?>"><?php echo $value->title; ?></a></h3>
                               </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
<!--                    <li>-->
<!--                        <h3><a target="_self" title="--><?php //echo $value->title; ?><!--" href="--><?php //echo $this->createUrl('/article/index', array('cateId'=>$value->id)); ?><!--">--><?php //echo $value->title; ?><!--</a></h3>-->
<!--                    </li>-->
            <?php } ?>

      </div>
      <h2>
        热门小组
        <span>
          <a href="<?php echo $this->createUrl('/group'); ?>" title="全部" target="_self">（全部）</a>
        </span>
      </h2>
      <div class="xiaozu">
        <?php foreach($groupSortList as $k=>$v){ ?>
          <div class="xiaozu_dl">
              <div class="xiaozu_dl_first">
                <a href="<?php echo $this->createUrl('group/detail',array('id'=>$v['id'])); ?>" title="<?php echo $v['name']; ?>" target="_self">
                  <img alt="<?php echo $v['name']; ?>" src="<?php echo $v['imgLink']; ?>" /></a>
                <div class="xiaozu_dt">
                  <a href="<?php echo $this->createUrl('group/detail',array('id'=>$v['id'])); ?>" title="<?php echo $v['name']; ?>" target="_self"><?php echo $v['name']; ?></a>
    <!--              （<font>--><?php //echo $v['topicCount']; ?><!--</font>）-->
                </div>
                  <div class="xiaozu_dd"><?php echo Helper::truncate_utf8_string($v['des'],20); ?></div>
              </div>
              <div class="xiaozu_dl_list">
                  <ul>
                      <?php foreach ($v['data'] as $key => $value) {?>
                          <li>
                              <h3><a href="<?php echo $this->createUrl('/group/topic',array('id'=>$value->id)); ?>" title="<?php echo $value->title; ?>" target="_self"><?php echo $value->title; ?></a></h3>
                          </li>
                      <?php } ?>
                  </ul>
              </div>
          </div>
        <?php } ?>
      </div>


    </div>
    <div class="right1">
      <!-- <div>
        <input class="inp2" />  
        <a class="a1" href="#">搜索</a>
      </div> -->
       <?php if(!Yii::app()->user->isGuest){?>
        <div class="side-user gclear">
            <div class="user-header gclear">
                <div class="user-info">
                    <a href="<?php echo $this->createUrl('/kongjian/info'); ?>"><img width="50" height="50" alt="<?php echo Yii::app()->user->nickname; ?>" src="<?php echo $this->createUrl(IMAGES_USER_PHOTO.Yii::app()->user->photo);?>" /></a>
                    <a href="<?php echo $this->createUrl('/kongjian/info'); ?>"><?php echo Yii::app()->user->nickname; ?></a>

                </div>
                <div class="user-num">
                    <p class="user-focus-num">
                        <span><?php echo Yii::app()->user->groupCount; ?></span>
                        <a href="<?php echo $this->createUrl('group/mine'); ?>">创建的小组</a>
                    </p>
                    <p class="focused">
                        <span><?php echo Yii::app()->user->topicCount; ?></span>
                        <a href="<?php echo $this->createUrl('group/mytopic'); ?>">发起的话题</a>
                    </p>
                </div>
                <b class="garrow_up arrow1"></b>
                <b class="garrow_up arrow2"></b>
            </div>
            <div class="user-asks">
                <div class="user_into"><a href="<?php echo Yii::app()->createUrl('kongjian/index',array('uid'=>Yii::app()->user->id)); ?>">进入个人动态</a></div>
            </div>
        </div>
      <?php } ?>
      <div class="xshd" style="padding-top:0;">
        <h2>活跃用户</h2>
      </div>
      <div class="yonghu">
        <ul>
          <?php foreach($memberList as $k=>$v){ ?>
            <li>
              <ol>
                <a style="float:left; position:relative;" href="<?php echo $this->createUrl('/kongjian/index',array('uid'=>$v->id)); ?>" title="<?php echo $v->nickname; ?>">
                  <?php if($v->id <= 100){ ?>
                  <div style="position:absolute;right:0;bottom:0;width:15px;height:15px;background:red;overflow:hidden;"><img style="width:15px;height:15px;" src="/images/vip.jpg" /></div>
                  <?php } ?>
                  <img alt="<?php echo $v->nickname; ?>" src="<?php echo $this->createUrl(IMAGES_USER_PHOTO.$v->photo);?>" /></a>
<!--                <div class="zx"></div>-->
              </ol>
              <p><a href="<?php echo $v->kongjian; ?>"><?php echo $v->nickname; ?></a></p>
            </li>
          <?php } ?>
        </ul>
      </div>
      <div class="xshd">
        <h2>最新创建公司</h2>
        · · ·
        <span>
          (
          <a href="<?php echo $this->createUrl('/group'); ?>">更多</a>
          )
        </span>
      </div>

      <?php foreach($groupListNew as $k=>$v){ ?>
        <div class="right2">
          <a href="<?php echo $this->createUrl('group/detail',array('id'=>$v->id)); ?>"><?php echo $v->name; ?></a>
          （<?php echo $v->topicCount; ?>）
        </div>
      <?php } ?>

      <div class="xshd">
        <h2>最新文章</h2>
        · · ·
        <span>
          (
          <a href="<?php echo $this->createUrl('/article/index'); ?>">更多</a>
          )
        </span>
      </div>
      <?php foreach($articleList as $v){ ?>
          <div class="right2">
            <a href="<?php echo $this->createUrl('/article/show', array('id'=>$v->id)); ?>"><?php echo Helper::truncate_utf8_string($v->title,15); ?></a>
          </div>
      <?php } ?>
    </div>
  </div>
  <script type="text/javascript">
  $('#login-form').ajaxForm({
    dataType:'json',
    success:function processJson(data) {
      var items = [];
      $.each(data,function(key, val){var tem=[key,val];items.push(tem)});
      var length = items.length;
      if(data.status != 1){       
        //items[i][0]错误节点名称
        //items[i][1]对应错误提示
        for(var i=0;i<length;i++){
            alert(items[i][1]);
            return false;
        }
      }else{
        document.location.reload(); 
      }
    }
  });
</script>
<!-- Baidu Button BEGIN -->
<script type="text/javascript" id="bdshare_js" data="type=slide&amp;img=0&amp;pos=right&amp;uid=0" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000);
</script>
<!-- Baidu Button END -->