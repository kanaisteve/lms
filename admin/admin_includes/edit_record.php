<!-- Retrieve data from the users table and display in the input fields -->
<?php 

    if(isset($_GET['edit_record'])) {
        $record_ID = $_GET['edit_record'];
        $record_query = "SELECT * FROM dsa_records WHERE id = '$record_ID'";
        $update_result = mysqli_query($conn, $record_query);
        while($record = mysqli_fetch_assoc($update_result)) {
            $record_id = $record['id'];
            $first_name = $record['firstname'];
            $last_name = $record['lastname'];
            $mobileno = $record['mobileno'];
            $gender = $record['gender'];
        }
        
    } 

    // Edit(Update) record in the dsa_records table using the recordID
    if(isset($_POST['btn_update_record'])) {
        $firstName = $_POST['firstname'];
        $lastName = $_POST['lastname'];
        $mobile_no = $_POST['mobileno'];
        $recordGender = $_POST['gender'];

        // update record
        $update_query = "UPDATE dsa_records SET firstname = '$firstName', lastname='$lastName', mobileno = '$mobile_no', gender = '$recordGender'
            WHERE id = '$record_ID'";
        $update_result = mysqli_query($conn, $update_query);

        // check update result and notify
        if($update_result) {
            echo '
                <div class="alert alert-success" role="alert">
                    Record has been updated in the database
                </div>
                ';
            header("location: records.php");
        } else {
            echo "Something is wrong!" . mysqli_error($conn);
        }                   
    }
?>

<!-- Edit Record -->
<form action="" method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label for="">First Name</label>
        <input type="text" name="firstname" value="<?php echo $first_name ?>" placeholder="First Name" class="form-control">
    </div>

    <div class="form-group">
        <label for="">Last Name</label>
        <input type="text" name="lastname" value="<?php echo $last_name ?>" placeholder="Last Name" class="form-control">
    </div>

    <div class="form-group">
        <label for="">Mobile No.</label>
        <input type="text" name="mobileno" placeholder="968808800" value="<?php echo $mobileno ?>" class="form-control">
    </div>
    
    <div class="form-group">
        <label for="">Gender</label>
        <input type="text" name="gender" placeholder="Male or Femail" value="<?php echo $gender ?>" class="form-control">
    </div>

    <div class="form-group">
        <input type="submit" name="btn_update_record" class="btn btn-info" value="Update Record">
    </div>
</form>