<?php

namespace app\widgets;

use Yii;
use yii\bootstrap5\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class DetailView extends \yii\bootstrap5\Widget
{

    public $model;
    /**
     * @var array[]
     * - attribute: string
     * - label: string
     * - type: string
     * - options: array
     */
    public $attributes = [];

    public $options = [
        'class' => 'col-12'
    ];

    public const TYPE_STRING = 'string';
    public const TYPE_DATE = 'date';
    public const TYPE_DATETIME = 'datetime';
    public const TYPE_BOOLEAN = 'boolean';
    public const TYPE_WEIGHT = 'weight';
    public const TYPE_CURRENCY = 'currency';
    public const TYPE_IMAGE = 'image';

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        echo '<div class="row mx-2">';
        foreach ($this->attributes as $value) {
            if (is_string($value)) {
                $attribute = $value;
                $type = 'string';
                if (count(explode(':', $value)) == 2) {
                    [$attribute, $type] = explode(':', $value);
                }
                $options = [
                    'attribute' => $attribute,
                    'label' => $this->model->getAttributeLabel($attribute),
                    'type' => $type ?: 'string'
                ];
                $this->generateField($options);
            } else if (is_array($value)) {
                if (in_array('columnSize', array_keys($value))) {
                    $this->options['class'] = $value['columnSize'];
                }
                $this->generateField(array_merge([
                    'label' => $this->model->getAttributeLabel($value['attribute']),
                    'type' => 'string'
                ], $value));
            }
        }
        echo '</div>';
    }

    public function generateField($options = []) {
        $label = Html::tag('label', $options['label'], ['class' => 'text-muted fw-bold']);
        $value = ArrayHelper::getValue($options, 'value', $this->model->{$options['attribute']});
        if (is_callable($value)) {
            $value = call_user_func($value, $this->model);
        }

        switch ($options['type']) {
            case self::TYPE_IMAGE:
                $field = '<div class="d-flex justify-content-center">' . Html::img($this->model->getImageFileUrl($options['attribute']), ['style' => 'max-height: 300px; max-width: 100%;']) . '</div>';
                break;
            case self::TYPE_DATE:
                $field = Html::tag('p', Yii::$app->formatter->asDate($value));
                break;
            case self::TYPE_DATETIME:
                $field = Html::tag('p', Yii::$app->formatter->asDatetime($value));
                break;
            case self::TYPE_CURRENCY:
                $field = Html::tag('p', Yii::$app->formatter->asCurrency($value));
                break;
            case self::TYPE_WEIGHT:
                $field = Html::tag('p', Yii::$app->formatter->asWeight($value / 1000));
                break;
            case self::TYPE_BOOLEAN:
                $field = Html::tag('p', ArrayHelper::getValue([Yii::t('yii', 'No'), Yii::t('yii', 'Yes')], (int)$value));
                break;
            default:
                $field = Html::tag('p', $value);
                break;
        }
        echo Html::tag('div', implode('', [$label, $field]), ArrayHelper::getValue($options, 'options', $this->options));
    }
}