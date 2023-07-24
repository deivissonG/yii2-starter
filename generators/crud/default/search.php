<?php
/**
 * This is the template for generating CRUD search class of the specified model.
 */

use yii\helpers\StringHelper;


/** @var yii\web\View $this */
/** @var app\generators\crud\Generator $generator */

$modelClass = StringHelper::basename($generator->modelClass);
$searchModelClass = StringHelper::basename($generator->searchModelClass);
if ($modelClass === $searchModelClass) {
    $modelAlias = $modelClass . 'Model';
}
$rules = $generator->generateSearchRules();
$labels = $generator->generateSearchLabels();
$searchAttributes = $generator->getSearchAttributes();
$searchConditions = $generator->generateSearchConditions();

echo "<?php\n";
?>

namespace <?= StringHelper::dirname(ltrim($generator->searchModelClass, '\\')) ?>;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use <?= ltrim($generator->modelClass, '\\') . (isset($modelAlias) ? " as $modelAlias" : "") ?>;

/**
 * <?= $searchModelClass ?> represents the model behind the search form of `<?= $generator->modelClass ?>`.
 */
class <?= $searchModelClass ?> extends <?= isset($modelAlias) ? $modelAlias : $modelClass ?>

{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            <?= implode(",\n            ", $rules) ?>,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = <?= isset($modelAlias) ? $modelAlias : $modelClass ?>::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        <?= implode("\n        ", $searchConditions) ?>
<?php if ($table = $generator->getTableSchema()) {
    $columns = \yii\helpers\ArrayHelper::getColumn($table->columns, 'name');
    if (in_array('created_at', $columns)){
        echo "
        if(\$this->created_at){
            \$date = \DateTime::createFromFormat('d/m/Y', \$this->created_at, new \DateTimeZone('America/Bahia'));
            if(\$date) {
                \$query->andFilterWhere(['like', 'created_at', \$date->format('Y-m-d')]);
            }
        }
        ";
    }
    if (in_array('updated_at', $columns)) {
        echo "
        if(\$this->updated_at){
            \$date = \DateTime::createFromFormat('d/m/Y', \$this->updated_at, new \DateTimeZone('America/Bahia'));
            if(\$date) {
                \$query->andFilterWhere(['like', 'updated_at', \$date->format('Y-m-d')]);
            }
        }
        ";
    }


} ?>

        return $dataProvider;
    }
}
