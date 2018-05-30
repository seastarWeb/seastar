<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_colour".
 *
 * @property integer $id
 * @property integer $model_id
 * @property string $colour_combinations
 * @property string $tank_frame_wheels
 * @property string $colour_option
 *
 * @property Models $model
 */
class TblColour extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_colour';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model_id'], 'required'],
            [['model_id'], 'integer'],
            [['colour_combinations'], 'string', 'max' => 26],
            [['tank_frame_wheels', 'colour_option'], 'string', 'max' => 17],
            [['model_id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'model_id' => 'Model ID',
            'colour_combinations' => 'Colour Combinations',
            'tank_frame_wheels' => 'Tank Frame Wheels',
            'colour_option' => 'Colour Option',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModel()
    {
        return $this->hasOne(Models::className(), ['id' => 'model_id']);
    }
}
