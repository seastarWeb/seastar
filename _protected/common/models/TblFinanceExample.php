<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_finance_example".
 *
 * @property integer $id
 * @property integer $model_id
 * @property string $plan_name
 * @property string $deposit
 * @property string $total_credit
 * @property string $purchase_fee
 * @property string $credit_facility_fee
 * @property string $total_payable
 * @property string $initial_payment
 * @property string $monthly_payments
 * @property string $optional_final_payment
 * @property string $agreement_duration
 * @property string $representative_apr
 * @property string $interest_rate
 * @property string $from
 * @property string $to
 */
class TblFinanceExample extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_finance_example';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model_id', 'plan_name', 'agreement_duration', 'date_from', 'date_to'], 'required'],
            [['model_id'], 'integer'],
            [['deposit', 'total_credit', 'purchase_fee', 'credit_facility_fee', 'total_payable', 'initial_payment', 'monthly_payments', 'optional_final_payment', 'representative_apr', 'interest_rate'], 'number'],
            [['date_from', 'date_to'], 'safe'],
            [['plan_name'], 'string', 'max' => 255],
            [['agreement_duration'], 'string', 'max' => 100]
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
            'plan_name' => 'Plan Name',
            'deposit' => 'Deposit',
            'total_credit' => 'Total Credit',
            'purchase_fee' => 'Purchase Fee',
            'credit_facility_fee' => 'Credit Facility Fee',
            'total_payable' => 'Total Payable',
            'initial_payment' => 'Initial Payment',
            'monthly_payments' => 'Monthly Payments',
            'optional_final_payment' => 'Optional Final Payment',
            'agreement_duration' => 'Agreement Duration',
            'representative_apr' => 'Representative Apr',
            'interest_rate' => 'Interest Rate',
            'date_from' => 'From',
            'date_to' => 'To',
        ];
    }
}
