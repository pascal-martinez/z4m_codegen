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
 * ZnetDK 4 Mobile Code Generator Validator Class
 *
 * File version: 1.0
 * Last update: 11/12/2024
 */

namespace z4m_codegen\mod;

/**
 * Generates code for Validator class.
 */
class ValidatorCode extends Code {
    
    static protected $subdirectory = 'validator';
    
    public function __construct() {
        parent::__construct('validator_template.php');
        $this->setPlaceholderValue('__VALIDATOR_NAMESPACE__', self::getNamespace());
        $this->setPlaceholderValue('__VALIDATOR_CLASS_NAME__', self::getClassName());
        $this->setPlaceholderValue('__PROPERTY_NAMES__', CodeInfos::getPropertyNamesAsText());
        $this->setPlaceholderValue('/*__VALIDATOR_METHODS__*/', self::getMethods());
        $this->setPlaceholderValue('__DAO_CLASS__', DAOCode::getClassForInstantiation());
        $this->generate();
    }
        
    static protected function getClassName() {
        return str_replace('Ctrl', 'Validator', CodeInfos::getGlobalInfo('controller_name'));
    }
    
    static protected function getMethods() {
        $code = '';
        $properties = CodeInfos::getDetailInfos();
        foreach ($properties as $key => $infos) {
            $columnCode = new ValidatorMethodCode($infos);
            $eol = count($properties) === $key + 1 ? '' : PHP_EOL;
            $code .= $columnCode->getCode(). $eol;
        }
        return $code;
    }
    
    static public function getClassForInstantiation() {
        return '\\' . self::getNamespace() . '\\' . self::getClassName() . '()';
    }
    
    public function getFileName() {
        return $this->getClassName() . '.php';
    }
    
    public function getDescription() {
        return "Form validator of the application";
    }
}
