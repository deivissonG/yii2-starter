<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function beforeAction( $action ) {
        if ( parent::beforeAction ( $action ) ) {
            if ( $action->id == 'error' ) {
                $this->layout = 'clean';
            }
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return Response|string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['user/login']);
        }
        return $this->render('index');
    }

    /**
     * Handles error for the entire application
     * @return void
     */
    public function actionError()
    {
        $this->layout = '@app/views/clean';
        $error = Yii::$app->errorHandler->error;
        if( $error )
        {
            $this -> render( 'error', array( 'error' => $error ) );
        }
    }
}