<?php

namespace backend\controllers;

use Yii;
use common\models\Announcement;
use common\models\AnnouncementSearch;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\File;
use common\models\Picture;

/**
 * AnnouncementController implements the CRUD actions for Announcement model.
 */
class AnnouncementController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    /**
     * @param $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        if ($action->id === 'ckeditor-image-upload') {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    /**
     * @return array
     */
    public function actions()
    {
        return [
            'image-upload' => [ // 预览图上传
                'class' => 'hzhihua\actions\FileUploadAction',
                'seeDirectory' => Yii::$app->params['baseUrl'],
                'uploadDirectory' => Yii::$app->params['baseDirectory'],
                'deleteAction' => 'image-delete',
                'downloadAction' => 'image-download',
                // 'on beforeUpload' => [new Picture(), 'beforeImageUpload'],
                'on afterUpload' => [new Picture(), 'afterImageUpload'],
//                'responseFormat' => 'json',
            ],
            'image-delete' => [ // 预览图删除
                'class' => 'hzhihua\actions\FileDeleteAction',
                'on beforeDelete' => [new Picture(), 'beforeImageDelete'],
                'on afterDelete' => [new Picture(), 'afterImageDelete'],
            ],
            'image-download' => [ // 预览图下载
                'class' => 'hzhihua\actions\FileDownloadAction',
                'on beforeDownload' => [new Picture(), 'beforeImageDownload'],
//                'responseFormat' => 'json',
            ],
            'ckeditor-image-upload' => [ // ckeditor picture upload
                'class' => 'hzhihua\actions\FileUploadAction',
                'attribute' => 'upload',
                'on afterUpload' => [new Picture(), 'afterImageUploadCKeditor'],
            ],
            'file-upload' => [ // 附件上传
                'class' => 'hzhihua\actions\FileUploadAction',
                'attribute' => 'file',
                'deleteAction' => 'file-delete',
                'downloadAction' => 'file-download',
                'seeDirectory' => Yii::$app->params['baseUrl'],
                'uploadDirectory' => Yii::$app->params['baseDirectory'],
                // 'on beforeUpload' => [new File(), 'beforeFileUpload'],
                'on afterUpload' => [new File(), 'afterFileUpload'],
//                'responseFormat' => 'json',
            ],
            'file-delete' => [ // 附件删除
                'class' => 'hzhihua\actions\FileDeleteAction',
                'on beforeDelete' => [new File(), 'beforeFileDelete'],
                // 'on afterDelete' => [new File(), 'afterFileDelete'],
            ],
            'file-download' => [ // 附件下载
                'class' => 'hzhihua\actions\FileDownloadAction',
                'on beforeDownload' => [new File(), 'beforeFileDownload'],
//                'responseFormat' => 'json',
            ],
        ];
    }

    /**
     * Lists all Announcement models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnnouncementSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Announcement model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Announcement model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Announcement();

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $picture_id = Picture::getIdByFileKey($post['picture_id']);
            $file_id = File::getIdByFileKey($post['file_id']);
            $_POST['Announcement']['picture_id'] = $picture_id;
            $_POST['Announcement']['file_id'] = $file_id;
            if ($model->load($_POST) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Announcement model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $picture_id = Picture::getIdByFileKey($post['picture_id']);
            $file_id = File::getIdByFileKey($post['file_id']);
            $_POST['Announcement']['picture_id'] = $picture_id;
            $_POST['Announcement']['file_id'] = $file_id;
            if ($model->load($_POST) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Announcement model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Announcement model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Announcement the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Announcement::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }
}
