<?php

  class Payment extends CFormModel{
   public $method;
   public $totalAmount;
   public $status;
    public function attributeLabels(){
      return array(
        'totalAmount' => 'Total Amount',
        'method' => 'Choose Payment Method',
      );
    }
    public function rules(){
      return array(
        array('status,method,totalAmount','required'),
      );
    }

  }
