<!-- Retrieve data from the users table and display in the input fields -->
<?php 
    if(isset($_GET['edit_user'])) {
        echo $_GET['edit_user'];
    }
    if(isset($_GET['edit_user'])) {
        $user_ID = $_GET['edit_user'];
        $user_query = "SELECT * FROM peri_users WHERE id = '$user_ID'";
        $update_result = mysqli_query($conn, $user_query);
        while($user = mysqli_fetch_assoc($update_result)) {
            $user_id = $user['id'];
            $mobile_number = $user['mobilenumber'];
            $first_name = $user['firstname'];
            $last_name = $user['lastname'];
            $user_role = $user['user_role'];
            $user_image = $user['profile_image'];
            $user_email = $user['email'];
            $user_password = $user['userpassword'];
        }
        
    } 

    // Edit(Update) user in the users table using the userID
    if(isset($_POST['btn_update_user'])) {
        $userName = $_POST['user_name'];
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $userRole = $_POST['user_role'];
        
        $userImg = $_FILES['image']['name'];
        $userTmp = $_FILES['image']['tmp_name'];

        $userEmail = $_POST['user_email'];
        $userMobile = $_POST['user_mobile'];
        $userPassword = $_POST['user_password'];

        // updating the image in the db
        if(empty($userImg)) {
            $userImg = $user_image;
        }

        // update user
        $update_query = "UPDATE peri_users SET firstname = '$firstName', lastname='$lastName', mobilenumber='$userMobile', profile_image = '$userImg', user_role='$userRole',  email = '$userEmail', userpassword = '$userPassword'
            WHERE id = '$user_ID'";
        $update_result = mysqli_query($conn, $update_query);

        // check update result and notify
        if($update_result) {
            // move image from database to local folder
            move_uploaded_file($userTmp, "./assets/img/user/" . $userImg);
            echo '
                <div class="alert alert-success" role="alert">
                    Record has been updated in the database
                </div>
                ';
            header("location: users.php");
        } else {
            echo "Something is wrong!" . mysqli_error($conn);
        }                   
    }
?>

<!-- Edit User -->
<form action="" method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <img width="150" height="120" class="img-responsive mt-3 mb-1" src="./assets/img/user/<?= $user_image ?>">
        <input type="file" name="image" class="form-control-file mt-2">
    </div>

    <div class="form-group">
        <label for="">First Name</label>
        <input type="text" name="first_name" value="<?php echo $first_name ?>" placeholder="First Name" class="form-control">
    </div>

    <div class="form-group">
        <label for="">Last Name</label>
        <input type="text" name="last_name" value="<?php echo $last_name ?>" placeholder="Last Name" class="form-control">
    </div>

    <div class="form-group">
        <label for="">User Role</label>
        <select name="user_role" id="" class="form-control mb-4">
            <option name="" id=""><?php echo $user_role ?></option>
            <?php 
                if($user_role == 'admin') {
                    echo "<option value='customer'> customer </option>";
                } else {
                    echo "<option value='admin'> admin </option>";
                }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="">Mobile Number</label>
        <input type="text" name="user_mobile" placeholder="User Name" value="<?php echo $mobile_number ?>" class="form-control">
    </div>

    <div class="form-group">
        <label for="">User Email</label>
        <input type="email" name="user_email" placeholder="User Email" value="<?php echo $user_email ?>" class="form-control">
    </div>

    <div class="form-group">
        <label for="">User Password</label>
        <input type="password" name="user_password" placeholder="Password" value="<?php echo $user_password ?>" class="form-control">
    </div>

    <div class="form-group">
        <input type="submit" name="btn_update_user" class="btn btn-info" value="Update User">
    </div>
</form>

