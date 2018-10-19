<?php
/**
 * @author LWM
 * @copyright Copyright (c) 2018
 * @package LWM_UploadPrescription
 */

class LWM_UploadPrescription_Model_Type_Onepage extends Mage_Checkout_Model_Type_Onepage
{
    
    // public function saveShippingMethod($shippingMethod)
    // {
    //     if (empty($shippingMethod)) {
    //         return array('error' => -1, 'message' => Mage::helper('checkout')->__('Invalid shipping method.'));
    //     }
    //     $rate = $this->getQuote()->getShippingAddress()->getShippingRateByCode($shippingMethod);
    //     if (!$rate) {
    //         return array('error' => -1, 'message' => Mage::helper('checkout')->__('Invalid shipping method.'));
    //     }
    //     $this->getQuote()->getShippingAddress()
    //         ->setShippingMethod($shippingMethod);

    //     $this->getCheckout()
    //         ->setStepData('shipping_method', 'complete', true)
    //         ->setStepData('uploadprescription', 'allow', true);

    //     return array();
    // }


    public function saveUploadprescription($data){
        if (empty($data)) {
            return array('error' => -1, 'message' => $this->_helper->__('Invalid data.'));
        }
        $this->getQuote()->setUploadprescription($data['prescription'])->setUploadprescriptionname($data['uploadname'])->save(); 
        
        $this->getCheckout()
            ->setStepData('uploadprescription', 'complete', true)
            ->setStepData('payment', 'allow', true);
 
        return array();
    }
}
