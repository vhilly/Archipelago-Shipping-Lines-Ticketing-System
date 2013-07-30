<?php

/**
 * This is the model class for table "refunded_tkts".
 *
 * The followings are the available columns in table 'refunded_tkts':
 * @property integer $id
 * @property string $tkt_no
 * @property string $tkt_serial
 * @property string $booking_no
 * @property integer $transaction
 * @property integer $passenger
 * @property integer $voyage
 * @property integer $seat
 * @property integer $status
 * @property string $date_booked
 * @property integer $rate
 * @property integer $type
 */
class RefundedTkts extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RefundedTkts the static model class
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
		return 'refunded_tkts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tkt_no, tkt_serial, booking_no, transaction, passenger, voyage, status, date_booked, rate', 'required'),
			array('transaction, passenger, voyage, seat, status, rate, type', 'numerical', 'integerOnly'=>true),
			array('tkt_no, tkt_serial, booking_no', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, tkt_no, tkt_serial, booking_no, transaction, passenger, voyage, seat, status, date_booked, rate, type', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'tkt_no' => 'Tkt No',
			'tkt_serial' => 'Tkt Serial',
			'booking_no' => 'Booking No',
			'transaction' => 'Transaction',
			'passenger' => 'Passenger',
			'voyage' => 'Voyage',
			'seat' => 'Seat',
			'status' => 'Status',
			'date_booked' => 'Date Booked',
			'rate' => 'Rate',
			'type' => 'Type',
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
		$criteria->compare('tkt_no',$this->tkt_no,true);
		$criteria->compare('tkt_serial',$this->tkt_serial,true);
		$criteria->compare('booking_no',$this->booking_no,true);
		$criteria->compare('transaction',$this->transaction);
		$criteria->compare('passenger',$this->passenger);
		$criteria->compare('voyage',$this->voyage);
		$criteria->compare('seat',$this->seat);
		$criteria->compare('status',$this->status);
		$criteria->compare('date_booked',$this->date_booked,true);
		$criteria->compare('rate',$this->rate);
		$criteria->compare('type',$this->type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}