<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="all" />
<meta name="author" content="mianshi8@qq.com" />
<meta name="Copyright" content="ebenchu" />
<title><?php echo $this->pageKeyword['title'];  ?></title>
<meta name="keywords" content="<?php echo $this->pageKeyword['keywords'];  ?>" >
<meta name="description" content="<?php echo $this->pageKeyword['description'];  ?>" >
<meta property="qc:admins" content="5336456477652563056375" />
<meta property="wb:webmaster" content="028cd7d60c45f425" />
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
?>
<script type="text/javascript">
    $(function() {
        $('#carousel').carouFredSel({
            width: '100%',
            items: {
                visible: 3,
                start: -1
            },
            scroll: {
                items: 1,
                duration: 1000,
                timeoutDuration: 3000
            },
            prev: '#prev',
            next: '#next',
            pagination: {
                container: '#pager',
                deviation: 1
            }
        });
    });
</script>

</head>

<body>

	<div class="con">
    	<div class="head1">
        	<div class="logo">
            	<a href="<?php echo Yii::app()->baseUrl;?>/">
                	<img src="<?php echo Yii::app()->baseUrl;?>/upload/sitelogo/<?php echo  Helper::siteConfig()->site_logo; ?>" />
                </a>
            </div>
            <div class="nav">
            	<a class="shouye" href="<?php echo Yii::app()->baseUrl;?>/">首页</a>
                <a href="<?php echo Yii::app()->createUrl('/group'); ?>">小组</a>
                <a href="<?php echo Yii::app()->createUrl('/article'); ?>">学院</a>
                <a href="<?php echo Yii::app()->createUrl('/tongcheng'); ?>">活动</a>
            </div>
            <div class="sousuo">
                <input type="text" value="小组、话题" class="inp3" id="search_inp"><a class="inp4" href="javascript:void(0)" id="search"></a>
            </div>

        </div>
        <?php echo $content ?>
        <div class="footer">
            <div style="overflow:hidden;">
                <div>开源联盟：
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
