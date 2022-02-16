<?php 
    
    include_once 'database.php';
    
    // set timezone
    date_default_timezone_set('Africa/Lusaka');
    // get and store timezone
    $timezone = date_default_timezone_get();
    
    class LoanForm {
        public $loansTable;
        public $db;
        public $mysqli;
        
        private $data;
        private $errors = [];
        private static $fields = ['loanamount', 'rate', 'duration', 'collateral', 'brandname', 'serialnumber', 'description', 'price1', 'brandname2', 'serialnumber2', 'description2', 'price2', 'brandname3', 'serialnumber3', 'description3', 'price3', 'brandname4', 'serialnumber4', 'description4', 'price4'];
        
        // Constructor
        public function __construct($post_data) {
            $this->data = $post_data;
            $this->loansTable = "lms_loans";
            $this->db = new Database();
            $this->mysqli = $this->db->connect();
        }
        
        public function validateLoanForm() {
            foreach(self::$fields as $field){
                if(!array_key_exists($field, $this->data)) {
                    trigger_error("$field is not present in data");
                    return;
                }
            }
            
            
            $this->validateLoanAmnt();
            $this->validateDuration();
            $this->validateRate();
            $this->validateCollateral();
            $this->validateBrandname();
            $this->validateSerialNumber();
            $this->validateDescription();
            $this->validatePrice();
            return $this->errors;
        }
        
        private function addError($key, $val) {
            $this->errors[$key] = $val;
        }
        
        private function validateLoanAmnt() {
            $val = trim($this->data['loanamount']);
            
            if(empty($val)) {
                $this->addError('loanamount', 'loan amount cannot be empty');
            } 
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
        
        private function validateCollateral() {
            $val = trim($this->data['collateral']);
            
            if(empty($val)) {
                $this->addError('collateral', 'collateral cannot be empty');
            } 
        }
        
        private function validateBrandname() {
            $val = trim($this->data['brandname']);
            
            if(empty($val)) {
                $this->addError('brandname', 'brandname cannot be empty');
            } 
        }
        
        private function validateSerialNumber() {
            $val = trim($this->data['serialnumber']);
            
            if(empty($val)) {
                $this->addError('serialnumber', 'serialnumber cannot be empty');
            } 
        }
        
        private function validateDescription() {
            $val = trim($this->data['description']);
            
            if(empty($val)) {
                $this->addError('description', 'description cannot be empty');
            } 
        }
        
        private function validatePrice() {
            $val = trim($this->data['price1']);
            
            if(empty($val)) {
                $this->addError('price1', 'price cannot be empty');
            } 
        }
        
        public function applyLoan($post, $fullnames, $mobileno, $email) {
            // set timezone
            date_default_timezone_set('Africa/Lusaka');
            $today = date('Y-m-d');
            $time = date('h:i:s');
            $referenceID = date('Ymdhis');
            $pending = 'pending';
            
            // Collect loan details
            $loanamount = trim($this->mysqli->real_escape_string($_POST['loanamount']));
            $interestrate = trim($this->mysqli->real_escape_string($_POST['rate']));
            $loanduration  = trim($this->mysqli->real_escape_string($_POST['duration']));
            $collateral_val = trim($this->mysqli->real_escape_string($_POST['collateral']));
        
            $rate = $interestrate / 100;
            $interest_value = $rate * $loanamount;
            
            $brandname = trim($this->mysqli->real_escape_string($_POST['brandname']));
            $serialnumber = trim($this->mysqli->real_escape_string($_POST['serialnumber']));
            $description = trim($this->mysqli->real_escape_string($_POST['description']));
            $price1 = trim($this->mysqli->real_escape_string($_POST['price1']));
            
            $brandname2 = trim($this->mysqli->real_escape_string($_POST['brandname2']));
            $serialnumber2 = trim($this->mysqli->real_escape_string($_POST['serialnumber2']));
            $description2 = trim($this->mysqli->real_escape_string($_POST['description2']));
            $price2 = trim($this->mysqli->real_escape_string($_POST['price2']));
            
            $brandname3 = trim($this->mysqli->real_escape_string($_POST['brandname3']));
            $serialnumber3 = trim($this->mysqli->real_escape_string($_POST['serialnumber3']));
            $description3 = trim($this->mysqli->real_escape_string($_POST['description3']));
            $price3 = trim($this->mysqli->real_escape_string($_POST['price3']));
            
            $brandname4 = trim($this->mysqli->real_escape_string($_POST['brandname4']));
            $serialnumber4 = trim($this->mysqli->real_escape_string($_POST['serialnumber4']));
            $description4 = trim($this->mysqli->real_escape_string($_POST['description4']));
            $price4 = trim($this->mysqli->real_escape_string($_POST['price4']));
        
            // Uploand Documents
            $idfront_img = $_FILES['idfront']['name'];
            $idfront_tmp = $_FILES['idfront']['tmp_name'];
        
            $idback_img = $_FILES['idback']['name'];
            $idback_tmp = $_FILES['idback']['tmp_name'];
            
            // insert loan application details into the loan_applications table
            $query = "INSERT INTO $this->loansTable (name, mobileno, email, loan_amount, loan_rate, loan_duration, earning, collateral_val, brandname, serialnumber, description, price1, brandname2, serialnumber2, description2, price2, brandname3, serialnumber3, description3,price3, brandname4, serialnumber4, description4,price4, loan_status, nrc_front, nrc_back, date_created, time_created, ref) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			if($stmt = $this->mysqli->prepare($query)) :
			    // Bind variables to the prepared statement as parameters
                $stmt->bind_param("ssssssssssssssssssssssssssssss", $fullnames, $mobileno, $email, $loanamount, $interestrate, $loanduration, $interest_value, $collateral_val, $brandname, $serialnumber, $description, $price1, $brandname2, $serialnumber2, $description2, $price2, $brandname3, $serialnumber3, $description3, $price3, $brandname4, $serialnumber4, $description4, $price4, $pending, $idfront_img, $idback_img, $today, $time, $referenceID);
                
                if($stmt->execute()){
                    /* store the result in an internal buffer */
                    $stmt->store_result();
                    
                    // upload image to respective folder
                    move_uploaded_file($idfront_tmp, "assets/img/loans/$idfront_img");
                    move_uploaded_file($idback_tmp, "assets/img/loans/$idback_img");
                
                    // move_uploaded_file($collateral1_tmp, "assets/img/loans/$collateral1_img");
                    $extension = array('jpeg','jpg','png','gif');
                    $a=0;
                    foreach ($_FILES['collateral1']['tmp_name'] as $key => $value) :
                        $filename = $_FILES['collateral1']['name'][$key];
                        $filename_tmp = $_FILES['collateral1']['tmp_name'][$key];

                        // extension
                        $ext = pathinfo($filename, PATHINFO_EXTENSION);

                        $finalimg = '';
                        if(in_array($ext, $extension)){
                            if(!file_exists('assets/img/loans/'.$filename)) {
                                move_uploaded_file($filename_tmp, 'assets/img/loans/'.$filename);
                                $finalimg = $filename;
                            } else {
                                $filename = str_replace('.', '-', basename($filename, $ext));
                                $newfilename = $filename.time().".".$ext;
                                move_uploaded_file($filename_tmp, 'assets/img/loans/'.$filename);
                                $finalimg = $newfilename;
                            }
                            
                            // insert images in the database
                            if($a==0){
                                //query1
                                $img1 = "UPDATE lms_loans SET collateral1= '$finalimg' WHERE ref = '$referenceID' AND mobileno= '$mobileNumber'";
                            }                
                            if($a==1){
                                //query1
                                $img1 = "UPDATE lms_loans SET collateral12= '$finalimg' WHERE ref = '$referenceID' AND mobileno= '$mobileNumber'";
                        
                            }                
                            if($a==2){
                                //query1
                                $img1 = "UPDATE lms_loans SET collateral13= '$finalimg' WHERE ref = '$referenceID' AND mobileno= '$mobileNumber'";
                            }                
                            if($a==3){
                                //query1
                                $img1 = "UPDATE lms_loans SET collateral14= '$finalimg' WHERE ref = '$referenceID' AND mobileno= '$mobileNumber'";
                            }                
                            if($a==4){
                                //query1
                                $img1 = "UPDATE lms_loans SET collateral15= '$finalimg' WHERE ref = '$referenceID' AND mobileno= '$mobileNumber'";
                            }
                            $a=$a+1;
                            $mysqli->query($img1);
                            
                        } else {
                            // display error
                        }
                        // header('Location: image_upload.php');
                        
                    endforeach;             
                
                    // move_uploaded_file($collateral2_tmp, "assets/img/loans/$collateral2_img");
                    $b=0;
                    foreach ($_FILES['collateral2']['tmp_name'] as $key => $value) :
                        $filename2 = $_FILES['collateral2']['name'][$key];
                        $filename2_tmp = $_FILES['collateral2']['tmp_name'][$key];

                        // extension
                        $ext2 = pathinfo($filename2, PATHINFO_EXTENSION);

                        $finalimg2 = '';
                        if(in_array($ext2, $extension)){
                            if(!file_exists('assets/img/loans/'.$filename2)) {
                                move_uploaded_file($filename2_tmp, 'assets/img/loans/'.$filename2);
                                $finalimg2 = $filename2;
                            } else {
                                $filename2 = str_replace('.', '-', basename($filename2, $ext2));
                                $newfilename2 = $filename2.time().".".$ext2;
                                move_uploaded_file($filename2_tmp, 'assets/img/loans/'.$filename2);
                                $finalimg2 = $newfilename2;
                            }
                            
                            // insert images in the database
                            if($b==0){
                                //query1
                                $img2 = "UPDATE lms_loans SET collateral2= '$finalimg2' WHERE ref = '$referenceID' AND mobileno= '$mobileNumber'";
                            }                
                            if($b==1){
                                //query1
                                $img2 = "UPDATE lms_loans SET collateral22= '$finalimg2' WHERE ref = '$referenceID' AND mobileno= '$mobileNumber'";
                        
                            }                
                            if($b==2){
                                //query1
                                $img2 = "UPDATE lms_loans SET collateral23= '$finalimg2' WHERE ref = '$referenceID' AND mobileno= '$mobileNumber'";
                            }                
                            if($b==3){
                                //query1
                                $img2 = "UPDATE lms_loans SET collateral24= '$finalimg2' WHERE ref = '$referenceID' AND mobileno= '$mobileNumber'";
                            }                
                            if($b==4){
                                //query1
                                $img2 = "UPDATE lms_loans SET collateral25= '$finalimg2' WHERE ref = '$referenceID' AND mobileno= '$mobileNumber'";
                            }
                            $b++;
                            $mysqli->query($img2);
                            
                        } else {
                            // display error
                        }
                        // header('Location: image_upload.php');   
                    endforeach;  
                
                    // move_uploaded_file($collateral3_tmp, "assets/img/loans/$collateral3_img");
                    $c = 0;
                    foreach ($_FILES['collateral3']['tmp_name'] as $key => $value) :
                        $filename3 = $_FILES['collateral3']['name'][$key];
                        $filename3_tmp = $_FILES['collateral3']['tmp_name'][$key];

                        // extension
                        $ext3 = pathinfo($filename3, PATHINFO_EXTENSION);

                        $finalimg3 = '';
                        if(in_array($ext3, $extension)){
                            if(!file_exists('assets/img/loans/'.$filename3)) {
                                move_uploaded_file($filename3_tmp, 'assets/img/loans/'.$filename3);
                                $finalimg3 = $filename3;
                            } else {
                                $filename3 = str_replace('.', '-', basename($filename3, $ext3));
                                $newfilename3 = $filename3.time().".".$ext3;
                                move_uploaded_file($filename3_tmp, 'assets/img/loans/'.$filename3);
                                $finalimg3 = $newfilename3;
                            }
                            
                            // insert images in the database
                            if($c==0){
                                //query1
                                $img3 = "UPDATE lms_loans SET collateral3= '$finalimg3' WHERE ref = '$referenceID' AND mobileno= '$mobileNumber'";
                            }                
                            if($c==1){
                                //query1
                                $img3 = "UPDATE lms_loans SET collateral32= '$finalimg3' WHERE ref = '$referenceID' AND mobileno= '$mobileNumber'";
                        
                            }                
                            if($c==2){
                                //query1
                                $img3 = "UPDATE lms_loans SET collateral33= '$finalimg3' WHERE ref = '$referenceID' AND mobileno= '$mobileNumber'";
                            }                
                            if($c==3){
                                //query1
                                $img3 = "UPDATE lms_loans SET collateral34= '$finalimg3' WHERE ref = '$referenceID' AND mobileno= '$mobileNumber'";
                            }                
                            if($c==4){
                                //query1
                                $img3 = "UPDATE lms_loans SET collateral35= '$finalimg3' WHERE ref = '$referenceID' AND mobileno= '$mobileNumber'";
                            }
                            $c++;
                            $mysqli->query($img3);
                            
                        } else {
                            // display error
                        }
                        // header('Location: image_upload.php');
                    endforeach;
                
                    // move_uploaded_file($collateral4_tmp, "assets/img/loans/$collateral4_img");
                    $d = 0;
                    foreach ($_FILES['collateral4']['tmp_name'] as $key => $value) :
                        $filename4 = $_FILES['collateral4']['name'][$key];
                        $filename4_tmp = $_FILES['collateral4']['tmp_name'][$key];

                    // extension
                        $ext4 = pathinfo($filename4, PATHINFO_EXTENSION);

                        $finalimg4 = '';
                        if(in_array($ext4, $extension)){
                            if(!file_exists('assets/img/loans/'.$filename4)) {
                                move_uploaded_file($filename4_tmp, 'assets/img/loans/'.$filename4);
                                $finalimg4 = $filename;
                            } else {
                                $filename4 = str_replace('.', '-', basename($filename4, $ext4));
                                $newfilename4 = $filename4.time().".".$ext4;
                                move_uploaded_file($filename4_tmp, 'assets/img/loans/'.$filename4);
                                $finalimg4 = $newfilename4;
                            }
                            
                            // insert images in the database
                            if($d==0){
                                //query1
                            $img4 = "UPDATE lms_loans SET collateral4= '$finalimg4' WHERE ref = '$referenceID' AND mobileno= '$mobileNumber'";
                            }                
                            if($d==1){
                                //query1
                                $img4 = "UPDATE lms_loans SET collateral42= '$finalimg4' WHERE ref = '$referenceID' AND mobileno= '$mobileNumber'";
                        
                            }                
                            if($d==2){
                                //query1
                                $img4 = "UPDATE lms_loans SET collateral43= '$finalimg4' WHERE ref = '$referenceID' AND mobileno= '$mobileNumber'";
                            }                
                            if($d==3){
                                //query1
                                $img4 = "UPDATE lms_loans SET collateral44= '$finalimg4' WHERE ref = '$referenceID' AND mobileno= '$mobileNumber'";
                            }                
                            if($d==4){
                                //query1
                                $img4 = "UPDATE lms_loans SET collateral45= '$finalimg4' WHERE ref = '$referenceID' AND mobileno= '$mobileNumber'";
                            }
                            $d=$d+1;
                            $mysqli->query($img4);
                            
                        } else {
                            // display error
                        }
                        // header('Location: image_upload.php');
                    endforeach;
                    
                    return true;
                } else{
                    return false;
                }
                
                // Close statement
                $stmt->close();
			endif;
        }
        
        // get loan status of customer
        public function getLoanDetails($mobileno) {
            $loan = "SELECT * FROM $this->loansTable WHERE mobileno = '$mobileno'";
            $result = $this->mysqli->query($loan);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row;
            } else {
                echo "Record not found";
                return false;
            }
                
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
?>