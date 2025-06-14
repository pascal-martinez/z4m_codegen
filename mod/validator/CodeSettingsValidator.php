<?php
/**
 * ZnetDK, Starter Web Application for rapid & easy development
 * See official website https://mobile.znetdk.fr
 * Copyright (C) 2024 Pascal MARTINEZ (contact@znetdk.fr)
 * License GNU GPL https://www.gnu.org/licenses/gpl-3.0.html GNU GPL
 * --------------------------------------------------------------------
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 * --------------------------------------------------------------------
 * ZnetDK 4 Mobile Code Generator Validator
 *
 * File version: 1.1
 * Last update: 06/10/2025
 */

namespace z4m_codegen\mod\validator;

use \z4m_codegen\mod\controller\z4mCodeGenCtrl;

class CodeSettingsValidator extends \Validator {
    
    static protected $labelRegex = '/^[\p{L}0-9\'\s]+$/u';
    static protected $elementIdRegex = '/^[a-z0-9\-]+$/i';
    static protected $controllerRegex = '/^[a-z0-9]+$/i';
    static protected $inputNameRegex = '/^[a-z0-9_]+$/i';

    protected function initVariables() {
        return [
            'entity_name', 'view_icon', 'element_id_prefix', 'controller_name',
            'code_location', 'model_class', 'input_label', 'input_name',
            'input_type', 'input_values', 'input_is_required'
        ];
    }

    /**
     * Entity name is required, not too long (35 chars max) and contains only
     * letters, spaces, numbers and single quote characters
     * @param String $value Entity name
     * @return boolean FALSE if invalid
     */
    protected function check_entity_name($value) {
        if (is_null($value)) {
            $this->setErrorMessage(LC_MSG_ERR_MISSING_VALUE);
            return FALSE;
        }
        if (strlen($value) > 35) {
            $this->setErrorMessage(LC_MSG_ERR_VALUE_BADLENGTH);
            return FALSE;
        }
        
        if (!preg_match(self::$labelRegex, $value)) {
            $this->setErrorMessage(LC_MSG_ERR_VALUE_INVALID);
            return FALSE;
        }
        return TRUE;
    }

    /**
     * View icon is a valid FontAwesome icon.
     * @param String $value View icon
     * @return boolean FALSE if invalid
     */
    protected function check_view_icon($value) {
        if (is_null($value)) {
            $this->setErrorMessage(LC_MSG_ERR_MISSING_VALUE);
            return FALSE;
        }
        if (!in_array($value, z4mCodeGenCtrl::$faIcons)) {
            $this->setErrorMessage("Unknown icon '{$value}'.");
            return FALSE;
        }
        return TRUE;
    }

    /**
     * Required, only letters and dash character. Max length: 50 characters.
     * @param String $value Element ID prefix
     * @return boolean FALSE if invalid
     */
    protected function check_element_id_prefix($value) {
        if (is_null($value)) {
            $this->setErrorMessage(LC_MSG_ERR_MISSING_VALUE);
            return FALSE;
        }
        if (strlen($value) > 50) {
            $this->setErrorMessage(LC_MSG_ERR_VALUE_BADLENGTH);
            return FALSE;
        }
        if (!preg_match(self::$elementIdRegex, $value)) {
            $this->setErrorMessage(LC_MSG_ERR_VALUE_INVALID);
            return FALSE;
        }
        return TRUE;
    }

    /**
     * Required, only letters, max length: 50 characters.
     * @param String $value Controller name
     * @return boolean FALSE if invalid
     */
    protected function check_controller_name($value) {
        if (is_null($value)) {
            $this->setErrorMessage(LC_MSG_ERR_MISSING_VALUE);
            return FALSE;
        }
        if (strlen($value) > 50) {
            $this->setErrorMessage(LC_MSG_ERR_VALUE_BADLENGTH);
            return FALSE;
        }
        if (!preg_match(self::$controllerRegex, $value)) {
            $this->setErrorMessage(LC_MSG_ERR_VALUE_INVALID);
            return FALSE;
        }
        return TRUE;
    }

    /**
     * Required, value 'module' or 'app'.
     * @param String $value Code location
     * @return boolean FALSE if invalid
     */
    protected function check_code_location($value) {
        if (is_null($value)) {
            $this->setErrorMessage(LC_MSG_ERR_MISSING_VALUE);
            return FALSE;
        }
        if (!in_array($value, ['module', 'app'])) {
            $this->setErrorMessage(LC_MSG_ERR_VALUE_INVALID);
            return FALSE;
        }
        return TRUE;
    }

    /**
     * Required, value 'simpledao' or 'dao'.
     * @param String $value Model class
     * @return boolean FALSE if invalid
     */
    protected function check_model_class($value) {
        if (is_null($value)) {
            $this->setErrorMessage(LC_MSG_ERR_MISSING_VALUE);
            return FALSE;
        }
        if (!in_array($value, ['simpledao', 'dao'])) {
            $this->setErrorMessage(LC_MSG_ERR_VALUE_INVALID);
            return FALSE;
        }
        return TRUE;
    }

