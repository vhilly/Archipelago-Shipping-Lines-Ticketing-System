<?php

/**
 * This is the model class for table "authorized_cust_vehicle".
 *
 * The followings are the available columns in table 'authorized_cust_vehicle':
 * @property integer $id
 * @property integer $company
 * @property integer $classification
 * @property string $plate_no
 *
 * The followings are the available model relations:
 * @property CargoClass $classification0
 * @property Customer $company0
 */
class AuthorizedCustVehicle extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AuthorizedCustVehicle the static model class
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
		return 'authorized_cust_vehicle';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company, classification, plate_no', 'required'),
			array('company, classification', 'numerical', 'integerOnly'=>true),
			array('plate_no', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, company, classification, plate_no', 'safe', 'on'=>'search'),
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
			'classification0' => array(self::BELONGS_TO, 'CargoClass', 'classification'),
			'company0' => array(self::BELONGS_TO, 'Customer', 'company'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'company' => 'Company',
			'classification' => 'Classification',
			'plate_no' => 'Plate No',
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
		$criteria->compare('company',$this->company);
		$criteria->compare('classification',$this->classification);
		$criteria->compare('plate_no',$this->plate_no,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}