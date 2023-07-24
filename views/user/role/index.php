<?php

/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Url;

/**
 * @var \yii\data\DataProviderInterface $dataProvider
 * @var \Da\User\Search\RoleSearch $searchModel
 * @var yii\web\View $this
 * @var \Da\User\Module $module
 */

$this->title = Yii::t('usuario', 'Roles');
//$this->params['breadcrumbs'][] = $this->title;

?>
<div class="p-3">
    <?php $this->beginContent($module->viewPath . '/shared/admin_layout.php') ?>
    <div class="table-responsive">
        <?= \kartik\grid\GridView::widget(
            [
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'layout' => "{items}\n{pager}",
                'columns' => [
                    [
                        'class' => \kartik\grid\ActionColumn::class,
                        'template' => '{update} {delete}',
                        'noWrap' => true,
                        'updateOptions' => [
                            'icon' => '<i data-feather="edit-3" class="feather-16"></i>',
                            'class' => 'btn btn-outline-primary btn-sm'
                        ],
                        'deleteOptions' => [
                            'icon' => '<i data-feather="trash-2" class="feather-16"></i>',
                            'class' => 'btn btn-outline-danger btn-sm'
                        ],
                    ],
                    [
                        'attribute' => 'name',
                        'header' => Yii::t('usuario', 'Name'),
                        'options' => [
                            'style' => 'width: 20%',
                        ],
                    ],
                    [
                        'attribute' => 'description',
                        'header' => Yii::t('usuario', 'Description'),
                        'options' => [
                            'style' => 'width: 55%',
                        ],
                    ],
                    [
                        'attribute' => 'rule_name',
                        'header' => Yii::t('usuario', 'Rule name'),
                        'options' => [
                            'style' => 'width: 20%',
                        ],
                    ],
                ],
                'headerContainer' => ['style' => 'top:50px', 'class' => 'kv-table-header'],
                'floatHeader' => false,
                'floatPageSummary' => true,
                'floatFooter' => false,
                'responsive' => false,
                'responsiveWrap' => false,
                'striped' => false,
                'showPageSummary' => true,
            ]
        ) ?>
    </div>
    <?php $this->endContent() ?>
</div>