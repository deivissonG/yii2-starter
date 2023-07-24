<?php

/** @var array $items */

$settings = new \app\widgets\Settings();
$companyLogo = file_exists(Yii::getAlias('@app/web') . $settings->getLogo()) ? $settings->getLogo() : '/default.png';
$companyName = $settings->getCompanyName() ?? Yii::$app->params['appName'];

$currentRoute = '/' . Yii::$app->controller->id . '/' . Yii::$app->controller->action->id;

if (Yii::$app->controller->id === 'site') {
    $currentRoute = '/' . Yii::$app->controller->action->id;
}
?>

<div class="sidebar-header p-2 d-flex flex-row align-items-center">
    <a href="/" title="<?= $companyName ?>" about="Home">
        <?= $companyLogo? "<img src=\"$companyLogo\" alt=\"$companyName\" height='44' />" : '<h1>' . Yii::$app->params['appName'] . '</h1>' ?>
    </a>
</div>
<nav class="d-flex flex-column mb-1 mt-4 px-3">
    <a href="/" class="text-decoration-none p-2 align-middle d-flex align-items-center <?= in_array($currentRoute, ['/', '/index']) ? 'text-primary' : 'text-secondary'?>"><i data-feather="home" class="me-2 feather-18"></i><?= Yii::t('app', 'Dashboard') ?></a>
    <?php foreach($items as $category => $item): ?>
        <p class="nav-cat my-1 fw-bold"><?= $category ?></p>
        <?php foreach($item as $navItem): ?>
            <a href="<?= $navItem['url'] ?>" class="text-decoration-none <?= $navItem['active'] ? 'text-primary' : 'text-secondary'?> p-2"><i data-feather="<?= $navItem['icon'] ?>" class="me-2 feather-18"></i><?= $navItem['label'] ?></a>
        <?php endforeach; ?>
    <?php endforeach; ?>
</nav>