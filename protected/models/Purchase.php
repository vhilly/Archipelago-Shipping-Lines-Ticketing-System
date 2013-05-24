<?php

  class Purchase extends CFormModel{

    public $passengerTotal;
    public $voyage;
    public $departureDate;
    public $class;
    public $hash;
    public $step;
   
    public function attributeLabels(){
      return array(
        'passengerTotal' => 'Number of Passengers',
        'voyage' => 'Voyage',
        'departureDate' => 'Departure Date',
        'class' => 'Class',
      );
    }
    public function rules(){
      return array(
        array('departureDate','required'),
        array('passengerTotal,voyage,class', 'numerical', 'integerOnly'=>true),
        array('passengerTotal,voyage,class', 'length', 'max'=>3),
        array('hash', 'length', 'max'=>32),
      );
    }
  }
