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
 * ZnetDK 4 Mobile Code Generator Validator method specific value type code Class
 *
 * File version: 1.0
 * Last update: 11/19/2024
 */

namespace z4m_codegen\mod;

/**
 * Generates code for Validator method accordinf value type.
 */
class ValidatorMethodTypeCode extends Code {

    public function __construct($property) {
        $this->generatedCode = '';
        $type = $property['input_type'];
        if (in_array($type, ['select', 'radio_group'])) {
            parent::__construct('validator_method_option_template.php');
            $this->setPlaceholderValue('__INPUT_VALUES__', self::getInputValuesRoundedByQuotes($property));
            $this->generate();
        } elseif (in_array($type, ['text', 'number', 'date', 'checkbox', 'email', 'tel', 'time'])) {
            parent::__construct("validator_method_{$type}_template.php");
            $this->generate();
        }
    }
    
    static protected function getInputValuesRoundedByQuotes($property) {
        $valuesAsArray = CodeInfos::getValuesAsArray($property['input_values']);
        $valuesWithQuotes = [];
        foreach ($valuesAsArray as $value) {
            $escapedVal = str_replace("'", "\'", $value);
            $valuesWithQuotes []= "'{$escapedVal}'";
        }
        return implode(', ', $valuesWithQuotes);
    }
    
    public function getFileName() {
        return NULL;
    }

    public function getDescription() {
        return "Validator value type code";
    }
}
