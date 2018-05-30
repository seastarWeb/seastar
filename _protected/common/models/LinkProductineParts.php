<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "link_pl_parts".
 *
 * @property string $plid
 * @property string $partnumber
 */
class LinkProductineParts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'link_pl_parts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['plid', 'partnumber'], 'required'],
            [['plid'], 'string', 'max' => 20],
            [['partnumber'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'plid' => 'Product Line ID',
            'partnumber' => 'Part Number',
        ];
    }
}
