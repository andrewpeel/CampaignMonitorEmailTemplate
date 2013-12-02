<?php

/*
  Copyright (C) <2011>  Vasyl Martyniuk <martyniuk.vasyl@gmail.com>

  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Event Manager
 *
 * @package AAM
 * @subpackage Model
 */
class mvb_Model_Manager_Event {

    public static $parent;

    /**
     *
     * @global array $submenu
     * @param string $tmpl
     * @param mvb_Model_Manager $parent
     * @return string
     */
    public static function render($tmpl, $parent) {
        global $wp_post_types, $wp_post_statuses;

        self::$parent = $parent;

        ob_start();
        require_once(WPACCESS_TEMPLATE_DIR . '/event_manager.phtml');
        $content = ob_get_contents();
        ob_clean();

        return $content;
    }

    public static function getEvents() {
        return self::$parent->getConfig()->getEvents();
    }

}