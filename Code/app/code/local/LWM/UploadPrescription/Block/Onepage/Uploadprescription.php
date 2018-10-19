<?php
/**
 * @author LWM
 * @copyright Copyright (c) 2018
 * @package LWM_UploadPrescription
 */

class LWM_UploadPrescription_Block_Onepage_Uploadprescription extends Mage_Checkout_Block_Onepage_Abstract
{
    protected function _construct()
    {    	
        $this->getCheckout()->setStepData('uploadprescription', array(
            'label'     => Mage::helper('checkout')->__('Upload Prescription'),
            'is_show'   => true
        ));
        
        parent::_construct();
    }
}