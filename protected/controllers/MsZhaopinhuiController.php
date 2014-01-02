<?php

class MsZhaopinhuiController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
    public $layout='zhaopinhui';


	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
//	public function accessRules()
//	{
//		return array(
//			array('allow',  // allow all users to perform 'index' and 'view' actions
//				'actions'=>array('index','view'),
//				'users'=>array('*'),
//			),
//			array('allow', // allow authenticated user to perform 'create' and 'update' actions
//				'actions'=>array('create','update'),
//				'users'=>array('@'),
//			),
//			array('allow', // allow admin user to perform 'admin' and 'delete' actions
//				'actions'=>array('admin','delete'),
//				'users'=>array('admin'),
//			),
//			array('deny',  // deny all users
//				'users'=>array('*'),
//			),
//		);
//	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new MsZhaopinhui;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['MsZhaopinhui']))
		{
			$model->attributes=$_POST['MsZhaopinhui'];
            $model->createtime = date("Y-m-d H:i:s");
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

//    public function actionAdmin()
//    {
//        $model=new MsZhaopinhui;
//
//        // Uncomment the following line if AJAX validation is needed
//        // $this->performAjaxValidation($model);
//
//        if(isset($_POST['MsZhaopinhui']))
//        {
//            $model->attributes=$_POST['MsZhaopinhui'];
//            if($model->save())
//                $this->redirect(array('view','id'=>$model->id));
//        }
//
//        $this->render('create',array(
//            'model'=>$model,
//        ));
//    }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['MsZhaopinhui']))
		{
			$model->attributes=$_POST['MsZhaopinhui'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $model=new MsZhaopinhui();

        $criteria = new CDbCriteria();
        $criteria->select='*';
        $criteria->condition = "status='1' and unix_timestamp(activity_date) >=unix_timestamp(:systime)";
        $criteria->params = array(
            ':systime'=>date('Y-m-d H:i:s'),
        );
        $total = $model->count($criteria);
        $pager = new CPagination($total);
        $pager->pageSize = 20;
        $pager->applyLimit($criteria);
        $models = $model->findAll($criteria);

        $dataProvider = array();
        $this->render('explore',array('zhaopinhuis'=>$models,'pages'=>$pager,
            'dataProvider'=>$dataProvider,'tagSelected'=>null));
	}

    public function actionListByTag($tagCode){
        $criteria = new CDbCriteria();
//        $sql = "SELECT distinct zph.id,zph.name,zph.activity_date,zph.activity_address"
//            ." from ms_zhaopinhui zph,ms_zpdetail detail,ms_zpdetail_tag tag "
//            ."where tag.tag_code=:tagCode and tag.zp_detailid=detail.id and detail.zpId=zph.id";
        //用like查询
        $sql = "SELECT id,name,activity_date,activity_address"
        ." from ms_zhaopinhui where description like concat('%',".":tagCode".",'%')"
        ." and unix_timestamp(activity_date) >=unix_timestamp(:systime)";
        $model=Yii::app()->db->createCommand($sql." LIMIT :offset,:limit");
        $pager = new CPagination(count($model));
        $pager->pageSize = 20;
        $pager->applylimit($criteria);
        $model->bindValue(':tagCode', $tagCode);
        $model->bindValue(':offset', $pager->currentPage*$pager->pageSize);
        $model->bindValue(':limit', $pager->pageSize);
        $model->bindValue(':systime',date('Y-m-d H:i:s'));
        $models=$model->queryAll();

        $zphs = array();
        foreach($models as $m){
            $model=new MsZhaopinhui();
            $model->id = $m['id'];
            $model->name = $m['name'];
            $model->activity_address = $m['activity_address'];
            $model->activity_date = $m['activity_date'];
            $zphs[] = $model;
        }
        $this->render('explore',array('zhaopinhuis'=>$zphs,'pages'=>$pager,'tagSelected'=>$tagCode));
    }

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new MsZhaopinhui('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['MsZhaopinhui']))
			$model->attributes=$_GET['MsZhaopinhui'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return MsZhaopinhui the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=MsZhaopinhui::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param MsZhaopinhui $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='ms-zhaopinhui-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
