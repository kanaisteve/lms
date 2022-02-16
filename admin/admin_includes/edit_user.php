<!-- Retrieve data from the users table and display in the input fields -->
<?php 
    // get user record by id
    if(isset($_GET['edit_user']) && !empty($_GET['edit_user'])) :
        $editId = $_GET['edit_user'];
        $user = $userObj->getUserById($editId);
        $user_image = $user['profile_image'];
    endif; 

    // Edit(Update) user in the users table using the userID
    if(isset($_POST['btn_update_user'])) :      
        $user = $userObj->updateUser($_POST, $user_image);
    endif;
?>

<!-- Edit User -->
<form action="" method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <img width="150" height="120" class="img-responsive mt-3 mb-1" src="./assets/img/user/<?= $user_image ?>">
        <input type="file" name="image" class="form-control-file mt-2">
    </div>

    <div class="form-group">
        <label for="">First Name</label>
        <input type="text" name="first_name" value="<?php echo $user['firstname'] ?>" placeholder="First Name" class="form-control">
    </div>

    <div class="form-group">
        <label for="">Last Name</label>
        <input type="text" name="last_name" value="<?php echo $user['lastname'] ?>" placeholder="Last Name" class="form-control">
    </div>

    <div class="form-group">
        <label for="">User Role</label>
        <select name="user_role" id="" class="form-control mb-4">
            <option name="" id=""><?php echo $user['user_role'] ?></option>
            <?php 
                if($user['user_role'] == 'admin') {
                    echo "<option value='customer'> customer </option>";
                } else {
                    echo "<option value='admin'> admin </option>";
                }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="">Mobile Number</label>
        <input type="text" name="mobile_no" placeholder="User Name" value="<?php echo $user['mobilenumber'] ?>" class="form-control">
    </div>

    <div class="form-group">
        <label for="">User Email</label>
        <input type="email" name="email" placeholder="User Email" value="<?php echo $user['email'] ?>" class="form-control">
    </div>

    <!--<div class="form-group">-->
    <!--    <label for="">User Password</label>-->
    <!--    <input type="password" name="user_password" placeholder="Password" value="<?php echo $user['userpassword'] ?>" class="form-control">-->
    <!--</div>-->

    <div class="form-group">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        <input type="submit" name="btn_update_user" class="btn btn-info" value="Update User">
    </div>
</form>

