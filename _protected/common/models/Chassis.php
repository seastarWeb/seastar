<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_chassis".
 *
 * @property integer $id
 * @property integer $model_id
 * @property string $frame
 * @property string $wheelbase
 * @property string $rake
 * @property string $trail
 * @property string $front_suspension
 * @property string $front_wheel
 * @property string $front_wheel_travel
 * @property string $front_brake
 * @property string $front_tyre
 * @property string $rear_suspsension
 * @property string $rear_wheel_travel
 * @property string $rear_brake
 * @property string $rear_wheel
 * @property string $rear_tyre
 * @property string $fuel_capacity
 * @property string $dry_weight
 * @property string $seat_height
 * @property string $max_height
 * @property string $max_length
 *
 * @property Models $model
 */
class Chassis extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_chassis';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model_id'], 'integer'],
            [['frame'], 'string', 'max' => 27],
            [['wheelbase', 'max_length'], 'string', 'max' => 18],
            [['rake'], 'string', 'max' => 6],
            [['trail', 'dry_weight'], 'string', 'max' => 13],
            [['front_suspension'], 'string', 'max' => 52],
            [['front_wheel', 'rear_wheel'], 'string', 'max' => 48],
            [['front_wheel_travel', 'rear_wheel_travel', 'max_height'], 'string', 'max' => 15],
            [['front_brake'], 'string', 'max' => 144],
            [['front_tyre'], 'string', 'max' => 36],
            [['rear_suspsension'], 'string', 'max' => 126],
            [['rear_brake'], 'string', 'max' => 50],
            [['rear_tyre'], 'string', 'max' => 35],
            [['fuel_capacity'], 'string', 'max' => 20],
            [['seat_height'], 'string', 'max' => 49]
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
            'frame' => 'Frame',
            'wheelbase' => 'Wheelbase',
            'rake' => 'Rake',
            'trail' => 'Trail',
            'front_suspension' => 'Front Suspension',
            'front_wheel' => 'Front Wheel',
            'front_wheel_travel' => 'Front Wheel Travel',
            'front_brake' => 'Front Brake',
            'front_tyre' => 'Front Tyre',
            'rear_suspsension' => 'Rear Suspsension',
            'rear_wheel_travel' => 'Rear Wheel Travel',
            'rear_brake' => 'Rear Brake',
            'rear_wheel' => 'Rear Wheel',
            'rear_tyre' => 'Rear Tyre',
            'fuel_capacity' => 'Fuel Capacity',
            'dry_weight' => 'Dry Weight',
            'seat_height' => 'Seat Height',
            'max_height' => 'Max Height',
            'max_length' => 'Max Length',
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
