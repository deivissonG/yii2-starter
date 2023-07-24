<?php

namespace app\controllers\user;

use Yii;
use Da\User\Model\User;
use Da\User\Event\UserEvent;
use Da\User\Factory\MailFactory;
use Da\User\Service\UserCreateService;
use Da\User\Validator\AjaxRequestModelValidator;
use Da\User\Controller\AdminController as BaseController;

class AdminController extends BaseController
{
    public function actionCreate()
    {
        /** @var User $user */
        $user = $this->make(User::class, [], ['scenario' => 'create']);

        /** @var UserEvent $event */
        $event = $this->make(UserEvent::class, [$user]);

        $this->make(AjaxRequestModelValidator::class, [$user])->validate();

        if ($user->load(Yii::$app->request->post()) && $user->validate()) {
            $this->trigger(UserEvent::EVENT_BEFORE_CREATE, $event);

            $mailService = MailFactory::makeWelcomeMailerService($user);

            if ($this->make(UserCreateService::class, [$user, $mailService])->run() || $user->save()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('usuario', 'User has been created'));
                $this->trigger(UserEvent::EVENT_AFTER_CREATE, $event);
                return $this->redirect(['update', 'id' => $user->id]);
            }
            Yii::$app->session->setFlash('danger', Yii::t('usuario', 'User account could not be created.'));
        }

        return $this->render('create', ['user' => $user]);
    }
}