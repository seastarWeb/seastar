<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_vat".
 *
 * @property integer $id
 * @property string $wef
 * @property string $rate
 * @property string $tds
 */
class TblVat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_vat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wef', 'tds'], 'safe'],
            [['rate'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID (tinyint)',
            'wef' => 'Date Effective',
            'rate' => 'VAT Rate',
            'tds' => 'Tds',
        ];
    }
}
