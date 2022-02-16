<?php 
    include_once 'database.php';
    
    // set timezone
    date_default_timezone_set('Africa/Lusaka');

    class Loans {
        public $loanTable;
        public $db;
        public $mysqli;
            
        // Constructor
        public function __construct() {
            $this->loanTable = "lms_loans";
            $this->db = new Database();
            $this->mysqli = $this->db->connect();
        }
        
        // Insert loan application details into loans table
        public function addLoan($post) {
            $referenceID = date('Ymdhis');
            $today = date('Y-m-d');
            $time = date('h:i:s');
            // Collect loan details
            $loanamount = $this->mysqli->real_escape_string( $_POST['loanamount']);
            $interestrate = $this->mysqli->real_escape_string($_POST['rate']);
            $loanduration = $this->mysqli->real_escape_string($_POST['duration']);
            $collateral_val = $this->mysqli->real_escape_string($_POST['collateral']);
            
            $rate = $interestrate / 100;
            $interest_value = $rate * $loanamount;
        
            $brandname = $this->mysqli->real_escape_string($_POST['brandname']);
            $serialnumber = $this->mysqli->real_escape_string($_POST['serialnumber']);
            $description = $this->mysqli->real_escape_string($_POST['description']);
            $price1 = $this->mysqli->real_escape_string($_POST['price1']);
      
            $brandname2 = $this->mysqli->real_escape_string($_POST['brandname2']);
            $serialnumber2 = $this->mysqli->real_escape_string($_POST['serialnumber2']);
            $description2 = $this->mysqli->real_escape_string($_POST['description2']);
            $price2 = $this->mysqli->real_escape_string($_POST['price2']);
      
            $brandname3 = $this->mysqli->real_escape_string($_POST['brandname3']);
            $serialnumber3 = $this->mysqli->real_escape_string($_POST['serialnumber3']);
            $description3 = $this->mysqli->real_escape_string($_POST['description3']);
            $price3 = $this->mysqli->real_escape_string($_POST['price3']);
      
            $brandname4 = $this->mysqli->real_escape_string($_POST['brandname4']);
            $serialnumber4 = $this->mysqli->real_escape_string($_POST['serialnumber4']);
            $description4 = $this->mysqli->real_escape_string($_POST['description4']);
            $price4 = $this->mysqli->real_escape_string($_POST['price4']);
        
            // Uploand Documents
            $idfront_img = $_FILES['idfront']['name'];
            $idfront_tmp = $_FILES['idfront']['tmp_name'];
        
            $idback_img = $_FILES['idback']['name'];
            $idback_tmp = $_FILES['idback']['tmp_name'];
            
            $query = "INSERT INTO $this->loanTable(name, mobilenumber, email, loan_amount, loan_rate, loan_duration, earning, collateral_val, brandname, serialnumber, description, price1, brandname2, serialnumber2, description2, price2, brandname3, serialnumber3, description3,price3, brandname4, serialnumber4, description4,price4, loan_status, nrc_front, nrc_back, date_created, time_created, ref) VALUES ($fullName_Sess', '$mobileNumber', '$email_Sess', '$loanamount', '$interestrate', '$loanduration', '$interest_value', '$collateral_val', '$brandname', '$serialnumber', '$description', '$price1', '$brandname2', '$serialnumber2', '$description2','$price2', '$brandname3', '$serialnumber3', '$description3','$price3', '$brandname4', '$serialnumber4', '$description4','$price4', 'pending', '$idfront_img', '$idback_img', '$today', '$time', '$referenceID')";
            
            $result = $this->mysqli->query($query);
            if ($result == true) {
                header("Location:index.php?msg1=insert");
            } else {
                echo "Registration failed try again!";
            }

        }
        
        // Fetch loan records for show listing [used on the index page]
        public function fetchLoans() {
            $query = "SELECT * FROM $this->loanTable";
            $result = $this->mysqli->query($query);
            if ($result->num_rows > 0) {
                $data = array();
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                return $data;
            } else {
                echo "No found records";
            }
        }
        
        // Fetch single data for edit from loans table
        public function fetchLoanById($id) {
            $query = "SELECT * FROM $this->loanTable WHERE id = '$id'";
            $result = $this->mysqli->query($query);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row;
            } else {
                echo "Record not found";
            }
          
        }
        
        // Fetch loans by mobile number
        public function fetchLoansByMobileNo($mobileno) {
            $query = "SELECT * FROM $this->loanTable WHERE mobileno = '$mobileno'";
            $result = $this->mysqli->query($query);
            if ($result->num_rows > 0) {
                $data = array();
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                return $data;
            } else {
                echo "Record not found";
                return false;
            }
        }
        
        // Fetch pending loans in the loans table
        public function fetchPendingLoans() {
            $query = "SELECT * FROM $this->loanTable WHERE loan_status = 'pending'";
            $result = $this->mysqli->query($query);
            if ($result->num_rows > 0) {
                $data = array();
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                return $data;
            } else {
                echo '<p class="text-center text-danger">No pending loans found</p>';
                return false;
            }
        }
        
        // Fetch approved loans in the loans table
        public function fetchApprovedLoans() {
            $query = "SELECT * FROM $this->loanTable WHERE loan_status = 'approved'";
            $result = $this->mysqli->query($query);
            if ($result->num_rows > 0) {
                $data = array();
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                return $data;
            } else {
                echo '<p class="text-center text-danger">No approved loans found</p>';
                return false;
            }
        }
        
        // Fetch disbursed loans in the loans table
        public function fetchDisbursedLoans() {
            $query = "SELECT * FROM $this->loanTable WHERE loan_status = 'disbursed'";
            $result = $this->mysqli->query($query);
            if ($result->num_rows > 0) {
                $data = array();
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                return $data;
            } else {
                echo '<p class="text-center text-danger">No disbursed loans found</p>';
                return false;
            }
        }
        
        // Fetch rejected loans in the loans table
        public function fetchRejectedLoans() {
            $query = "SELECT * FROM $this->loanTable WHERE loan_status = 'rejected'";
            $result = $this->mysqli->query($query);
            if ($result->num_rows > 0) {
                $data = array();
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                return $data;
            } else {
                echo '<p class="text-center text-danger">No rejected loans found</p>';
                return false;
            }
        }
        
        // Fetch cleared loans in the loans table
        public function fetchClearedLoans() {
            $query = "SELECT * FROM $this->loanTable WHERE loan_status = 'cleared'";
            $result = $this->mysqli->query($query);
            if ($result->num_rows > 0) {
                $data = array();
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                return $data;
            } else {
                echo '<p class="text-center text-danger">No cleared loans found</p>';
                return false;
            }
        }
        
        // Fetch defaulted loans in the loans table
        public function fetchDefaultedLoans() {
            $query = "SELECT * FROM $this->loanTable WHERE loan_status = 'defaulted'";
            $result = $this->mysqli->query($query);
            if ($result->num_rows > 0) {
                $data = array();
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                return $data;
            } else {
                echo '<p class="text-center text-danger">No defaulted loans found</p>';
                return false;
            }
        }
        
        // Update loan data into loans table
        public function updateLoan($postData) {
            $cust_ID = $_GET['id'];
            
            // $id = $this->mysqli->real_escape_string($_POST['id']);
            $firstName = $this->mysqli->real_escape_string($_POST['firstname']);
            $middleName = $this->mysqli->real_escape_string($_POST['middlename']);
            $lastName = $this->mysqli->real_escape_string($_POST['lastname']);
            $emailId = $this->mysqli->real_escape_string($_POST['email']);
            $mobileNo = $this->mysqli->real_escape_string($_POST['mobileno']);
            $idNo = $this->mysqli->real_escape_string($_POST['idno']);
            $sex = $this->mysqli->real_escape_string($_POST['gender']);
            $dateOfBirth = $this->mysqli->real_escape_string($_POST['dob']);
            $street = $this->mysqli->real_escape_string($_POST['address']);
            $townCity = $this->mysqli->real_escape_string($_POST['town_city']);
            $state  = $this->mysqli->real_escape_string($_POST['province']);
            
            if (!empty($id) && !empty($postData)):
                $query = "UPDATE lms_users SET firstname = '$firstName', middlename = '$middleName', lastname='$lastName', mobilenumber = '$mobileNo', email='$emailId',  idno = '$idNo', gender = '$sex', dob = '$dateOfBirth', address = '$street', city='$townCity', state = '$state' 
                WHERE mobilenumber = '$cust_ID'";
                    
                $update_result = $mysqli->query($update_query);

                // check update result and notify
                // if($update_result) {
                //                         echo '
                //         <div class="alert alert-success" role="alert">
                //             Client loan details have been updated in the database
                //             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	        	// 	<span aria-hidden="true">&times;</span>
		    	        	// </button>
                //         </div>';
                        
                //     header("location: customer_list.php");
                    
                // } else {
                //     echo "Something is wrong!" . mysqli_error($conn);
                // }  
                
                if ($update_result == true) {
                    header("location: customer_list.php?msg2=update");
                } else {
                    echo "Update failed try again!";
                }
            endif;
        }
        
        // Delete loan data from loans table
        public function deleteLoan($id) {
            $query = "DELETE FROM $this->loanTable WHERE id = '$id'";
            $result = $this->mysqli->query($query);
            if ($result == true) {
                header("Location:index.php?msg3=delete");
            } else {
                echo "Record not found to delete, try again";
            }
        }

        // Count total loans in the loans table
        public function countLoans() {
            $sql = "SELECT * FROM $this->loanTable";
            $result = $this->mysqli->query($sql);
            $rowCount = $result->num_rows;
            return $rowCount;
        }

        // Count total disbursed loans in the loans table
        public function countLoansDisbursed() {
			$disbursed = 'disbursed';
			$stmt = $this->mysqli->prepare("SELECT * FROM $this->loanTable WHERE loan_status=?");
			$stmt->bind_param("s", $disbursed);
			$stmt->execute();
            $result = $stmt->get_result();
            $countDisbursed = $result->num_rows;
            return $countDisbursed;
        }

        // summing up all the disbursed loans
        public function totalLoansDisbursed() {
            $disbursed = 'disbursed';
			// summing up all the disbursed loans
            $total_disbursed_stmt = $this->mysqli->prepare("SELECT SUM(loan_amount) as total_loans_disbursed FROM $this->loanTable  WHERE loan_status=? ");
            $total_disbursed_stmt->bind_param("s", $disbursed);
            $total_disbursed_stmt->execute();
            $result = $total_disbursed_stmt->get_result();
            $row = $result->fetch_assoc();
            if($row['total_loans_disbursed']>0){
                $loansdisbursed = $row['total_loans_disbursed'];
                return $loansdisbursed;
            }else{
                $loansdisbursed = '0';
                return $loansdisbursed;
            }
        }

        // Count total pending loans in the loans table
        public function countLoansPending() {
			$pending = 'pending';
			$pendingStmt = $this->mysqli->prepare("SELECT * FROM $this->loanTable WHERE loan_status = ?");
			$pendingStmt->bind_param("s", $pending);
			$pendingStmt->execute();
            $result = $pendingStmt->get_result();
            $countPending = $result->num_rows;
            return $countPending;
        }

        // summing up all the pending loans
        public function totalLoansPending() {
            $pending = 'pending';
			$total_pending_stmt = $this->mysqli->prepare("SELECT SUM(loan_amount) as total_loans_pending FROM $this->loanTable  WHERE loan_status = ?");
			$total_pending_stmt->bind_param("s", $pending);
            $total_pending_stmt->execute();
            $result = $total_pending_stmt->get_result();
            $row = $result->fetch_assoc();
            if($row['total_loans_pending']>0){
                $loanspending = $row['total_loans_pending'];   
                return $loanspending;
            }else{
                $loanspending = '0';
                return $loanspending;
            }
        }

        // summing up the earnings in the loans table
        public function totalEarnings() {
            $cleared = 'cleared';
		    $total_earnings_stmt = $this->mysqli->prepare("SELECT SUM(earning) as total_earnings FROM $this->loanTable  WHERE loan_status = ?");
		    $total_earnings_stmt->bind_param("s", $cleared);
		    $total_earnings_stmt->execute();
            $result = $total_earnings_stmt->get_result();
            $row = $result->fetch_assoc();
            if($row['total_earnings']>0){
                $totalearning = $row['total_earnings'];  
                return $totalearning;
            }else{
                $totalearning = '0';
                return $totalearning;
            }
        }

        // summing up the collaterals in the loans table of the disbursed loans
        public function totalCollateral() {
            $result = $this->mysqli->query("SELECT SUM(collateral_val) as total_collateral FROM $this->loanTable WHERE loan_status = 'disbursed'");
            $row = $result->fetch_assoc();
            if($row['total_collateral'] > 0){
                $totalcollateral = $row['total_collateral'];  
                return $totalcollateral;
            }else{
                $totalcollateral = '0';
                return $totalcollateral;
            }
        }
        
        // change loan status to approved in the loans table
        public function approveLoan($approve_id) {
            $sql_loans = "UPDATE $this->loanTable SET loan_status = 'approved' WHERE mobileno = '$approve_id'";
            $sql_result = $this->mysqli->query($sql_loans);

            if($sql_result) {
                header('location: index.php');
            }
        }
        
        // change loan status to rejected in the loans table
        public function rejectLoan($reject_id) {
            $sql_loans = "UPDATE $this->loanTable SET loan_status = 'rejected' WHERE mobileno = '$reject_id'";
            $sql_result = $this->mysqli->query($sql_loans);

            if($sql_result) {
                header('location: index.php');
            }
        }
        
        // change loan status to disbursed in the loans table
        public function disburseLoan($disburse_id) {
            $sql_loans = "UPDATE $this->loanTable SET loan_status = 'disbursed' WHERE mobileno = '$disburse_id'";
            $sql_result = $this->mysqli->query($sql_loans);

            if($sql_result) {
                header('location: loans_approved.php');
            }
        }
        
        // change loan status to clear in the loans table
        public function clearLoan($disburse_id) {
            $sql_loans = "UPDATE $this->loanTable SET loan_status = 'cleared' WHERE mobileno = '$disburse_id'";
            $sql_result = $this->mysqli->query($sql_loans);

            if($sql_result) {
                header('location: loans_disbursed.php');
            }
        }
        
        /*********** customer methods ************/
        /* Calculating the current or disbursed loan of customer */
        public function currentLoan($mobileno) {
			$disbursed = 'disbursed';
			$loans_disbursed_query = "SELECT SUM(loan_amount) as total_loans_disbursed FROM $this->loanTable  WHERE mobileno = ? AND loan_status = ?";
            
            $stmt = $this->mysqli->prepare($loans_disbursed_query);
			$stmt->bind_param("ss", $mobileno, $disbursed);
			$stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
                                    
            if($row['total_loans_disbursed'] > 0){
                $loansdisbursed = $row['total_loans_disbursed'];   
                return $loansdisbursed;
            }else{
                $loansdisbursed = '0';
                return $loansdisbursed;
            }
        }
        
        /* calcualte how much is customer owing */
        public function totalOwing($mobileno) {
            $disbursed = 'disbursed';
            $sql = "SELECT (IFNULL(loan_amount,0) + IFNULL(earning,0)) AS 'total_owing' FROM $this->loanTable WHERE mobileno=? AND loan_status=? AND (loan_amount + earning) > 0";
            $stmt = $this->mysqli->prepare($sql);
			$stmt->bind_param("ss", $mobileno, $disbursed);
			$stmt->execute();
            $result = $stmt->get_result();
            $rowee = $result->fetch_assoc();
                                    
            if($rowee['total_owing'] > 0){
                $total_owing = $rowee['total_owing']; 
                return $total_owing;
            }else{
                $total_owing = '0';
                return $total_owing;
            }
        }
        
        /* Number of days remaining to pay back the loan (should be counting down) */
        public function daysLeft($mobileNumber) {
            $duration_query = "SELECT * FROM $this->loanTable WHERE loan_status = 'disbursed' AND mobileno ='$mobileNumber'";
                                    
            $duration_result = $this->mysqli->query($duration_query);
            $row = $duration_result->fetch_assoc();
            $duration = $row['loan_duration'];
            $days = "";
            if($duration == 1) {
                $days = 7;
            } else if ($duration == 2) {
                $days = 14;
            } else if ($duration == 3) {
                $days = 21;
            } else if ($duration == 4) {
                $days = 28;
            }
                                    
            $date_query = "SELECT * FROM $this->loanTable WHERE loan_status = 'disbursed' AND mobileno = '$mobileNumber' ";
            $date_result = $this->mysqli->query($date_query);
                                    
            if($date_result->num_rows) {
                $row = $date_result->fetch_assoc();
                $date = $row['date_created'];
                                    
                $futureDate = date_create($date);
                $days = $days.' days';
                date_add($futureDate, date_interval_create_from_date_string($days));
            
                $currentDate = date("Y-m-d");
                $currentDate = date_create($currentDate);
                $dateRemaining = date_diff($currentDate,$futureDate);
                
                return $dateRemaining->format("%a"); 
            }
        }
        
        /* calcualte date when customer suppose to pay back loan */
        public function dueDate($mobileNumber) {
            $duration_query = "SELECT * FROM $this->loanTable WHERE loan_status = 'disbursed' AND mobileno ='$mobileNumber'";
                                    
            $duration_result = $this->mysqli->query($duration_query);
            $row = $duration_result->fetch_assoc();
            $duration = $row['loan_duration'];
            $days = "";
            if($duration == 1) {
                $days = 7;
            } else if ($duration == 2) {
                $days = 14;
            } else if ($duration == 3) {
                $days = 21;
            } else if ($duration == 4) {
                $days = 28;
            }
            
            $date_query = "SELECT * FROM $this->loanTable WHERE loan_status = 'disbursed' AND mobileno = '$mobileNumber' ";
            $date_result = $this->mysqli->query($date_query); 
                                    
            if($date_result->num_rows) {
                $row = $date_result->fetch_assoc();
                $date = $row['date_created'];
                                    
                $futureDate = date_create($date);
                $days = $days.' days';
                date_add($futureDate, date_interval_create_from_date_string($days));
                
                return date_format($futureDate,"Y-m-d");; 
            }
        }
        
    }
    
    /*
        === Loans Object Index ======
        1. addLoan()
        2. fetchLoans()
        3. fetchLoanById()
        4. fetchPendingLoans()
        5. fetchApprovedLoans()
        6. fetchDisbursedLoans()
        7. fetchRejectedLoans()
        8. fetchClearedLoans()
        9. fetchDefaultedLoans()
        10.updateLoan()
        11.deleteLoan()
        12.countLoans()
        13.countLoansDisbursed()
        14.totalLoansDisbursed()
        15.countLoansPending()
        16.totalLoansPending()
        17.totalEarnings()
        18.totalCollateral()
        19.approveLoan()
        20.rejectLoan()
        21.disburseLoan()
        22.clearLoan()
        23.defaultLoan()
        
        24. currentLoan($mobileno)
        25. totalOwing($mobileno)
        26. daysLeft($mobileno)
        27. dueDate($mobileno)
        
    */
?>