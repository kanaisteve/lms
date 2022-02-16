<!-- Add Record Script -->
<?php 
    if(isset($_POST['btn_add_record'])) {
        $firstName = $_POST['firstname'];
        $lastName = $_POST['lastname'];
        $mobileno = $_POST['mobileno'];
        $gender = $_POST['gender'];
        $town_city = $_POST['town_city'];
        $province = $_POST['province'];
    
        // insert dsa record into the dsa_records table
        $add_record = "INSERT INTO dsa_records (firstname, lastname, mobileno, gender, town_city, state, entered_by) 
            VALUES ('$firstName', '$lastName', '$mobileno', '$gender', '$town_city', '$province', '$fullName')";
        $result = mysqli_query($conn, $add_record);
        
        if($result){
            echo '
                <div class="alert alert-success" role="alert">
                    New Record has been saved in the database
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
                </div>';
        } else {
            echo "Query Failed!";
        }
        
    }
?>

<!-- Add New User -->
<form id="form_to_submit" action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">First Name</label>
        <input required type="text" id="form_firstname" name="firstname" placeholder="First Name" class="form-control">
    </div>

    <div class="form-group">
        <label for="">Last Name</label>
        <input required type="text" id="form_lastname" name="lastname" placeholder="Last Name" class="form-control">
    </div>

    <div class="form-group">
        <label for="">Mobile Number</label>
        <input required type="text" id="form_number" name="mobileno" placeholder="968-808-800" class="form-control">
    </div>
    
    <div class="form-group">
        <label for="">Gender</label>
        <select name="gender" id="form_gender" class="form-control">
            <option value="male" id="">Male</option>
            <option value="female" id="">Female</option>
        </select>
    </div>

    <div class="form-group">
        <label for="">Town/City</label>
        <input required type="text" id="form_city" name="town_city" placeholder="Town or City" class="form-control">
    </div>
    
    <div class="form-group">
        <label for="">Province</label>
        <select name="province" id="form_province" class="form-control">
            <option value="Lusaka" id="">Lusaka</option>
            <option value="Copperbelt" id="">Copperbelt</option>
            <option value="Central" id="">Central</option>
            <option value="Southern" id="">Southern</option>
            <option value="Western" id="">Western</option>
            <option value="North-Western" id="">North-Western</option>
            <option value="Eastern" id="">Eastern</option>
            <option value="Northern" id="">Northern</option>
            <option value="Luapula" id="">Luapula</option>
            <option value="Muchinga" id="">Muchinga</option>
        </select>
    </div>
    
    <div class="form-group">
        <input name="btn_add_record" class="btn btn-info" value="Submit" onclick="add_confirm()">
    </div>
</form>



<script type="text/javascript">
    function add_confirm(){
        var a = document.getElementById('form_firstname').value;
        var b = document.getElementById('form_lastname').value;
        var c = document.getElementById('form_number').value;
        var d = document.getElementById('form_gender').value;
        var e = document.getElementById('form_city').value;
        var f = document.getElementById('form_province').value;
        var g = "Full Name: " + a +" "+ b + '\n' + "Mobile No: " + c+'\n' + "Gender: " + d +'\n'+ "Town/City: " + e +'\n'+ "Province: " + f;
        
     var r = confirm(g);   
     if(r == true){
         document.getElementById('form_to_submit').submit();
     }
     
    }
</script>