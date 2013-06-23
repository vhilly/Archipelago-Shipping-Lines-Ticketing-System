<?php

/**
 * This is the model class for table "transaction".
 *
 * The followings are the available columns in table 'transaction':
 * @property integer $id
 * @property integer $type
 * @property integer $payment_method
 * @property integer $payment_status
 * @property integer $uid
 * @property string $trans_date
 * @property string $input_date
 * @property double $ovamount
 * @property double $ovdiscount
 * @property string $reference
 *
 * The followings are the available model relations:
 * @property Booking[] $bookings
 * @property BookingCargo[] $bookingCargos
 * @property TransactionType $type0
 * @property PaymentMethod $paymentMethod
 * @property PaymentStatus $paymentStatus
 * @property Users $u
 */
class Transaction extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Transaction the static model class
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
		return 'transaction';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, payment_method, payment_status, uid, trans_date, input_date', 'required'),
			array('type, payment_method, payment_status, uid', 'numerical', 'integerOnly'=>true),
			array('ovamount, ovdiscount', 'numerical'),
			array('reference', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type, payment_method, payment_status, uid, trans_date, input_date, ovamount, ovdiscount, reference', 'safe', 'on'=>'search'),
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
			'bookings' => array(self::HAS_MANY, 'Booking', 'transaction'),
			'bookingCargos' => array(self::HAS_MANY, 'BookingCargo', 'transaction'),
			'type0' => array(self::BELONGS_TO, 'TransactionType', 'type'),
			'paymentMethod' => array(self::BELONGS_TO, 'PaymentMethod', 'payment_method'),
			'paymentStatus' => array(self::BELONGS_TO, 'PaymentStatus', 'payment_status'),
			'u' => array(self::BELONGS_TO, 'Users', 'uid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type' => 'Type',
			'payment_method' => 'Payment Method',
			'payment_status' => 'Payment Status',
			'uid' => 'Uid',
			'trans_date' => 'Trans Date',
			'input_date' => 'Input Date',
			'ovamount' => 'Ovamount',
			'ovdiscount' => 'Ovdiscount',
			'reference' => 'Reference',
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
		$criteria->compare('type',$this->type);
		$criteria->compare('payment_method',$this->payment_method);
		$criteria->compare('payment_status',$this->payment_status);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('trans_date',$this->trans_date,true);
		$criteria->compare('input_date',$this->input_date,true);
		$criteria->compare('ovamount',$this->ovamount);
		$criteria->compare('ovdiscount',$this->ovdiscount);
		$criteria->compare('reference',$this->reference,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
