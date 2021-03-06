<?php

/**
 * This is the model class for table "paid_misc_fees".
 *
 * The followings are the available columns in table 'paid_misc_fees':
 * @property integer $id
 * @property integer $transaction
 * @property integer $misc_fee
 * @property string $amt
 * @property string $timestamp
 *
 * The followings are the available model relations:
 * @property Transaction $transaction0
 * @property PaidMiscFees $miscFee
 * @property PaidMiscFees[] $paidMiscFees
 */
class PaidMiscFees extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PaidMiscFees the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'paid_misc_fees';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(' misc_fee,voyage', 'required'),
			array(' misc_fee', 'numerical', 'integerOnly'=>true),
			array('amt', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,  misc_fee, amt, timestamp', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'miscFee' => array(self::BELONGS_TO, 'PaidMiscFees', 'misc_fee'),
			'paidMiscFees' => array(self::HAS_MANY, 'PaidMiscFees', 'misc_fee'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'misc_fee' => 'Misc Fee',
			'amt' => 'Amt',
			'timestamp' => 'Timestamp',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('misc_fee',$this->misc_fee);
		$criteria->compare('amt',$this->amt,true);
		$criteria->compare('timestamp',$this->timestamp,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
