<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Library functions for Theme assets tool
 *
 * @package    tool_themeassets
 * @author     Sam Chaffee
 * @copyright  Copyright (c) 2017 Open LMS (https://www.openlms.net)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

function tool_themeassets_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, $options = []) {
    if (!$context instanceof \context_system) {
        return false;
    }

    $itemid = (int) array_shift($args);
    if ($itemid != 0) {
        return false;
    }

    $relativepath = implode('/', $args);
    $fullpath = "/{$context->id}/tool_themeassets/$filearea/$itemid/$relativepath";

    $fs = get_file_storage();
    if (!$file = $fs->get_file_by_hash(sha1($fullpath)) || $file->is_directory()) {
        return false;
    }

    $options['cacheability'] = 'public';

    send_stored_file($file, null, 0, false, $options);
}
