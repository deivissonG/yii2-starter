<?php

/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use Da\User\Widget\ConnectWidget;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View            $this
 * @var \Da\User\Form\LoginForm $model
 * @var \Da\User\Module         $module
 */

$this->title = Yii::t('app', 'Welcome!');
$this->params['breadcrumbs'][] = $this->title;
$logoPath = file_exists(Yii::getAlias('@app/web') . '/logo.png') ? '/logo.png' : false;
$appName = Yii::$app->params['appName'];
?>

<?= $this->render('/shared/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="row h-100 vh-100 ms-0 me-0 position-relative">
    <div class="position-absolute top-50 start-50 translate-middle bg-light shadow-sm rounded-1 col-xs-12 col-sm-6 col-lg-5 col-xl-4 col-xxl-3 px-4">

        <div class="d-flex flex-column justify-content-center align-items-center">

            <?php if ($logoPath): ?>
                <img alt="<?= $appName ?>" src="<?= $logoPath ?>" width="60%" class="my-4"/>
            <?php else: ?>
                <h1><?= $appName ?></h1>
            <?php endif; ?>
            <h3 class="text-center"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="mb-2">
            <?php $form = ActiveForm::begin(
                [
                    'id' => $model->formName(),
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
                    'validateOnBlur' => false,
                    'validateOnType' => false,
                    'validateOnChange' => false,
                    'class' => 'form-floating'
                ]
            ) ?>
        </div>

        <div class="p-1">
            <?= $form->field(
                $model,
                'login',
                ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1', 'placeholder' => Yii::t('app', 'Username or email')]]
            )->label('Usuário'); ?>
        </div>

        <div class="p-1">
            <?= $form
                ->field(
                    $model,
                    'password',
                    ['inputOptions' => ['class' => 'form-control', 'tabindex' => '2']]
                )
                ->passwordInput()
                ->label(
                    Yii::t('usuario', 'Password')
                    . ($module->allowPasswordRecovery ?
                        ' (' . Html::a(
                            Yii::t('usuario', 'Forgot password?'),
                            ['/user/recovery/request'],
                            ['tabindex' => '5']
                        )
                        . ')' : '')
                ) ?>
        </div>

        <?= $form->field($model, 'rememberMe')->checkbox(['tabindex' => '4']) ?>

        <div class="mb-2 p-1 justify-content-center d-flex">
            <?= Html::submitButton(
                Yii::t('usuario', 'Login'),
                ['class' => 'btn btn-primary btn-block', 'tabindex' => '3']
            ) ?>

            <?php ActiveForm::end(); ?>
        </div>

    <?php if ($module->enableEmailConfirmation): ?>
        <p class="text-center">
            <?= Html::a(
                Yii::t('usuario', 'Didn\'t receive confirmation message?'),
                ['/user/registration/resend']
            ) ?>
        </p>
    <?php endif ?>
    <?php if ($module->enableRegistration): ?>
        <p class="text-center">
            <?php Html::a(Yii::t('usuario', 'Don\'t have an account? Sign up!'), ['/user/registration/register']) ?>
        </p>
    <?php endif ?>
    <!-- <?= ConnectWidget::widget(
        [
            'baseAuthUrl' => ['/user/security/auth'],
        ]
    ) ?> -->
    </div>
</div>
