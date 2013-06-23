<?php

/**
 * This is the model class for table "passage_fare_rates".
 *
 * The followings are the available columns in table 'passage_fare_rates':
 * @property integer $id
 * @property integer $type
 * @property integer $route
 * @property integer $class
 * @property string $price
 * @property string $as_of
 * @property string $active
 *
 * The followings are the available model relations:
 * @property SeatingClass $class0
 * @property Route $route0
 * @property Ticket[] $tickets
 */
class PassageFareRates extends CActiveRecord
{
        private $_requiredFields = '';
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PassageFareRates the static model class
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
		return 'passage_fare_rates';
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
			array($this->_requiredFields, 'required'),
			array('type,id, route, class', 'numerical', 'integerOnly'=>true),
			array('price', 'length', 'max'=>20),
			array('active', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type, route, class, price, as_of, active', 'safe', 'on'=>'search'),
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
			'class0' => array(self::BELONGS_TO, 'SeatingClass', 'class'),
			'route0' => array(self::BELONGS_TO, 'Route', 'route'),
			'type0' => array(self::BELONGS_TO, 'PassageFareTypes', 'type'),
			'tickets' => array(self::HAS_MANY, 'Ticket', 'rate'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Rate',
			'type' => 'Type',
			'route' => 'Route',
			'class' => 'Class',
			'price' => 'Price',
			'as_of' => 'As Of',
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
		$criteria->compare('type',$this->type);
		$criteria->compare('route',$this->route);
		$criteria->compare('class',$this->class);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('as_of',$this->as_of,true);
		$criteria->compare('active',$this->active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
