<?php

/**
 * This is the model class for table "booking_cargo".
 *
 * The followings are the available columns in table 'booking_cargo':
 * @property integer $id
 * @property integer $transaction
 * @property integer $voyage
 * @property integer $rate
 * @property integer $cargo
 * @property integer $status
 * @property string $date_booked
 *
 * The followings are the available model relations:
 * @property CargoFareRates $rate0
 * @property Transaction $transaction0
 * @property Cargo $cargo0
 * @property BookingStatus $status0
 * @property Voyage $voyage0
 * @property StowageCargoMap[] $stowageCargoMaps
 */
class BookingCargo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BookingCargo the static model class
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
		return 'booking_cargo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('transaction, voyage, rate, cargo, status', 'required'),
			array('transaction, voyage, rate, cargo, status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, transaction, voyage, rate, cargo, status, date_booked', 'safe', 'on'=>'search'),
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
			'rate0' => array(self::BELONGS_TO, 'CargoFareRates', 'rate'),
			'transaction0' => array(self::BELONGS_TO, 'Transaction', 'transaction'),
			'cargo0' => array(self::BELONGS_TO, 'Cargo', 'cargo'),
			'status0' => array(self::BELONGS_TO, 'BookingStatus', 'status'),
			'voyage0' => array(self::BELONGS_TO, 'Voyage', 'voyage'),
			'stowageCargoMaps' => array(self::HAS_MANY, 'StowageCargoMap', 'cargo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'transaction' => 'Transaction',
			'voyage' => 'Voyage',
			'rate' => 'Rate',
			'cargo' => 'Cargo',
			'status' => 'Status',
			'date_booked' => 'Date Booked',
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
		$criteria->compare('transaction',$this->transaction);
		$criteria->compare('voyage',$this->voyage);
		$criteria->compare('rate',$this->rate);
		$criteria->compare('cargo',$this->cargo);
		$criteria->compare('status',$this->status);
		$criteria->compare('date_booked',$this->date_booked,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
