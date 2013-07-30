<?php

/**
 * This is the model class for table "booking".
 *
 * The followings are the available columns in table 'booking':
 * @property integer $id
 * @property string $tkt_no
 * @property string $booking_no
 * @property integer $transaction
 * @property integer $passenger
 * @property integer $voyage
 * @property integer $seat
 * @property integer $status
 * @property string $date_booked
 * @property integer $rate
 * @property integer $type
 *
 * The followings are the available model relations:
 * @property Passenger $passenger0
 * @property BookingStatus $status0
 * @property Transaction $transaction0
 * @property Voyage $voyage0
 * @property Seat $seat0
 * @property PassageFareRates $rate0
 * @property BookingType $type0
 * @property BookingHistory[] $bookingHistories
 * @property PaidMiscFees[] $paidMiscFees
 */
class BookingNo extends CActiveRecord
{

	public $last_name;
    	public $first_name;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BookingNo the static model class
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
		return 'booking';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tkt_no, booking_no, transaction, passenger, voyage, status, date_booked, rate', 'required'),
			array('transaction, passenger, voyage, seat, status, rate, type', 'numerical', 'integerOnly'=>true),
			array('tkt_no, booking_no', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, tkt_no, booking_no, transaction, passenger, voyage, seat, status, date_booked, rate, type', 'safe', 'on'=>'search'),
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
			'passenger0' => array(self::BELONGS_TO, 'Passenger', 'passenger'),
			'status0' => array(self::BELONGS_TO, 'BookingStatus', 'status'),
			'transaction0' => array(self::BELONGS_TO, 'Transaction', 'transaction'),
			'voyage0' => array(self::BELONGS_TO, 'Voyage', 'voyage'),
			'seat0' => array(self::BELONGS_TO, 'Seat', 'seat'),
			'rate0' => array(self::BELONGS_TO, 'PassageFareRates', 'rate'),
			'type0' => array(self::BELONGS_TO, 'BookingType', 'type'),
			'bookingHistories' => array(self::HAS_MANY, 'BookingHistory', 'booking_id'),
			'paidMiscFees' => array(self::HAS_MANY, 'PaidMiscFees', 'bid'),
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
		$criteria->compare('booking_no',$this->booking_no,true);
		$criteria->compare('transaction',$this->transaction);
		$criteria->compare('passenger',$this->passenger);
		$criteria->compare('voyage',$this->voyage);
		$criteria->compare('seat',$this->seat);
		$criteria->compare('status',$this->status);
		$criteria->compare('date_booked',$this->date_booked,true);
		$criteria->compare('rate',$this->rate);
		$criteria->compare('type',$this->type);
		$criteria->compare('passenger0.first_name',$this->first_name,true);
                $criteria->compare('passenger0.last_name',$this->last_name,true);




		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		'sort'=>array(
          'attributes'=>array(
            'first_name'=>array(
              'asc'=>'passenger0.first_name',
              'desc'=>'passenger0.first_name DESC'
            ),
            'last_name'=>array(
              'asc'=>'passenger0.last_name',
              'desc'=>'passenger0.last_name DESC'
            ),
            '*',
          )
        ),


		));
	
	}
}
