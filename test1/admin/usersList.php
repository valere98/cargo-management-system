<?php 

    require_once 'header.php';

    $email = $_SESSION['admin_login'];

    if(isset($_POST['profile-submit'])){

        $fullname = $_POST['fullname'];
        $user_email = $_POST['email'];
        $contact = $_POST['contact'];
        $city = $_POST['city'];

        $result = mysqli_query($connect, "UPDATE `admin` SET `fullname`='$fullname',`contact`='$contact',`city`='$city',`email`='$user_email' WHERE `email` = '$email'");

        if($result){
            ?>

<script type="text/javascript">
alert('Profile Updated Successfully!');
javascript: history.go(-1);
</script>

<?php
        } else{
            ?>
<script type="text/javascript">
alert('Profile Update Not Successful!');
</script>
<?php
        }

    }

?>





<script src="../js/bootstrap.bundle.min.js"></script>

</body>

</html>