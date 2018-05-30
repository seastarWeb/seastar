<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;
/**
 * This is the model class for table "tbl_model_range".
 *
 * @property integer $id
 * @property string $model_range
 *
 * @property Models[] $models
 */
class TblModelRange extends \yii\db\ActiveRecord
{
/**
 * @inheritdoc
 */
    public function behaviors()
    {
        return [
        [
        'class' => SluggableBehavior::className(),
        'attribute' => 'model_range',
        'slugAttribute' => 'alias',
        ],
        ];
    }


    public static function tableName()
    {
        return 'tbl_model_range';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model_range'], 'required'],
            [['model_range'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'model_range' => 'Model Range',
            'alias' => 'Slug',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModels()
    {
        return $this->hasMany(Models::className(), ['model_range_id' => 'id']);
    }
}
