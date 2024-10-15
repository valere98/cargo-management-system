<?php

require_once 'header.php';

$email = $_SESSION['user_login'];
// Get the user ID based on their email
$data_id = mysqli_query($connect, "SELECT `id` FROM `users` WHERE `email` = '$email'");
$user_id = mysqli_fetch_assoc($data_id)['id'];

// Define price per kilogram and per cubic meter
$price_per_kg = 100;  // Set your rate here
$price_per_cubic_meter = 200; // Set your rate for volume here

// Fetch cargo details for the current user
$cargo_result = mysqli_query($connect, "SELECT * FROM `cargo` WHERE `user_id` = '$user_id' AND `status` = 0");

if (mysqli_num_rows($cargo_result) > 0) {
    // Calculate price for each cargo item
    while ($row = mysqli_fetch_assoc($cargo_result)) {
        $weight = $row['weight'];
        $volume = $row['volume'];
        $quantity = $row['quantity'];

        // Calculate the weight and volume prices
        $weight_price = $weight * $price_per_kg;
        $volume_price = $volume * $price_per_cubic_meter;
        $total_price = ($weight_price + $volume_price) * $quantity;

        // Update the price table
        $update_query = "UPDATE `price` SET `total_price` = '$total_price', `weight_price` = '$weight_price' WHERE `user_id` = '$user_id'";
        if (!mysqli_query($connect, $update_query)) {
            echo "Error updating total price: " . mysqli_error($connect);
        }
    }
    // Reset cargo result pointer for displaying the details in the form
    mysqli_data_seek($cargo_result, 0);
}

// After price calculation, redirect to the payment gateway if payment button is clicked
if (isset($_POST['payment-submit'])) {
    header('Location: payment-getway.php');
}

?>

<!-- Cargo form -->
<section class="cargo-form mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-12">
                <div class="sender-details mt-5 p-5" style="background-color: whitesmoke;">

                    <?php if (isset($success)): ?>
                        <div class="alert alert-success alert-dismissible fade show mt-3 mb-3" role="alert">
                            <?= $success ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger alert-dismissible fade show mt-3 mb-3" role="alert">
                            <?= $error ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <?php if (mysqli_num_rows($cargo_result) > 0): ?>
                            <h5 style="font-weight: bold;" class="text-center mb-5">Sender's Details</h5>
                            <!-- Sender Details fields go here (if any) -->

                            <h5 style="font-weight: bold;" class="text-center mb-5 mt-5">Cargo's Details</h5>

                            <?php while ($row = mysqli_fetch_assoc($cargo_result)): ?>
                                <!-- Cargo details -->
                                <div class="form-outline mb-4">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">Cargo's Weight:</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="cweight" value="<?= $row['weight'] . ' kg' ?>" readonly />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-outline mb-4">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">Cargo's Volume:</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="cvolume" value="<?= $row['volume'] . ' m^3' ?>" readonly />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-outline mb-4">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">Cargo's Quantity:</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control" name="cquantity" value="<?= $row['quantity'] ?>" readonly />
                                        </div>
                                    </div>
                                </div>

                                <!-- Price details -->
                                <?php
                                $price_result = mysqli_query($connect, "SELECT * FROM `price` WHERE `user_id` = '$user_id'");
                                if ($price_row = mysqli_fetch_assoc($price_result)): ?>
                                    <div class="form-outline mb-4">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label">Total Price:</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" value="<?= $price_row['total_price'] . ' ksh'; ?>" readonly />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label">Weight Price:</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" value="<?= $price_row['weight_price'] . ' ksh'; ?>" readonly />
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endwhile; ?>

                            <div class="button-sub text-center">
                                <!-- Submit button -->
                                <button type="submit" class="btn btn-dark btn-block mt-4" name="payment-submit">Make Payment</button>
                            </div>
                        <?php else: ?>
                            <p>No cargo details available.</p>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="../js/bootstrap.bundle.min.js"></script>

</body>
</html>
