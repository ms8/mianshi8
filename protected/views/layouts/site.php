<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="all" />
<meta name="author" content="mianshi8@qq.com" />
<meta name="Copyright" content="mianshi8" />
<title><?php echo $this->pageKeyword['title'];  ?></title>
<meta name="keywords" content="<?php echo $this->pageKeyword['keywords'];  ?>" >
<meta name="description" content="<?php echo $this->pageKeyword['description'];  ?>" >
<meta property="qc:admins" content="" />
<meta property="wb:webmaster" content="" />
<link href="favicon.ico" type="image/x-icon" rel=icon>
<link href="favicon.ico" type="image/x-icon" rel="shortcut icon">
<link href="favicon.ico" type="image/x-icon" rel="shortcut icon">
<?php 
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.JS_PATH.'jquery-1.7.1.min.js');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery-ui.js');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/carouFredSel.js');

    Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/js/artDialog/skins/idialog.css');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/artDialog/artDialog.min.js');

    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/common.js');
    //Yii::app()->clientScript->registerCssFile('common.css');
    Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/red.css');
    Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/fontello/css/fontawesome.css');
?>
<script type="text/javascript">
//    $(function() {
//        $('#carousel').carouFredSel({
//            width: '100%',
//            items: {
//                visible: 3,
//                start: -1
//            },
//            scroll: {
//                items: 1,
//                duration: 1000,
//                timeoutDuration: 3000
//            },
//            prev: '#prev',
//            next: '#next',
//            pagination: {
//                container: '#pager',
//                deviation: 1,
//                anchorBuilder:function(nr, item) {
//                    return '<a href="#'+nr+'"><span>'+nr+'</span></a>';
//                }
//            }
//        });
//    });
</script>

</head>

<body>

<div>
    <?php if(!Yii::app()->user->isGuest){?>
    <div class="httop1">
        <div class="httop11">
            <a href="<?php echo Yii::app()->baseUrl;?>/">首页</a>
            <a href="<?php echo Yii::app()->createUrl('/mszhaopinhui'); ?>">招聘会</a>
            <a href="<?php echo Yii::app()->createUrl('/group'); ?>">公司</a>
            <a href="<?php echo Yii::app()->createUrl('/article'); ?>">学院</a>
<<<<<<< Updated upstream
            <!--<a href="<?php //echo Yii::app()->createUrl('/tongcheng'); ?>">活动</a>-->
=======
            <!-- <a href="<?php //echo Yii::app()->createUrl('/tongcheng'); ?>">活动</a>-->
>>>>>>> Stashed changes
        </div>
        <div class="httop12">
            <!-- <a href="javascript:void(0)">提醒
                <span class="num">
                <span>1</span>
                <i></i>
                </span>
            </a> -->
            <a href="<?php echo Yii::app()->createUrl('kongjian/index',array('uid'=>Yii::app()->user->id)); ?>">欢迎您：<?php echo Yii::app()->user->nickname;?></a>
            <a href="<?php echo Yii::app()->createUrl('kongjian/info'); ?>">设置</a>
            <a href="<?php echo Yii::app()->createUrl('public/logout'); ?>">退出</a>
        </div>
    </div>
    <?php }?>
    	<div class="head1">
        	<div class="logo">
            	<a href="<?php echo Yii::app()->baseUrl;?>/">
                	<img src="<?php echo Yii::app()->baseUrl;?>/upload/sitelogo/<?php echo  Helper::siteConfig()->site_logo; ?>" />
                </a>
            </div>
            <div class="nav">
                <?php if(!Yii::app()->user->isGuest){?>
                    <a class="shouye" href="<?php echo Yii::app()->baseUrl;?>/">首页</a>
                    <a href="<?php echo Yii::app()->createUrl('/mszhaopinhui'); ?>">招聘会</a>
                    <a href="<?php echo Yii::app()->createUrl('/group'); ?>">公司</a>
<<<<<<< Updated upstream
                    <a href="<?php echo Yii::app()->createUrl('/article'); ?>">学院</a>
=======
                    <a href="<?php echo Yii::app()->createUrl('/article'); ?>">面试达人</a>
>>>>>>> Stashed changes
                    
                <?php }else{?>
                    <a class="shouye" href="<?php echo Yii::app()->baseUrl;?>/">首页</a>
                    <a href="<?php echo Yii::app()->createUrl('/mszhaopinhui'); ?>">招聘会</a>
                    <a href="<?php echo Yii::app()->createUrl('/group'); ?>">公司</a>
                    <a href="<?php echo Yii::app()->createUrl('/article'); ?>">学院</a>
<<<<<<< Updated upstream
                    <!--<a href="<?php echo Yii::app()->createUrl('/tongcheng'); ?>">活动</a>-->
=======
                   <!-- <a href="<?php //echo Yii::app()->createUrl('/tongcheng'); ?>">活动</a>-->
>>>>>>> Stashed changes
                <?php }?>
            </div>
            <div class="sousuo">
                <input type="text" value="公司、小组、话题" class="inp3" id="search_inp"><a class="inp4" href="javascript:void(0)" id="search"></a>
            </div>

        </div>
        <?php echo $content ?>
        <div class="footer">
            <div style="overflow:hidden;">
                <div>友情链接：
                <?php $links = Links::model()->findAll(array('condition'=>'status = 1','order'=>'sort desc')); ?>
                <?php if(!empty($links)){ ?>
                    <?php foreach($links as $v){ ?>
                        <a href="<?php echo $v->url; ?>"><?php echo $v->name; ?></a>
                    <?php } ?>
                    </div>
                <?php } ?>
            </div>
            <div class="footer1">
                <?php echo  Helper::siteConfig()->site_copyright; ?>
            </div>
            <div class="footer2">
                <?php
                    $danye = Cate::model()->findAll(array('condition'=>'type = 2 and status = 1'));
                    foreach($danye as $v){
                ?>
                <a href="<?php echo $v->danyeurl; ?>"><?php echo $v->name; ?></a>  
                <?php
                    }
                ?>
                <div style="display:none;">
                <?php echo  Helper::siteConfig()->site_code; ?>
                </div>
            </div>
        </div>
    </div>

</body>
</html>


<div class="toptype"><a href="javascript:void(0);" onClick="window.scrollTo(0,0);" class="gotop_btn" id="goTopButton" style="display:none;">&nbsp;</a></div>
<script type="text/javascript">
(function($){
  $(window).scroll(function(event){
    if($(this).scrollTop() > 0){
      if($.browser.ie6){
        $('#goTopButton').css('top', $(this).scrollTop() + $(this).height() - 170);
      }
      if($('#goTopButton').css('display') == 'none'){
        $('#goTopButton').fadeIn();
      }
    }else{
      $('#goTopButton').fadeOut();
    }
  });
})(jQuery);
</script>
