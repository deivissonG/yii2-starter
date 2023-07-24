<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property string $name
 * @property string|null $value
 * @property int $active
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'value'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('product', 'Name'),
            'value' => Yii::t('product', 'Value'),
            'active' => Yii::t('product', 'Active'),
            'created_by' => Yii::t('product', 'Created By'),
            'updated_by' => Yii::t('product', 'Updated By'),
            'created_at' => Yii::t('product', 'Created At'),
            'updated_at' => Yii::t('product', 'Updated At'),
        ];
    }
}
