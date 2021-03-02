<!DOCTYPE html>
<html>
    <head>
        <title>Create an account</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <!-- Font Awesome CSS -->
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css'>
        <link rel="stylesheet" href="styles.css">
        <!-- Rotobo Font -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="fonts/icomoon/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="top">
            <img src="images/bg_1.jpg"/>
        </div>
        <div class="bottom">
            <div class="alert" id="alert" role="alert"></div>
            <div class="container col-md-6">
                <!-- Create Registration Form -->
                <div class="form-block">
                    <h3><strong>Registration Form</strong></h3>
                    <form action="createAcc.php" method="POST">
                        <!-- Username Field-->
                        <div class="form-group">
                            <span style="color:Red">* indicates required field</span><br/>
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username"placeholder="Your Username *"  required>
                        </div>
                        <!-- Phone Number Field-->
                        <div class="form-group">
                            <label for="phone_number">Phone Number</label><br/>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Your Phone Number *" maxlength="11" size="13"  required>
                        </div>
                        <!-- Password Field -->
                        <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                            title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" 
                            onkeyup="keyUp()" required>
                        </div>
                        <div class="message" id="message" style="display:none" >
                            <label style="font-weight:bold">Password must contain the following:</label>
                            <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                            <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                            <p id="number" class="invalid">A <b>number</b></p>
                            <p id="length" class="invalid" >Minimum <b>8 characters</b></p>
                        </div>
                        <div class="form-group">
                            <label for="password">Confirm Password</label>
                            <input type="password" class="form-control" id="password2" name="password2"  placeholder="Re-enter your password *" required>
                        </div>
                        <!-- Link to LOGIN page -->
                        <div class="form-group">
                            <span>Have an existing account?</span>
                            <span><a href="login.php" class="login-acc">Login Account</a></span> 
                            <input type="submit" name="register" value="Register" class="btn btn-block">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
<!-- Password Validation -->
<script type="text/javascript">
    var myInput = document.getElementById("password");
    var letter = document.getElementById("letter");
    var capital = document.getElementById("capital");
    var number = document.getElementById("number");
    var length = document.getElementById("length");
    // When the user clicks on the password field, show the message box
    myInput.onfocus = function() {
        document.getElementById("message").style.display = "block";
    }
    // When the user clicks outside of the password field, hide the message box
    myInput.onblur = function() {
        document.getElementById("message").style.display = "none";
    }
    // When the user starts to type something inside the password field
        function keyUp() {
        // Validate lowercase letters
        var lowerCaseLetters = /[a-z]/g;
        if(myInput.value.match(lowerCaseLetters)) {  
            letter.classList.remove("invalid");
            letter.classList.add("valid");
        } else {
            letter.classList.remove("valid");
            letter.classList.add("invalid");
        }                   
        // Validate capital letters
        var upperCaseLetters = /[A-Z]/g;
        if(myInput.value.match(upperCaseLetters)) {  
            capital.classList.remove("invalid");
            capital.classList.add("valid");
        } else {
            capital.classList.remove("valid");
            capital.classList.add("invalid");
        }
        // Validate numbers
            var numbers = /[0-9]/g;
            if(myInput.value.match(numbers)) {  
                number.classList.remove("invalid");
                number.classList.add("valid");
            } else {
                number.classList.remove("valid");
                number.classList.add("invalid");
            }            
        // Validate length
            if(myInput.value.length >= 8) {
                length.classList.remove("invalid");
                length.classList.add("valid");
            } else {
                length.classList.remove("valid");
                length.classList.add("invalid");
            }
        }
</script>          
<!-- POP Out message -->
<script type="text/javascript">
    function show_alert(status) {
        var alertDiv = document.getElementById("alert");
        if (status == "fail_username") {
            alertDiv.classList.add("alert-warning");
            $(alertDiv).append("Username exist. Please enter a new valid username."); 
        }else if (status == "password_same_username") {
            alertDiv.classList.add("alert-danger");
            $(alertDiv).append("Password should not same as Username!"); 
        }else if (status == "fail_reenter") {
            alertDiv.classList.add("alert-danger");
            $(alertDiv).append("Password mismatch!"); 
        }else {
            alertDiv.classList.add("alert-success");
            $(alertDiv).append("<button type='button' class='close' data-dismiss='alert'>&times;</button>"+
                               "</button>"+status+".");
        }
    }
</script>

<?php
include "dbConnection.php";
    if (isset($_POST["register"])) {
        $status=0;
        // GET USER INPUT
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);
        $re_password = mysqli_real_escape_string($conn,$_POST['password2']);
        $phone= mysqli_real_escape_string($conn,$_POST['phone_number']);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); 
        // CHECK USERNAME
            $GetUsernameQuery = mysqli_query($conn, "SELECT * FROM user");
            $numberOfUsername = mysqli_num_rows($GetUsernameQuery); 
            while($ex_username = mysqli_fetch_array($GetUsernameQuery)) {
                    //check same username
                if($ex_username['username'] == $username){
                    echo "<script>show_alert('fail_username')</script>"; //Alert use new username
                    $status=0;
                    exit(0);
                }    
            }
        // CHECK PASSWORD
                //validate password cannot same as username
            if($username==$password){
                echo "<script>show_alert('password_same_username')</script>";
                $status=0;
                exit(0);
            }else if($password!=$re_password){
                //validate two password are equal to each other
                echo "<script>show_alert('fail_reenter')</script>";   
                $status=0;
                exit(0);
            }
            else
                $status=1;
        // INSERT INTO Database   
        if($status==1){
                //store new data into database
                $insertQuery="INSERT INTO user(username, password_hash, phone) VALUES ('$username','$hashed_password','$phone')";
                $register=mysqli_query($conn,$insertQuery);
                // If Insert Successfully
                if($register){
                    
                    echo "<script>show_alert('Congratulation! Registration Success!')</script>";
                    echo "<script>window.setTimeout(
                        function(){
                            window.location.href='login.php';
                        },3000);</script>";
                }
                else{
                    echo "<script>show_alert('Database Not Working')</script>";
                    exit(0);
                }
        }
    }
mysqli_close($conn);
?>