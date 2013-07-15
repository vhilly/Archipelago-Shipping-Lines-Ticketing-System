<?php

/**
 * This is the model class for table "misc_fees".
 *
 * The followings are the available columns in table 'misc_fees':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $amt
 * @property integer $transaction_type
 * @property string $active
 *
 * The followings are the available model relations:
 * @property TransactionType $transactionType
 */
class MiscFees extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MiscFees the static model class
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
		return 'misc_fees';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, description, amt, transaction_type', 'required'),
			array('transaction_type', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>100),
			array('amt', 'length', 'max'=>20),
			array('active', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, description, amt, transaction_type, active', 'safe', 'on'=>'search'),
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
			'transactionType' => array(self::BELONGS_TO, 'TransactionType', 'transaction_type'),
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
			'description' => 'Description',
			'amt' => 'Amt',
			'transaction_type' => 'Transaction Type',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('amt',$this->amt,true);
		$criteria->compare('transaction_type',$this->transaction_type);
		$criteria->compare('active',$this->active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}