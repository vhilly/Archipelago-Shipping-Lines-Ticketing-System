<?php

/**
 * This is the model class for table "cargo_class".
 *
 * The followings are the available columns in table 'cargo_class':
 * @property integer $id
 * @property string $name
 * @property string $desc
 * @property integer $lane_meter
 * @property string $as_of
 * @property string $active
 *
 * The followings are the available model relations:
 * @property Cargo[] $cargos
 * @property CargoFareRates[] $cargoFareRates
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
	s */
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
			array('name, desc, lane_meter', 'required'),
			array('lane_meter', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>100),
			array('active', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, desc, lane_meter, as_of, active', 'safe', 'on'=>'search'),
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
			'cargoFareRates' => array(self::HAS_MANY, 'CargoFareRates', 'class'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'desc' => 'Desc',
			'lane_meter' => 'Lane Meter',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('lane_meter',$this->lane_meter);
		$criteria->compare('as_of',$this->as_of,true);
		$criteria->compare('active',$this->active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
