<?php 
    require_once '../database/connect.php'; 

    if(isset($_POST['btn_edit_rate'])) {
        $update_id = $_POST['edit_id'];
        $update_duration = $_POST['edit_duration'];
        $update_rate = $_POST['edit_rate'];

        // Update query
        $query = "UPDATE peri_rates SET loan_duration = '$update_duration', interest_rate = '$update_rate' WHERE id = '$update_id'";
        $result = mysqli_query($conn, $query);

        if($result) {
            header("location: loan_rates.php");
            echo '<p class="alert alert-success"> Your interest rate has been updated :)</p>';
        } else {
            echo "Query Failed!";
        }
    }
?>