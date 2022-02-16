<?php 
    include_once 'libs/validator.php';
    $validator = new Validator();
    
    if(isset($_POST['login_btn'])) {
        $validator->addField('firstName');
        $validator->addRule('firstName', array('min-length', 2));
        $validator->addRule('firstName', array('empty'));
        
        // check errors
        if($validator->formValid) {
            //redirect to success pages
            header("Location: success.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validator Class</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.css"/>
</head>
<body>
    <div class="card text-center" style="padding:15px;">
        <h3>Validator Class in PHP</h3>
        <h6>PHP Tutorial</h6>
    </div><br> 

    <div class="container">
        <div class="card">
            <div class="card-body">
                <!-- <img src="" alt="" class="card-img-top" style="width:25%;border-radius:50%;margin-left:110px;"> -->
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="form-group mt-2">
                        <lable for="username">First Name:</lable>
                        <input type="text" class="form-control" name="firstName" placeholder="Enter First Name" value="<?php if(isset($_POST['firstName'])) echo $_POST['firstName'] ?>">
                    </div>
                    <div class="form-group mt-2">
                      <label for="lastName">Last Name:</label>
                      <input type="text" class="form-control" name="lastName" placeholder="Enter Last Name" value="<?php if(isset($_POST['lastName'])) echo $_POST['lastName'] ?>"
                    </div>
                    <div class="form-group mt-2">
                      <label for="email">Email:</label>
                      <input type="email" class="form-control" name="email" placeholder="Enter email" value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>"
                    </div>
                    <div class="form-group mt-2">
                      <label for="password">Password:</label>
                      <input type="text" class="form-control" name="password" placeholder="Enter password" value="<?php if(isset($_POST['password'])) echo $_POST['password'] ?>"
                    </div>
                    <!-- submit button -->
                    <div class="form-group mt-3" style="float: right">
                        <input type="submit" name="login_btn" class="btn btn-primary" style="float:right;" value="Login">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>
</html>