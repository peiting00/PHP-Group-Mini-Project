<?php
include"dbConnection.php";
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
                    <form action="home.php" name="home" method="post">
                        <div class="form-group">
                            <label for="name">Name <span style="color:red">*</span></label>
                            <input type="text" class="form-control" placeholder="Your Name" name="name" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email <span style="color:red">*</span></label>
                            <input type="email" class="form-control" placeholder="Your Email" name="email" id="email" required>
                        </div>
                        <div class="form-group">
                            <label for="age">Age </label>
                            <input type='number' class="form-control" placeholder="Your Age" name='age' id='age' min='1' max='200'step='5' required>
                        </div>
                        <div class="form-group">
                            <label for="birthdate">Birthdate <span style="color:red">*</span></label>
                            <input type='date' class="form-control" placeholder="Your Age" name='date' id='date' min='1940-01-01' max="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <label for="fav_food">Your Favourite Food <span style="color:red">*</span></label><br/>
                                <div>
                                    <label for='banana'>Banana</label>
                                    <input type="checkbox"  name="banana" id="banana" required>
                                </div>
                                <div>
                                <label for='apple' >Apple</label>
                                <input type='checkbox' name="apple" id="apple" required>
                                </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <label for="gender">Gender <span style="color:red">*</span></label><br/>
                                <div>
                                    <label for='Male'>Male</label>
                                    <input type="radio"  name="gender" id="male" required>
                                </div>
                                <div>
                                <label for='female' >Female</label>
                                <input type='radio' name="gender" id="female" required>
                                </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <label for='eyeColor'>Eye Color <span style="color:red">*</span></label>
                            <select name='eyeColor' id='eyeColor'>
                                <option value='Green'>Green</option>
                                <option value='Black'>Black</option>
                                <option value='Blue'>Blue</option>
                                <option value='Red'>Red</option>
                                <option value='Red'>Amber</option>
                                <option value='Red'>Grey</option>
                                <option value='Red'>Hazel</option>
		                    </select>
	                    </div>
                        <div class="form-group">
	                        <label for='bio'>Bio <span style="color:red">*</span></label>
	                        <textarea id='bio' name='bio' placeholder="My name is Sam. I am currently..." required></textarea>
	                    </div>
                        <hr/>
                        <div>
                            <label for='file'>File</label>
                            <input id='file' type='file' name='file'>
	                    </div>
                        <br/>
                        <div class="form-group">
                            <label for='phone'>Phone <span style="color:red">*</span></label>
                            <input type='tel' name='phone' id='phone' class="form-control" placeholder="012-12345678" pattern="[0-9]{3}-[0-9]{8}" required>
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
                            <label for='password'> Password <span style="color:red">*</span></label>
                            <input type='password' class="form-control" placeholder="Enter your password to validate submission" name="password" required>
                        </div>
                        <div>
                            <button type='reset' id="reset" name="reset" class="btn" size=5  onClick="return confirmReset()">Reset</button>
		                    <button type='submit' id="submit" name="submit" class="btn" size=5 >Submit</button>
                            <button type='logout' id="logout" name="logout" class="btn" size=5 >logout</button>

                        </div>

                    </form>
                </div>
            </div>
        </div>
</body>
</html>	

<script>
function confirmReset(){
    var c=confirm("Are you sure want to RESET the form? This will clear the fiel")
    if(c == true){
        return true;
    }else{
        return false;
    }
}
</script>



<?php
include "dbConnection.php";

    if(isset($_POST['logout'])){

        //redirect to logout page
        echo "<script>window.setTimeout(
            function(){
                window.location.href='login.php';
            },0);</script>";
    }

?>
