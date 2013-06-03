<?php

  class Report extends CFormModel{

    private $_requiredFields = '';
    private $_fields = array();

    public $departure_date;
    public $vessel;
    public $voyage;
    public function attributeLabels(){
      return array(
        'departure_date' => 'Departure Date',
        'vessel' => 'Vessel',
        'voyage' => 'Voyage',
      );
    }
    public function rules(){
      return array(
        array($this->_requiredFields,'required'),
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