<?php 
    //connect to database
    include_once('./database/oo_connect.php'); 
    session_start();
    if(isset($_SESSION['id']) && isset($_SESSION['email'])) {
        if(isset($_POST['oldpass']) && isset($_POST['newpass']) && isset($_POST['confirmpass'])) {
            function validate($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            
            $op = validate($_POST['oldpass']);
            $np = validate($_POST['newpass']);
            $c_np = validate($_POST['confirmpass']);
            
            if(empty($op)) {
                header("Location: change-password.php?error=Current password is required");
                exit();
            }
            
            else if(empty($np)) {
                header("Location: change-password.php?error=New password is required");
                exit();
            }
            
            else if(empty($c_np)) {
                header("Location: change-password.php?error=The confirmation password does not match");
                exit();
            } else {
                // everything is fine
                $op = password_hash($op, PASSWORD_DEFAULT);
                $np = password_hash($op, PASSWORD_DEFAULT);;
                $id = $_SESSION['id'];
                
                $sql = "SELECT userpassword FROM lms_users WHERE id='$id' AND userpassword='$op'";
                $result = $mysqli->query($sql);
                if($result->num_rows === 1) {
                    $query = "UPDATE lms_users SET userpassword = '$np' WHERE id='$id'";
                    $mysqli->query($query);
                    header("Location: change-password.php?success=Your password has been changed successfully");
                    exit();
                } else {
                    header("Location: change-password.php?error=$result");
                    exit();
                }
            }
        } else {
            // one of the fields is empty
        }
    } else {
        // you must be first logged in.
        header("Location: change-password.php?error=Sessions not set!");
    }
?>