    /**
     * Required, only letters, spaces, numbers and single quote characters,
     * max 40 characters.
     * @param Array $values Input labels
     * @return boolean FALSE if invalid
     */
    protected function check_input_label($values) {
        if (!is_array($values)) {
            $this->setErrorMessage(LC_MSG_ERR_MISSING_VALUE);
            return FALSE;
        }
        $inputLabels = [];
        foreach ($values as $position => $value) {
            if (strlen($value) > 40) {
                $this->setErrorMessage(LC_MSG_ERR_VALUE_BADLENGTH);
                $this->setErrorVariable("input_label[]:{$position}");
                return FALSE;
            }            
            if (!preg_match(self::$labelRegex, $value)) {
                $this->setErrorMessage(LC_MSG_ERR_VALUE_INVALID);
                $this->setErrorVariable("input_label[]:{$position}");
                return FALSE;
            }
            if (in_array($value, $inputLabels)) {
                $this->setErrorMessage("Input label '{$value}' set twice.");
                $this->setErrorVariable("input_label[]:{$position}");
                return FALSE;
            }
            $inputLabels []= $value;
        }
        return TRUE;
    }

    /**
     * Required, only letters and underscores, max 40 characters.
     * @param Array $values Input names
     * @return boolean FALSE if invalid
     */
    protected function check_input_name($values) {
        if (!is_array($values)) {
            $this->setErrorMessage(LC_MSG_ERR_MISSING_VALUE);
            return FALSE;
        }
        $inputNames = [];
        foreach ($values as $position => $value) {
            if (strlen($value) > 50) {
                $this->setErrorMessage(LC_MSG_ERR_VALUE_BADLENGTH);
                $this->setErrorVariable("input_name[]:{$position}");
                return FALSE;
            }
            if (!preg_match(self::$inputNameRegex, $value)) {
                $this->setErrorMessage(LC_MSG_ERR_VALUE_INVALID);
                $this->setErrorVariable("input_name[]:{$position}");
                return FALSE;
            }
            if (in_array($value, $inputNames)) {
                $this->setErrorMessage("Input name '{$value}' set twice.");
                $this->setErrorVariable("input_name[]:{$position}");
                return FALSE;
            }
            $inputNames []= $value;
        }
        return TRUE;
    }

    /**
     * Required, only supported input types.
     * @param Array $values Input types
     * @return boolean FALSE if invalid
     */
    protected function check_input_type($values) {
        if (!is_array($values)) {
            $this->setErrorMessage(LC_MSG_ERR_MISSING_VALUE);
            return FALSE;
        }
        foreach ($values as $position => $value) {
            $types = array_keys(z4mCodeGenCtrl::$inputTypes);
            if (!in_array($value, $types)) {
                $this->setErrorMessage(LC_MSG_ERR_VALUE_INVALID);
                $this->setErrorVariable("input_type[]:{$position}");
                return FALSE;
            }
        }
        return TRUE;
    }

    /**
     * Required if input type is 'radio_group' or 'select', values are separated
     * by a comma.
     * @param Array $values Input values
     * @return boolean FALSE if invalid
     */
    protected function check_input_values($values) {
        if (!is_array($values)) {
            $this->setErrorMessage(LC_MSG_ERR_MISSING_VALUE);
            return FALSE;
        }
        foreach ($values as $position => $value) {
            $inputType = $this->getValue('input_type')[$position];
            if (strlen(trim($value)) === 0 && in_array($inputType, ['radio_group', 'select'])) {
                $this->setErrorMessage(LC_MSG_ERR_MISSING_VALUE);
                $this->setErrorVariable("input_values[]:{$position}");
                return FALSE;
            } elseif (in_array($inputType, ['radio_group', 'select'])) {
                $options = explode(',', $value);
                if (count($options) < 2) {
                    $this->setErrorMessage(LC_MSG_ERR_VALUE_INVALID);
                    $this->setErrorVariable("input_values[]:{$position}");
                    return FALSE;
                }
                if (strlen($value) > 500) {
                    $this->setErrorMessage(LC_MSG_ERR_VALUE_BADLENGTH);
                    $this->setErrorVariable("input_values[]:{$position}");
                    return FALSE;
                }
            }
        }
        return TRUE;
    }
    
    /**
     * Empty string or value set to 'required'
     * @param Array $values Input required properties
     * @return boolean FALSE if invalid
     */
    protected function check_input_is_required($values) {
        if (!is_array($values)) {
            $this->setErrorMessage(LC_MSG_ERR_MISSING_VALUE);
            return FALSE;
        }
        foreach ($values as $position => $value) {
            if ($value !== '' && $value !== 'required') {
                $this->setErrorMessage(LC_MSG_ERR_VALUE_INVALID);
                $this->setErrorVariable("input_is_required[]:{$position}");
                return FALSE;
            }
        }
        return TRUE;
    }

}
