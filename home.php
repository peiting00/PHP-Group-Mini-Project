<?php
include('session.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Homepage</title>
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
<body>
        <div class="top">
            <img src="images/bg_1.jpg"/>
        </div>
        <div class="bottom">
            <div class="alert" id="alert" role="alert">
            </div>
            <div class="container col-md-6">
                <div class="form-block">
                    <h4><?php echo "Welcome, ". $_SESSION['login_user'].'<br>'; ?></h4>
                    <h4>Please complete your profile.</h4>
                    <form action="home.php"  method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Name <span style="color:red">*</span></label>
                            <input type="text" class="form-control" placeholder="Your Full Name" name="name" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email <span style="color:red">*</span></label>
                            <input type="email" class="form-control" placeholder="example@gmail.com" name="email" id="email" required>
                        </div>
                        <div class="form-group">
                            <label for="age">Age </label>
                            <input type='text' class="form-control" placeholder="Auto generated from your Birthdate" name='age' id='age' title='Auto generated Field' readonly>
                        </div>
                        <div class="form-group">
                            <label for="birthdate">Birthdate <span style="color:red">*</span></label>
                            <input type='date' class="form-control" name='birthdate' id='birthdate' onChange="setAge()" min='1940-01-01' max="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <label for="fav_food">Your Favourite Food </label><br/>
                                <div>
                                    <label for='banana'>Banana</label>
                                    <input type="checkbox"  name="fav[]" value="banana" id="banana" >
                                </div>
                                <div>
                                <label for='apple' >Apple</label>
                                <input type='checkbox' name="fav[]" value="apple" id="apple" >
                                </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <label for="gender">Gender <span style="color:red">*</span></label><br/>
                                <div>
                                    <label for='Male'>Male</label>
                                    <input type="radio"  name="gender" id="male" value="Male" required>
                                </div>
                                <div>
                                <label for='female' >Female</label>
                                <input type='radio' name="gender" id="female" value="Female" required>
                                </div>
                        </div>
                        <div class="form-group">
                            <label for='lbleyeColor'>Eye Color <span style="color:red">*</span></label>
                            <select name="eyeColor" id="eyeColor">
                                <option value="Green">Green</option>
                                <option value="Black">Black</option>
                                <option value="Blue">Blue</option>
                                <option value="Red">Red</option>
                                <option value="Amber">Amber</option>
                                <option value="Grey">Grey</option>
                                <option value="Hazel">Hazel</option>
		                    </select>
	                    </div>
                        <hr/>
                        <div class="form-group">
	                        <label for='bio'>Bio <span style="color:red">*</span></label>
	                        <textarea id='bio' name='bio' placeholder="Hi,I am from...." required></textarea>
	                    </div>
                        <div class="form-group">
                            <label for='file'> Upload Profile Picture <span style="color:red">*</span></label>
                            <input type='file' name='uploadfile' accept="image/*" required>
                        </div>
                        <div class="form-group">
                            <label for='url'>URL </label>
                            <input type='url' name='url' id='url' class="form-control" placeholder="https://example.com" pattern="https://.*" size="30">
                        </div>
                        <div class="form-group">
                            <label for='color'> Color </label>
                            <input type='color' class="form-control" name='color' id='color'>
                        </div>
                        <div class="form-group">
                            <button type='reset' id="reset" name="reset" class="btn"  onClick="return confirmReset()">Reset</button>
		                    <button type='submit' id="submit" name="submit" class="btn" >Submit</button>
                        </div>
                        <div>
                            <span style="text-align:center;">Click here to <a href="logout.php" class="login-acc">Logout</a></span> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
</body>
</html>	

<script>
//User click 'RESET' button, confirmation POP OUT
function confirmReset(){
    var c=confirm("Are you sure want to RESET the form? All input will be clear if you click 'OK' .")
    if(c == true){
        return true;
    }else{
        return false;
    }
}

//Auto Set Age 
function setAge(){
    //get current date
    var today = new Date();
    //extract year from the current date
    var nowY = today.getFullYear();

    //get user input
    var d = document.getElementById('birthdate').value; 
    //format input as date
    var dob = new Date(d);
    //extract year from input date
    var prevY = dob.getFullYear();
    //calculate
    var age = nowY - prevY ;
    
    //age input field
    document.getElementById('age').value = age;
}
</script>

<!-- POP Out message -->
<script type="text/javascript">
    function show_alert(status) {
        var alertDiv = document.getElementById("alert");
        if(status == "insert_success") {
            alertDiv.classList.add("alert-success");
            $(alertDiv).append("Profile Information upload Success!");
        }else if(status == "insert_error") {
            alertDiv.classList.add("alert-danger");
            $(alertDiv).append("Failed to upload profile Information! Try again.");
        }
    }
</script>

<?php
include "dbConnection.php";

    if(isset($_POST['submit'])){
        //RETRIEVE USER INPUT
        $username=$_SESSION['login_user'];
        $name= $_POST["name"];
        $email= $_POST["email"];
        $age= $_POST["age"];
        $dob=$_POST["birthdate"]; //convert string to TIME
        $favFood= implode(",",$_POST["fav"]); //convert array into string
        $gender= $_POST["gender"];
        $eyeColor= $_POST["eyeColor"];
        $bio= $_POST["bio"];
        $url= $_POST["url"];
        $color= $_POST["color"];
        $username= $_SESSION['login_user'];
        
        //Upload image file
        $filename=$_FILES['uploadfile']['name'];
        $tempname=$_FILES['uploadfile']['tmp_name'];
            $folder="image/".$filename;
        
        
        //get userID from user
        $id = mysqli_query($conn,"SELECT userID from user WHERE username='$username'");
        $idRow = mysqli_fetch_row($id);
        
        //INSERT INTO DATABASE
        $insertQuery="INSERT INTO profile(userID,name,email,age,birthdate,fav_food,gender,eye_color,bio,file,url,color) 
        VALUES ('$idRow[0]','$name','$email','$age','$dob','$favFood','$gender','$eyeColor','$bio','$filename','$url','$color')";
        $insert=mysqli_query($conn,$insertQuery);
                
            if($insert)
                echo "<script>show_alert('insert_success')</script>";
            else{
                echo "<script>show_alert('insert_error')</script>";
                die("failed:".mysqli_error($conn));
            }
    }
        
?>
