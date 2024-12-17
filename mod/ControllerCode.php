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
 * ZnetDK 4 Mobile Code Generator App Controller Code Class
 *
 * File version: 1.0
 * Last update: 11/18/2024
 */

namespace z4m_codegen\mod;

/**
 * Generates code for App menu.
 */
class ControllerCode extends Code {

    static protected $subdirectory = 'controller';

    public function __construct() {
        $modelClass = CodeInfos::getGlobalInfo('model_class');
        parent::__construct($modelClass === 'dao' ? 'controller_dao_template.php'
                : 'controller_template.php');
        $this->setPlaceholderValue('__CONTROLLER_NAMESPACE__', self::getNamespace());
        $this->setPlaceholderValue('__CONTROLLER_CLASS_NAME__', CodeInfos::getGlobalInfo('controller_name'));
        $this->setPlaceholderValue('{{VIEW_NAME}}', DataListCode::getViewName());
        $this->setPlaceholderValue('__VALIDATOR_CLASS__', ValidatorCode::getClassForInstantiation());
        $this->setPlaceholderValue('__PROPERTY_NAMES__', $this->getPropertyNamesAsText());
        $this->setPlaceholderValue('{{SEARCH_COLUMN}}', $this->getSearchColumnName());
        $this->setPlaceholderValue('__DAO_CLASS__', DAOCode::getClassForInstantiation());
        $this->generate();
    }

    protected function getPropertyNamesAsText() {
        $propertyNames = CodeInfos::getPropertyNames();
        $propertyNamesWithQuotes = [];
        foreach ($propertyNames as $propertyName) {
            $propertyNamesWithQuotes []= "'{$propertyName}'";
        }
        return implode(', ', $propertyNamesWithQuotes);
    }

    protected function getSearchColumnName() {
        $propertyNames = CodeInfos::getPropertyNames();
        return $propertyNames[count($propertyNames) === 1 ? 0 : 1];
    }

    public function getFileName() {
        return CodeInfos::getGlobalInfo('controller_name') . '.php';
    }

    public function getDescription() {
        return "App controller of the application";
    }
}
