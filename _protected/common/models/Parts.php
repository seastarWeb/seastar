<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yz\shoppingcart\CartPositionInterface;
use yz\shoppingcart\CartPositionTrait;

/**
 * This is the model class for table "parts".
 *
 * @property string $PARTNO
 * @property string $DESCRIPTION
 * @property string $PRICE
 * @property string $REFERNO
 * @property string $OBSOLETE
 * @property integer $STOCK_LEVEL
 * @property string $BIN
 * @property string $TRADE_PRICE
 * @property integer $ON_ORDER
 * @property string $GROUP1
 * @property string $PATTERN1
 * @property string $PATTERN2
 * @property string $PATTERN3
 * @property integer $REORDER
 * @property integer $MAX
 * @property string $VAT
 * @property string $SUPPLIER
 * @property string $NOTES
 * @property string $MODEL
 * @property string $PC
 * @property integer $PQTY
 * @property integer $checksum
 * @property string $Supplier2
 * @property string $Supplier3
 * @property string $Supplier4
 * @property string $Supplier5
 * @property string $Supplier6
 * @property string $Supplier7
 * @property string $TradePrice2
 * @property string $TradePrice3
 * @property string $TradePrice4
 * @property string $TradePrice5
 * @property string $TradePrice6
 * @property string $TradePrice7
 * @property string $supPartNo2
 * @property string $supPartNo3
 * @property string $supPartNo4
 * @property string $supPartNo5
 * @property string $supPartNo6
 * @property string $supPartNo7
 * @property integer $type
 * @property string $2ndPartNO
 * @property string $HighLight
 * @property integer $AddNotes
 * @property integer $A
 * @property integer $B
 * @property integer $C
 * @property string $PriceB
 * @property string $trade_price1
 * @property string $URL
 * @property string $PriceC
 * @property string $PriceD
 * @property double $weight
 */
class Parts extends ActiveRecord implements CartPositionInterface
{
    use CartPositionTrait;

    public function getPrice()
    {
	return $this->price;
    }

    public function getId()
    {
	return $this->id;
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DESCRIPTION', 'OBSOLETE', 'BIN', 'GROUP1', 'PATTERN1', 'PATTERN2', 'PATTERN3', 'NOTES', 'MODEL', 'PC', 'Supplier2', 'Supplier3', 'Supplier4', 'Supplier5', 'Supplier6', 'Supplier7', 'supPartNo2', 'supPartNo3', 'supPartNo4', 'supPartNo5', 'supPartNo6', 'supPartNo7', '2ndPartNO', 'HighLight', 'URL'], 'string'],
            [['PRICE', 'TRADE_PRICE', 'TradePrice2', 'TradePrice3', 'TradePrice4', 'TradePrice5', 'TradePrice6', 'TradePrice7', 'PriceB', 'trade_price1', 'PriceC', 'PriceD', 'weight'], 'number'],
            [['STOCK_LEVEL', 'ON_ORDER', 'REORDER', 'MAX', 'PQTY', 'checksum', 'type', 'AddNotes', 'A', 'B', 'C'], 'integer'],
            [['AddNotes', 'A', 'B', 'C'], 'required'],
            [['PARTNO', 'REFERNO'], 'string', 'max' => 50],
            [['VAT'], 'string', 'max' => 2],
            [['SUPPLIER'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PARTNO' => 'Partno',
            'DESCRIPTION' => 'Description',
            'PRICE' => 'Price',
            'REFERNO' => 'Referno',
            'OBSOLETE' => 'Obsolete',
            'STOCK_LEVEL' => 'Stock  Level',
            'BIN' => 'Bin',
            'TRADE_PRICE' => 'Trade  Price',
            'ON_ORDER' => 'On  Order',
            'GROUP1' => 'Group1',
            'PATTERN1' => 'Pattern1',
            'PATTERN2' => 'Pattern2',
            'PATTERN3' => 'Pattern3',
            'REORDER' => 'Reorder',
            'MAX' => 'Max',
            'VAT' => 'Vat',
            'SUPPLIER' => 'Supplier',
            'NOTES' => 'Notes',
            'MODEL' => 'Model',
            'PC' => 'Pc',
            'PQTY' => 'Pqty',
            'checksum' => 'Checksum',
            'Supplier2' => 'Supplier2',
            'Supplier3' => 'Supplier3',
            'Supplier4' => 'Supplier4',
            'Supplier5' => 'Supplier5',
            'Supplier6' => 'Supplier6',
            'Supplier7' => 'Supplier7',
            'TradePrice2' => 'Trade Price2',
            'TradePrice3' => 'Trade Price3',
            'TradePrice4' => 'Trade Price4',
            'TradePrice5' => 'Trade Price5',
            'TradePrice6' => 'Trade Price6',
            'TradePrice7' => 'Trade Price7',
            'supPartNo2' => 'Sup Part No2',
            'supPartNo3' => 'Sup Part No3',
            'supPartNo4' => 'Sup Part No4',
            'supPartNo5' => 'Sup Part No5',
            'supPartNo6' => 'Sup Part No6',
            'supPartNo7' => 'Sup Part No7',
            'type' => 'Type',
            '2ndPartNO' => '2nd Part No',
            'HighLight' => 'High Light',
            'AddNotes' => 'Add Notes',
            'A' => 'A',
            'B' => 'B',
            'C' => 'C',
            'PriceB' => 'Price B',
            'trade_price1' => 'Trade Price1',
            'URL' => 'Url',
            'PriceC' => 'Price C',
            'PriceD' => 'Price D',
            'weight' => 'Weight',
        ];
    }
}
