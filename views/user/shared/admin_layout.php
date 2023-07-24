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

/** @var \yii\web\View $this */
/** @var string $content */

$this->params['breadcrumbs'][] = $this->title;

?>
<div class="clearfix"></div>

<?= $this->render(
    '/shared/_alert',
    [
        'module' => Yii::$app->getModule('user'),
    ]
) ?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading d-flex align-items-center justify-content-between">
                <h4 class="page-title"><?= Html::encode($this->title) ?></h4>
                <?php if (Yii::$app->controller->action->id === "index"): ?>
                <a href="<?= \yii\helpers\Url::to('create') ?>" title="<?= Yii::t('app', 'Add') ?>" class="btn btn-outline-success btn-sm"><i class="fas fa-plus feather-14"></i>  <?= Yii::t('app', 'Add') ?></a>
                <?php endif; ?>
            </div>
            <div class="panel-body">
                <?= $this->render('/shared/_menu') ?>
                <?= $content ?>
            </div>
        </div>
    </div>
</div>
