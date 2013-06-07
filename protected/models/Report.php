<?php

  class Report extends CFormModel{

    private $_requiredFields = '';
    private $_fields = array();

    public $departure_date;
    public $vessel;
    public $voyage;
    public $tktNo;
    public function attributeLabels(){
      return array(
        'departure_date' => 'Departure Date',
        'vessel' => 'Vessel',
        'voyage' => 'Voyage',
        'tktNo' => 'Ticket No.'
      );
    }
    public function rules(){
      return array(
        array($this->_requiredFields,'required'),
        array('departure_date, voyage, vessel, tktNo', 'safe', 'on'=>'search'),
        array('departure_date,voyage', 'length', 'max'=>100),
        array('tktNo', 'length', 'max'=>100),
      );
    }
    public function addRequiredField($field = ''){
      if(is_array($field))
        $this->_fields = $field;
      else
        $this->_fields[] = $field;
      $this->_requiredFields = implode(',',$this->_fields);
    }

  }
