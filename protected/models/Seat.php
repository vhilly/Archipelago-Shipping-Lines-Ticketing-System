<?php

/**
 * This is the model class for table "seat".
 *
 * The followings are the available columns in table 'seat':
 * @property integer $id
 * @property integer $seating_class
 * @property string $name
 * @property string $active
 *
 * The followings are the available model relations:
 * @property Booking[] $bookings
 * @property SeatingClass $seatingClass
 * @property SeatTicketMap[] $seatTicketMaps
 */
class Seat extends CActiveRecord
{
    private $_requiredFields = '';
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Seat the static model class
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
		return 'seat';
	}

    public function __construct($requiredFields=''){
      $this->_requiredFields = $requiredFields;
    }
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array($this->_requiredFields, 'required'),
			array('seating_class,id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>100),
			array('active', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, seating_class, name, active', 'safe', 'on'=>'search'),
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
			'bookings' => array(self::HAS_MANY, 'Booking', 'seat'),
			'seatingClass' => array(self::BELONGS_TO, 'SeatingClass', 'seating_class'),
			'seatTicketMaps' => array(self::HAS_MANY, 'SeatTicketMap', 'seat'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Seat',
			'seating_class' => 'Seating Class',
			'name' => 'Name',
			'active' => 'Active',
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
		$criteria->compare('seating_class',$this->seating_class);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('active',$this->active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
