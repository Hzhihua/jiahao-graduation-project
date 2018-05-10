<?php
/**
 * @Author: cnzhihua
 * @Date: 2018-05-09 15:58
 * @Github: https://github.com/Hzhihua
 */

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\Media;
use common\models\MediaSearch;

class MediaController extends Controller
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
        return array_merge(parent::actions(), [
            'file-upload' => [
                'class' => 'hzhihua\actions\FileUploadAction',
                'attribute' => 'file',
                'deleteAction' => 'file-delete',
                'downloadAction' => 'file-download',
                'seeDirectory' => Yii::$app->params['baseUrl'],
                'uploadDirectory' => Yii::$app->params['baseDirectory'],
                'on afterUpload' => [new Media(), 'afterMediaUpload'],
            ],
            'file-delete' => [
                'class' => 'hzhihua\actions\FileDeleteAction',
                'on beforeDelete' => [new Media(), 'beforeMediaDelete'],
            ],
            'file-download' => [
                'class' => 'hzhihua\actions\FileDownloadAction',
                'on beforeDownload' => [new Media(), 'beforeMediaDownload'],
            ],
        ]);
    }

    public function actionIndex()
    {
        $searchModel = new MediaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Media();

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * @return \yii\web\Response
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete()
    {
        $file_key = Yii::$app->request->get('file_key');
        if (($model = Media::findOne(['file_key' => $file_key]))) {
            $baseDirectory = rtrim(Yii::getAlias(Yii::$app->params['baseDirectory']), '/') . '/';
            @unlink(sprintf(
                '%s%s/%s.%s',
                $baseDirectory,
                $model->new_directory,
                $model->new_name,
                $model->extension
            ));
            $model->delete();
        }
        return $this->redirect(['index']);
    }
}