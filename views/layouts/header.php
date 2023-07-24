<?php

use Da\User\Model\Profile;

use yii\bootstrap5\Dropdown;
use yii\bootstrap5\Html;
use yii\helpers\Url;

$profile = Profile::findOne(Yii::$app->user->id);
?>
<header id="header" class="d-flex flex-row justify-content-between align-items-center px-3 py-2">
    <button id="sidebar-toggle" class="btn btn-icon rounded-circle p-2 shadow-sm text-secondary">
        <i data-feather="menu" class="feather-14"></i>
    </button>
    <div class="d-flex flex-row justify-content-between">

        <!--    Dark/light bootstrap toggle-->
        <a id="theme-toggle" class="btn btn-icon rounded-circle text-secondary shadow-sm me-3" href="javascript:void(0);" onclick="toggleTheme()" role="button" aria-expanded="false">
            <i data-feather="moon" class="feather-16"></i>
        </a>

        <a class="btn btn-pill rounded-pill dropdown-toggle text-secondary shadow-sm" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="me-2 username-dropdown"><?= $profile->name ?? Yii::$app->user->identity->username ?></span>
            <img alt="" src="<?= $profile->getAvatarUrl() ?>" class="rounded-circle" width="30px"/>
        </a>

        <?= Dropdown::widget([
            'items' => [
                ['label' => Yii::t('usuario', 'Profile'), 'url' => ['/user/settings'], 'icon' => 'settings'],
                ['label' => Yii::t('usuario', 'Logout'), 'url' => ['/user/security/logout'], 'icon' => 'log-out', 'linkOptions' => ['data-method' => 'post']],
            ],
            'options' => ['aria-labelledby' => 'navbarDropdownUserImage']
        ]); ?>
    </div>
</header>