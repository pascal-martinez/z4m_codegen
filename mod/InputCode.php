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
 * ZnetDK 4 Mobile Code Generator Input Code Class
 *
 * File version: 1.0
 * Last update: 11/10/2024
 */

namespace z4m_codegen\mod;

/**
 * Generates code for form input.
 */
class InputCode extends Code {

    public function __construct($infos) {
        $type = $infos['input_type'];
        $template = self::getTemplateFileName($type);
        parent::__construct($template);
        $this->setPlaceholderValue('{{INPUT_LABEL}}', $infos['input_label']);
        if ($type === 'radio_group') {
            $this->setPlaceholderValue('{{RADIO_INPUTS}}',
                self::getRadioInputs($infos['input_name'],
                    $infos['input_is_required'], $infos['input_values']));
        } else {
            $this->setPlaceholderValue('{{INPUT_NAME}}', $infos['input_name']);
            $this->setPlaceholderValue('{{INPUT_IS_REQUIRED}}',
                    self::getInputIsRequiredValue($infos['input_is_required']));
            if ($type === 'checkbox') {
                $this->setPlaceholderValue('{{INPUT_VALUE}}', 1);
            } elseif ($type === 'radio') {
                $this->setPlaceholderValue('{{INPUT_VALUE}}', $infos['input_value']);
            } elseif ($type === 'select') {
                $this->setPlaceholderValue('{{SELECT_OPTIONS}}', 
                    self::getSelectOptions($infos['input_values']));
            } else {
                $this->setPlaceholderValue('{{INPUT_TYPE}}', $type);
            }
        }
        $this->generate();
    }

    static protected function getTemplateFileName($type) {
        switch ($type) {
            case 'radio_group':
                return 'input_radio_group_template.php';
            case 'radio':
            case 'select':
            case 'checkbox':
            case 'textarea':
                return "input_{$type}_template.php";
            default:
                return "input_template.php";
        }
    }

    static protected function getInputIsRequiredValue($inputIsRequired) {
        if ($inputIsRequired === 'required') {
            return ' required';
        }
        return '';
    }

    static protected function getRadioInputs($inputName, $isRequired, $values) {
        $valuesAsArray = CodeInfos::getValuesAsArray($values);
        $code = '';
        foreach ($valuesAsArray as $key => $value) {
            $radioInputCode = new InputCode([
                'input_type' => 'radio',
                'input_name' => $inputName,
                'input_is_required' => self::getInputIsRequiredValue($isRequired),
                'input_label' => mb_convert_case($value, MB_CASE_TITLE, "UTF-8"),
                'input_value' => $value
            ]);
            $eol = count($valuesAsArray) === $key +1 ? '' : PHP_EOL;
            $code .= $radioInputCode->getCode() . $eol;
        }
        return $code;
    }

    static protected function getSelectOptions($values) {
        $valuesAsArray = CodeInfos::getValuesAsArray($values);
        $code = '';
        foreach ($valuesAsArray as $key => $value) {
            $selectOptionCode = new SelectOptionCode($value,
                    mb_convert_case($value, MB_CASE_TITLE, "UTF-8"));
            $eol = count($valuesAsArray) === $key +1 ? '' : PHP_EOL;
            $code .= $selectOptionCode->getCode() . $eol;
        }
        return $code;
    }

    public function getFileName() {
        return NULL;
    }

    public function getDescription() {
        return "Input field";
    }
}
