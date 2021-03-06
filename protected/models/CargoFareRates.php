<?php

/**
 * This is the model class for table "cargo_fare_rates".
 *
 * The followings are the available columns in table 'cargo_fare_rates':
 * @property integer $id
 * @property integer $route
 * @property integer $class
 * @property integer $lane_meter_rate
 * @property string $proposed_tariff
 * @property string $as_of
 * @property string $active
 *
 * The followings are the available model relations:
 * @property BookingCargo[] $bookingCargos
 * @property CargoClass $class0
 * @property Route $route0
 */
class CargoFareRates extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CargoFareRates the static model class
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
		return 'cargo_fare_rates';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('', 'required'),
			array('route,id, class, lane_meter_rate', 'numerical', 'integerOnly'=>true),
			array('proposed_tariff', 'length', 'max'=>9),
			array('active', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, route, class, lane_meter_rate, proposed_tariff, active', 'safe', 'on'=>'search'),
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
			'bookingCargos' => array(self::HAS_MANY, 'BookingCargo', 'rate'),
			'class0' => array(self::BELONGS_TO, 'CargoClass', 'class'),
			'route0' => array(self::BELONGS_TO, 'Route', 'route'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Class',
			'route' => 'Route',
			'class' => 'Class',
			'lane_meter_rate' => 'Lane Meter Rate',
			'proposed_tariff' => 'Proposed Tariff',
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
		$criteria->compare('route',$this->route);
		$criteria->compare('class',$this->class);
		$criteria->compare('lane_meter_rate',$this->lane_meter_rate);
		$criteria->compare('proposed_tariff',$this->proposed_tariff,true);
		$criteria->compare('active',$this->active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
