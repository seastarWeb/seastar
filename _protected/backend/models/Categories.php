<?php 
namespace backend\models;

use Yii;

/**
 * * This is the model class for table "vw_categories".
 * *
 * * @property string $Brand
 * * @property string $Category
 * * @property string $SubCategory
 * * @property string $Lines
 * */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * * @inheritdoc
     * */
    public static function tableName()
    {
	return 'vw_Categories';
    }

    /**
     * * @inheritdoc
     * */
    public function rules()
    {
	return [
	    [['Lines'], 'integer'],
	    [['Brand'], 'string', 'max' => 50],
	    [['Category', 'SubCategory'], 'string', 'max' => 100]
		];
    }

    /**
     * * @inheritdoc
     * */
    public function attributeLabels()
    {
	return [
	    'Brand' => 'Brand',
	    'Category' => 'Category',
	    'SubCategory' => 'Sub Category',
	    'Lines' => 'Lines',
	    ];
    }
} 
