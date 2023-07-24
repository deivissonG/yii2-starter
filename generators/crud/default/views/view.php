<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/** @var yii\web\View $this */
/** @var app\generators\crud\Generator $generator */

$urlParams = $generator->generateUrlParams();

echo "<?php\n";
?>

use yii\helpers\Html;
use \app\widgets\DetailView;

/** @var yii\web\View $this */
/** @var <?= ltrim($generator->modelClass, '\\') ?> $model */

$this->title = <?= $generator->generateString('$model->' . $generator->getNameAttribute()); ?>;
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-view my-1 mx-3">

    <div class="d-flex flex-row align-items-center my-3">
        <h4 class="page-title m-0"><?= "<?= " ?>Html::encode($this->title) ?></h4>
        <?= "<?= " ?>Html::a('<i data-feather="edit-3"></i>', ['update', <?= $urlParams ?>], ['class' => 'btn btn-icon-sm shadow-sm text-primary rounded-circle mx-2 px-2']) ?>
        <?= "<?= " ?>Html::a('<i data-feather="trash-2"></i>', ['delete', <?= $urlParams ?>], [
            'class' => 'btn btn-icon-sm shadow-sm text-danger rounded-circle px-2',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </div>
    <div class="row mx-0">
        <div class="card col-12 col-xxl-8">
            <div class="card-title h6"><?= "<?= " ?> Yii::t('app', 'Basic Info') ?></div>
            <div class="card-body">
                <?= "<?= " ?>DetailView::widget([
                    'model' => $model,
                    'attributes' => [
<?php
if (($tableSchema = $generator->getTableSchema()) === false) {
    foreach ($generator->getColumnNames() as $name) {
        if (!in_array($name, ['active', 'created_at', 'updated_at', 'created_by', 'updated_by'])) {
            echo "                        '" . $name . "',\n";
        }
    }
} else {
    foreach ($generator->getTableSchema()->columns as $column) {
        if (!in_array($column->name, ['active', 'created_at', 'updated_at', 'created_by', 'updated_by'])) {
            $format = $generator->generateColumnFormat($column);
            echo "                        '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
        }
    }
}
?>
                    ],
                ]) ?>
            </div>
        </div>
        <div class="col-12 col-xxl-4">
            <?= "<?= " ?> $this->render('@app/views/common/_recordInfo', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
