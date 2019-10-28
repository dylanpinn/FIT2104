<?php
/**
 * Find if project is in a subdirectory so absolute links work correctly.
 */
function get_current_dir_root()
{
    $current_sub_dir_root = str_replace($_SERVER['DOCUMENT_ROOT'], '', __DIR__);
    $current_sub_dir_root = str_replace("\\", '/', $current_sub_dir_root);
    return $current_sub_dir_root;
}
