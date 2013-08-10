<?php

/**
 * This is the model class for table "upgrades".
 *
 * The followings are the available columns in table 'upgrades':
 * @property integer $id
 * @property integer $voyage
 * @property string $amt
 *
 * The followings are the available model relations:
 * @property Voyage $voyage0
 */
class Upgrades extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Upgrades the static model class
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
		return 'upgrades';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('voyage', 'required'),
			array('voyage', 'numerical', 'integerOnly'=>true),
			array('amt', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, voyage, amt', 'safe', 'on'=>'search'),
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
			'voyage0' => array(self::BELONGS_TO, 'Voyage', 'voyage'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'voyage' => 'Voyage',
			'amt' => 'Amt',
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
		$criteria->compare('voyage',$this->voyage);
		$criteria->compare('amt',$this->amt,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}