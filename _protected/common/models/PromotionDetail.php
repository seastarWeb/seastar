<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_promotion_detail".
 *
 * @property integer $id
 * @property integer $promotion_id
 * @property string $promotion_detail
 * @property string $imageUrl
 *
 * @property Promotion $promotion
 */
class PromotionDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_promotion_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['promotion_id'], 'required'],
            [['promotion_id'], 'integer'],
            [['promotion_detail'], 'string'],
            [['imageUrl'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'promotion_id' => 'Promotion Related To',
            'promotion_detail' => 'Promotion Detail',
            'imageUrl' => 'Image Url',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromotion()
    {
        return $this->hasOne(Promotion::className(), ['id' => 'promotion_id']);
    }
}
