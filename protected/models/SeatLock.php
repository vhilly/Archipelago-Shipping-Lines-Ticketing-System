<?php

/**
 * This is the model class for table "seat_lock".
 *
 * The followings are the available columns in table 'seat_lock':
 * @property integer $id
 * @property integer $voyage
 * @property integer $seat
 * @property string $vsid
 * @property string $created_by
 * @property string $timestamp
 *
 * The followings are the available model relations:
 * @property Seat $seat0
 * @property Voyage $voyage0
 */
class SeatLock extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SeatLock the static model class
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
		return 'seat_lock';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('voyage, seat, vsid, created_by, timestamp', 'required'),
			array('voyage, seat', 'numerical', 'integerOnly'=>true),
			array('vsid', 'length', 'max'=>30),
			array('created_by', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, voyage, seat, vsid, created_by, timestamp', 'safe', 'on'=>'search'),
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
			'seat0' => array(self::BELONGS_TO, 'Seat', 'seat'),
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
			'seat' => 'Seat',
			'vsid' => 'Vsid',
			'created_by' => 'Created By',
			'timestamp' => 'Timestamp',
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
		$criteria->compare('seat',$this->seat);
		$criteria->compare('vsid',$this->vsid,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('timestamp',$this->timestamp,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}