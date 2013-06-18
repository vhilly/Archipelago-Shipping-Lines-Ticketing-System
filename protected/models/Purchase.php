<?php

  class Purchase extends CFormModel{

    public $passenger=false;
    public $cargo=false;
    public $passengerModels = array();
    public $seatModels = array();
    public $stowage = array();
    public $fareModels = array();
    public $cargoFareModels = array();
    public $cargoModel=array();
    public $passengerMin;
    public $passengerTotal;
    public $passengerMax;
    public $voyage;
    public $class;
    public $current_step =1;
    public $fareList;
    public $cargoFareList;
    public $passengerList;
    public $seatingList;
    public $cargoList;
    public $cargoPrice;
    public $payment_method;
    public $payment_status;
    public $payment_total;
    public $transaction_type;
    public $transaction_no;
    public $fares =array();
    public $route;
    public $cargoFares =array();
    private $_requiredFields = '';
    private $_fields = array();

    public function __construct($required='Y',$limit='1',$max='1',$free='0'){
      if($required=='Y'){
        $this->addRequiredField('passengerTotal');
        $this->passengerMin = $limit ? $limit : '1';
        $this->passengerMax = $max > $this->passengerMin ? $max : $this->passengerMin;
        $this->passenger=true;
      }else{
        $this->passengerMin =0;
        $this->passengerMin =0;
      }
      $this->passengerTotal=$this->passengerMin;
    }
    public function addRequiredField($field = ''){
      if(is_array($field))
        $this->_fields = $field;      
      else
        $this->_fields[] = $field;

        $this->_requiredFields .= implode(',',$this->_fields);
    }


    public function attributeLabels(){
      return array(
        'passengerTotal' => 'Number of Passengers',
        'voyage' => 'Voyage',
        'class' => 'Class',
        'cargoPrice' => 'Price',
      );
    }
    public function rules(){
      $test = $this->passengerMin;
      return array(
        array($this->_requiredFields.',voyage','required'),
        array('passengerTotal', 'numerical','min'=>$test,'max'=>$this->passengerMax),
        array('voyage,class,cargoPrice,payment_total,payment_method,payment_status,transaction_no', 'numerical', 'integerOnly'=>true),
        array('passengerTotal,voyage,class,current_step', 'length', 'max'=>3),
        array('cargoPrice', 'length', 'max'=>32),
        array('passengerList,cargoFareList,fareList,cargoList,seatingList', 'length', 'max'=>9000),
      );
    }
    public function setCargo($required='Y'){
      if($required=='Y'){
        $this->cargo=true;
        $this->class=3;
      }
    }
  }
