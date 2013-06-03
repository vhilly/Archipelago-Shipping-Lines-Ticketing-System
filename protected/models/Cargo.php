<?php

/**
 * This is the model class for table "cargo".
 *
 * The followings are the available columns in table 'cargo':
 * @property integer $id
 * @property string $shipper
 * @property string $company
 * @property string $destination
 * @property string $address
 * @property integer $cargo_class
 * @property string $article_no
 * @property string $article_desc
 * @property integer $weight
 * @property integer $length
 * @property string $contact
 * @property integer $voyage
 *
 * The followings are the available model relations:
 * @property BookingCargo[] $bookingCargos
 * @property CargoClass $cargoClass
 * @property Voyage $voyage0
 */
class Cargo extends CActiveRecord
{
        public $price;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cargo the static model class
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
		return 'cargo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cargo_class, voyage', 'required'),
			array('cargo_class, weight, length, voyage', 'numerical', 'integerOnly'=>true),
			array('shipper, company, destination, article_no, contact', 'length', 'max'=>100),
			array('address', 'length', 'max'=>255),
			array('article_desc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, shipper, company, destination, address, cargo_class, article_no, article_desc, weight, length, contact, voyage', 'safe', 'on'=>'search'),
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
			'bookingCargos' => array(self::HAS_MANY, 'BookingCargo', 'cargo'),
			'cargoClass' => array(self::BELONGS_TO, 'CargoClass', 'cargo_class'),
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
			'shipper' => 'Shipper',
			'company' => 'Company',
			'destination' => 'Destination',
			'address' => 'Address',
			'cargo_class' => 'Cargo Class',
			'article_no' => 'Article No',
			'article_desc' => 'Article Desc',
			'weight' => 'Weight',
			'length' => 'Length',
			'contact' => 'Contact',
			'voyage' => 'Voyage',
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
		$criteria->compare('shipper',$this->shipper,true);
		$criteria->compare('company',$this->company,true);
		$criteria->compare('destination',$this->destination,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('cargo_class',$this->cargo_class);
		$criteria->compare('article_no',$this->article_no,true);
		$criteria->compare('article_desc',$this->article_desc,true);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('length',$this->length);
		$criteria->compare('contact',$this->contact,true);
		$criteria->compare('voyage',$this->voyage);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
