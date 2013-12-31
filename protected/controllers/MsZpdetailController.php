<?php

class MsZpdetailController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
    public $layout='zpdetail';

    public $zph;

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

    public function actionDetail($id){
        $this->zph = MsZhaopinhui::model()->findByPk($id);
        $model=new MsZpdetail();

        $criteria = new CDbCriteria();
        $criteria->select='*';
        $criteria->condition = "zpId=:zpid";
        $criteria->params = array(
            ':zpid'=>$id,
        );
        $total = $model->count($criteria);
        $pager = new CPagination($total);
        $pager->pageSize = 20;
        $pager->applyLimit($criteria);
        $models = $model->findAll($criteria);

        $this->render('explore',array('zpdetail'=>$models,'pages'=>$pager,'tagSelected'=>null));
    }

    public function actionListByTag($tagCode,$zpId){
        $this->zph = MsZhaopinhui::model()->findByPk($zpId);

        $criteria = new CDbCriteria();
        $sql = "SELECT detail.companyId, detail.name, detail.position, detail.description "
            ." from ms_zpdetail detail,ms_zpdetail_tag tag "
            ."where tag.tag_code=:tagCode and tag.zp_detailid=detail.id and zpId=:zpId";
        $model=Yii::app()->db->createCommand($sql." LIMIT :offset,:limit");
        $pager = new CPagination(count($model));
        $pager->pageSize = 20;
        $pager->applylimit($criteria);
        $model->bindValue(':zpId', $zpId);
        $model->bindValue(':tagCode', $tagCode);
        $model->bindValue(':offset', $pager->currentPage*$pager->pageSize);
        $model->bindValue(':limit', $pager->pageSize);
        $models=$model->queryAll();

        $zpds = array();
        foreach($models as $m){
            $model=new MsZpdetail();
            $model->companyId = $m['companyId'];
            $model->name = $m['name'];
            $model->position = $m['position'];
            $model->description = $m['description'];
            $zpds[] = $model;
        }
        $this->render('explore',array('zpdetail'=>$zpds,'pages'=>$pager,'tagSelected'=>$tagCode));
    }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
        $model = $this->loadModel($id);
		$this->render('view',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new MsZpdetail;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['MsZpdetail']))
		{
			$model->attributes=$_POST['MsZpdetail'];
            $data = $_POST['MsZpdetail'];
            $tags = $data['tags'];

            $model->companyId = null;


			if($model->save()){
                foreach($tags as $tag){
                    $detailTag = new MsZpdetailTag();
                    $detailTag->zp_detailid = $model->id;
                    $detailTag->tag_code = $tag;
                    $tagInfo=MsDictionary::model()->find(array('condition'=>'code=:code',
                        'params'=>array(':code'=>$tag)));
                    $detailTag->tag_name = $tagInfo->name;
                    $detailTag->save();
                }

                $this->redirect(array('view','id'=>$model->id));
            }

		}

        /*********************************************************************************/
        $zhaopinhuis = array();
        $zhps = Yii::app()->db->createCommand()
            ->select('id,name')
            ->from('ms_zhaopinhui')
            ->where('status=\'1\'')
            ->queryAll();
        foreach ($zhps as $zhp ){
            $tmp=new MsZhaopinhui();
            $tmp->id = $zhp['id'];
            $tmp->name = $zhp['name'];
            $zhaopinhuis[] = $tmp;
        }
        $zpTags=array();
        $zptag = Yii::app()->db->createCommand()
            ->select('code,name')
            ->from('ms_dictionary')
            ->where('type=\'zp_tag\'')
            ->queryAll();
        foreach ($zptag as $zhp ){
            $zpTags[$zhp['code']] = $zhp['name'];
        }
        /*********************************************************************************/


		$this->render('create',array(
			'model'=>$model,
            'zhaopinhuis'=>$zhaopinhuis,
            'zpTags'=>$zpTags,
		));
	}

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

		if(isset($_POST['MsZpdetail']))
		{
			$model->attributes=$_POST['MsZpdetail'];
            $model->companyId = null;
            $data = $_POST['MsZpdetail'];
            $tags = $data['tags'];
			if($model->save()){
                /*先删除原有数据*/
                MsZpdetailTag::model()->deleteAll('zp_detailid=:zpid',array(':zpid'=>$id));
                foreach($tags as $tag){
                    $detailTag = new MsZpdetailTag();
                    $detailTag->zp_detailid = $model->id;
                    $detailTag->tag_code = $tag;
                    /*保存新的数据*/
                    $tagInfo=MsDictionary::model()->find(array('condition'=>'code=:code',
                        'params'=>array(':code'=>$tag)));
                    $detailTag->tag_name = $tagInfo->name;
                    $detailTag->save();
                }
                $this->redirect(array('view','id'=>$model->id));
            }

		}

        /*********************************************************************************/
        $zhaopinhuis = array();
        $zhps = Yii::app()->db->createCommand()
            ->select('id,name')
            ->from('ms_zhaopinhui')
            ->where('status=\'1\'')
            ->queryAll();
        foreach ($zhps as $zhp ){
            $tmp=new MsZhaopinhui();
            $tmp->id = $zhp['id'];
            $tmp->name = $zhp['name'];
            $zhaopinhuis[] = $tmp;
        }
        $zpTags=array();
        $zptag = Yii::app()->db->createCommand()
            ->select('code,name')
            ->from('ms_dictionary')
            ->where('type=\'zp_tag\'')
            ->queryAll();
        foreach ($zptag as $zhp ){
            $zpTags[$zhp['code']] = $zhp['name'];
        }
        /*********************************************************************************/

		$this->render('update',array(
			'model'=>$model,
            'zhaopinhuis'=>$zhaopinhuis,
            'zpTags'=>$zpTags,
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
		$dataProvider=new CActiveDataProvider('MsZpdetail');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new MsZpdetail('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['MsZpdetail']))
			$model->attributes=$_GET['MsZpdetail'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return MsZpdetail the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=MsZpdetail::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param MsZpdetail $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='ms-zpdetail-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
