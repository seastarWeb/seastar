<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MenuMaintenance;

/**
 * SearchMenu represents the model behind the search form about `backend\models\MenuMaintenance`.
 */
class SearchMenu extends MenuMaintenance
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pid', 'status', 'version'], 'integer'],
            [['menu', 'metadesc', 'title', 'page', 'template', 'URL'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = MenuMaintenance::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'pid' => $this->pid,
            'status' => $this->status,
            'version' => $this->version,
        ]);

        $query->andFilterWhere(['like', 'menu', $this->menu])
            ->andFilterWhere(['like', 'metadesc', $this->metadesc])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'page', $this->page])
            ->andFilterWhere(['like', 'template', $this->template])
            ->andFilterWhere(['like', 'URL', $this->URL]);

        return $dataProvider;
    }
}
