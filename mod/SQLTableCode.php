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
 * ZnetDK 4 Mobile Code Generator SQL Table creation script
 *
 * File version: 1.0
 * Last update: 11/06/2024
 */

namespace z4m_codegen\mod;

/**
 * Generates code for SQL create table.
 */
class SQLTableCode extends Code {
    
    static protected $subdirectory = 'sql';
    
    public function __construct() {
        parent::__construct('sql_table_template.sql');
        $this->setPlaceholderValue('{{TABLE_NAME}}', CodeInfos::getGlobalInfo('sql_table_name'));
        $this->setPlaceholderValue('{{TABLE_COLUMNS}}', $this->getColumns());
        $this->setPlaceholderValue('{{ENTITY_NAME}}', CodeInfos::getGlobalInfo('entity_name'));
        $this->generate();
    }    
    
    protected function getColumns() {
        $inputInfos = CodeInfos::getDetailInfos();
        $code = '';
        $inputNames = [];
        foreach ($inputInfos as $key => $infos) {
            if (!in_array($infos['input_name'], $inputNames)) {
                $columnCode = new SQLTableColumnCode($infos);
                $eol = count($inputInfos) === $key +1 ? '' : PHP_EOL;
                $code .= $columnCode->getCode(). $eol;
            }
            $inputNames [] = $infos['input_name'];
        }
        return $code;
    }
    
    public function getFileName() {
        return self::getScriptFileName();
    }
    
    static public function getScriptFileName() {
        return 'create_table_' . CodeInfos::getGlobalInfo('sql_table_name') . '.sql';
    }
    
    public function getDescription() {
        return "Script to create SQL table";
    }
}
