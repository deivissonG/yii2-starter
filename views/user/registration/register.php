<?php

/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View                   $this
 * @var \Da\User\Form\RegistrationForm $model
 * @var \Da\User\Model\User            $user
 * @var \Da\User\Module                $module
 */

$this->title = Yii::t('usuario', 'Sign up');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row h-100 vh-100 position-relative bg-light">
    <div class="position-absolute top-50 start-50 translate-middle card col-sm-12 col-md-8 col-lg-6 col-xl-4 p-4">
        <div class="card-title px-2">
            <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="card-body">
            <?php $form = ActiveForm::begin(
                [
                    'id' => $model->formName(),
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
                ]
            ); ?>

            <div class="mb-2">
                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
            </div>
            <div class="mb-2">
                <?= $form->field($model, 'username') ?>
            </div>
            <?php if ($module->generatePasswords === false): ?>
                <div class="mb-2">
                    <?= $form->field($model, 'password')->passwordInput() ?>
                </div>
            <?php endif ?>

            <?php if ($module->enableGdprCompliance): ?>
                <div class="mb-2">
                    <?= $form->field($model, 'gdpr_consent')->checkbox(['value' => 1]) ?>
                </div>
            <?php endif ?>
            <div class="mb-2">
                <?= Html::submitButton(Yii::t('usuario', 'Sign up'), ['class' => 'btn btn-success btn-block']) ?>
            </div>

            <?php ActiveForm::end(); ?>
            <p class="text-center">
                <?= Html::a(Yii::t('usuario', 'Already registered? Sign in!'), ['/user/security/login']) ?>
            </p>
        </div>
    </div>
</div>
