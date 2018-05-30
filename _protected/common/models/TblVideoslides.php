<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_videoslides".
 *
 * @property integer $id
 * @property integer $vid
 * @property string $title
 * @property string $href
 * @property string $type
 * @property string $youtube
 * @property string $poster
 * @property integer $model_id
 *
 * @property Models $model
 */
class TblVideoslides extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_videoslides';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vid', 'title', 'href', 'youtube', 'poster'], 'required'],
            [['vid', 'model_id'], 'integer'],
            [['title'], 'string', 'max' => 50],
            [['href', 'youtube'], 'string', 'max' => 100],
            [['type'], 'string', 'max' => 20],
            [['poster'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'vid' => 'Vid',
            'title' => 'Title',
            'href' => 'Href',
            'type' => 'Type',
            'youtube' => 'Youtube',
            'poster' => 'Poster',
            'model_id' => 'Model ID',
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
