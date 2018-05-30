<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_promotion".
 *
 * @property integer $id
 * @property string $promotion
 * @property string $promotion_text
 * @property string $wef
 * @property string $wet
 * @property string $created
 * @property string $imageUrl
 *
 * @property PromotionDetail[] $promotionDetails
 */
class TblPromotion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_promotion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['promotion_text'], 'string'],
            [['wef', 'wet', 'created'], 'safe'],
            [['promotion'], 'string', 'max' => 100],
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
            'promotion' => 'Promotion',
            'promotion_text' => 'Promotion Page',
            'wef' => 'Effective From',
            'wet' => 'Effective To',
            'created' => 'Created At',
            'imageUrl' => 'Image Url',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromotionDetails()
    {
        return $this->hasMany(PromotionDetail::className(), ['promotion_id' => 'id']);
    }
}
