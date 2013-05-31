<?php

/**
 * This is the model class for table "stowage_cargo_map".
 *
 * The followings are the available columns in table 'stowage_cargo_map':
 * @property integer $id
 * @property integer $cargo
 * @property integer $stowage
 *
 * The followings are the available model relations:
 * @property BookingCargo $cargo0
 * @property Stowage $stowage0
 */
class StowageCargoMap extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return StowageCargoMap the static model class
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
		return 'stowage_cargo_map';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cargo, stowage', 'required'),
			array('cargo, stowage', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, cargo, stowage', 'safe', 'on'=>'search'),
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
			'cargo0' => array(self::BELONGS_TO, 'BookingCargo', 'cargo'),
			'stowage0' => array(self::BELONGS_TO, 'Stowage', 'stowage'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cargo' => 'Cargo',
			'stowage' => 'Stowage',
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
		$criteria->compare('cargo',$this->cargo);
		$criteria->compare('stowage',$this->stowage);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}