<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "finance_log".
 *
 * @property integer $id
 * @property string $url
 * @property string $tds
 * @property string $requester_ip
 * @property string $geolocation
 * @property double $amount
 * @property integer $orderid
 */
class FinanceLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'finance_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tds'], 'safe'],
            [['amount'], 'number'],
            [['orderid'], 'integer'],
            [['url'], 'string', 'max' => 255],
            [['requester_ip', 'geolocation'], 'string', 'max' => 50]
        ];
    }
public function behaviors()
{
    return [
        'timestamp' => [
            'class' => TimestampBehavior::className(),
            'attributes' => [
                ActiveRecord::EVENT_BEFORE_INSERT => 'tds',
  //              ActiveRecord::EVENT_BEFORE_UPDATE => 'update_time',
            ],
            'value' => function() { return date("Y-m-d H:i:s"); },// unix timestamp },
        ],
    ];
}
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'tds' => 'Tds',
            'requester_ip' => 'Requester Ip',
            'geolocation' => 'Geolocation',
            'amount' => 'Amount',
            'orderid' => 'Orderid',
        ];
    }
}
