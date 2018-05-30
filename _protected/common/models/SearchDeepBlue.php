<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\DeepBlueParts;

/**
 * SearchDeepBlue represents the model behind the search form about `common\models\DeepBlueParts`.
 */
class SearchDeepBlue extends DeepBlueParts
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['partid', 'STOCK_LEVEL', 'ON_ORDER', 'REORDER', 'MAX', 'PQTY', 'checksum', 'type', 'AddNotes', 'A', 'B', 'C'], 'integer'],
            [['PARTNO', 'DESCRIPTION', 'REFERNO', 'OBSOLETE', 'BIN', 'GROUP1', 'PATTERN1', 'PATTERN2', 'PATTERN3', 'VAT', 'SUPPLIER', 'NOTES', 'MODEL', 'PC', 'Supplier2', 'Supplier3', 'Supplier4', 'Supplier5', 'Supplier6', 'Supplier7', 'supPartNo2', 'supPartNo3', 'supPartNo4', 'supPartNo5', 'supPartNo6', 'supPartNo7', '2ndPartNO', 'HighLight', 'URL'], 'safe'],
            [['PRICE', 'TRADE_PRICE', 'TradePrice2', 'TradePrice3', 'TradePrice4', 'TradePrice5', 'TradePrice6', 'TradePrice7', 'PriceB', 'trade_price1', 'PriceC', 'PriceD', 'weight'], 'number'],
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
        $query = DeepBlueParts::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'partid' => $this->partid,
            'PRICE' => $this->PRICE,
            'STOCK_LEVEL' => $this->STOCK_LEVEL,
            'TRADE_PRICE' => $this->TRADE_PRICE,
            'ON_ORDER' => $this->ON_ORDER,
            'REORDER' => $this->REORDER,
            'MAX' => $this->MAX,
            'PQTY' => $this->PQTY,
            'checksum' => $this->checksum,
            'TradePrice2' => $this->TradePrice2,
            'TradePrice3' => $this->TradePrice3,
            'TradePrice4' => $this->TradePrice4,
            'TradePrice5' => $this->TradePrice5,
            'TradePrice6' => $this->TradePrice6,
            'TradePrice7' => $this->TradePrice7,
            'type' => $this->type,
            'AddNotes' => $this->AddNotes,
            'A' => $this->A,
            'B' => $this->B,
            'C' => $this->C,
            'PriceB' => $this->PriceB,
            'trade_price1' => $this->trade_price1,
            'PriceC' => $this->PriceC,
            'PriceD' => $this->PriceD,
            'weight' => $this->weight,
        ]);

        $query->andFilterWhere(['like', 'PARTNO', $this->PARTNO])
            ->andFilterWhere(['like', 'DESCRIPTION', $this->DESCRIPTION])
            ->andFilterWhere(['like', 'REFERNO', $this->REFERNO])
            ->andFilterWhere(['like', 'OBSOLETE', $this->OBSOLETE])
            ->andFilterWhere(['like', 'BIN', $this->BIN])
            ->andFilterWhere(['like', 'GROUP1', $this->GROUP1])
            ->andFilterWhere(['like', 'PATTERN1', $this->PATTERN1])
            ->andFilterWhere(['like', 'PATTERN2', $this->PATTERN2])
            ->andFilterWhere(['like', 'PATTERN3', $this->PATTERN3])
            ->andFilterWhere(['like', 'VAT', $this->VAT])
            ->andFilterWhere(['like', 'SUPPLIER', $this->SUPPLIER])
            ->andFilterWhere(['like', 'NOTES', $this->NOTES])
            ->andFilterWhere(['like', 'MODEL', $this->MODEL])
            ->andFilterWhere(['like', 'PC', $this->PC])
            ->andFilterWhere(['like', 'Supplier2', $this->Supplier2])
            ->andFilterWhere(['like', 'Supplier3', $this->Supplier3])
            ->andFilterWhere(['like', 'Supplier4', $this->Supplier4])
            ->andFilterWhere(['like', 'Supplier5', $this->Supplier5])
            ->andFilterWhere(['like', 'Supplier6', $this->Supplier6])
            ->andFilterWhere(['like', 'Supplier7', $this->Supplier7])
            ->andFilterWhere(['like', 'supPartNo2', $this->supPartNo2])
            ->andFilterWhere(['like', 'supPartNo3', $this->supPartNo3])
            ->andFilterWhere(['like', 'supPartNo4', $this->supPartNo4])
            ->andFilterWhere(['like', 'supPartNo5', $this->supPartNo5])
            ->andFilterWhere(['like', 'supPartNo6', $this->supPartNo6])
            ->andFilterWhere(['like', 'supPartNo7', $this->supPartNo7])
            ->andFilterWhere(['like', 'HighLight', $this->HighLight])
            ->andFilterWhere(['like', 'URL', $this->URL]);

        return $dataProvider;
    }
}
