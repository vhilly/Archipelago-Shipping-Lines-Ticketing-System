<?php

  class Purchase extends CFormModel{

    public $passenger=false;
    public $cargo=false;
    public $passengerMin=1;
    public $passengerTotal;
    public $passengerMax=100;
    public $voyage;
    public $class;
    public $hash;
    public $step;
    public $ticketList;
    public $passengerList;
    public $seatingList;
    public $cargoList;
    public $cargoPrice;
    public $payment_method;
    public $payment_status;
    public $payment_total;
    public $transaction_type;
    public $trNo;



    private $_requiredFields = '';
    private $_fields = array();

    public function addRequiredField($field = ''){
      if($field){
        $this->_fields[] = $field;
        $this->_requiredFields = implode(',',$this->_fields);
      }
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
      return array(
        array($this->_requiredFields,'required'),
        array('passengerTotal', 'numerical','min'=>$this->passengerMin,'max'=>$this->passengerMax),
        array('voyage,class,payment_total,payment_method,payment_status,trNo', 'numerical', 'integerOnly'=>true),
        array('passengerTotal,voyage,class', 'length', 'max'=>3),
        array('hash,cargoPrice', 'length', 'max'=>32),
        array('passengerList,ticketList,cargoList,seatingList', 'length', 'max'=>9000),
      );
    }

    public function setPassenger($required='Y',$limit='1',$max='100',$free=0){
      if($required=='Y'){
        $this->addRequiredField('passengerTotal');
        $this->passengerMin = $limit ? $limit : '1';
        $this->passengerMax = $max > $this->passengerMin ? $max : $this->passengerMin;
        $this->passenger=true;
      }else{
        $this->passengerMin =0;
        $this->passengerMin =0;
      }
    }
    public function setCargo($required='Y'){
      if($required=='Y'){
        $this->cargo=true;
        $this->class=3;
      }
    }
  }
