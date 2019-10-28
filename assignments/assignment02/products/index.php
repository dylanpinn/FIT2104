<?php
ob_start();
session_start();
include_once('../root.php');

// Must be logged in to view
include_once('../shared/authentication.php');
must_be_logged_in();

// Include shared functions.
include_once("../shared/display_code.php");
include_once("../shared/connection.php");
$dbh = new PDO ("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
?>
<!DOCTYPE html>
<html lang="en">
<?php include('../shared/head.php'); ?>
<body>
<?php include('../shared/nav.php'); ?>

<?php
if (array_key_exists('display-code', $_GET) && $_GET['display-code']) {
    display_code('products');
    return;
}
?>

<div class="container">
    <?php
    if (
        isset($_SESSION['message']) &&
        isset($_SESSION['message']['success']) &&
        $_SESSION['message']['success'] == 'create'
    ) {
        include('./partials/_alert_create_success.html');
        $_SESSION['message'] = null;
    } elseif (
        isset($_SESSION['message']) &&
        isset($_SESSION['message']['success']) &&
        $_SESSION['message']['success'] == 'update'
    ) {
        include('./partials/_alert_update_success.html');
        $_SESSION['message'] = null;
    } elseif (
        isset($_SESSION['message']) &&
        isset($_SESSION['message']['success']) &&
        $_SESSION['message']['success'] == 'delete'
    ) {
        include('./partials/_alert_delete_success.html');
        $_SESSION['message'] = null;
    } elseif (
        isset($_SESSION['message']) &&
        isset($_SESSION['message']['failure']) &&
        $_SESSION['message']['failure'] == 'product-find'
    ) {
        include('./partials/_alert_find_error.html');
        $_SESSION['message'] = null;
    }
    ?>

    <div class="table-heading-row">
        <h1>Products</h1>
        <a href="products/create.php" class="btn btn-primary">Create New Product</a>
    </div>
    <?php
    include_once('../shared/paginator.php');
    $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $query = 'SELECT product.id as product_id, name, image_name
              FROM product
              LEFT JOIN product_image ON product_image.product_id = product.id';

    if (array_key_exists('category', $_GET) && $_GET['category'] !== 'all') {
        $query .= ' LEFT JOIN product_category ON product.id = product_category.product_id';
        /* TODO: Protect against SQL injection here.*/
        $query .= ' WHERE product_category.category_id = ' . $_GET['category'];
    }

    if (array_key_exists('q', $_GET) && $_GET['q']) {
        /* TODO: Protect against SQL injection here.*/
        $query .= ' WHERE product.name LIKE "%' . $_GET['q'] . '%"';
    }

    $query .= ' ORDER BY product.id';

    $paginator = new Paginator($dbh, $query, 'products');
    $results = $paginator->getData($page);
    ?>

    <form class="form-inline my-lg-0 float-right" style="margin-bottom: 10px;">
        <label for="select-category" class="sr-only">Category</label>
        <?php
        $stmt = $dbh->prepare("SELECT * FROM category ORDER BY name");
        $stmt->execute();
        ?>
        <select class="form-control mr-sm-2" id="select-category" name="category" data-behaviour="submit-on-change">
            <option
                value="all"
                <?php echo array_key_exists('category', $_GET) && $_GET['category'] == 'all' ? 'selected' : '' ?>>
                All Categories
            </option>
            <?php while ($cat_row = $stmt->fetchObject()) : ?>
                <option value="<?php echo $cat_row->id; ?>"
                    <?php
                    echo array_key_exists('category', $_GET) && $_GET['category'] == $cat_row->id ? 'selected' : ''
                    ?>>
                    <?php echo $cat_row->name; ?>
                </option>
            <?php endwhile;
            $stmt->closeCursor();
            ?>
        </select>

        <label class="sr-only" for="search">Search</label>
        <input class="form-control mr-sm-2" type="search" name="q" placeholder="Search" aria-label="Search" id="search"
               value="<?php echo array_key_exists('q', $_GET) ? $_GET['q'] : ''; ?>">

        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">
            <i class="fas fa-search"></i> Search
        </button>
    </form>

    <table class="table table-hover">
        <thead>
        <tr>
            <th></th>
            <th>Name</th>
            <th>Category</th>
            <th colspan="2">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if (count($results->data) > 0): ?>
            <?php foreach ($results->data as $key => $row): ?>
                <tr>
                    <td>
                        <?php if (
                            $row->image_name &&
                            file_exists(__DIR__ . '/../product_images/' . $row->image_name)
                        ) : ?>
                            <img src="product_images/<?php echo $row->image_name; ?>" width="50" height="50"
                                 alt="<?php echo $row->name; ?>"/>
                        <?php endif; ?>
                    </td>
                    <td><?php echo $row->name; ?></td>
                    <td>
                        <?php
                        $stmt = $dbh->prepare("SELECT * FROM product_category WHERE product_id = ?");
                        $stmt->execute([$row->product_id]);
                        $categories = $stmt->fetchAll();
                        $category_names = [];
                        if ($categories && count($categories) > 0) {
                            foreach ($categories as $category) {
                                $stmt = $dbh->prepare("SELECT * FROM category WHERE id = ?");
                                $stmt->execute([intval($category['category_id'])]);
                                $cat = $stmt->fetchObject();
                                $category_names[] = $cat->name;
                            }
                            echo join(', ', $category_names);
                        }
                        $stmt->closeCursor();
                        ?>
                    </td>
                    <td>
                        <a href="products/edit.php?product_id=<?php echo $row->product_id; ?>">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </td>
                    <td>
                        <a href="products/remove.php?product_id=<?php echo $row->product_id; ?>">
                            <i class="fas fa-trash"></i> Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">No records</td>
            </tr>
        <?php endif; ?>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="5"><?php echo $paginator->total; ?> record/s</td>
        </tr>
        </tfoot>
    </table>


    <nav aria-label="Product list navigation">
        <?php echo $paginator->createLinks('pagination justify-content-center'); ?>
    </nav>
</div>
<?php
include('../shared/_display_code_btn.html');
?>
</body>
</html>
