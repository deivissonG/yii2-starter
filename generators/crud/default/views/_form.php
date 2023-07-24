<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/** @var yii\web\View $this */
/** @var app\generator\crud\Generator $generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
<?= $generator->hasBooleanColumn()? 'use kartik\switchinput\SwitchInput;' : '' ?>


/** @var yii\web\View $this */
/** @var <?= ltrim($generator->modelClass, '\\') ?> $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form col-12">
    <?= "<?php " ?>$form = ActiveForm::begin([
        'layout' => 'horizontal',
        'class' => 'form-horizontal',
    ]); ?>

<?php foreach ($generator->getColumnNames() as $attribute) {
    if (in_array($attribute, $safeAttributes) && !preg_match('/^(updated_at|created_at|created_by|updated_by)$/i', $attribute)) {
        echo "        <?= " . $generator->generateActiveField($attribute) . " ?>\n\n";
    }
} ?>
    <div class="row">
        <div class="col-2 form-group text-end my-2"></div>
        <div class="col-10 form-group my-2">
            <?= "<?= " ?>Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            <?= "<?= " ?>Html::button(Yii::t('app', 'Back'), ['class' => 'btn btn-default', 'onclick' => 'window.history.back()']) ?>
        </div>
    </div>
    <?= "<?php " ?>ActiveForm::end(); ?>
</div>
