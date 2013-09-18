<?php

/**
 * This is the model class for table "advance_ticket".
 *
 * The followings are the available columns in table 'advance_ticket':
 * @property integer $id
 * @property string $tkt_no
 * @property integer $seat
 * @property integer $class
 * @property integer $type
 * @property string $first_name
 * @property string $last_name
 * @property integer $age
 * @property string $date_created
 * @property string $validity_date
 *
 * The followings are the available model relations:
 * @property PassageFareTypes $type0
 * @property Seat $seat0
 * @property SeatingClass $class0
 */

class AdvanceTicket extends CActiveRecord
{
       public function getDbConnection() { 
         return Yii::app()->syncdb; 
       } 

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AdvanceTicket the static model class
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
		return 'advance_ticket';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tkt_no, class,type', 'required'),
			array(' class, type', 'numerical', 'integerOnly'=>true),
			array('tkt_no', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, tkt_no,class, type, date_created, validity_date', 'safe', 'on'=>'search'),
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
			'type0' => array(self::BELONGS_TO, 'PassageFareTypes', 'type'),
			'class0' => array(self::BELONGS_TO, 'SeatingClass', 'class'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'tkt_no' => 'Ticket No',
			'class' => 'Class',
			'type' => 'Type',
			'date_created' => 'Date Created',
			'validity_date' => 'Validity Date',
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
		$criteria->compare('tkt_no',$this->tkt_no,true);
		$criteria->compare('class',$this->class);
		$criteria->compare('type',$this->type);
		$criteria->compare('age',$this->age);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('validity_date',$this->validity_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
