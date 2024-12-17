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
 * ZnetDK 4 Mobile Code Generator Modal Code Class
 *
 * File version: 1.0
 * Last update: 11/04/2024
 */

namespace z4m_codegen\mod;

/**
 * Generates code for Modal dialog.
 */
class ModalCode extends Code {
    
    public function __construct($modalContent) {
        parent::__construct('modal_template.php');
        $this->setPlaceholderValue('{{ELEMENT_ID_PREFIX}}', CodeInfos::getGlobalInfo('element_id_prefix'));
        $this->setPlaceholderValue('{{MODAL_ICON}}', CodeInfos::getGlobalInfo('view_icon'));
        $this->setPlaceholderValue('{{MODAL_TITLE}}', CodeInfos::getGlobalInfo('entity_name'));
        $this->setPlaceholderValue('{{MODAL_CONTENT}}', $modalContent);
        $this->generate();
    }
    
    public function getFileName() {
        return CodeInfos::getScriptPrefix() . '_modal.php';
    }
    
    public function getDescription() {
        return "HTML Modal dialog";
    }
}
