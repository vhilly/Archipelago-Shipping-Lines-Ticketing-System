<?php

  /**
   * This is the model class for table "passage_fare_rates".
   *
   * The followings are the available columns in table 'passage_fare_rates':
   * @property integer $id
   * @property string $type
   * @property string $proposed
   * @property integer $class
   * @property string $price
   *
   * The followings are the available model relations:
   * @property SeatingClass $class0
   */
  class PassageFareRates extends CActiveRecord
  {
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

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
      // NOTE: you should only define rules for those attributes that
      // will receive user inputs.
      return array(
        array('type, class,price', 'required'),
        array('class', 'numerical', 'integerOnly'=>true),
        array('type, proposed', 'length', 'max'=>100),
        array('price', 'length', 'max'=>20),
        // The following rule is used by search().
        // Please remove those attributes that should not be searched.
        array('id, type, proposed, class, price', 'safe', 'on'=>'search'),
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
      );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
      return array(
        'id' => 'ID',
        'type' => 'Type',
        'proposed' => 'Proposed',
        'class' => 'Class',
        'price' => 'Price',
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
      $criteria->compare('type',$this->type,true);
      $criteria->compare('proposed',$this->proposed,true);
      $criteria->compare('class',$this->class);
      $criteria->compare('price',$this->price,true);

      return new CActiveDataProvider($this, array(
        'criteria'=>$criteria,
      ));
    }
  }
