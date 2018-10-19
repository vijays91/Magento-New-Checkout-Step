<?php
/**
 * @author LWM
 * @copyright Copyright (c) 2018
 * @package LWM_UploadPrescription
 */

class LWM_UploadPrescription_Block_Adminhtml_Sales_Order_Uploadprescription extends Mage_Adminhtml_Block_Sales_Order_View_Info
{

    public function getOrder() {
        return Mage::registry('current_order');
    }
}
