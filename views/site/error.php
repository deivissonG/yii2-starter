<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception$exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error bg-light vh-100 d-flex flex-column justify-content-center align-items-center">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= nl2br(Html::encode($message)) ?>
</div>
