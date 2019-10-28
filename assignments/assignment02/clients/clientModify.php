<?php
ob_start();
session_start();
include_once('../root.php');

// Must be logged in to view
include_once('../shared/authentication.php');
must_be_logged_in();
?>
<!DOCTYPE html>
<html lang="en">
<?php include('../shared/head.php'); ?>
<?php include('../shared/nav.php'); ?>
<?php

if (array_key_exists('display-code', $_GET) && $_GET['display-code']) {
    display_code('clients');
    return;
}

?>

<script lang="js">
    function confirm_delete() {
        window.location = 'clients/clientModify.php?client_id=<?php echo $_GET["client_id"]; ?>&Action=ConfirmDelete';
    }
</script>
<?php
include_once("../shared/connection.php");
$dbh = new PDO ("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
$query = "select * from client where id = " . $_GET["client_id"];
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
                <h1>Update Client Information For Client ID: <?php echo $row->id; ?></h1>
            </div>
            <form method="post"
                  action="clients/clientModify.php?client_id=<?php echo $_GET["client_id"]; ?>&Action=ConfirmUpdate">
                <div class="form-group">
                    <div class="form-row">
                        <div class="col">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control"
                                   value="<?php echo $row->first_name; ?>">
                        </div>
                        <div class="col">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control"
                                   value="<?php echo $row->last_name; ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile Number</label>
                    <input type="tel" name="mobile" id="mobile" class="form-control"
                           value="<?php echo $row->mobile; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" class="form-control"
                           value="<?php echo $row->email; ?>">
                </div>
                <div class="form-group">
                    <label for="mail_list">Do you wanna receive our news? </label>

                    <select class="form-control" id="mail_list" name="mail_list" style="width:200px;">
                        <option <?php echo $row->mail_list == 'Y' ? 'selected' : ''; ?> value="Y">
                            Yes
                        </option>
                        <option <?php echo $row->mail_list == 'N' ? 'selected' : ''; ?> value="N">
                            No
                        </option>
                    </select>
                </div>
                <div class="table-heading-row">
                    <h3>Address Information</h3>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col">
                            <label for="street">Street</label>
                            <input type="text" name="street" id="street" class="form-control"
                                   value="<?php echo $row->street; ?>">
                        </div>
                        <div class="col">
                            <label for="suburb">Suburb</label>
                            <input type="text" name="suburb" id="suburb" class="form-control"
                                   value="<?php echo $row->suburb; ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col">
                            <label for="state">State</label>
                            <select class="form-control" id="state" name="state">
                                <option <?php echo $row->state == '' ? 'selected' : ''; ?> value="">
                                    Please Select
                                </option>
                                <option <?php echo $row->state == 'ACT' ? 'selected' : ''; ?> value="ACT">
                                    A.C.T
                                </option>
                                <option <?php echo $row->state == 'NSW' ? 'selected' : ''; ?> value="NSW">
                                    NSW
                                </option>
                                <option <?php echo $row->state == 'NT' ? 'selected' : ''; ?> value="NT">
                                    NT
                                </option>
                                <option <?php echo $row->state == 'QLD' ? 'selected' : ''; ?> value="QLD">
                                    Queensland
                                </option>
                                <option <?php echo $row->state == 'SA' ? 'selected' : ''; ?> value="SA">
                                    South Australia
                                </option>
                                <option <?php echo $row->state == 'TAS' ? 'selected' : ''; ?> value="TAS">
                                    Tasmania
                                </option>
                                <option <?php echo $row->state == 'VIC' ? 'selected' : ''; ?> value="VIC">
                                    Victoria
                                </option>
                                <option <?php echo $row->state == 'WA' ? 'selected' : ''; ?> value="WA">
                                    Western Australia
                                </option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="postcode">Postcode</label>
                            <input type="text" name="postcode" id="postcode" maxlength="4" minlength="3"
                                   class="form-control"
                                   value="<?php echo $row->postcode; ?>">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Update">
                    <a href="clients" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
        <?php
        break;
    //confirm update page
    case "ConfirmUpdate":
        $query = "UPDATE client set first_name = ?, last_name = ?, street = ? , suburb = ?, postcode = ?,
                    state = ?, mobile = ?, email = ?, mail_list = ?
                 WHERE id = ?";
        $stmt = $dbh->prepare($query);

        if (!$stmt->execute([
            $_POST['first_name'], $_POST['last_name'], $_POST['street'], $_POST['suburb'], $_POST['postcode'],
            $_POST['state'], $_POST['mobile'], $_POST['email'], $_POST['mail_list'], $_GET["client_id"]
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
                <h1>Customer record successfully updated</h1>
                <a href="clients" class="btn btn-primary">Ok</a>
            </div>
            <?php
        }

        break;
    //delete page
    case "Delete":
        ?>
        <div class="container">
            <div class="table-heading-row">
                <h1>Delete Client (ID: <?php echo $row->id; ?>) </h1>
            </div>
            <p>Are you sure you want to delete client - <?php echo $row->first_name . ' ' . $row->last_name; ?> </p>

            <p>
                <button onclick="confirm_delete()" class="btn btn-primary">Confirm</button>
                <a href="clients" class="btn btn-secondary">Cancel</a>
            </p>
        </div>

        <?php
        break;
    //confirm delete page
    case "ConfirmDelete":
        $query = "DELETE FROM client WHERE id = ?";
        $stmt = $dbh->prepare($query);
        if ($stmt->execute([$_GET["client_id"]])) {
            ?>

            <div class="container">
                <h1>The following customer record has been successfully deleted</h1>
                <p>
                    <?php echo "Client No. $row->id $row->first_name $row->last_name"; ?>
                </p>

                <a href="clients" class="btn btn-primary">Ok</a>
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
