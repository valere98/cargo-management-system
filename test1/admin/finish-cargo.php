<?php
require_once 'header.php';

$email = $_SESSION['admin_login'];

// Database connection
$connect = mysqli_connect("localhost", "root", "", "courier-booking-system");

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get data from POST request
    $id = $_POST['id'];
    $sender_name = $_POST['sender_name'];
    $sender_contact = $_POST['sender_contact'];
    $sender_address = $_POST['sender_address'];
    $receiver_name = $_POST['receiver_name'];
    $receiver_contact = $_POST['receiver_contact'];
    $receiver_address = $_POST['receiver_address'];
    $status = $_POST['status'];

    // Update the cargo status to 'Delivered' (status = 1) in the database
    $updateQuery = "UPDATE cargo SET status = '1' WHERE id = '$id'";
    if (mysqli_query($connect, $updateQuery)) {
        $success = "Cargo marked as delivered successfully.";
    } else {
        $error = "Error updating cargo status: " . mysqli_error($connect);
    }
}

?>

<div class="basic-price-table">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <!-- Success Message -->
                <?php if (isset($success)) { ?>
                    <div class="alert alert-success alert-dismissible fade show mt-3 mb-3" role="alert">
                        <?= htmlspecialchars($success) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>

                <!-- Error Message -->
                <?php if (isset($error)) { ?>
                    <div class="alert alert-danger alert-dismissible fade show mt-3 mb-3" role="alert">
                        <?= htmlspecialchars($error) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>

                <table class="table table-bordered table-striped table-hover mt-5 mb-5">
                    <thead>
                        <tr>
                            <td colspan="12">
                                <h3>Manage Delivered Cargos</h3>
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">Tracking ID</th>
                            <th scope="col">Sender Name</th>
                            <th scope="col">Sender Contact</th>
                            <th scope="col">Sender Address</th>
                            <th scope="col">Sender City</th>
                            <th scope="col">Receiver Name</th>
                            <th scope="col">Receiver Contact</th>
                            <th scope="col">Receiver Address</th>
                            <th scope="col">Receiver City</th>
                            <th scope="col">Order Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Query to fetch delivered cargos (status = 1)
                        $result = mysqli_query($connect, "SELECT * FROM cargo WHERE status = '1'");

                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?= htmlspecialchars($row['tracking_id']) ?></td>
                                <td><?= htmlspecialchars($row['sender_name']) ?></td>
                                <td><?= htmlspecialchars($row['sender_contact']) ?></td>
                                <td><?= htmlspecialchars($row['sender_address']) ?></td>
                                <td><?= htmlspecialchars($row['sender_city']) ?></td>
                                <td><?= htmlspecialchars($row['receiver_name']) ?></td>
                                <td><?= htmlspecialchars($row['receiver_contact']) ?></td>
                                <td><?= htmlspecialchars($row['receiver_address']) ?></td>
                                <td><?= htmlspecialchars($row['receiver_city']) ?></td>
                                <td><?= date('d-M-Y', strtotime($row['date'])) ?></td>
                                <td>
                                    <a href="cargo-details.php?cargo-id=<?= base64_encode($row['id']) ?>&user-id=<?= base64_encode($row['user_id']) ?>">See Full Details</a>
                                    <a href="manage-cargo.php?cargo-id=<?= base64_encode($row['id']) ?>&user-id=<?= base64_encode($row['user_id']) ?>">Manage Cargo</a>
                                    <a href="book-driver.php?cargo-id=<?= base64_encode($row['id']) ?>&user-id=<?= base64_encode($row['user_id']) ?>&driver-id=<?= base64_encode($row['driver_id']) ?>">Book Driver</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
