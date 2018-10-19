<?php
/**
 * @author LWM
 * @copyright Copyright (c) 2018
 * @package LWM_UploadPrescription
 */

$installer = $this;
// $installer->startSetup();

$installer->addAttribute('quote', 'uploadprescriptionname', array('type' => 'text'));
$installer->addAttribute('order', 'uploadprescriptionname', array('type' => 'text'));

$installer->endSetup();