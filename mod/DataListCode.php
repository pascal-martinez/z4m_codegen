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
 * ZnetDK 4 Mobile Code Generator DataList Code Class
 *
 * File version: 1.0
 * Last update: 11/05/2024
 */

namespace z4m_codegen\mod;

/**
 * Generates code for DataList.
 */
class DataListCode extends Code {
    
    static protected $subdirectory = 'view';

    public function __construct($modalCode) {
        parent::__construct('datalist_template.php');
        $this->setPlaceholderValue('/*#{{ELEMENT_ID_PREFIX}}*/', '#' . CodeInfos::getGlobalInfo('element_id_prefix'));
        $this->setPlaceholderValue('{{ELEMENT_ID_PREFIX}}', CodeInfos::getGlobalInfo('element_id_prefix'));
        $this->setPlaceholderValue('{{VIEW_NAME}}', $this->getFileName());
        $this->setPlaceholderValue('{{ENTITY_NAME}}', CodeInfos::getGlobalInfo('entity_name'));
        $this->setPlaceholderValue('{{LOAD_ACTION}}', $this->getLoadAction());
        $this->setPlaceholderValue('{{AUTOCOMPLETE_ACTION}}', $this->getAutocompleteAction());
        $this->setPlaceholderValue('{{DATALIST_HEADER_COLUMNS}}', $this->getHeaderColumns());
        $this->setPlaceholderValue('{{DATALIST_ROWS}}', $this->getRowCells());
        $this->setPlaceholderValue('{{CONTROLLER_NAME}}', CodeInfos::getGlobalInfo('controller_name'));
        $this->setPlaceholderValue('{{MODAL_DIALOG}}', $modalCode);
        $this->generate();
    }
    
    protected function getLoadAction() {
        $controller = CodeInfos::getGlobalInfo('controller_name');
        $action = 'all';
        return " data-zdk-load=\"{$controller}:{$action}\"";
    }
    
    protected function getAutocompleteAction() {
        $controller = CodeInfos::getGlobalInfo('controller_name');
        $action = 'suggestions';
        return " data-zdk-autocomplete=\"{$controller}:{$action}\"";
    }
    
    protected function getHeaderColumns() {
        $colWidths = [1 => 'l12', 2 => 'l6', 3 => 'l4', 4 => 'l3'];
        $columnInfos = CodeInfos::getDetailInfos();
        $columnCount = count($columnInfos) + 1;
        $colWidth = $columnCount > 3 ? $colWidths[4] : $colWidths[$columnCount];
        // First column is ID
        $firstColumnCode = new DataListHeaderColumnCode($colWidth, 'ID');
        $code = $firstColumnCode->getCode() . PHP_EOL;
        // Next columns
        foreach ($columnInfos as $key => $infos) {
            if ($key === 3) {
                break; // 4 columns maxi
            }
            $columnCode = new DataListHeaderColumnCode($colWidth, $infos['input_label']);
            $eol = $key === 2 || count($columnInfos) === $key +1 ? '' : PHP_EOL;
            $code .= $columnCode->getCode(). $eol;
        }
        return $code;
    }

    protected function getRowCells() {
        $colWidths = [1 => 's12 m12 l12', 2 => 's12 m6 l6', 3 => 's12 m4 l4', 4 => 's12 l3 m3'];
        $columnInfos = CodeInfos::getDetailInfos();
        $columnCount = count($columnInfos) + 1;
        $colWidth = $columnCount > 3 ? $colWidths[4] : $colWidths[$columnCount];
        // First row cell
        $firstCellCode = new DataListRowIdCellCode($colWidth);
        $code = $firstCellCode->getCode() . PHP_EOL;;
        // Next row cells
        foreach ($columnInfos as $key => $infos) {
            if ($key === 3) {
                break; // 4 columns maxi
            }
            $rowCellCode = new DataListRowCellCode($colWidth, $infos['input_name']);
            $eol = $key === 2 || count($columnInfos) === $key +1 ? '' : PHP_EOL;
            $code .= $rowCellCode->getCode(). $eol;
        }
        return $code;
    }

    static public function getViewName() {
        return CodeInfos::getScriptPrefix() . '_view';
    }
    
    public function getFileName() {
        return self::getViewName() . '.php';
    }

    public function getDescription() {
        return "DataList view";
    }
}
