<?php

/**
 * This is the model class for table "daily_cashflow".
 *
 * The followings are the available columns in table 'daily_cashflow':
 * @property integer $id
 * @property integer $vessel
 * @property string $date
 * @property integer $is_sync
 */
class DailyCashflow extends CActiveRecord
{
       public function getDbConnection() { 
         return Yii::app()->syncdb; 
       } 
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'daily_cashflow';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('vessel, date', 'required'),
			array('vessel, is_sync', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, vessel, date, is_sync', 'safe', 'on'=>'search'),
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
			'vessel' => 'Vessel',
			'date' => 'Date',
			'is_sync' => 'Is Sync',
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
		$criteria->compare('vessel',$this->vessel);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('is_sync',$this->is_sync);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DailyCashflow the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
