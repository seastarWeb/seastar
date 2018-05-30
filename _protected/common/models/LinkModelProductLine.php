<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "link_model_productline".
 *
 * @property integer $mid
 * @property integer $plid
 *
 * @property Models $m
 * @property ProductLines $pl
 */
class LinkModelProductLine extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'link_model_productline';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mid', 'plid'], 'required'],
            [['mid', 'plid'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mid' => 'Model Identifier',
            'plid' => 'Product Line Identifier',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getM()
    {
        return $this->hasOne(Models::className(), ['id' => 'mid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPl()
    {
        return $this->hasOne(ProductLines::className(), ['id' => 'plid']);
    }
}
