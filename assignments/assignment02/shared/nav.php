<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once('authentication.php');

/**
 * Check if the current request path matches the start of another path.
 * @param string $path - Path to check, e.g. /products
 * @param bool $exact - Current request path must match entire path.
 * @return bool
 */
function request_matches_path($path, $exact = false)
{
    $request = $_SERVER['REQUEST_URI'];
    if ($exact) {
        $match = $request === $path;
    } else {
        $match = substr($request, 0, strlen($path)) === $path;
    }
    return $match;
}

?>

<nav class="navbar navbar-expand-md navbar-light bg-light">
    <a class="navbar-brand" href="<?php echo get_current_dir_root(); ?>">
        <img src="assets/logo-sm.png" alt="Famox" height="55" width="55">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <?php if (is_logged_in()): ?>
                <li class="nav-item
                <?php echo request_matches_path(get_current_dir_root() . '/products') ? 'active' : ''; ?>">
                    <a class="nav-link" href="products">Products</a>
                </li>
            <?php endif; ?>
            <?php if (is_logged_in()): ?>
                <li class="nav-item
                <?php echo request_matches_path(get_current_dir_root() . '/category') ? 'active' : ''; ?>">
                    <a class="nav-link" href="category">Categories</a>
                </li>
            <?php endif; ?>
            <?php if (is_logged_in()): ?>
                <li class="nav-item
                <?php echo request_matches_path(get_current_dir_root() . '/clients') ? 'active' : ''; ?>">
                    <a class="nav-link" href="clients">Clients</a>
                </li>
            <?php endif; ?>
            <?php if (is_logged_in()): ?>
                <li class="nav-item
                <?php echo request_matches_path(get_current_dir_root() . '/projects') ? 'active' : ''; ?>">
                    <a class="nav-link" href="projects">Projects</a>
                </li>
            <?php endif; ?>
            <?php if (is_logged_in()): ?>
                <li class="nav-item
                <?php echo request_matches_path(get_current_dir_root() . '/update-prices') ? 'active' : ''; ?>">
                    <a class="nav-link" href="update-prices">Update Prices</a>
                </li>
            <?php endif; ?>
            <?php if (is_logged_in()): ?>
                <li class="nav-item
                <?php echo request_matches_path(get_current_dir_root() . '/images') ? 'active' : ''; ?>">
                    <a class="nav-link" href="images">Images</a>
                </li>
            <?php endif; ?>
            <li class="nav-item
                <?php echo request_matches_path(get_current_dir_root() . '/documentation') ? 'active' : ''; ?>">
                <a class="nav-link" href="documentation">Documentation</a>
            </li>
        </ul>
    </div>

    <ul class="navbar-nav">
        <?php
        if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == true):
            ?>
            <li class="nav-item">
                <a class="nav-link" href="login/logout.php">Logout</a>
            </li>
        <?php
        else:
            ?>
            <li class="nav-item <?php echo request_matches_path(get_current_dir_root() . '/login') ? 'active' : ''; ?>">
                <a class="nav-link" href="login">Login</a>
            </li>
        <?php
        endif;
        ?>
    </ul>
</nav>
