<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[UvwStockLevels]].
 *
 * @see UvwStockLevels
 */
class UvwStockLevelsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return UvwStockLevels[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return UvwStockLevels|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}