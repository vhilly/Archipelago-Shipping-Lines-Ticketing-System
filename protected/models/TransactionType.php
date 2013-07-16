<?php

/**
 * This is the model class for table "transaction_type".
 *
 * The followings are the available columns in table 'transaction_type':
 * @property integer $id
 * @property string $name
 * @property string $navigation_title
 * @property string $cargo
 * @property double $discount
 * @property integer $discount_percent
 * @property integer $bundled_passenger_rate
 * @property integer $minimum_passenger
 * @property integer $maximum_passenger
 * @property string $terminal_fee_amnt
 * @property string $active
 *
 * The followings are the available model relations:
 * @property Transaction[] $transactions
 * @property PassageFareRates $bundledPassengerRate
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
			array('name, navigation_title, discount_percent', 'required'),
			array('discount_percent, bundled_passenger_rate, minimum_passenger, maximum_passenger', 'numerical', 'integerOnly'=>true),
			array('discount', 'numerical'),
			array('name, navigation_title', 'length', 'max'=>100),
			array('cargo,account_to, active', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, navigation_title, cargo, discount, discount_percent, bundled_passenger_rate, minimum_passenger, maximum_passenger, active', 'safe', 'on'=>'search'),
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
			'transactions' => array(self::HAS_MANY, 'Transaction', 'type'),
			'bundledPassengerRate' => array(self::BELONGS_TO, 'PassageFareRates', 'bundled_passenger_rate'),
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
			'cargo' => 'Cargo',
			'discount' => 'Discount',
			'discount_percent' => 'Discount Percent',
			'bundled_passenger_rate' => 'Bundled Passenger Rate',
			'minimum_passenger' => 'Minimum Passenger',
			'maximum_passenger' => 'Maximum Passenger',
			'account_to' => 'Account To',
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
		$criteria->compare('cargo',$this->cargo,true);
		$criteria->compare('discount',$this->discount);
		$criteria->compare('discount_percent',$this->discount_percent);
		$criteria->compare('bundled_passenger_rate',$this->bundled_passenger_rate);
		$criteria->compare('minimum_passenger',$this->minimum_passenger);
		$criteria->compare('maximum_passenger',$this->maximum_passenger);
		$criteria->compare('active',$this->active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
