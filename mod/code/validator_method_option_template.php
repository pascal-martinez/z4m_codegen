        if (!is_null($value) && !in_array($value, [__INPUT_VALUES__])) {
            $this->setErrorMessage(LC_MSG_ERR_VALUE_INVALID);
            return FALSE;
        }