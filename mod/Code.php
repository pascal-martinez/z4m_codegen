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
 * ZnetDK 4 Mobile Code Generator Menu Code Class
 *
 * File version: 1.0
 * Last update: 11/04/2024
 */

namespace z4m_codegen\mod;

/**
 * Generates code from template.
 */
abstract class Code {

    static protected $templateDir = ZNETDK_MOD_ROOT . '/z4m_codegen/mod/code/';
    static protected $subdirectory = '';
    protected $template;
    protected $placeholders;
    protected $generatedCode;    


    public function __construct($template) {
        $this->template = $template;
        $this->generatedCode = NULL;
        $this->placeholders = [];
    }

    public function getCode() {
        return $this->generatedCode;
    }

    static protected function getNamespace() {
        if (CodeInfos::getGlobalInfo('code_location') === 'module') {
            return CodeInfos::getScriptPrefix() . '\mod\\' . static::$subdirectory;
        } else {
            return 'app\\' . static::$subdirectory;
        }
    }
    
    static public function getSubDirectory() {
        if (static::$subdirectory === '') {
            return '';
        }
        return static::$subdirectory . '/';
    }

    abstract public function getFileName();
    
    

    abstract public function getDescription();

    protected function setPlaceholderValue($placeholder, $value) {
        $this->placeholders[$placeholder] = $value;
    }

    protected function generate() {
        $templatePath = self::$templateDir . $this->template;
        $code = file_get_contents($templatePath);
        if ($code === FALSE) {
            throw new \Exception("Code template '{$templatePath}' not found.");
        }
        foreach ($this->placeholders as $placeholder => $value) {
            $code = str_replace($placeholder, strval($value), $code);
        }
        $this->generatedCode = $code;
    }

}
