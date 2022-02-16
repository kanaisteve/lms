<?php 
    class Validator {
        private $fields = array(); /* create array to store form field names */
        private $fieldErrors = array(); /* create array to store errors for form fields */
        private $formIsValid = true;
        
        public function addField($fieldName) {
            $this->fields[] = $fieldName;
            $this->fieldErrors[$fieldName] = array();
        }
        
        public function addRule($fieldName, $fieldRule) {
            $ruleName = $fieldRule[0];
            
            switch($ruleName) {
                case 'min-length':
                    if(strlen($_POST[$fieldName]) < $fieldRule[1]) {
                        $this->addErrorToField($fieldName, ucwords($fieldName). " cannot be less than {$fieldRule[1]} in length");
                    }
                break;
                
                case 'empty':
                    if(strlen($_POST[$fieldName]) == 0) {
                        $this->addErrorToField($fieldName, ucwords($fieldName). " cannot be empty");
                    }
                break;
                
                default:
                    
                break;
            }
        }
        
        private function addErrorToField($fieldName, $errorMsg) {
            $this->formIsValid = false;
            $this->fieldErrors[$fieldName][] = $errorMsg;
        }
        
        public function printFieldError($fieldName) {
            if(isset($this->fieldErrors[$fieldName])) {
                foreach($this->fieldErrors[$fieldName] as $fieldError) {
                    echo "<p class='error'>{$fieldError}</p>";
                }
            }
        }
        
        public function printAllFieldErrors() {
            foreach($this->fields as $field) {
                $this->printFieldError($field);
            }
        }
        
        public function formValid() {
            return $this->formIsValid;
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
        Validator Methods:
            1. addField($fieldName)
            2. addRule($fieldName, $fieldRule)
            3. addErrorToField($fieldname, $errorMsg)
            4. printFieldError($fieldName)
            5. printFieldErrors()
            6. formValid()
            7. isBlank($string)
            8. isDigit($string)
    */
?>