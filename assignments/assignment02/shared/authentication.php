<?php

/**
 * Checks if user is logged in.
 *
 * If not then redirects to login page and display message.
 */
function must_be_logged_in()
{
    // User is logged in.
    if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == true) {
        return;
    }
    // Handle user is not logged in.
    $_SESSION['message']['error'] = 'login';
    header("Location: " . get_current_dir_root() . '/login');
}


/**
 * Check if the current user is logged in.
 *
 * @return bool
 */
function is_logged_in()
{
    // User is logged in.
    if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == true) {
        return true;
    }
    return false;
}
