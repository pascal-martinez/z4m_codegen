        if (!is_null($value) && strlen($value) > 100) {
            $this->setErrorMessage(LC_MSG_ERR_VALUE_BADLENGTH);
            return FALSE;
        }
        if (!is_null($value) && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->setErrorMessage(LC_MSG_ERR_EMAIL_INVALID);
            return FALSE;
        }