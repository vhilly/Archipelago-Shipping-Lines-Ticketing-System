<?php

/**
 * This is the model class for table "daily_cashflow_values".
 *
 * The followings are the available columns in table 'daily_cashflow_values':
 * @property integer $id
 * @property integer $entity_id
 * @property integer $field_id
 * @property string $value
 */
class DailyCashflowValues extends CActiveRecord
{
       public function getDbConnection() { 
         return Yii::app()->syncdb; 
       } 
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'daily_cashflow_values';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('entity_id, field_id, value', 'required'),
			array('entity_id, field_id', 'numerical', 'integerOnly'=>true),
			array('value', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, entity_id, field_id, value', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'entity_id' => 'Entity',
			'field_id' => 'Field',
			'value' => 'Value',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('entity_id',$this->entity_id);
		$criteria->compare('field_id',$this->field_id);
		$criteria->compare('value',$this->value,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DailyCashflowValues the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
