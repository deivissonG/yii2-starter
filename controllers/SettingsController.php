<?php

namespace app\controllers;

use app\widgets\Settings;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * SettingsController.
 */
class SettingsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'only' => ['*'],
                    'rules' => [
                        [
                            'actions' => ['index', 'clear-logo'],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Agraciado models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new Settings();

        if ($model->load($this->request->post())){
            if($model->save()) {
                \Yii::$app->session->addFlash('success', Yii::t('app', 'Successfully Saved'));
            } else {
                \Yii::$app->session->addFlash('danger', Yii::t('app', 'Internal Error'));
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionClearLogo()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new Settings();
        return $model->unsetLogo();
    }
}
