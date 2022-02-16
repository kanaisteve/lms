<?php
    include_once "./libs/users.php";
    include_once './libs/user_validator.php';
    
    // insert new user in the users table
    if(isset($_POST['btn_add_user'])) :
        // create a uservalidator and users object to access their methods
        $validation = new UserValidator($_POST);
        $userObj = new Users();
        
        // validate entries
        $errors = $validation->validateForm();
        
        // add user if their are no errors
        if(empty($errors)) {
            $userObj->addUser($_POST);
            header("location: ./users.php");
        }
    endif;
?>

<!-- Add New User -->
<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">First Name</label>
        <input type="text" name="firstname" value="<?php if(isset($_POST['firstname'])) echo $_POST['firstname'] ?>" placeholder="First Name" class="form-control">
        <span class="help-block text-danger"><?php echo $errors['firstname'] ?? '' ?></span>
    </div>

    <div class="form-group">
        <label for="">Last Name</label>
        <input type="text" name="lastname" value="<?php if(isset($_POST['lastname'])) echo $_POST['lastname'] ?>" placeholder="Last Name" class="form-control">
        <span class="help-block text-danger"><?php echo $errors['lastname'] ?? '' ?></span>
    </div>

    <div class="form-group">
        <label for="">User Role</label>
        <select name="user_role" id="" class="form-control">
            <option value="customer" id="">Customer</option>
            <option value="admin" id="">Admin</option>
        </select>
    </div>

    <div class="form-group">
        <label for="">User Email</label>
        <input type="email" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>" placeholder="User Email" class="form-control">
        <span class="help-block text-danger"><?php echo $errors['email'] ?? '' ?>. </span>
    </div>

    <div class="form-group">
        <label for="">Mobile Number</label>
        <input type="text" name="mobilenumber" value="<?php if(isset($_POST['mobilenumber'])) echo $_POST['mobilenumber'] ?>" placeholder="Mobile Number" class="form-control">
        <span class="help-block text-danger"><?php echo $errors['mobilenumber'] ?? '' ?>. </span>
    </div>

    <div class="form-group">
        <label for="">User Image</label>
        <input type="file" name="uImage" class="form-control-file">
    </div>

    <div class="form-group">
        <label for="">User Password</label>
        <input type="password" name="password" placeholder="Password" class="form-control">
        <span class="help-block text-danger"><?php echo $errors['password'] ?? '' ?></span>
    </div>
    
    <div class="form-group">
        <label for="">Confirm User Password</label>
        <input type="password" name="confirm_password" id="cpassword" placeholder="Confirm Password" class="form-control">
        <span class="help-block text-danger"><?php echo $errors['confirm_password'] ?? '' ?></span>
    </div>

    <div class="form-group">
        <input type="submit" name="btn_add_user" class="btn btn-md btn-primary" value="Add User">
    </div>
</form>