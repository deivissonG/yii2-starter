<?php

/** @var yii\web\View $this */
/** @var string $content */

use kartik\bs5dropdown\Dropdown;
use yii\bootstrap5\Html;
use app\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use diecoding\toastr\ToastrFlash;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);


ToastrFlash::widget([
    'positionClass' => 'toast-bottom-right'
]);

?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/feather-icons"></script>
    </head>
    <body class="d-flex flex-row h-100 align-items-stretch">
    <?php $this->beginBody() ?>

    <div id="sidebar">
        <?= $this->render('sidebar', [
            'items' => [
                Yii::t('app', 'Advanced') => [
                    ['url' => '/user/admin', 'label' => Yii::t('app', 'Users'), 'icon' => 'user', 'active' => @substr_compare(Yii::$app->controller->route, 'user', 0, strlen('user'))==0],
                    ['url' => '/settings/index', 'label' => Yii::t('settings', 'Settings'), 'icon' => 'settings', 'active' => Yii::$app->controller->id === 'settings']
                ]
            ]
        ]); ?>
    </div>
    <div class="wrapper d-flex flex-column flex-nowrap h-100 overflow-scroll w-100">
        <?= $this->render('header'); ?>

        <main id="main" class="flex-shrink-0 align-self-stretch" role="main">
            <div class="container-fluid py-2 h-100 bg-secondary-subtle">
                <div class="card py-2 rounded-4 shadow-sm">
                    <?php if (!empty($this->params['breadcrumbs'])): ?>
                        <div class="breadcrumb-wrapper ms-3">
                            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]); ?>
                        </div>
                    <?php endif ?>
                    <?= $content ?>
                </div>
            </div>
        </main>
    </div>

    <?php $this->endBody() ?>
    <script>
        feather.replace()
    </script>
    </body>

    </html>
<?php $this->endPage() ?>