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
 * ZnetDK 4 Mobile Code Generator Form Code Class
 *
 * File version: 1.0
 * Last update: 11/06/2024
 */

namespace z4m_codegen\mod;

/**
 * Generates code for Data Form.
 */
class FormCode extends Code {
    
    public function __construct() {
        parent::__construct('form_template.php');
        $this->setPlaceholderValue('{{LOAD_ACTION}}', $this->getLoadAction());
        $this->setPlaceholderValue('{{SUBMIT_ACTION}}', $this->getSubmitAction());
        $this->setPlaceholderValue('{{INPUTS}}', $this->getInputs());
        $this->generate();
    }
    
    protected function getLoadAction() {
        $controller = CodeInfos::getGlobalInfo('controller_name');
        $action = 'detail';
        return " data-zdk-load=\"{$controller}:{$action}\"";
    }
    
    protected function getSubmitAction() {
        $controller = CodeInfos::getGlobalInfo('controller_name');
        $action = 'store';
        return " data-zdk-submit=\"{$controller}:{$action}\"";
    }
    
    protected function getInputs() {
        $inputInfos = CodeInfos::getDetailInfos();
        $code = '';
        foreach ($inputInfos as $key => $infos) {
            $inputCode = new InputCode($infos);
            $eol = count($inputInfos) === $key +1 ? '' : PHP_EOL;
            $code .= $inputCode->getCode(). $eol;
        }
        return $code;
    }
    
    public function getFileName() {
        return CodeInfos::getScriptPrefix() . '_form.php';
    }
        
    public function getDescription() {
        return "HTML Form";
    }
}
