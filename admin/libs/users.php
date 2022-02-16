<?php 
    
    include_once 'database.php';
    
    // set timezone
    date_default_timezone_set('Africa/Lusaka');
    // get and store timezone
    $timezone = date_default_timezone_get();
    
    class Users {
        public $userTable;
        public $db;
        public $mysqli;
        
        // Constructor
        public function __construct() {
            $this->userTable = "lms_users";
            $this->db = new Database();
            $this->mysqli = $this->db->connect();
        }
        
        public function register($postData) {
            session_start();
            // collect post data and store in variables
            $firstname = trim($this->mysqli->real_escape_string($_POST['firstname']));
            $lastname = trim($this->mysqli->real_escape_string($_POST['lastname']));
            // $user_role = $this->mysqli->real_escape_string($_POST['user_role']);
            $mobilenumber = trim($this->mysqli->real_escape_string($_POST['mobilenumber']));
            $email = trim($this->mysqli->real_escape_string($_POST['email']));
            $password = password_hash($this->mysqli->real_escape_string($_POST['password']), PASSWORD_DEFAULT); 
            $confirm_password = $this->mysqli->real_escape_string($_POST['confirm_password']);
            
            $today = date('Y-m-d');
            $time = date('h:i:s');
            $user_role = 'customer';
            
            // Add user information into the users table
            $add_user = "INSERT INTO $this->userTable (firstname, lastname, email, mobilenumber, userpassword, user_role, joining_date, joining_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            
            if($stmt = $this->mysqli->prepare($add_user)) {
                // bind variables to the prepared statement as parameters
                $stmt->bind_param("ssssssss", $firstname, $lastname, $email, $mobilenumber, $password, $user_role, $today, $time);
                
                // attempt to execute the prepared statement
                if($stmt->execute()) {
                    // email activation
                    // ...
                    // store data in session variables
                    $_SESSION['firstname'] = $firstname;
                    $_SESSION['lastname'] = $lastname;
                    $_SESSION['email'] = $email;
                    return true;
                } else {
                    return false;
                }
            }
                    
            // if($this->mysqli->query($add_user)) {
            //     return true;
            // } else {
            //     return false;
            // }
        }
        
        public function login($username, $password) {
            session_start();
            $query = "SELECT * FROM $this->userTable WHERE mobilenumber='$username' OR email='$username' LIMIT 1";
    
            $result = $this->mysqli->query($query);
            $user = $result->fetch_assoc();
            if($result->num_rows > 0) {
                $hashed_password = $user['userpassword'];
                if(password_verify($password, $hashed_password)){
                    // Store data in session variables
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $user['id'];
                    $_SESSION["email"] = $user['email'];
                    $_SESSION["mobilenumber"] = $user['mobilenumber'];   
                    $_SESSION["fullName"] = $user['firstname'].' '.$user['lastname'];                       
                    $_SESSION["userRole"] = $user['user_role'];                        
                    $_SESSION["userImg"] = $user['profile_image'];                         
                  
                    // Redirect user to welcome page
                    if(isset($_SESSION['userRole'])) {
                        if($_SESSION['userRole'] === 'admin') {
                            header("location: admin/index.php");
                        } else {
                            header ("location: admin/indexCust.php");
                        }
                    }
                } else {
                  // Display an error message if password is not valid
                  $password_err = "The password you entered was not valid.";
                } 
            } else{
                // Display an error message if username doesn't exist
                $username_err = "No account found with that username.";
            }
        }
        
        // user login 
        public function signin($postData) {
            $username = $this->mysqli->real_escape_string($_POST['username']);
            $password = md5($_POST['password']);
            
            $query = "SELECT * FROM $this->userTable WHERE mobilenumber='$username' OR email='$username' AND userpassword = '$password'";
            $result = $this->mysqli->query($query);
            $user = $result->fetch_assoc();
            $count_row = $result->num_rows;
            
            if ($count_row == 1) {
                $_SESSION['id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['mobilenumber'] = $user['mobilenumber'];
                $_SESSION["fullName"] = $firstname.' '.$lastname; 
                $_SESSION['userRole'] = $user['user_role'];
                $_SESSION['userImg'] = $user['profile_image'];
                $_SESSION['loggedin'] = true;
                $_SESSION['LAST_ACTIVE_TIME'] = time();
                return true;
            } else {
                return false;
            }
        }
        
        public function signup($postData) {
            // collect post data and store in variables
            $firstname = trim($this->mysqli->real_escape_string($_POST['firstname']));
            $lastname = trim($this->mysqli->real_escape_string($_POST['lastname']));
            $user_role = $this->mysqli->real_escape_string($_POST['user_role']);
            $mobilenumber = trim($this->mysqli->real_escape_string($_POST['mobilenumber']));
            $email = trim($this->mysqli->real_escape_string($_POST['email']));
            $password = password_hash($this->mysqli->real_escape_string($_POST['password']), PASSWORD_DEFAULT); 
            $confirm_password = $this->mysqli->real_escape_string($_POST['confirm_password']);
    
            $user_img = $_FILES['uImage']['name'];
            $user_tmp = $_FILES['uImage']['tmp_name'];
            
            if(!empty($firstname) && !empty($lastname) && !empty($email) && !empty($mobilenumber) && !empty($password) && !empty($confirm_password)) {
                // Add user information into the users table
                $add_user = "INSERT INTO $this->userTable (firstname, lastname, email, mobilenumber, userpassword, profile_image, user_role, joining_date, joining_time) 
                    VALUES ('$firstname', '$lastname', '$email', '$mobilenumber', '$password', '$user_img', '$user_role', '$today', '$time')";
                    
                if($this->mysqli->query($add_user)) {
                    return true;
                } else {
                    return false;
                }
            }
        }
        
        public function logout() {
            session_start();
            // Destroy the session.
            session_destroy();
            // Unset all of the session variables
            //$_SESSION = array();
            session_unset($_SESSION['id']);
            session_unset($_SESSION['LAST_ACTIVE_TIME']);
            session_unset($_SESSION['loggedin']);
            session_unset($_SESSION['email']);
            session_unset($_SESSION['mobilenumber']);
            session_unset($_SESSION['fullName']);
            session_unset($_SESSION['userRole']);
            session_unset($_SESSION['userImg']);
            // Redirect to login page
            header("location: ../sign-in.php");
            die();
        }
        
        // check if email exists
        public function emailExists($email) {
            $query = "SELECT * FROM $this->userTable WHERE email = '$email'";
            $result = $this->mysqli->query($query);
            if ($result->num_rows > 0) {
                return true;
            } else {
                return false;
            }
        }
        
        // check if phone number exists
        public function mobileNumberExists($mobileno) {
            $query = "SELECT * FROM $this->userTable WHERE mobilenumber = '$mobileno'";
            $result = $this->mysqli->query($query);
            if ($result->num_rows > 0) {
                // $error = 'This mobile number is already taken';
                // return $error;
                return true;
            } else {
                // $success = 'This mobile number is not taken';
                // return $success;
                return false;
            }
        }
        
        // check if user already exists with same username or email
        public function mobileOrEmailExists($mobilenumber, $email) {
            $query = "SELECT * FROM $this->userTable WHERE mobilenumber = '$mobilenumber' OR email='$email' LIMIT 1";
            $result = $this->mysqli->query($query);
            $user = $result->fetch_assoc();
            if ($user) {
                if ($user['mobilenumber'] === $mobilenumber) {
                    // error = 'mobile number already exists';
                    return true;
                }
                if ($user['email'] === $email)  {
                    // error = 'email already exists';
                    return true;
                }
            }
        }
        
        public function uploadId($post, $mobileNumber) {
            $frontImg = $_FILES['front']['name'];
            $frontTmp = $_FILES['front']['tmp_name'];
                                                
            $backImg = $_FILES['back']['name'];
            $backTmp = $_FILES['back']['tmp_name'];
            
            if(!empty($frontImg) || !empty($backImg)) :
                // update id photos
                $update_query = "UPDATE $this->userTable SET id_front = '$frontImg', id_back = '$backImg' WHERE mobilenumber = '$mobileNumber'";
                $update_result = $this->mysqli->query($update_query);

                // check update result and notify
                if($update_result) {
                    // move image from database to local folder
                    move_uploaded_file($frontTmp, "./assets/img/idPhotos/" . $frontImg);
                    move_uploaded_file($backTmp, "./assets/img/idPhotos/" . $backImg);
                    // echo '
                    //     <div class="alert alert-success" role="alert">
                    //         Your ID has been updated successfully.
                    //     </div>
                    //     ';
                    // header("location: user-profile.php");
                    return true;
                } else {
                    echo "Something is wrong!" . $this->mysqli->error;
                }          
            endif;
        }
        
        public function changeAvatar($post, $mobileNumber) {
            $avatarImg = $_FILES['image']['name'];
            $userTmp = $_FILES['image']['tmp_name'];

            // updating the image in the db
            if(!empty($avatarImg)) :
                // update avatar of customer
                $update_query = "UPDATE $this->userTable SET avatar = '$avatarImg' WHERE mobilenumber = '$mobileNumber'";
                $update_result = $this->mysqli->query($update_query);

                // check update result and notify
                if($update_result) {
                    // move image from database to local folder
                    move_uploaded_file($userTmp, "./assets/img/avatar/" . $avatarImg);
                    // echo '
                    //     <div class="alert alert-success" role="alert">
                //         Avatar has been updated in the database
                    //     </div>
                //     ';
                    return true;
                } else {
                    echo "Something is wrong!" . $this->mysqli->error;
                } 
            endif;
        }
        
        // Insert user data into users table
        public function addUser($post) {
            // collect post data and store in variables
            $firstname = trim($this->mysqli->real_escape_string($_POST['firstname']));
            $lastname = trim($this->mysqli->real_escape_string($_POST['lastname']));
            $user_role = $this->mysqli->real_escape_string($_POST['user_role']);
            $mobilenumber = trim($this->mysqli->real_escape_string($_POST['mobilenumber']));
            $email = trim($this->mysqli->real_escape_string($_POST['email']));
            $password = password_hash($this->mysqli->real_escape_string($_POST['password']), PASSWORD_DEFAULT); 
            $confirm_password = $this->mysqli->real_escape_string($_POST['confirm_password']);
    
            $user_img = $_FILES['uImage']['name'];
            $user_tmp = $_FILES['uImage']['tmp_name'];
            
            $today = date('Y-m-d');
            $time = date('h:i:s');
            
            // Add user information into the users table
            $add_user = "INSERT INTO $this->userTable (firstname, lastname, email, mobilenumber, userpassword, profile_image, user_role, joining_date, joining_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            if($stmt = $this->mysqli->prepare($add_user)) {
                // bind variables to the prepared statement as parameters
                $stmt->bind_param("sssssssss", $firstname, $lastname, $email, $mobilenumber, $password, $user_img, $user_role, $today, $time);
                
                // attempt to execute the prepared statement
                if($stmt->execute()) {
                    move_uploaded_file($user_tmp, "./assets/img/user/$user_img");
                    return true;
                } else {
                    return false;
                }
            }
                    
            // if($this->mysqli->query($add_user)) {
            //     return true;
            // } else {
            //     return false;
            // }
        }
        
        // Fetch user records for show listing
        public function getUsers() {
            $query = "SELECT * FROM $this->userTable";
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
        
        // Fetch single data for edit from customer table
        public function getUserById($id) {
            $query = "SELECT * FROM $this->userTable WHERE id = '$id'";
            $result = $this->mysqli->query($query);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row;
            } else {
                echo "Record not found";
            }
                
        }
        
        // Fetch single data for edit from customer table
        public function getUserByMobileNo($mobileno) {
            $query = "SELECT * FROM $this->userTable WHERE mobilenumber = '$mobileno'";
            $result = $this->mysqli->query($query);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row;
            } else {
                echo "Record not found";
                return false;
            }
                
        }
        
        // Fetch user records that are customers for show listing
        public function getCustomers() {
            $query = "SELECT * FROM $this->userTable WHERE user_role = 'customer'";
            $result = $this->mysqli->query($query);
            if ($result->num_rows > 0) {
                $data = array();
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                return $data;
            } else {
                echo '<p class="text-center text-danger">No customers found</p>';
                return false;
            }
        }
        
        // Update user data into users table
        public function updateUser($postData, $userImage) {
            $id = $this->mysqli->real_escape_string($_POST['id']);
            $firstName = trim($this->mysqli->real_escape_string($_POST['first_name'])); 
            $lastName = trim($this->mysqli->real_escape_string($_POST['last_name']));
            $mobileNo = trim($this->mysqli->real_escape_string($_POST['mobile_no']));
            $userEmail = trim($this->mysqli->real_escape_string($_POST['email']));
            
            $userImg = $_FILES['image']['name'];
            $userTmp = $_FILES['image']['tmp_name'];
            
            $userRole = $this->mysqli->real_escape_string($_POST['user_role']);

            if (!empty($id) && !empty($postData)):
                // updating the image in the db
                if(empty($userImg)) {
                    $userImg = $userImage;
                }

                // update user
                $update_query = "UPDATE $this->userTable SET firstname=?, lastname=?, mobilenumber=?, email =?, profile_image =?, user_role=?  
                WHERE id =?";
                $stmt = $this->mysqli->prepare($update_query);
                $stmt->bind_param("sssssss", $firstName, $lastName, $mobileNo, $userEmail, $userImg, $userRole, $id);
		
                // check update result and notify
                if($stmt->execute()) {
                // move image from database to local folder
                    move_uploaded_file($userTmp, "./assets/img/user/" . $userImg);
                    echo '
                        <div class="alert alert-success" role="alert">
                            Record has been updated in the database
                        </div>
                        ';
                    header("location: users.php");
                } else {
                    echo "Something is wrong!" . $this->mysqli->error;
                } 
            endif;
        }
        
        public function updateProfile($postData) {
            // Collect personal details
            $ID = $this->mysqli->real_escape_string($_POST['id']);
            $firstName = $this->mysqli->real_escape_string($_POST['firstname']);
            $middleName = $this->mysqli->real_escape_string($_POST['middlename']);
            $lastName = $this->mysqli->real_escape_string($_POST['lastname']);
            $mobileNo = $this->mysqli->real_escape_string($_POST['mobileno']);
            $paymentNo = $this->mysqli->real_escape_string($_POST['paymentno']);
            $emailId = $this->mysqli->real_escape_string($_POST['email']); 
            $idNo = $this->mysqli->real_escape_string($_POST['idno']); 
            $occupation = $this->mysqli->real_escape_string($_POST['occupation']); 
            $sex = $this->mysqli->real_escape_string($_POST['gender']);
            $dateOfBirth = $this->mysqli->real_escape_string($_POST['dob']);
            $street = $this->mysqli->real_escape_string($_POST['address']);
            $townCity = $this->mysqli->real_escape_string($_POST['town_city']);
            $state = $this->mysqli->real_escape_string($_POST['province']);

            // update personal details
            $update_query = "UPDATE $this->userTable SET firstname=?, middlename=?, lastname=?, mobilenumber=?, paymentnumber=?, email=?,  idno =?, occupation=?, gender=?, dob=?, address=?, city=?, state=? 
            WHERE id = ?";
            
            $stmt = $this->mysqli->prepare($update_query);
            $stmt->bind_param("ssssssssssssss", $firstName, $middleName, $lastName, $mobileNo, $paymentNo, $emailId, $idNo, $occupation, $sex, $dateOfBirth, $street, $townCity, $state, $ID);

            // check update result and notify
            if($stmt->execute()) {
                echo '
                    <div class="alert alert-success" role="alert">
                        Your details have been updated in the database
                    </div>
                    ';
                return true;
            } else {
                echo "Something is wrong!" . $this->mysqli->error;
                // return false;
            } 
        }
        
        // Delete user data from users table
        public function deleteUser($user_ID) {
            $query = "DELETE FROM $this->userTable WHERE id = '$user_ID'";
            $result = $this->mysqli->query($query);
            if ($result == true) {
                header("Location:users.php?msg3=delete");
            } else {
                echo "Record not found to delete, try again";
            }
        }
        
        // Change user role to admin
        public function changeToAdmin($admin_id) {
            $query = "UPDATE $this->userTable SET user_role = 'admin' WHERE id = '$admin_id'";
            $sql_result = $this->mysqli->query($query);
            if($sql_result) {
                header('location: users.php');
            }
        }
        
        // Change user role to customer
        public function changeToCustomer($customer_id) {
            $query = "UPDATE $this->userTable SET user_role = 'customer' WHERE id = '$customer_id'";
            $user_result = $this->mysqli->query($query);
            if($user_result) {
                header('location: users.php');
            }
        }
        
        // Change(Update) user password from the users table
        public function changePassword($postData, $id) {
            $old_password = password_hash($this->mysqli->real_escape_string($_POST['oldpass']), PASSWORD_DEFAULT);
            $new_password = password_hash($this->mysqli->real_escape_string($_POST['newpass']), PASSWORD_DEFAULT);
            $con_password = password_hash($this->mysqli->real_escape_string($_POST['confirmpass']), PASSWORD_DEFAULT);
            
            // collect current password of the user from the database
            $query = "SELECT * FROM $this->userTable WHERE id = '$id'";
            $result = $this->mysqli->query($query);
            if ($result->num_rows > 0 ) {
                $row = $result->fetch_assoc();
                $db_password = $row['userpassword'];
            } else {
                // user record was not found
                $msg = 'no user of that id found';
                return $msg;
                // return false;
            }
        
            if(!empty($new_password) && !emptpy($old_password) && !empty($con_password)) :
                if($old_password == $db_password) {
                    if ($new_password == $con_password) {
                        $update = "UPDATE $this->userTable SET userpassword = '$new_password' WHERE id = '$id'";
                        if ($this->mysqli->query($update)) {
                            return true; // updated successfully
                        } else {
                            // return false; // failed to update
                            $msg1 = "Something is wrong!" . $this->mysqli->error;
                            return $msg1;
                        }
                    } else {
                        // new_password & con_password passwords do not match
                        // return false;
                        $msg2 = "Something is wrong!" . $this->mysqli->error;
                        return $msg2;
                    } 
                } else {
                    // old password & db_password do not match 
                    // return false;
                    $msg3 = "Something is wrong!" . $this->mysqli->error;
                    return $msg3;
                }
            endif;
        }
    }
    
    /*
        === Users Object Index ======
        1. register() and signup()
        2. login() and signin()
        3. isEmailExists()
        4. isPhoneNumberExists()
        
        1. addUser($postData)
        2. fetchUsers()
        3. fetchUserById()
        4. updateUser($postData)
        5. deleteUser($id)
        6. changeToAdmin($admin_id)
        7. changeToCustomer($customer_id)
        8. chagePassword()
    */
?>