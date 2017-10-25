<?php
namespace frontend\controllers;

use yii\web\Controller;

/**
 * Site controller
 */
class ErrorController extends Controller
{

    public function beforeAction($action)
    {
        if (! parent::beforeAction($action)) {
            return false;
        }

        $this->layout = 'error';

        return true;
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'index' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

}
