<?php

  class Purchase extends CFormModel{
    public $transaction_type;
    public $passenger_min=1;
    public $passenger_max=1;
    public $passenger_total=1;
    public $payment_method=1;
    public $payment_total;
    public $tr_no;
    public $fares=array();
    public $payment_status;
    public $payment_discount;
    public $bundled_rate;
    public $voyage;
    public $route;
    public $class;
    public $cargo_cost;
    public $cargo_rate;
    public $total_fares;
    public $current_step =1;
    public $account_to;
    private $_requiredFields = '';
    private $_fields = array();
    
    


    public function __construct($type=null,$limit='1',$max='1',$required=''){
        $this->addRequiredField($required);
        $this->passenger_min = $limit ? $limit : '1';
        $this->passenger_max = $max > $this->passenger_min ? $max : $this->passenger_min;
        $this->passenger_total=$this->passenger_min;
        $this->transaction_type=$type;
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
        'passenger_total' => 'Number of Passengers',
        'voyage' => 'Voyage',
        'class' => 'Class',
        'cargoPrice' => 'Price',
      );
    }
    public function rules(){
      return array(
        array($this->_requiredFields.',class,passenger_total,voyage','required'),
        array('passenger_total', 'numerical','min'=>$this->passenger_min,'max'=>$this->passenger_max),
        array('account_to,voyage,route,class,payment_status,payment_total,payment_discount,payment_method', 'numerical', 'integerOnly'=>true),
        array('', 'length', 'max'=>3),
        array('cargo_cost', 'length', 'max'=>32),
        array('', 'length', 'max'=>9000),
      );
    }
  }
