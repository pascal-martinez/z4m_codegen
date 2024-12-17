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
 * ZnetDK 4 Mobile Code Generator SQL table column Class
 *
 * File version: 1.0
 * Last update: 11/06/2024
 */

namespace z4m_codegen\mod;

/**
 * Generates code for a table column.
 */
class SQLTableColumnCode extends Code {
    
    public function __construct($infos) {
        parent::__construct("sql_table_column_template.sql");
        $this->setPlaceholderValue('{{COLUMN_NAME}}', $infos['input_name']);
        $this->setPlaceholderValue('{{COLUMN_TYPE}}', self::getSQLType($infos['input_type']));
        $this->setPlaceholderValue('{{COLUMN_NULL}}', self::getNullable($infos['input_is_required']));
        $this->setPlaceholderValue('{{COLUMN_COMMENT}}', self::getComment($infos));
        $this->generate();
    }
    
    static protected function getSQLType($inputType) {
        $sqlTypes = [
            'text' => 'VARCHAR(50)',
            'textarea' => 'TEXT',
            'date' => 'DATE',
            'time' => 'TIME',
            'number' => 'INT',
            'tel' => 'VARCHAR(20)',
            'email' => 'VARCHAR(100)',
            'radio_group' => 'VARCHAR(50)',
            'checkbox' => 'BOOLEAN',
            'select' => 'VARCHAR(50)'
        ];
        return $sqlTypes[$inputType];
    }
    
    static protected function getNullable($inputIsRequired) {
        return $inputIsRequired === 'required' ? 'NOT NULL' : 'NULL';
    }
    
    static protected function getComment($infos) {
        return str_replace("'", "''", $infos['input_type'] === 'radio_group' 
                || $infos['input_type'] === 'select'
            ? "{$infos['input_label']}: {$infos['input_values']}" 
            : $infos['input_label']);
    }
    
    public function getFileName() {
        return NULL;
    }
    
    public function getDescription() {
        return "SQL Table column";
    }
}
