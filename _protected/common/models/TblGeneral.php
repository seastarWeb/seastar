<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_general".
 *
 * @property integer $id
 * @property integer $model_id
 * @property string $instruments
 * @property string $warranty
 * @property string $maintenance_service_intervals
 * @property string $valve_clearance_check
 *
 * @property Models $model
 */
class TblGeneral extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_general';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model_id'], 'required'],
            [['model_id'], 'integer'],
            [['instruments'], 'string', 'max' => 1000],
            [['warranty'], 'string', 'max' => 50],
            [['maintenance_service_intervals'], 'string', 'max' => 50],
            [['valve_clearance_check'], 'string', 'max' => 50]
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
            'instruments' => 'Instruments',
            'warranty' => 'Warranty',
            'maintenance_service_intervals' => 'Maintenance Service Intervals',
            'valve_clearance_check' => 'Valve Clearance Check',
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
