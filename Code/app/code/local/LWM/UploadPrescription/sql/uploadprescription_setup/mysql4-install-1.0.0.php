<?php
/**
 * @author LWM
 * @copyright Copyright (c) 2018
 * @package LWM_UploadPrescription
 */

$installer = $this;
// $installer->startSetup();

$installer->addAttribute('quote', 'uploadprescription', array('type' => 'text'));
$installer->addAttribute('order', 'uploadprescription', array('type' => 'text'));

$installer->endSetup();