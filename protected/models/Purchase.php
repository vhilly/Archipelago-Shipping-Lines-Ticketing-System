<?php

  class Purchase extends CFormModel{

    public $passenger=false;
    public $passengerMin=1;
    public $passengerTotal;
    public $passengerMax=100;
    public $cargo;
    public $voyage;
    public $departureDate;
    public $class;
    public $hash;
    public $step;
    public $ticketList;
    public $passengerList;
    public $payment_method;
    public $payment_status;
    public $transaction_type;
    
    

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
        'departureDate' => 'Departure Date',
        'class' => 'Class',
        'cargo' => 'Cargo',
      );
    }
    public function rules(){
      return array(
        array($this->_requiredFields,'required'),
        array('passengerTotal', 'numerical','min'=>$this->passengerMin,'max'=>$this->passengerMax),
        array('voyage,class', 'numerical', 'integerOnly'=>true),
        array('passengerTotal,voyage,class', 'length', 'max'=>3),
        array('hash', 'length', 'max'=>32),
        array('passengerList,ticketList', 'length', 'max'=>9000),
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
  }
