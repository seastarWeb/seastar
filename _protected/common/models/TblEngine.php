<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_engine".
 *
 * @property integer $id
 * @property integer $model_id
 * @property string $type
 * @property string $displacement
 * @property string $bore_and_stroke
 * @property string $compression_ratio
 * @property string $power
 * @property string $torque
 * @property string $fuel_injection
 * @property string $exaust
 * @property string $emissions
 * @property string $gearbox
 * @property string $ratio
 * @property string $primary_drive
 * @property string $final_drive
 * @property string $clutch
 *
 * @property Models $model
 */
class TblEngine extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_engine';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model_id'], 'integer'],
            [['type'], 'string', 'max' => 84],
            [['displacement'], 'string', 'max' => 50],
            [['bore_and_stroke'], 'string', 'max' => 100],
            [['compression_ratio'], 'string', 'max' => 50],
            [['power'], 'string', 'max' => 50],
            [['torque'], 'string', 'max' => 50],
            [['fuel_injection'], 'string', 'max' => 255],
            [['exaust'], 'string', 'max' => 255],
            [['emissions'], 'string', 'max' => 100],
            [['gearbox'], 'string', 'max' =>100],
            [['ratio'], 'string', 'max' => 100],
            [['primary_drive'], 'string', 'max' => 100],
            [['final_drive'], 'string', 'max' => 100],
            [['clutch'], 'string', 'max' => 200],
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
            'type' => 'Type',
            'displacement' => 'Displacement',
            'bore_and_stroke' => 'Bore And Stroke',
            'compression_ratio' => 'Compression Ratio',
            'power' => 'Power',
            'torque' => 'Torque',
            'fuel_injection' => 'Fuel Injection',
            'exaust' => 'Exhaust',
            'emissions' => 'Emissions',
            'gearbox' => 'Gearbox',
            'ratio' => 'Ratio',
            'primary_drive' => 'Primary Drive',
            'final_drive' => 'Final Drive',
            'clutch' => 'Clutch',
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
