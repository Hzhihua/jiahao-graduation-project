<?php
/**
 * @Author: cnzhihua
 * @Date: 2018-05-07 15:25
 * @Github: https://github.com/Hzhihua
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Question;

class CommunicationController extends Controller
{
    /**
     * 显示咨询列表
     * @return string
     */
    public function actionIndex()
    {
        $data = Question::find()->orderBy(['answer_id' => SORT_ASC, 'id' => SORT_DESC])->asArray()->all();

        return $this->render('index', [
            'data' => $data,
        ]);
    }

    /**
     * 创建新的咨询
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Question();

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

   /**
    * @param integer $id
    * @return mixed
    */
    public function actionView($id)
    {
        $data = Question::find()->where(['id' => (int) $id])->with('answer')->asArray()->one();
        return $this->render('view', [
            'data' => $data,
        ]);
    }

    /**
     * Finds the Question model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Question the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Question::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('frontend', 'The requested page does not exist.'));
    }
}