<?php

/**
 * This is the model class for table "transaction_type".
 *
 * The followings are the available columns in table 'transaction_type':
 * @property integer $id
 * @property string $name
 * @property string $navigation_title
 * @property string $passenger
 * @property string $cargo
 * @property double $discount
 * @property integer $discount_percent
 * @property integer $free_passenger
 * @property integer $minimum_passenger
 * @property integer $maximum_passenger
 * @property integer $free_cargo
 * @property integer $minimum_cargo
 * @property string $active
 */
class TransactionType extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TransactionType the static model class
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
		return 'transaction_type';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, navigation_title', 'required'),
			array('discount_percent, free_passenger, minimum_passenger, maximum_passenger, free_cargo, minimum_cargo', 'numerical', 'integerOnly'=>true),
			array('discount', 'numerical'),
			array('name, navigation_title', 'length', 'max'=>100),
			array('passenger, cargo, active', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, navigation_title, passenger, cargo, discount, discount_percent, free_passenger, minimum_passenger, maximum_passenger, free_cargo, minimum_cargo, active', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'navigation_title' => 'Navigation Title',
			'passenger' => 'Passenger',
			'cargo' => 'Cargo',
			'discount' => 'Discount',
			'discount_percent' => 'Discount Percent',
			'free_passenger' => 'Free Passenger',
			'minimum_passenger' => 'Minimum Passenger',
			'maximum_passenger' => 'Maximum Passenger',
			'free_cargo' => 'Free Cargo',
			'minimum_cargo' => 'Minimum Cargo',
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
		$criteria->compare('navigation_title',$this->navigation_title,true);
		$criteria->compare('passenger',$this->passenger,true);
		$criteria->compare('cargo',$this->cargo,true);
		$criteria->compare('discount',$this->discount);
		$criteria->compare('discount_percent',$this->discount_percent);
		$criteria->compare('free_passenger',$this->free_passenger);
		$criteria->compare('minimum_passenger',$this->minimum_passenger);
		$criteria->compare('maximum_passenger',$this->maximum_passenger);
		$criteria->compare('free_cargo',$this->free_cargo);
		$criteria->compare('minimum_cargo',$this->minimum_cargo);
		$criteria->compare('active',$this->active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}