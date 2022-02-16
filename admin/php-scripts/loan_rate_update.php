<?php 
    require_once 'database/oo_connect.php'; 

    if(isset($_POST['btn_edit_rate'])) {
        $update_id = trim($_POST['edit_id']);
        $update_rate = trim($_POST['edit_rate']);
        $update_duration = trim($_POST['edit_duration']);

        // Update query
        $query = "UPDATE lms_rates SET loan_duration=?, interest_rate=? WHERE id=?";
        if($stmt = $mysqli->prepare($query)) :
            $stmt->bind_param("iii", $update_duration, $interest_rate, $update_id);
            if($stmt->execute()) {
                header("location: loan_rates.php");
                echo '<p class="alert alert-success"> Your interest rate has been updated :)</p>';
            } else {
                echo "Query Failed!";  
            }
            // close statement
            $stmt->close();
        endif;
    }
?>