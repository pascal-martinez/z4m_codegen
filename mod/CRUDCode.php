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
 * ZnetDK 4 Mobile Code Generator CRUD Code Class
 *
 * File version: 1.0
 * Last update: 11/04/2024
 */

namespace z4m_codegen\mod;

/**
 * Generates code for CRUD View.
 * Generated scripts are :
 * - 'menu.inc'
 * - 'view/my_entity_list_view.php'
 * - 'controller/MyEntityCtrl.php'
 * - 'validator/my_entity_validator.php'
 * - 'sql/my_entity_table.sql'
 */
class CRUDCode {
    
    public function __construct() {
        
    }
    
    public function getAllCode() {
        $codes = [];
        // Menu
        $menuCode = new \z4m_codegen\mod\MenuCode();
        $codes[] = [
            'text' => $menuCode->getCode(),
            'fileName' => $menuCode->getFileName(),
            'subDir' => $menuCode->getSubDirectory()
        ];
        // Form
        $formCode = new \z4m_codegen\mod\FormCode();
        // Modal
        $modalCode = new \z4m_codegen\mod\ModalCode($formCode->getCode());
        // DataList
        $dataListCode = new DataListCode($modalCode->getCode());
        $codes[] = [
            'text' => $dataListCode->getCode(),
            'fileName' => $dataListCode->getFileName(),
            'subDir' => $dataListCode->getSubDirectory()
        ];
        // Validator
        $validatorCode = new ValidatorCode();
        $codes[] = [
            'text' => $validatorCode->getCode(),
            'fileName' => $validatorCode->getFileName(),
            'subDir' => $validatorCode->getSubDirectory()
        ];
        // DAO
        if (CodeInfos::getGlobalInfo('model_class') === 'dao') {
            $daoCode = new DAOCode();
            $codes[] = [
                'text' => $daoCode->getCode(),
                'fileName' => $daoCode->getFileName(),
                'subDir' => $daoCode->getSubDirectory()
            ];
        }
        // Controller
        $controllerCode = new ControllerCode();
        $codes[] = [
            'text' => $controllerCode->getCode(),
            'fileName' => $controllerCode->getFileName(),
            'subDir' => $controllerCode->getSubDirectory()
        ];
        // SQL Table
        $sqlTableCode = new SQLTableCode();
        $codes[] = [
            'text' => $sqlTableCode->getCode(),
            'fileName' => $sqlTableCode->getFileName(),
            'subDir' => $sqlTableCode->getSubDirectory()
        ];
        return $codes;
    }
    
    public function getZipArchivePath() {
        if (!class_exists('\ZipArchive')) {
            throw new \Exception('ZIP not installed.');
        }
        $archivePath = sys_get_temp_dir() . DIRECTORY_SEPARATOR 
                . session_id() . '_' . time() . '.tmp';
        $zipArchive = new \ZipArchive();
        if ($zipArchive->open($archivePath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== TRUE) {
            throw new \Exception("Unable to create ZIP archive '{$archivePath}'.");
        }
        $allCode = $this->getAllCode();
        $installPath = CodeInfos::getInstallationPath();
        foreach ($allCode as $code) {
            $zipArchive->addFromString("{$installPath}{$code['subDir']}{$code['fileName']}",
                    $code['text']);
        }
        $zipArchive->close();        
        return $archivePath;
    }
    
}
