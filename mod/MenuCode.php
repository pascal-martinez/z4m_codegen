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
 * Last update: 11/06/2024
 */

namespace z4m_codegen\mod;

/**
 * Generates code for App menu.
 */
class MenuCode extends Code {
    
    public function __construct() {
        parent::__construct('menu_template.php');
        $this->setPlaceholderValue('{{VIEW_LABEL}}', self::getMenuItemLabel());
        $this->setPlaceholderValue('{{VIEW_NAME}}', DataListCode::getViewName());
        $this->setPlaceholderValue('{{VIEW_ICON}}', CodeInfos::getGlobalInfo('view_icon'));
        $this->generate();
    }
    
    static public function getMenuItemLabel() {
        return CodeInfos::getGlobalInfo('entity_name') . ' list';
    }
    
    public function getFileName() {
        return 'menu.inc';
    }
    
    public function getDescription() {
        return "This script is to include in the 'menu.php' script of the application.";
    }
}
