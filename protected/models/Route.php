<?php

/**
 * This is the model class for table "route".
 *
 * The followings are the available columns in table 'route':
 * @property integer $id
 * @property string $name
 * @property string $from_port
 * @property string $to_port
 * @property string $active
 *
 * The followings are the available model relations:
 * @property PassageFareRates[] $passageFareRates
 * @property Voyage[] $voyages
 */
class Route extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Route the static model class
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
		return 'route';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, from_port, to_port', 'required'),
			array('name, from_port, to_port', 'length', 'max'=>100),
			array('active', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, from_port, to_port, active', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations auto_portmatically generated below.
		return array(
			'passageFareRates' => array(self::HAS_MANY, 'PassageFareRates', 'route'),
			'voyages' => array(self::HAS_MANY, 'Voyage', 'route'),
		);
	}

	/**
	 * @return array custo_portmized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'from_port' => 'From',
			'to_port' => 'To',
			'active' => 'Active',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to_port remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('from_port',$this->from_port,true);
		$criteria->compare('to_port',$this->to_port,true);
		$criteria->compare('active',$this->active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
