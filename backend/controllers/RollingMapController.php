<?php

namespace backend\controllers;

use common\models\Picture;
use Yii;
use common\models\RollingMap;
use common\models\RollingMapSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RollingMapController implements the CRUD actions for RollingMap model.
 */
class RollingMapController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'image-upload' => [
                'class' => 'hzhihua\actions\FileUploadAction',
                'seeDirectory' => Yii::$app->params['baseUrl'],
                'uploadDirectory' => Yii::$app->params['baseDirectory'],
                'deleteAction' => 'image-delete',
                'downloadAction' => 'image-download',
                'on beforeUpload' => [new Picture(), 'beforeImageUpload'],
                'on afterUpload' => [new Picture(), 'afterImageUpload'],
//                'responseFormat' => 'json',
            ],
            'image-delete' => [
                'class' => 'hzhihua\actions\FileDeleteAction',
                'on beforeDelete' => [new Picture(), 'beforeImageDelete'],
//                'on afterDelete' => [new Picture(), 'afterImageDelete'],
            ],
            'image-download' => [
                'class' => 'hzhihua\actions\FileDownloadAction',
                'on beforeDownload' => [new Picture(), 'beforeImageDownload'],
//                'responseFormat' => 'json',
            ],
        ];
    }

    /**
     * Lists all RollingMap models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RollingMapSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RollingMap model.
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
     * Creates a new RollingMap model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RollingMap();

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $file_id = Picture::getIdByFileKey($post['picture_id']);
            $_POST['RollingMap']['picture_id'] = $file_id;
            if ($model->load($_POST) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RollingMap model.
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
            $file_id = Picture::getIdByFileKey($post['picture_id']);
            $_POST['RollingMap']['picture_id'] = $file_id;
            if ($model->load($_POST) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing RollingMap model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $baseDirectory = rtrim(Yii::$app->params['baseDirectory'], '/') . '/';
        $data = Picture::find()->where(['id' => $model->id])->asArray()->one();
        @unlink(sprintf(
            '%s%s/%s.%s',
            $baseDirectory,
            $data['new_directory'],
            $data['new_name'],
            $data['extension']
        ));
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RollingMap model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return RollingMap the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RollingMap::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }
}
