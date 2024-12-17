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
 * ZnetDK 4 Mobile Code Generator DAO Code Class
 *
 * File version: 1.0
 * Last update: 11/07/2024
 */

namespace z4m_codegen\mod;

/**
 * Generates code for App menu.
 */
class DAOCode extends Code {
    
    static protected $subdirectory = 'model';
    
    public function __construct() {
        parent::__construct('dao_template.php', 'model');
        $this->setPlaceholderValue('__DAO_NAMESPACE__', self::getNamespace());
        $this->setPlaceholderValue('__DAO_CLASS_NAME__', self::getClassName());
        $this->setPlaceholderValue('{{SQL_TABLE_NAME}}', self::getSqlTableName());
        $this->generate();
    }
    
    static public function getClassName() {
        return str_replace('Ctrl', 'DAO', CodeInfos::getGlobalInfo('controller_name'));
    }
    
    static protected function getSqlTableName() {
        return CodeInfos::getGlobalInfo('sql_table_name');
    }
    
    static public function getClassForInstantiation() {
        $modelClass = CodeInfos::getGlobalInfo('model_class');
        if ($modelClass === 'dao') {
            return '\\' . self::getNamespace() . '\\' . self::getClassName() . '()';
        } else {
            return '\\SimpleDAO(\'' . self::getSqlTableName() . '\')';
        }
    }
        
    public function getFileName() {
        return $this->getClassName() . '.php';
    }
    
    public function getDescription() {
        return "DAO of the application";
    }
}
