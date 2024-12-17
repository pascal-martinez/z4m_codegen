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
 * ZnetDK 4 Mobile Code Generator Validator method Class
 *
 * File version: 1.0
 * Last update: 11/07/2024
 */

namespace z4m_codegen\mod;

/**
 * Generates code for Validator method.
 */
class ValidatorMethodCode extends Code {

    public function __construct($property) {
        parent::__construct('validator_method_template.php');
        $this->setPlaceholderValue('{{INPUT_NAME}}', $property['input_name']);
        $this->setPlaceholderValue('{{VALIDATOR_REQUIRED}}', self::getRequiredCode($property['input_is_required']));
        $this->setPlaceholderValue('{{VALIDATOR_TYPE_CHECKS}}', self::getTypeCode($property));
        $this->generate();
    }
        
    static protected function getRequiredCode($inputIsRequired) {
        $code = '';
        if ($inputIsRequired === 'required') {
            $requiredCode = new ValidatorMethodRequiredCode();
            $code = $requiredCode->getCode() . PHP_EOL;
        }
        return $code;
    }
    
    static protected function getTypeCode($property) {
        $typeCode = new ValidatorMethodTypeCode($property);
        $typeCodeStr = $typeCode->getCode();
        $code = strlen($typeCodeStr) > 0 ? $typeCodeStr . PHP_EOL : '';
        return $code;
    }
    

    public function getFileName() {
        return NULL;
    }

    public function getDescription() {
        return "Validator method";
    }
}
