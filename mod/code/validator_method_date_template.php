        if (!is_null($value) && !\General::isW3cDateValid($value)) {
            $this->setErrorMessage(LC_MSG_ERR_DATE_INVALID);
            return FALSE;
        }