<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $state_id
 * @property int $active
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property State $state
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['state_id', 'active', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['state_id'], 'exist', 'skipOnError' => true, 'targetClass' => State::class, 'targetAttribute' => ['state_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('product', 'ID'),
            'name' => Yii::t('product', 'Name'),
            'state_id' => Yii::t('product', 'State ID'),
            'active' => Yii::t('product', 'Active'),
            'created_by' => Yii::t('product', 'Created By'),
            'updated_by' => Yii::t('product', 'Updated By'),
            'created_at' => Yii::t('product', 'Created At'),
            'updated_at' => Yii::t('product', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[State]].
     *
     * @return \yii\db\ActiveQuery|StateQuery
     */
    public function getState()
    {
        return $this->hasOne(State::class, ['id' => 'state_id']);
    }

    /**
     * {@inheritdoc}
     * @return CityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CityQuery(get_called_class());
    }
}
