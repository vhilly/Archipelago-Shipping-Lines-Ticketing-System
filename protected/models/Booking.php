<?php

/**
 * This is the model class for table "booking".
 *
 * The followings are the available columns in table 'booking':
 * @property integer $id
 * @property integer $transaction
 * @property integer $passenger
 * @property integer $voyage
 * @property integer $seat
 * @property integer $status
 * @property string $date_booked
 *
 * The followings are the available model relations:
 * @property Seat $seat0
 * @property Passenger $passenger0
 * @property BookingStatus $status0
 * @property Transaction $transaction0
 * @property Voyage $voyage0
 */
class Booking extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Booking the static model class
	 */
    public $last_name;
    public $first_name;
    public $transNo;
    public $cnt;//reserved
    public $r_cnt;//reserved
    public $c_cnt;//checkedin
    public $b_cnt;//boarded
        private $_requiredFields = '';
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    public function makeRequired($requiredFields=''){
      $this->_requiredFields = $requiredFields;
    }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'booking';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array($this->_requiredFields.'transaction, passenger, tkt_no, booking_no, voyage, status,rate', 'required'),
			array('transaction, passenger, voyage, seat, status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, transaction, passenger,tkt_no, voyage,first_name,last_name, seat, status, date_booked', 'safe', 'on'=>'search'),
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
			'passenger0' => array(self::BELONGS_TO, 'Passenger', 'passenger'),
			'status0' => array(self::BELONGS_TO, 'BookingStatus', 'status'),
			'transaction0' => array(self::BELONGS_TO, 'Transaction', 'transaction'),
			'voyage0' => array(self::BELONGS_TO, 'Voyage', 'voyage'),
			'rate0' => array(self::BELONGS_TO, 'PassageFareRates', 'rate'),
			'type0' => array(self::BELONGS_TO, 'BookingType', 'type'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'tkt_no' => 'Ticket No.',
			'booking_no' => 'Booking No.',
			'transaction' => 'Transaction',
			'passenger' => 'Passenger',
			'voyage' => 'Voyage',
			'seat' => 'Seat',
			'status' => 'Status',
			'rate' => 'Rate',
                        'cnt'=>'Total',
                        'r_cnt'=>'Reserved',
                        'b_cnt'=>'Boarded',
                        'c_cnt'=>'Checked In',
			'date_booked' => 'Date Booked',
			'type' => 'Booking Type',
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
      $criteria->with=array(
        'passenger0'=>array(
          'together'=>false,
          'select'=>false
        ),
      );

		$criteria->compare('id',$this->id);
		$criteria->compare('transaction',$this->transaction);
		$criteria->compare('booking_no',$this->booking_no);
		$criteria->compare('tkt_no',$this->tkt_no);
		$criteria->compare('passenger',$this->passenger);
		$criteria->compare('voyage',$this->voyage);
		$criteria->compare('seat',$this->seat);
		$criteria->compare('status',$this->status);
		$criteria->compare('rate',$this->rate);
		$criteria->compare('date_booked',$this->date_booked,true);
                $criteria->compare('passenger0.first_name',$this->first_name,true);
                $criteria->compare('passenger0.last_name',$this->last_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
        'sort'=>array(
          'attributes'=>array(
            'first_name'=>array(
              'asc'=>'passenger0.first_name',
              'desc'=>'passenger0.first_name DESC'
            ),
            'last_name'=>array(
              'asc'=>'passenger0.last_name',
              'desc'=>'passenger0.last_name DESC'
            ),
            '*',
          )
        ),
		));
	}
	public function printSearch()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
      $criteria->with=array(
        'passenger0'=>array(
          'together'=>false,
          'select'=>false
        ),
      );

		$criteria->compare('id',$this->id);
		$criteria->compare('transaction',$this->transaction);
		$criteria->compare('booking_no',$this->booking_no);
		$criteria->compare('tkt_no',$this->tkt_no);
		$criteria->compare('passenger',$this->passenger);
		$criteria->compare('voyage',$this->voyage);
		$criteria->compare('seat',$this->seat);
		$criteria->compare('status',$this->status);
		$criteria->compare('rate',$this->rate);
		$criteria->compare('date_booked',$this->date_booked,true);
                $criteria->compare('passenger0.first_name',$this->first_name,true);
                $criteria->compare('passenger0.last_name',$this->last_name,true);
                $criteria->addCondition('status != 5');
		$dataProvider = new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
        'sort'=>array(
          'attributes'=>array(
            'first_name'=>array(
              'asc'=>'passenger0.first_name',
              'desc'=>'passenger0.first_name DESC'
            ),
            'last_name'=>array(
              'asc'=>'passenger0.last_name',
              'desc'=>'passenger0.last_name DESC'
            ),
            '*',
          )
        ),
		));
          $dataProvider->setPagination(false);
          return $dataProvider;
	}
}
