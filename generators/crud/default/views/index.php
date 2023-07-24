<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/** @var yii\web\View $this */
/** @var app\generator\crud\Generator $generator */

$modelClass = StringHelper::basename($generator->modelClass);

echo "<?php\n";
?>

use <?= $generator->modelClass ?>;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\ActionColumn;
use <?= $generator->indexWidgetType === 'grid' ? "kartik\\grid\\GridView" : "yii\\widgets\\ListView" ?>;
<?= $generator->enablePjax ? 'use yii\widgets\Pjax;' : '' ?>

/** @var yii\web\View $this */
<?= !empty($generator->searchModelClass) ? "/** @var " . ltrim($generator->searchModelClass, '\\') . " \$searchModel */\n" : '' ?>
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-index">

<?= $generator->enablePjax ? "    <?php Pjax::begin(); ?>\n" : '' ?>
<?php if(!empty($generator->searchModelClass)): ?>
<?= "    <?php " . ($generator->indexWidgetType === 'grid' ? "// " : "") ?>echo $this->render('_search', ['model' => $searchModel]); ?>
<?php endif; ?>

<?php if ($generator->indexWidgetType === 'grid'): ?>
    <?= "<?= " ?>GridView::widget([
        'dataProvider' => $dataProvider,
        <?= !empty($generator->searchModelClass) ? "'filterModel' => \$searchModel,\n        'columns' => [\n" : "'columns' => [\n"; ?>
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, <?= StringHelper::basename($generator->modelClass) ?> $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'template' => '{view} {update} {delete}',
                'viewOptions' => [
                    'icon' => '<i data-feather="eye" class="feather-16"></i>',
                    'class' => 'btn btn-outline-success btn-sm'
                ],
                'updateOptions' => [
                    'icon' => '<i data-feather="edit-3" class="feather-16"></i>',
                    'class' => 'btn btn-outline-primary btn-sm'
                ],
                'deleteOptions' => [
                    'icon' => '<i data-feather="trash-2" class="feather-16"></i>',
                    'class' => 'btn btn-outline-danger btn-sm'
                ],
                'noWrap' => true
            ],

<?php
$count = 0;
if (($tableSchema = $generator->getTableSchema()) === false) {
    foreach ($generator->getColumnNames() as $name) {
        if (++$count < 7) {
            echo "            '" . $name . "',\n";
        } else {
            echo "            //'" . $name . "',\n";
        }
    }
} else {
    foreach ($tableSchema->columns as $column) {
        $format = $generator->generateColumnFormat($column);
            // generate columns for each type using kartik widgets
            echo "            [\n";
            echo "                'attribute' => '" . $column->name . "',\n";
            if ($format === 'datetime') {
                echo "                'filterType' => GridView::FILTER_DATE,\n";
                echo "                'format' => ['date', 'dd/MM/Y HH:mm:ss'],\n";
                echo "                'filterOptions' => [\n";
                echo "                    'pluginOptions' => [\n";
                echo "                        'autoclose' => true,\n";
                echo "                        'format' => 'dd-M-yyyy'\n";
                echo "                    ]\n";
                echo "                ],\n";
                echo "                'noWrap' => true\n";
            } elseif ($format === 'image'){
                echo "                'format' => 'raw',\n";
                echo "                'value' => function (\$model) {\n";
                echo "                    return Html::img(\$model->getImageFileUrl('" . $column->name . "'), ['width' => '100px']);\n";
                echo "                }\n";
            } elseif ($column->name === 'active') {
                echo "                'class' => \kartik\grid\BooleanColumn::class,\n";
                echo "                'filterType' => GridView::FILTER_SELECT2,\n";
                echo "                'filter' => ['0' => Yii::t('app', 'Active'), '1' => Yii::t('app', 'Inactive')],\n";
                echo "                'filterWidgetOptions' => [\n";
                echo "                    'pluginOptions' => [\n";
                echo "                        'placeholder' => Yii::t('app', 'Select'),\n";
                echo "                        'allowClear' => true\n";
                echo "                    ],\n";
                echo "                ],\n";
            } elseif ($format === 'boolean') {
                echo "                'class' => \kartik\grid\BooleanColumn::class,\n";
                echo "                'filterType' => GridView::FILTER_SELECT2,\n";
                echo "                'filter' => ['0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')],\n";
                echo "                'filterWidgetOptions' => [\n";
                echo "                    'pluginOptions' => [\n";
                echo "                        'placeholder' => Yii::t('app', 'Select'),\n";
                echo "                        'allowClear' => true\n";
                echo "                    ],\n";
                echo "                ],\n";
            } elseif ($format === 'boolean') {
                echo "                'class' => \kartik\grid\BooleanColumn::class,\n";
                echo "                'filterType' => GridView::FILTER_SELECT2,\n";
                echo "                'filter' => ['0' => Yii::t('app', 'Active'), '1' => Yii::t('app', 'Inactive')],\n";
                echo "                'filterWidgetOptions' => [\n";
                echo "                    'pluginOptions' => [\n";
                echo "                        'placeholder' => Yii::t('app', 'Select'),\n";
                echo "                        'allowClear' => true\n";
                echo "                    ],\n";
                echo "                ],\n";
            } elseif ($column->type === 'integer' && in_array($column->name, ['created_by', 'updated_by'])) {
                echo "                'value' => function (\$model) {\n";
                echo "                    \$user = \app\models\User::findOne(\$model->$column->name);\n";
                echo "                    if (\$user) {\n";
                echo "                        return \yii\helpers\ArrayHelper::getValue(\$user, 'profile.name') ?? \$user->username;\n";
                echo "                    }\n";
                echo "                    return null;\n";
                echo "                },\n";
                echo "                'filterType' => GridView::FILTER_SELECT2,\n";
                echo "                'filter' => \yii\helpers\ArrayHelper::map(\app\models\User::find()->all(), 'id',\n";
                echo "                    function (\$m) {\n";
                echo "                        return \yii\helpers\ArrayHelper::getValue(\$m, 'profile.name') ?? \$m->username;\n";
                echo "                    }),\n";
                echo "                'filterWidgetOptions' => [\n";
                echo "                    'pluginOptions' => [\n";
                echo "                        'allowClear' => true,\n";
                echo "                    ],\n";
                echo "                ],\n";
                echo "                'filterInputOptions' => [\n";
                echo "                    'placeholder' => Yii::t('app', 'Select a {model}', [\n";
                echo "                        'model' => Yii::t('app', 'User')\n";
                echo "                    ]),\n";
                echo "                ],\n";
                echo "                'noWrap' => true\n";
            } else {
                echo "                'noWrap' => true\n";
            }
            echo "            ],\n";
//            echo "            '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
//        } else {
//            echo "            //'" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
//        }
    }
}
?>
        ],
        'headerContainer' => ['style' => 'top:50px', 'class' => 'kv-table-header'],
        'floatHeader' => false,
        'floatPageSummary' => true,
        'floatFooter' => false,
        'responsive' => false,
        'responsiveWrap' => false,
        'striped' => false,
        'showPageSummary' => true,
        'panel' => [
            'heading'=> false,
            'type' => 'default',
            'showFooter'=>false
        ],
        'exportConfig' => [
            'csv' => [],
            'txt' => [],
            'xls' => [],
        ],
        'toolbar' =>  [
            Html::a('<i class="fas fa-plus"></i> ' . Yii::t('app', 'Add'), ['create'], ['class' => 'btn btn-sm btn-outline-success']),
            Html::a('<i class="fas fa-redo"></i> ' . Yii::t('app', 'Reset'), ['index'], [ 'class' => 'btn btn-sm btn-outline-secondary']),
            '{export}',
            '{toggleData}',
        ],
        'persistResize' => false,
        'export' => [
            'label' => Yii::t('app', 'Export'),
            'options' => [
                'class' => 'btn btn-outline-secondary btn-sm'
            ]
        ],
        'panelBeforeTemplate' => '<div class="clearfix m-2 mb-4"><h4 class="page-title float-start">' . $this->title . '</h4><div class="float-end">{toolbar}</div>',
        'toggleDataOptions' => [
            'minCount' => 10,
            'all' => [
                'class' => 'btn btn-sm btn-outline-secondary',
            ],
            'page' => [
                'class' => 'btn btn-sm btn-outline-secondary',
            ],
        ],
    ]); ?>
<?php else: ?>
    <?= "<?= " ?>ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model-><?= $generator->getNameAttribute() ?>), ['view', <?= $generator->generateUrlParams() ?>]);
        },
    ]) ?>
<?php endif; ?>

<?= $generator->enablePjax ? "    <?php Pjax::end(); ?>\n" : '' ?>

</div>
