<?php

/**
 * This is the model class for table "voyage".
 *
 * The followings are the available columns in table 'voyage':
 * @property integer $id
 * @property string $name
 * @property integer $vessel
 * @property integer $route
 * @property string $departure_time
 * @property string $arrival_time
 *
 * The followings are the available model relations:
 * @property Ticket[] $tickets
 * @property Route $route0
 * @property Vessel $vessel0
 */
class Voyage extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Voyage the static model class
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
		return 'voyage';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, vessel, route, departure_time, arrival_time', 'required'),
			array('vessel, route', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, vessel, route, departure_time, arrival_time', 'safe', 'on'=>'search'),
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
			'tickets' => array(self::HAS_MANY, 'Ticket', 'voyage'),
			'route0' => array(self::BELONGS_TO, 'Route', 'route'),
			'vessel0' => array(self::BELONGS_TO, 'Vessel', 'vessel'),
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
			'vessel' => 'Vessel',
			'route' => 'Route',
			'departure_time' => 'Departure Time',
			'arrival_time' => 'Arrival Time',
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
		$criteria->compare('vessel',$this->vessel);
		$criteria->compare('route',$this->route);
		$criteria->compare('departure_time',$this->departure_time,true);
		$criteria->compare('arrival_time',$this->arrival_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}