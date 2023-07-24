<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/** @var yii\web\View $this */
/** @var app\generators\crud\Generator $generator */

$urlParams = $generator->generateUrlParams();
$modelClassName = Inflector::camel2words(StringHelper::basename($generator->modelClass));
$nameAttributeTemplate = '$model->' . $generator->getNameAttribute();
$titleTemplate = $generator->generateString('Update ' . $modelClassName . ': {name}', ['name' => '{nameAttribute}']);
if ($generator->enableI18N) {
    $title = strtr($titleTemplate, ['\'{nameAttribute}\'' => $nameAttributeTemplate]);
} else {
    $title = strtr($titleTemplate, ['{nameAttribute}\'' => '\' . ' . $nameAttributeTemplate]);
}

echo "<?php\n";
?>

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var <?= ltrim($generator->modelClass, '\\') ?> $model */

$this->title = <?= $title ?>;
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model-><?= $generator->getNameAttribute() ?>, 'url' => ['view', <?= $urlParams ?>]];
$this->params['breadcrumbs'][] = <?= $generator->generateString('Update') ?>;
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-update my-1 mx-3">
    <h4 class="page-title my-3"><?= "<?= " ?>Html::encode($this->title) ?></h4>
    <div class="border rounded col-12 col-xxl-8">
        <div class="form-title h6 border-bottom m-0 p-2 py-3 mb-2"><?= Yii::t('app', 'Basic Info') ?></div>
        <div class="form-body mx-2">
            <?= "<?= " ?>$this->render('_form', [
            'model' => $model,
            ]) ?>
        </div>
    </div>
</div>

