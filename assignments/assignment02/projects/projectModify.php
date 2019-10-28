<?php
ob_start();
session_start();
include_once('../root.php');

// Must be logged in to view
include_once('../shared/authentication.php');
must_be_logged_in();

include("../shared/display_code.php");
?>
<!DOCTYPE html>
<html lang="en">
<?php include('../shared/head.php'); ?>
<?php include('../shared/nav.php'); ?>
<?php

if (array_key_exists('display-code', $_GET) && $_GET['display-code']) {
    display_code('projects');
    return;
}
?>

<script lang="js">
    function confirm_delete() {
        window.location = 'projects/projectModify.php?project_id=<?php echo $_GET["project_id"]; ?>&Action=ConfirmDelete';
    }
</script>
<?php
include("../shared/connection.php");
$dbh = new PDO ("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
$query = "select * from project where id = " . $_GET["project_id"];
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetchObject();

$strAction = $_GET["Action"];

switch ($strAction) {
    //update page
    case "Update":
        ?>
        <div class="container">
            <div class="table-heading-row">
                <h1>Update Project Information For Project ID: <?php echo $row->id; ?></h1>
            </div>
            <form method="post"
                  action="projects/projectModify.php?project_id=<?php echo $_GET["project_id"]; ?>&Action=ConfirmUpdate">
                <div class="form-group">
                    <div class="form-row">
                        <div class="col">
                            <label for="name">Project Name</label>
                            <input type="text" name="name" id="name" class="form-control"
                                   value="<?php echo $row->name; ?>">
                        </div>
                        <div class="col">
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date" class="form-control"
                                   value="<?php echo $row->date; ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col">
                            <label for="country">Country</label>
                            <input type="text" name="country" id="country" min="0" step="0.01" class="form-control"
                                   value="<?php echo $row->country; ?>">
                        </div>
                        <div class="col">
                            <label for="city">City</label>
                            <input type="text" name="city" id="city" min="0" step="0.01" class="form-control"
                                   value="<?php echo $row->city; ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="number" name="amount" id="amount" min="0" step="0.01" class="form-control"
                               value="<?php echo $row->amount; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description"
                              placeholder="Description of the product."><?php echo $row->description; ?></textarea>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary" data-behaviour="disable-on-submit">Update</button>
                    <a href="projects" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
        <?php
        break;
    //confirm update page
    case "ConfirmUpdate":
        $query = "UPDATE project set name = ?, date = ?, description = ?, country = ?, city = ?, amount = ?
                  WHERE id = ?";
        $stmt = $dbh->prepare($query);

        if (!$stmt->execute([
            $_POST['name'], $_POST['date'], $_POST['description'], $_POST['country'], $_POST['city'], $_POST['amount'],
            $_GET["project_id"]
        ])) {
            $err = $stmt->errorInfo();
            echo "Error updating record to database - contact System Administrator. Error is :  <b>" . $err[2] . "</b>";
            ?>
            <form>
                <input type="button" value="Go back" onclick="history.back()">
            </form>
            <?php
        } else {
            ?>
            <div class="container">
                <h1>Project record successfully updated</h1>
                <a href="projects" class="btn btn-primary">Ok</a>
            </div>
            <?php
        }

        break;
    //delete page
    case "Delete":
        ?>
        <div class="container">
            <div class="table-heading-row">
                <h1>Delete Project (ID: <?php echo $row->id; ?>) </h1>
            </div>
            <div class="table-heading-row">
                <p>Are you sure you want to delete project - <?php echo $row->name ?> </p>
            </div>

            <div class="form-group">
                <button class="btn btn-primary" onclick="confirm_delete()">Confirm</button>
                <a href="projects" class="btn btn-secondary">Cancel</a>
            </div>
        </div>

        <?php
        break;
    //confirm delete page
    case "ConfirmDelete":
        $query = "DELETE FROM project WHERE id =" . $_GET["project_id"];
        $stmt = $dbh->prepare($query);
        if ($stmt->execute()) {
            ?>
            <div class="container">
                <h1>The following project record has been successfully deleted</h1>
                <p>
                    <?php echo "Project No. $row->id $row->name"; ?>
                </p>

                <p>
                    <a href="projects" class="btn btn-primary">Ok</a>
                </p>
            </div>
            <?php

        } else {
            $err = $stmt->errorInfo();
            echo "Error updating record to database - contact System Administrator. Error is :  <b>" . $err[2] . "</b>";
            ?>
            <form>
                <input type="button" value="Go back" onclick="history.back()">
            </form>
            <?php
        }
        break;
}
$stmt->closeCursor();
?>
<?php
include('../shared/_display_code_btn.html');
?>

</html>
