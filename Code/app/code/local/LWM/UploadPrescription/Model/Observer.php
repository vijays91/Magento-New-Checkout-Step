<?php
/**
 * @author LWM
 * @copyright Copyright (c) 2018
 * @package LWM_UploadPrescription
 */

class LWM_UploadPrescription_Model_Observer extends Mage_Core_Helper_Abstract
{
    public function sales_convert_quote_to_order(Varien_Event_Observer $observer) {
        if ($uploadprescriptionname = $observer->getEvent()->getQuote()->getUploadprescriptionname()) {
            try {
                $observer->getEvent()->getOrder()->setUploadprescriptionname($uploadprescriptionname);
            } catch (Exception $e) {
                Mage::logException($e);
            }
        }
        
        if ($uploadprescription = $observer->getEvent()->getQuote()->getUploadprescription()) {
            try {
                $observer->getEvent()->getOrder()->setUploadprescription($uploadprescription);
            } catch (Exception $e) {
                Mage::logException($e);
            }
        }
        return $this;
    }
}
