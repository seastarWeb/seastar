<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%Menu}}".
 *
 * @property integer $id
 * @property integer $pid
 * @property string $menu
 * @property string $metadesc
 * @property string $title
 * @property string $page
 * @property string $template
 * @property integer $status
 * @property integer $version
 * @property integer $model_range_id
 *
 * @property TblMenu $p
 * @property TblMenu[] $tblMenus
 * @property MenuItem[] $menuItems
 * @property MenuToPart[] $menuToParts
 */
class TblMenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'status', 'version','model_range_id'], 'integer'],
            [['menu', 'metadesc', 'title', 'page'], 'required'],
            [['page'], 'string'],
            [['menu'], 'string', 'max' => 50],
            [['metadesc'], 'string', 'max' => 255],
            [['title'], 'string', 'max' => 200],
            [['template'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Ident',
            'pid' => 'Parent Menu',
            'menu' => 'menu',
            'metadesc' => 'Meta Description',
            'title' => 'Page Title',
            'page' => 'Page Content',
            'template' => 'Template',
            'status' => 'Active?',
            'version' => 'Current Version',
            'model_range_id'=>'Model Range',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getP()
    {
        return $this->hasOne(TblMenu::className(), ['id' => 'pid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblMenus()
    {
        return $this->hasMany(TblMenu::className(), ['pid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenuItems()
    {
        return $this->hasMany(MenuItem::className(), ['menuId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenuToParts()
    {
        return $this->hasMany(MenuToPart::className(), ['menuId' => 'id']);
    }
}
