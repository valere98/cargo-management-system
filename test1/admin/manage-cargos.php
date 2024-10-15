<?php 

require_once 'header.php';
$email = $_SESSION['admin_login'];

// Connect to the database
$connect = mysqli_connect("localhost", "root", "", "courier-booking-system");

// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['update'])) {
    // Get form data
    $id = $_POST['id'];
    $sender_name = $_POST['sender_name'];
    $sender_contact = $_POST['sender_contact'];
    $sender_address = $_POST['sender_address'];
    $receiver_name = $_POST['receiver_name'];
    $receiver_contact = $_POST['receiver_contact'];
    $receiver_address = $_POST['receiver_address'];
    $status = $_POST['status']; // New status from the dropdown

    // Update the cargo table
    $updateCargoQuery = "UPDATE cargo SET sender_name='$sender_name', sender_contact='$sender_contact', 
                         sender_address='$sender_address', receiver_name='$receiver_name', 
                         receiver_contact='$receiver_contact', receiver_address='$receiver_address', 
                         status='$status' WHERE id='$id'";

    if (mysqli_query($connect, $updateCargoQuery)) {
        // Update or insert into the tracking table using tracking_id
        $date = date('Y-m-d H:i:s'); // Current timestamp
        $tracking_id = $_POST['tracking_id'];

        // Check if tracking record exists for this tracking ID
        $checkTrackingQuery = "SELECT * FROM tracking WHERE tracking_id='$tracking_id'";
        $trackingResult = mysqli_query($connect, $checkTrackingQuery);

        if (mysqli_num_rows($trackingResult) > 0) {
            // Update tracking record if it exists
            $updateTrackingQuery = "UPDATE tracking SET status='$status', date='$date' 
                                    WHERE tracking_id='$tracking_id'";
            if (!mysqli_query($connect, $updateTrackingQuery)) {
                $error = "Failed to update tracking status: " . mysqli_error($connect);
            }
        } else {
            // Insert new tracking record if it doesn't exist
            $user_id = $_POST['user_id']; // Add user_id to insert a new tracking record
            $insertTrackingQuery = "INSERT INTO tracking (user_id, tracking_id, status, date) 
                                    VALUES ('$user_id', '$tracking_id', '$status', '$date')";
            if (!mysqli_query($connect, $insertTrackingQuery)) {
                $error = "Failed to insert tracking status: " . mysqli_error($connect);
            }
        }
        
        if (!isset($error)) {
            $success = "Cargo and tracking status updated successfully.";
        }
    } else {
        $error = "Failed to update cargo: " . mysqli_error($connect);
    }
}
?>

<div class="basic-price-table">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <?php if(isset($success)){ ?>
                <div class="alert alert-success alert-dismissible fade show mt-3 mb-3" role="alert">
                    <?= htmlspecialchars($success) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php } ?>

                <?php if(isset($error)){ ?>
                <div class="alert alert-danger alert-dismissible fade show mt-3 mb-3" role="alert">
                    <?= htmlspecialchars($error) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php } ?>

                <table class="table table-bordered table-striped table-hover mt-5 mb-5">
                    <thead>
                        <tr>
                            <td colspan="12">
                                <h3>Manage Cargos</h3>
                            </td>
                        </tr>
                        <tr>
                            <th>Destination</th>
                            <th>Tracking ID</th>
                            <th>Sender Name</th>
                            <th>Sender Contact</th>
                            <th>Sender Address</th>
                            <th>Receiver Name</th>
                            <th>Receiver Contact</th>
                            <th>Receiver Address</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $result = mysqli_query($connect, "SELECT * FROM cargo WHERE status IN ('Pending', 'On Transit', 'Delivered')");

                        if (!$result) {
                            die("Query failed: " . mysqli_error($connect));
                        }

                        while($row = mysqli_fetch_assoc($result)) { ?>
                        <form method="POST" action="update-cargo.php" id="cargoForm-<?= htmlspecialchars($row['id']) ?>">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">
                            <input type="hidden" name="tracking_id" value="<?= htmlspecialchars($row['tracking_id']) ?>">
                            <input type="hidden" name="user_id" value="<?= htmlspecialchars($row['user_id']) ?>">
                            <tr>
                                <td>Dhaka - <?= htmlspecialchars($row['receiver_city']) ?> Cargo</td>
                                <td><?= htmlspecialchars($row['tracking_id']) ?></td>
                                <td><input type="text" name="sender_name" value="<?= htmlspecialchars($row['sender_name']) ?>"></td>
                                <td><input type="text" name="sender_contact" value="<?= htmlspecialchars($row['sender_contact']) ?>"></td>
                                <td><input type="text" name="sender_address" value="<?= htmlspecialchars($row['sender_address']) ?>"></td>
                                <td><input type="text" name="receiver_name" value="<?= htmlspecialchars($row['receiver_name']) ?>"></td>
                                <td><input type="text" name="receiver_contact" value="<?= htmlspecialchars($row['receiver_contact']) ?>"></td>
                                <td><input type="text" name="receiver_address" value="<?= htmlspecialchars($row['receiver_address']) ?>"></td>
                                <td><?= date('d-M-Y', strtotime($row['date'])) ?></td>
                                <td>
                                    <select name="status" class="form-select" onchange="checkStatus(this, <?= htmlspecialchars($row['id']) ?>)">
                                        <option value="Pending" <?= $row['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                        <option value="On Transit" <?= $row['status'] == 'On Transit' ? 'selected' : '' ?>>On Transit</option>
                                        <option value="Delivered" <?= $row['status'] == 'Delivered' ? 'selected' : '' ?>>Delivered</option>
                                    </select>
                                </td>
                                <td>
                                    <button type="submit" name="update" class="btn btn-primary btn-sm">Update</button>
                                </td>
                            </tr>
                        </form>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
// Check the status and redirect the form to finish-cargo.php if "Delivered" is selected
function checkStatus(selectElement, formId) {
    var status = selectElement.value;
    var form = document.getElementById('cargoForm-' + formId);

    if (status === "Delivered") {
        form.action = "finish-cargo.php";
    } else {
        form.action = "update-cargo.php"; // Default action
    }
}
</script>

<script src="../js/bootstrap.bundle.min.js"></script>

</body>
</html>
