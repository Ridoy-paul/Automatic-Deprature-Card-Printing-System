<?php require_once("backend/config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by FARA IT Fusion</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="formfonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="formcss/style.css">
    
    
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="" crossorigin="anonymous">-->
    
    
    <style>
        .main {
    background: #f8f8f8;
    padding: 50px 0;
}
.signin-content {
    padding-top: 3px;
    padding-bottom: 0;
}
#signin {
    background-color: #054C8C;
    text-align: center;
    margin: auto;
    display: block;
}
    </style>
</head>
<body style="background-color:#F79C2D;">

    <div class="main" style="background-color:#F79C2D;">

        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <table style="width:100%" style="padding-top: 10px;">
                  <tr>
                    <th style="text-align: left;"><img src="media/Mujib Borsho.png" width="90px;"><img src="media/bimanbd.png" width="90px;"></th>
                    
                    <th><h2 class="form-title" style="font-family: arial; margin-top: 5px; overflow: hidden;"><b>Departure Card Printing System</b></h2><p style="color: red;"><?php display_message(); ?></p></th>
                  </tr>
                </table>

                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="media/dep1.png" alt="sing up image"></figure>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Sign in</h2>
                        <form method="POST" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="email" id="email" placeholder="Enter Email"/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass_md5" id="your_pass" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                <!--<a href="client-access-info.php" class="signup-image-link">Are you client ? Please Generate Your Login info</a>-->
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="adminLogin" id="signin" class="form-submit" value="Log in"/>
                            </div>
                            
                        </form>
                        <div style="margin-top: 40px;">
                            <table style="width:100%">
                              <tr>
                                <th style="margin-top: 10px;"><h4 class="form-title" style="font-family: arial; overflow: hidden;"><b>Powred By</b></h4></th>
                                <th style="text-align: left;"><img src="media/ad.jpg" width="90px;"></th>
                              </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        

    </div>

    <!-- JS -->
    <script src="formvendor/jquery/jquery.min.js"></script>
    <script src="formjs/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
<?php
// admin login
if(isset($_POST['adminLogin'])){
        $username = escape_string($_POST['email']);
        $password = escape_string($_POST['pass_md5']);

        $query = query("SELECT * FROM admin WHERE username = '$username'");
        confirm($query);
        $rows = mysqli_num_rows($query);
        if ($rows > 0) {
            $row = fetch_array($query);
            $db_pass = $row['password'];
            $status = $row['status'];
            if($db_pass == md5($password)) {
                $_SESSION['username'] = $username;
                redirect("index.php");
                set_message("Login Successfull");
               
            }
            else {
                set_message("Sorry Username or password is invalid, Please try again");
                redirect("login.php");
            }
        }  
        
        else
        {
            if(isset($_POST['adminLogin']))
            {
                    $username_CRM = escape_string($_POST['email']);
                    $password_CRM = escape_string($_POST['pass_md5']);
    
                    $query_crm = query("SELECT * FROM admin WHERE username = '$username_CRM' AND type='CRM' AND status='SHOW'");
                    confirm($query_crm);
                    
                    $rows_crm = mysqli_num_rows($query_crm);
                    
                    $row_crm = fetch_array($query_crm);
                    
                    $db_pass_crm = $row_crm['password'];
               
                    if($db_pass_crm == md5($password_CRM)) {
                    $_SESSION['username'] = $username;
                    redirect("index.php");
                    set_message("Login Successfull");
                   
                    }
                    else {
                        set_message("Please try again");
                        redirect("login.php");
                        
                    }
            }
        }
    }
    


?>

