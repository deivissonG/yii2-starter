<?php

namespace app\models;

use Da\User\Model\User as BaseUser;

/**
 * @property UserNotification[] $userNotifications
 */
class User extends BaseUser implements \yii\web\IdentityInterface
{

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return Customer::findOne(['access_token' => $token]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserNotifications()
    {
        return $this->hasMany(UserNotification::class, ['user_id' => 'id']);
    }
}