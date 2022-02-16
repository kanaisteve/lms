<?php
    include_once 'users.php';
    /*
        - create a user validator class to handle validation
        - constructor takes in POST data from form
        - check required "fields to check" are present in the data
        - create methods to validate individual fields
            -- a method to validate a username
            -- a method to validate an email
        - return an error array once all checks are done
    */
    
    class UserValidator {
        private $data;
        public $userObj;
        private $errors = [];
        private static $fields = ['firstname', 'lastname', 'email', 'mobilenumber', 'password', 'confirm_password'];
        
        public function __construct($post_data) {
            $this->data = $post_data;
            $this->userObj = new Users();
        }
        
        public function validateForm() {
            foreach(self::$fields as $field){
                if(!array_key_exists($field, $this->data)) {
                    trigger_error("$field is not present in data");
                    return;
                }
            }
            
            // $this->validateUsername();
            $this->validateFirstName();
            $this->validateLastName();
            $this->validateEmail();
            $this->validateMobileNo();
            $this->validatePassword();
            $this->validateConfirmPassword();
            return $this->errors;
        }
        
        private function validateUsername() {
            $val = trim($this->data['username']);
            
            if(empty($val)) {
                $this->addError('username', 'username cannot be empty');
            } else {
                if(!preg_match('/^[a-zA-Z0-9]{6,12}$/', $val)) {
                    $this->addError('username', 'username must be 6-12 chars & alphanumeric');
                }
            }
        }
        
        private function validateFirstName() {
            $firstname = trim($this->data['firstname']);
            
            if(empty($firstname)) {
                $this->addError('firstname', 'first name cannot be empty');
            } else {
                if(!preg_match("/^[a-zA-Z ]*$/", $firstname)) {
                    $this->addError('firstname', 'only letters and white space allowed');
                }
            }
        }
        
        private function validateLastName() {
            $lastname = trim($this->data['lastname']);
            
            if(empty($lastname)) {
                $this->addError('lastname', 'last name cannot be empty');
            } else {
                if(!preg_match("/^[a-zA-Z ]*$/", $lastname)) {
                    $this->addError('lastname', 'only letters and white space allowed');
                }
            }
        }
        
        private function validateEmail() {
            $email = trim($this->data['email']);
            
            if(empty($email)) {
                $this->addError('email', 'email cannot be empty');
            } 
            else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->addError('email', 'email must be valid email');
            } else {
                if($this->userObj->emailExists($email)) {
                    $this->addError('email', 'email already exists');
                }
            }
        }
        
        private function validateMobileNo() {
            $val = trim($this->data['mobilenumber']);
            
            if(empty($val)) {
                $this->addError('mobilenumber', 'mobile number cannot be empty');
            } 
            else if ($this->userObj->mobileNumberExists($_POST['mobilenumber'])) {
                $this->addError('mobilenumber', 'mobile number is already taken');
            }
            else {
                if(!preg_match("/^[0-9]{10}+$/", $val)) {
                    $this->addError('mobilenumber', 'only 10-digit mobile numbers allow');
                }
            }
        }
        
        // [character length check, must contain 1special character,lowercase,uppercase and digit] use 8 or more characters with a mix of letters, numbers & symboles
        private function validatePassword() {
            $password = trim($this->data['password']);
            
            if (empty($password)) {
                $this->addError('password', 'password cannot be empty');
            }
            else if(strlen($password) < 6) {
                $this->addError('password', 'password must have atleast 6 characters');
            } else {
                if(!preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,20}$/", $password)) {
                    $this->addError('password', 'Password should be between 6 to 20 charcters long, contains atleast one special chacter, lowercase, uppercase and a digit');
                }
            }
        }
        
        private function validateConfirmPassword() {
            $password = trim($this->data['password']);
            $con_password = trim($this->data['confirm_password']);
            
            if(empty($con_password)) {
                $this->addError('confirm_password', 'please confirm password');
            } else {
                if($password != $con_password){
                    $this->addError('confirm_password', 'Passwords did not match');
                }
            }
        }
        
        private function addError($key, $val) {
            $this->errors[$key] = $val;
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
        UserValidator Methods:
            1. validateForm()
            2. validateUsername()
            3. validateFirstName()
            4. validateLastName()
            5. validateEmail()
            6. validateMobileNo()
            7. validatePassword()
            8. validateConPassword()
            9. addError($key, $val)
            10.isBlank($string)
            11.isDigit($string)
    */
?>