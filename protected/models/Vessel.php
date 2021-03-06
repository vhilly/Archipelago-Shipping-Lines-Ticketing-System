<?php

/**
 * This is the model class for table "vessel".
 *
 * The followings are the available columns in table 'vessel':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $passenger_limit
 * @property string $blocked_seats
 *
 * The followings are the available model relations:
 * @property Voyage[] $voyages
 */
class Vessel extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Vessel the static model class
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
		return 'vessel';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, description, passenger_limit', 'required'),
			array('passenger_limit', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>100),
			array('blocked_seats', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, description, passenger_limit, blocked_seats', 'safe', 'on'=>'search'),
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
			'voyages' => array(self::HAS_MANY, 'Voyage', 'vessel'),
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
			'description' => 'Desc',
			'passenger_limit' => 'Passenger Limit',
			'blocked_seats' => 'Blocked Seats',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('passenger_limit',$this->passenger_limit);
		$criteria->compare('blocked_seats',$this->blocked_seats,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
