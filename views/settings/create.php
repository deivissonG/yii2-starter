<?php


/** @var yii\web\View $this */
/** @var app\widgets\Settings $model */
/** @var \yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('settings', 'Settings');
?>
<div class="categoria-create p-4 col-sm-12">

    <h4 class="mb-3"><?= $this->title ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
