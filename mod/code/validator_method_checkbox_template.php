        if (!is_null($value) && $value !== '1') {
            $this->setErrorMessage(LC_MSG_ERR_VALUE_INVALID);
            return FALSE;
        }