<?php

/**
 * This is the model class for table "passenger".
 *
 * The followings are the available columns in table 'passenger':
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $contact
 * @property string $middle_name
 * @property string $prefix
 * @property string $gender
 * @property string $civil_status
 * @property string $nationality
 * @property string $address
 *
 * The followings are the available model relations:
 * @property Booking[] $bookings
 */
class Passenger extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Passenger the static model class
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
		return 'passenger';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('first_name, last_name, email, contact, middle_name, nationality', 'length', 'max'=>100),
			array('prefix', 'length', 'max'=>5),
			array('gender, civil_status', 'length', 'max'=>1),
			array('address', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, first_name, last_name, email, contact, middle_name, prefix, gender, civil_status, nationality, address', 'safe', 'on'=>'search'),
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
			'bookings' => array(self::HAS_MANY, 'Booking', 'passenger'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'email' => 'Email',
			'contact' => 'Contact',
			'middle_name' => 'Middle Name',
			'prefix' => 'Prefix',
			'gender' => 'Gender',
			'civil_status' => 'Civil Status',
			'nationality' => 'Nationality',
			'address' => 'Address',
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
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('contact',$this->contact,true);
		$criteria->compare('middle_name',$this->middle_name,true);
		$criteria->compare('prefix',$this->prefix,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('civil_status',$this->civil_status,true);
		$criteria->compare('nationality',$this->nationality,true);
		$criteria->compare('address',$this->address,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
