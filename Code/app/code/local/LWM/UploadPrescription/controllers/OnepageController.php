<?php
/**
 * @author LWM
 * @copyright Copyright (c) 2018
 * @package LWM_UploadPrescription
 */

require_once Mage::getModuleDir('controllers', 'Mage_Checkout') . DS . 'OnepageController.php';

class LWM_UploadPrescription_OnepageController extends Mage_Checkout_OnepageController
{
    public function saveShippingMethodAction()
    {
        if ($this->_expireAjax()) {
            return;
        }
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost('shipping_method', '');
            $result = $this->getOnepage()->saveShippingMethod($data);
            // $result will contain error data if shipping method is empty
            if (!$result) {
                Mage::dispatchEvent(
                    'checkout_controller_onepage_save_shipping_method',
                     array(
                          'request' => $this->getRequest(),
                          'quote'   => $this->getOnepage()->getQuote()));
                $this->getOnepage()->getQuote()->collectTotals();
                $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));

                $result['goto_section'] = 'uploadprescription';
                // $result['update_section'] = array(
                //     'name' => 'uploadprescription',
                //     'html' => $this->_getUploadprescriptionHtml()
                // );
            }
            $this->getOnepage()->getQuote()->collectTotals()->save();
            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
        }
    }

    public function _getUploadprescriptionHtml() {
        $layout = $this->getLayout();
        $update = $layout->getUpdate();
        $update->load('checkout_onepage_uploadprescription');
        $layout->generateXml();
        $layout->generateBlocks();
        $output = $layout->getOutput();
        return $output;
    }

    public function uploadprescriptionAction() {
        $_data = array('filename' => '' );
        $type = 'file';
        if(isset($_FILES[$type]['name']) && $_FILES[$type]['name'] != '') {
            try {
                $uploader = new Varien_File_Uploader($type);
                $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png', 'pdf'));
                $uploader->setAllowRenameFiles(true);
                $uploader->setFilesDispersion(true);
                $path = Mage::getBaseDir('media') . DS . 'uploadprescription' . DS;
                $uploader->save($path, $_FILES[$type]['name']);
                $filename = $uploader->getUploadedFileName();
                $_data = array(
                    'filename'   => $filename,
                    'uploadname' => $_FILES['file']['name'],
                );
            } catch (Exception $e) {

            }
            
            if($this->getRequest()->getParam('orderid')) {
                $orderid = $this->getRequest()->getParam('orderid');
                $uploadname = $_FILES['file']['name'];
                Mage::getModel("sales/order")->load($orderid)->setUploadprescription($filename)->setUploadprescriptionname($uploadname)->save();
                // Mage::getSingleton('core/session')->addSuccess('Successfully changed the uploaded prescription.');
            }

        }
        $this->getResponse()->setBody(json_encode( $_data));
    }

    public function saveUploadprescriptionAction()
    {
        if ($this->_expireAjax()) {
            return;
        }

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost('uploadprescription', "");
            $result = $this->getOnepage()->saveUploadprescription($data);
            if (!isset($result['error'])) {
                Mage::dispatchEvent("checkout_controller_onepage_save_uploadprescription", array("request" => $this->getRequest(), "quote" => $this->getOnepage()->getQuote()));
                $this->getResponse()->setBody(Zend_Json::encode($result));
                $result['goto_section'] = 'payment';
                $result['update_section'] = array(
                    'name' => 'payment-method',
                    'html' => $this->_getPaymentMethodsHtml()
                );
            }
            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
        }
    }
}
