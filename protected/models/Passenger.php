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
 * @property string $birth_date
 *
 * The followings are the available model relations:
 * @property Booking[] $bookings
 */
class Passenger extends CActiveRecord
{
  const CS_SINGLE = 1;
  const CS_MARRIED = 2;
  const CS_WIDOWED = 3;
  const CS_SEPARATED = 4;
  const CS_DIVORCED = 5;
        private $_requiredFields = '';
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

    public function makeRequired($requiredFields=''){
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
			array($this->_requiredFields.'', 'required'),
			array('first_name, last_name, email, middle_name, nationality', 'length', 'max'=>100),
			array('prefix', 'length', 'max'=>5),
			array('contact,age', 'numerical', 'integerOnly'=>true),
			array('email', 'email'),
			array('gender, civil_status', 'length', 'max'=>1),
			array('address', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,age, first_name, last_name, email, contact, middle_name, prefix, gender, civil_status, nationality, address, birth_date', 'safe', 'on'=>'search'),
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
			'bookings' => array(self::HAS_ONE, 'Booking', 'passenger'),
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
			'contact' => 'Contact No.',
			'middle_name' => 'Middle Name',
			'prefix' => 'Prefix',
			'gender' => 'Gender',
			'civil_status' => 'Civil Status',
			'nationality' => 'Nationality',
			'address' => 'Address',
			'birth_date' => 'Birth Date',
			'age' => 'Age',
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
		$criteria->compare('birth_date',$this->birth_date,true);
		$criteria->compare('age',$this->age,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
  public function getCSOptions(){
    return array(
                  self::CS_SINGLE => 'Single',
                  self::CS_MARRIED => 'Married',
                  self::CS_WIDOWED => 'Widowed',
                  self::CS_SEPARATED => 'Separated',
                  self::CS_DIVORCED => 'Divorced',
                );
  }

   
}
