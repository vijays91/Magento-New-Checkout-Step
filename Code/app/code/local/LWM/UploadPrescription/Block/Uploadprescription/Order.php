<?php
/**
 * @author LWM
 * @copyright Copyright (c) 2018
 * @package LWM_UploadPrescription
 */

class LWM_UploadPrescription_Block_Uploadprescription_Order extends Mage_Checkout_Block_Onepage
{
    public function getOrder()
    {
        return Mage::registry('current_order');
    }
}