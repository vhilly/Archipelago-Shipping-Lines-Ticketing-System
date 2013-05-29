<?php

/**
 * This is the model class for table "cargo_class".
 *
 * The followings are the available columns in table 'cargo_class':
 * @property integer $id
 * @property string $class
 * @property string $desc
 * @property integer $lane_meter
 * @property integer $lane_meter_rate
 * @property string $proposed_tariff
 * @property string $as_of
 * @property string $active
 *
 * The followings are the available model relations:
 * @property Cargo[] $cargos
 */
class CargoClass extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CargoClass the static model class
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
		return 'cargo_class';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('class, desc, lane_meter, lane_meter_rate, proposed_tariff', 'required'),
			array('lane_meter, lane_meter_rate', 'numerical', 'integerOnly'=>true),
			array('class', 'length', 'max'=>100),
			array('proposed_tariff', 'length', 'max'=>20),
			array('active', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, class, desc, lane_meter, lane_meter_rate, proposed_tariff, as_of, active', 'safe', 'on'=>'search'),
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
			'cargos' => array(self::HAS_MANY, 'Cargo', 'cargo_class'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'class' => 'Class',
			'desc' => 'Desc',
			'lane_meter' => 'Lane Meter',
			'lane_meter_rate' => 'Lane Meter Rate',
			'proposed_tariff' => 'Proposed Tariff',
			'as_of' => 'As Of',
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
		$criteria->compare('class',$this->class,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('lane_meter',$this->lane_meter);
		$criteria->compare('lane_meter_rate',$this->lane_meter_rate);
		$criteria->compare('proposed_tariff',$this->proposed_tariff,true);
		$criteria->compare('as_of',$this->as_of,true);
		$criteria->compare('active',$this->active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
