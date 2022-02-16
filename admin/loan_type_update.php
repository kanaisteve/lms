<?php 
    require_once '../database/connect.php'; 

    if(isset($_POST['btn_edit_loantype'])) {
        $update_id = $_POST['edit_id'];
        $update_loantype = $_POST['loantype'];
        $update_duration = $_POST['duration'];
        $update_unit = $_POST['unit'];
        $update_rate = $_POST['rate'];

        // Update query
        $query = "UPDATE peri_loan_types SET loan_type = '$update_loantype', duration = '$update_duration', units = '$update_unit', rate = '$update_rate' WHERE id = '$update_id'";
        $result = mysqli_query($conn, $query);

        if($result) {
            header("location: loan_types.php");
            echo '<p class="alert alert-success"> Your loan type has been updated :)</p>';
        } else {
            echo "Query Failed!";
        }
    }
?>