<?php

/**
 * This is the model class for table "booking".
 *
 * The followings are the available columns in table 'booking':
 * @property integer $id
 * @property integer $passenger
 * @property integer $ticket
 * @property string $status
 * @property string $date_booked
 * @property string $departure_date
 *
 * The followings are the available model relations:
 * @property Passenger $passenger0
 * @property Ticket $ticket0
 */
class Booking extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Booking the static model class
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
			array('passenger, ticket, status,  departure_date', 'required'),
			array('passenger, ticket', 'numerical', 'integerOnly'=>true),
			array('status', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, passenger, ticket, status, date_booked, departure_date', 'safe', 'on'=>'search'),
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
			'ticket0' => array(self::BELONGS_TO, 'Ticket', 'ticket'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'passenger' => 'Passenger',
			'ticket' => 'Ticket',
			'status' => 'Status',
			'date_booked' => 'Date Booked',
			'departure_date' => 'Departure Date',
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
		$criteria->compare('passenger',$this->passenger);
		$criteria->compare('ticket',$this->ticket);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('date_booked',$this->date_booked,true);
		$criteria->compare('departure_date',$this->departure_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}