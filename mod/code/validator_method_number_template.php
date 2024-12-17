        if (!is_null($value) && !is_numeric($value)) {
            $this->setErrorMessage(LC_MSG_ERR_VALUE_INVALID);
            return FALSE;
        }