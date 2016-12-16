<?php

/* +***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 * *********************************************************************************** */

require_once('modules/Vtiger/models/Vehicle.php');

class Contacts_Save_Action extends Vtiger_Save_Action {

    public function process(Vtiger_Request $request) {
        
        error_log("Request::: ".print_r($request, 1));
        
        $result = Vtiger_Util_Helper::transformUploadedFiles($_FILES, true);
        $_FILES = $result['imagename'];

        //To stop saveing the value of salutation as '--None--'
        $salutationType = $request->get('salutationtype');
        if ($salutationType === '--None--') {
            $request->set('salutationtype', '');
        }

        //Line custom for vehicles
        Vehicle_Model::getInstance()->insertVehicles($request);

        parent::process($request);
    }

}
