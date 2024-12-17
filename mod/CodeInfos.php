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
 * ZnetDK 4 Mobile Code Generator Code infos Class
 *
 * File version: 1.0
 * Last update: 11/06/2024
 */

namespace z4m_codegen\mod;

/**
 * Input informations required to generate code
 */
class CodeInfos {
        
    static protected $sessionKeyForGlobal = 'z4m_codegen_global_infos';
    static protected $sessionKeyForDetail = 'z4m_codegen_detail_infos';
    static protected $globalInfoNames = ['entity_name', 'view_icon', 'element_id_prefix',
        'controller_name', 'sql_table_name', 'code_location', 'model_class'];
    static protected $detailInfoNames = ['input_label', 'input_name', 'input_type',
        'input_values', 'input_is_required'];
    
    static public function getGlobalInfo($name) {
        if (!in_array($name, self::$globalInfoNames)) {
            throw new \Exception("Info '{$name}' is unknown.");
        }
        $request = new \Request();
        $value = $request->$name;
        if ($value === NULL) {
            $values = \UserSession::getCustomValue(self::$sessionKeyForGlobal);
            if (!is_array($values) || !key_exists($name, $values)) {
                throw new \Exception("No value found for info '{$name}'.");
            }
            $value = $values[$name];
        }
        return $value;
    }
    
    static public function getScriptPrefix() {
        $elementIdPrefix = self::getGlobalInfo('element_id_prefix');
        if ($elementIdPrefix !== NULL) {
            return str_replace('-', '_', $elementIdPrefix);
        }
        return NULL;
    }
        
    static public function getInstallationPath() {
        if (self::getGlobalInfo('code_location') === 'module') {
            return self::getScriptPrefix() . '/mod/';
        } else {
            return "default/app/";
        }
    }
    
    static public function getDetailInfos() {
        $request = new \Request();
        $rows = [];
        $rawData = [];
        foreach (self::$detailInfoNames as $infoName) {
            $rawData[] = $request->$infoName;
        }
        $rowCount = is_array($rawData[0]) ? count($rawData[0]) : 0;
        if ($rowCount === 0) {
            $rowsInSession = \UserSession::getCustomValue(self::$sessionKeyForDetail);            
            return is_array($rowsInSession) ? $rowsInSession : $rows;
        }
        for ($index = 0; $index < $rowCount; $index++) {
            $row = [];
            foreach (self::$detailInfoNames as $key => $infoName) {
                if (!key_exists($key, $rawData) || !key_exists($index, $rawData[$key])) {
                    throw new \Exception("Missing detail info for keys '{$key},{$index}'.");
                }
                $row[$infoName] = $rawData[$key][$index];
            }
            $rows []= $row;
        }
        return $rows;
    }
    
    static public function getPropertyNames() {
        $details = self::getDetailInfos();
        $propertyNames = ['id'];
        foreach ($details as $row) {
            if (!in_array($row['input_name'], $propertyNames)) {
                $propertyNames []= $row['input_name'];
            }
        }
        return $propertyNames;
    }
    
    static public function getPropertyNamesAsText() {
        $propertyNames = self::getPropertyNames();
        $propertyNamesWithQuotes = [];
        foreach ($propertyNames as $propertyName) {
            $propertyNamesWithQuotes []= "'{$propertyName}'";
        }
        return implode(', ', $propertyNamesWithQuotes);
    }
    
    static public function getPropertyLabels($inputName) {
        $details = self::getDetailInfos();
        $labels = [];
        foreach ($details as $property) {
            if ($property['input_name'] === $inputName) {
                $labels []= $property['input_label'];
            }
        }
        return $labels;
    }
    
    static public function getValuesAsArray($valuesAsString) {
        $valuesAsArray = explode(',', $valuesAsString);
        $cleanValues = [];
        foreach ($valuesAsArray as $value) {
            $cleanValues[] = trim($value);
        }
        return $cleanValues;
    }
    
    static public function storeInSession() {
        // Global infos
        $global = [];
        foreach (self::$globalInfoNames as $globalInfoName) {
            $global[$globalInfoName] = self::getGlobalInfo($globalInfoName);
        }
        \UserSession::setCustomValue(self::$sessionKeyForGlobal, $global, TRUE);
        // Detail infos
        $detail = self::getDetailInfos();
        \UserSession::setCustomValue(self::$sessionKeyForDetail, $detail, TRUE);
    }
}
