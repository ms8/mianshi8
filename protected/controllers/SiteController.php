<?php

class SiteController extends Controller
{
	public $layout='site';

	public function init(){
		Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.CSS_PATH.'common.css');
	}
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function actionIndex(){

		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.JS_PATH.'jquery-1.7.1.min.js');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.JS_PATH.'jquery.form.js');
		$model=new LoginForm;

		// 推荐公司
		$groupList = Group::model()->findAll(array('condition'=>'status = 1 and type=1','order'=>'sort desc','limit'=>8));
        $groupSortList = array();
        foreach ($groupList as $key => $value){
            $criteria = new CDbCriteria();
            $criteria->order = "hot desc,create_time desc";
            $groupTopicList=$value->topicMany($criteria);
            array_push($groupSortList,array("id"=>$value->id,"imgLink"=>$value->imgLink,"name"=>$value->name,"title"=>$value->topicCount,"des"=>$value->des,"data"=>$groupTopicList));
        }

        // 推荐小组
        $xiaozuList = Group::model()->findAll(array('condition'=>'status = 1 and type=2','order'=>'sort desc','limit'=>8));
        $xiaozuSortList = array();
        foreach ($xiaozuList as $key2 => $value2){
            $criteriaxiaozu = new CDbCriteria();
            $criteriaxiaozu->order = "hot desc,create_time desc";
            $xiaozuTopicList=$value2->topicMany($criteriaxiaozu);
            array_push($xiaozuSortList,array("id"=>$value2->id,"imgLink"=>$value2->imgLink,"name"=>$value2->name,"title"=>$value2->topicCount,"des"=>$value2->des,"data"=>$xiaozuTopicList));
        }
		// 活跃用户
		$memberList = Member::model()->findAll(array('condition'=>'','order'=>'last_login_time desc','limit'=>20));
		// 最新创建公司
		$groupListNew = Group::model()->findAll(array('condition'=>'status = 1 and type=1','order'=>'id desc','limit'=>20));
        // 最新创建公司
        $xiaozuListNew = Group::model()->findAll(array('condition'=>'status = 1 and type=2','order'=>'id desc','limit'=>20));

        // 最热话题
//		$topicList = Topic::model()->findAll(array('condition'=>'status != 2','order'=>'istop asc,id desc','limit'=>10));
        // 文章类别
        $articleSort = Cate::model()->findAll(array('condition'=>'status = 1 and type = 1','order'=>'id','limit'=>80));
        $articleSortList = array();
        foreach ($articleSort as $key => $value){
            $articleDetailList = Article::model()->findAll(array('condition'=>'status = 1 and cateId = '.$value->id,'order'=>'id desc','limit'=>6));
            array_push($articleSortList,array("id"=>$value->id,"img"=>$value->img,"name"=>$value->name,"title"=>$value->title,"des"=>$value->des,"data"=>$articleDetailList));
        }
		// 最新文章
		$articleList = Article::model()->findAll(array('condition'=>'status = 1','order'=>'id desc','limit'=>8));

		//首页幻灯
//		$ad = Ad::model()->findAll(array('condition'=>'status = 1','order'=>'sort desc','limit'=>8));
        //最新招聘会
        $criteriaZPH = new CDbCriteria();
        $criteriaZPH->select='*';
        $criteriaZPH->limit=8;
        $criteriaZPH->condition = "status='1' and unix_timestamp(activity_date) >=unix_timestamp(:systime)";
        $criteriaZPH->params = array(
            ':systime'=>date('Y-m-d H:i:s'),
        );
        $zhaopinhui = MsZhaopinhui::model()->findAll($criteriaZPH);

		$this->pageKeyword=array(
			'title'=>Helper::siteConfig()->seo_title,
			'keywords'=>Helper::siteConfig()->seo_keywords,
			'description'=>Helper::siteConfig()->seo_description,
		);
		$this->render('index',compact('model','memberList','groupListNew','articleList','articleSortList','groupSortList','zhaopinhui','xiaozuListNew','xiaozuSortList'));
	}

	public function actionDown(){

		if(Yii::app()->user->isGuest){
			header("Content-type: text/html; charset=utf-8");
			echo "<script>alert('请注册并登录后下载，谢谢支持!');window.location.href=".Yii::app()->baseUrl."'/public/register';</script>";
			exit;
		}

		$file_dir= $_SERVER['DOCUMENT_ROOT'].'/anzhuangbao/';
		$file_name="ebenchu.zip";
		if (!file_exists($file_dir.$file_name)) { //检查文件是否存在
			echo "no file!";
			exit;
		}else{
			echo 1;
			$file = fopen($file_dir . $file_name,"r"); // 打开文件 
			Header("Content-type: application/octet-stream"); 
			Header("Accept-Ranges: bytes"); 
			Header("Accept-Length: ".filesize($file_dir . $file_name)); 
			Header("Content-Disposition: attachment; filename=" . $file_name); // 输出文件内容 
			echo fread($file,filesize($file_dir . $file_name)); 
			fclose($file);
			exit;
		}
	}

	public function actionTest(){
		Helper::SendEmail('25461865@qq.com','测试邮件','测试邮件内容');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
	
}