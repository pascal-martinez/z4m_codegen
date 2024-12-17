<?php
/**
 * Data Validator class.
 * Code Generated by the Code Generator module of ZnetDK 4 Mobile.
 */
namespace __VALIDATOR_NAMESPACE__;
class __VALIDATOR_CLASS_NAME__ extends \Validator {
    
    protected function initVariables() {
        return array(__PROPERTY_NAMES__);
    }
    
    protected function check_id($value) {
        if (!is_null($value)) {
            $dao = new __DAO_CLASS__;
            if ($dao->getById($value) === FALSE) {
                $this->setErrorMessage(LC_MSG_INF_NO_RESULT_FOUND);
                $this->setErrorVariable(NULL);
                return FALSE;
            }
        }
        return TRUE;
    }

/*__VALIDATOR_METHODS__*/
}