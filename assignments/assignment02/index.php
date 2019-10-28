<?php
ob_start();
session_start();
include_once('root.php');
include_once('./shared/authentication.php');

include("./shared/connection.php");
include("./shared/display_code.php");

$dbh = new PDO ("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
?>
<!DOCTYPE html>
<html lang="en">
<?php include('./shared/head.php'); ?>
<body>
<?php include('./shared/nav.php'); ?>
<?php
if (array_key_exists('display-code', $_GET) && $_GET['display-code']) {
    display_code('projects');
    return;
}
?>
<?php

// Must be logged in to view
must_be_logged_in();
?>
<div class="container">
    <?php
    if (
        isset($_SESSION['message']) &&
        isset($_SESSION['message']['success']) &&
        $_SESSION['message']['success'] == 'login'
    ): ?>
        <div class="alert alert-success alert-dismissible fade show" style="margin-top: 15px" role="alert">
            Logged in successfully.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
        $_SESSION['message'] = null;
    endif;
    if (
        isset($_SESSION['message']) &&
        isset($_SESSION['message']['success']) &&
        $_SESSION['message']['success'] == 'logout'
    ): ?>
        <div class="alert alert-success alert-dismissible fade show" style="margin-top: 15px" role="alert">
            Logged out successfully.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
        $_SESSION['message'] = null;
    endif;
    ?>
    <h1>Famox</h1>
    <h3>Most recent products</h3>
    <?php
    $prod_stmt = $dbh->prepare("SELECT * FROM product ORDER BY id DESC LIMIT 5");
    $prod_stmt->execute();
    ?>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Categories</th>
            <th>Country of Origin</th>
            <th>Purchase Price</th>
            <th>Sale Price</th>
        </tr>
        </thead>
        <tbody>
        <?php
        while ($row = $prod_stmt->fetch()) {
            ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["name"]; ?></td>
                <td>
                    <?php
                    $prod_cat_stmt = $dbh->prepare("SELECT * FROM product_category WHERE product_id = ?");
                    $prod_cat_stmt->execute([$row["id"]]);
                    $categories = $prod_cat_stmt->fetchAll();
                    $category_names = [];
                    if ($categories && count($categories) > 0) {
                        foreach ($categories as $category) {
                            $cat_stmt = $dbh->prepare("SELECT * FROM category WHERE id = ?");
                            $cat_stmt->execute([intval($category['category_id'])]);
                            $cat = $cat_stmt->fetchObject();
                            $category_names[] = $cat->name;
                        }
                        echo join(', ', $category_names);
                    }
                    ?>
                </td>
                <td><?php echo $row["country_of_origin"]; ?></td>
                <td><?php echo $row["purchase_price"] ? '$' . $row['purchase_price'] : ''; ?></td>
                <td><?php echo $row["sale_price"] ? '$' . $row['sale_price'] : ''; ?></td>
            </tr>
            <?php
        }
        ?>
        <?php
        $prod_stmt->closeCursor();  //free up the resources
        ?>
        </tbody>
    </table>
    <p><a href="products">View all</a></p>

    <h3>Most recent projects</h3>
    <?php
    $project_stmt = $dbh->prepare("SELECT * FROM project ORDER BY id DESC LIMIT 5");
    $project_stmt->execute();
    ?>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Date</th>
            <th>Country</th>
            <th>City</th>
            <th>Amount</th>
        </tr>
        </thead>
        <tbody>
        <?php
        while ($row = $project_stmt->fetch()) {
            ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["name"]; ?></td>
                <td><?php echo $row["date"]; ?></td>
                <td><?php echo $row["country"]; ?></td>
                <td><?php echo $row["city"]; ?></td>
                <td>$<?php echo $row["amount"]; ?></td>
            </tr>
            <?php
        }
        ?>
        <?php
        $project_stmt->closeCursor();  //free up the resources
        ?>
        </tbody>
    </table>
    <p><a href="projects">View all</a></p>

    <h3>Most recent clients</h3>
    <?php
    $client_stmt = $dbh->prepare("SELECT * FROM client ORDER BY id DESC LIMIT 5");
    $client_stmt->execute();
    ?>
    <table class="table table-hover table-responsive">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Mobile Number</th>
            <th>Email Address</th>
            <th>In Mail List</th>
        </tr>
        </thead>
        <tbody>
        <?php
        while ($row = $client_stmt->fetch()) {
            ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["first_name"] . ' ' . $row["last_name"] ?></td>
                <td>
                    <?php echo $row["street"] . "\n" . $row["suburb"] . ' ' . $row['postcode'] . ' ' . $row['state']; ?>
                </td>
                <td><?php echo $row["mobile"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <td><?php echo $row["mail_list"]; ?></td>
            </tr>
            <?php
        }
        ?>
        <?php
        $client_stmt->closeCursor();  //free up the resources
        ?>
        </tbody>
    </table>
    <p><a href="clients">Clients</a></p>
</div>
</body>
</html>
