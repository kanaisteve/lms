<?php 
    include_once 'database.php';
    
    class Customers {
        public $customerTable;
        public $db;
        public $mysqli;
        
        public function __construct() {
            $this->userTable = "lms_customers";
            $this->db = new Database();
            $this->mysqli = $this->db->connect();
        }
        
        public function addCustomer($post) {
            $firstname = $this->mysqli->real_escape_string($_POST['firstname']);
            $lastname = $this->mysqli->real_escape_string($_POST['lastname']);
            $email = $this->mysqli->real_escape_string($_POST['email']);
            $mobilenumber = $this->mysqli->real_escape_string($_POST['mobilenumber']);
            $address = $this->mysqli->real_escape_string($_POST['address']);
            $city = $this->mysqli->real_escape_string($_POST['city']);
            $country = $this->mysqli->real_escape_string($_POST['country']);
            $uImage = $this->mysqli->real_escape_string($_POST['uImage']);
            
            $query = "INSERT INTO $this->customerTable(firstname, lastname, email, mobilenumber, address, city, country, profile_image, date_created, time_created) VALUES ('$firstname', '$lastname', '$email', '$mobilenumber', '$address', '$city', '$country' '$uImage', '$date', '$time');";
            
            $result = $this->mysqli->query($query);
            if ($result == true) {
                header("Location:index.php?msg1=insert");
            } else {
                echo "Registration failed try again!";
            }
        }
        
        // Fetch customer records for show listing [used on the index page]
        public function fetchCustomers() {
            $qeury = "SELECT * FROM $this->customerTable";
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
        
        // Fetch single customer record for edit from customers table
        public function fetchCustomerById($id) {
            $query = "SELECT * FROM $this->customerTable WHERE id = '$id'";
            $result = $this->mysqli->query($query);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row;
            } else {
                echo "Record not found";
            }
          
        }
        
        // Update customer data into customers table
        public function updateCustomer($postData) {
            $id = $this->mysqli->real_escape_string($_POST['id']);
            $firstname = $this->mysqli->real_escape_string($_POST['firstname']);
            $lastname = $this->mysqli->real_escape_string($_POST['lastname']);
            $email = $this->mysqli->real_escape_string($_POST['email']);
            $mobilenumber = $this->mysqli->real_escape_string($_POST['mobilenumber']);
            $address = $this->mysqli->real_escape_string($_POST['address']);
            $city = $this->mysqli->real_escape_string($_POST['city']);
            $country = $this->mysqli->real_escape_string($_POST['country']);
            $uImage = $this->mysqli->real_escape_string($_POST['uImage']);
            
            if (!empty($id) && !empty($postData)):
                $query = "UPDATE $this->userTable SET firstname = '$firstname', lastname = '$lastname', email = '$email', mobilenumber = '$mobilenumber', address = '$address', city = '$city', country = '$country', profile_image = '$uImage'
                    WHERE id = '$id'";
                    
                $result = $this->mysqli->qury($query);
                if ($result == true) {
                    header("Location:index.php?msg2=update");
                } else {
                    echo "Update failed try again!";
                }
            endif;
        }
        
        // Delete user data from users table
        public function deleteCustomer($id) {
            $query = "DELETE FROM $this->customerTable WHERE id = '$id'";
            $result = $this->mysqli->query($query);
            if ($result == true) {
                header("Location:index.php?msg3=delete");
            } else {
                echo "Record not found to delete, try again";
            }
        }
    }
    
    /*
        === Customer Object Index ======
        1. addCustomer($postData)
        2. fetchCustomers()
        3. fetchCustomerById()
        4. updateCustomer($postData)
        5. deleteCustomer($id)
    */
?>