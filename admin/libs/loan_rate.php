<?php 
    
    include_once 'database.php';
    
    // set timezone
    date_default_timezone_set('Africa/Lusaka');
    // get and store timezone
    $timezone = date_default_timezone_get();
    
    class LoanRates {
        public $userTable;
        public $db;
        public $mysqli;
        
        private $data;
        private $errors = [];
        private static $fields = ['duration', 'rate'];
        
        // Constructor
        public function __construct($post_data) {
            $this->data = $post_data;
            $this->ratesTable = "lms_rates";
            $this->db = new Database();
            $this->mysqli = $this->db->connect();
        }
        
        public function validateForm() {
            foreach(self::$fields as $field){
                if(!array_key_exists($field, $this->data)) {
                    trigger_error("$field is not present in data");
                    return;
                }
            }
            
            // $this->validateUsername();
            $this->validateDuration();
            $this->validateRate();
            return $this->errors;
        }
        
        private function addError($key, $val) {
            $this->errors[$key] = $val;
        }
        
        private function validateDuration() {
            $val = trim($this->data['duration']);
            
            if(empty($val)) {
                $this->addError('duration', 'duration cannot be empty');
            } 
        }
        
        private function validateRate() {
            $val = trim($this->data['rate']);
            
            if(empty($val)) {
                $this->addError('rate', 'rate cannot be empty');
            } 
        }
        
        public function addRate($post) {
            // Collect loan details
            $duration = $this->mysqli->real_escape_string( $_POST['duration']);
            $rate = $this->mysqli->real_escape_string($_POST['rate']);
            
            $query = "INSERT INTO $this->ratesTable (loan_duration, interest_rate) VALUES (?, ?)";
			if($stmt = $this->mysqli->prepare($query)) :
			    // Bind variables to the prepared statement as parameters
                $stmt->bind_param("ss", $duration, $rate);
                
                if($stmt->execute()){
                    /* store the result in an internal buffer */
                    $stmt->store_result();
                    return true;
                } else{
                    return false;
                }
                
                // Close statement
                $stmt->close();
			endif;
        }
        
        public function getRates() {
            $query = "SELECT * FROM $this->ratesTable";
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
        
        public function getRateById($id) {
            $query = "SELECT * FROM $this->ratesTable WHERE id = '$id'";
            $result = $this->mysqli->query($query);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row;
            } else {
                echo "Record not found";
            }
        }
        
        public function updateRate($postData) {
            $id = $this->mysqli->real_escape_string($_POST['edit_id']);
            $duration = trim($this->mysqli->real_escape_string($_POST['edit_duration'])); 
            $rate = trim($this->mysqli->real_escape_string($_POST['edit_rate']));
            
            if (!empty($id) && !empty($postData)):
                // update loan rate
                $update_query = "UPDATE $this->ratesTable SET loan_duration=?, interest_rate=?  
                WHERE id =?";
                $stmt = $this->mysqli->prepare($update_query);
                $stmt->bind_param("sss", $duration, $rate, $id);
		
                // check update result and notify
                if($stmt->execute()) {
                    return true;
                } else {
                    echo "Something is wrong!" . $this->mysqli->error;
                } 
            endif;
        }
        
        public function deleteRate($id) {
            $query = "DELETE FROM $this->ratesTable WHERE id = '$id'";
            $result = $this->mysqli->query($query);
            if ($result == true) {
                header("Location:loan_rates.php");
            } else {
                echo "Record not found to delete, try again";
            }
        }
                
        public function isBlank($str) {
            if(strlen($str) < 1)
            return true;
            
            else
            return false;
        }
        
        public function isDigit($str) {
            if (ctype_digit($str)) 
            return true;
            
            else
            return false;
        }
    }
            
    /*
        LoanRate Methods:
            1. addRate($post)
            2. getRates()
            3. getRateById($id)
            4. updateRate()
            5. deleteRate($id)
            7. isBlank($string)
            8. isDigit($string)
    */
    
    
    // collect details about the rates
    // $loanduration = "SELECT * FROM lms_rates";
    // $loanduration_result = $mysqli->query($loanduration);
    // while($row = $loanduration_result->fetch_assoc()) : 
    //     $id = $row['id']; 
    //     $loanDuration = $row['loan_duration']; 
    //     $interestRatee = $row['interest_rate']; 
    // endwhile;
    
    // collect loan details for particular customer
    // $loan = "SELECT * FROM lms_loans WHERE mobileno = '$mobileNumber'";
    // $loan_result = $mysqli->query($loan);
    // while($rw = mysqli_fetch_assoc($loan_result)) :
    //     $loanStatus = $rw['loan_status'];
    // endwhile;
?>