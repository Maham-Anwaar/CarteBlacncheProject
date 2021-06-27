<?php 
    session_start();
    $passwordErr = $emailErr = $websiteErr = "";
    $password = $email = "";
    $error = false; 
    $email_check=1;

    if (isset($_POST['log_in']))
    {
          if (empty($_POST["password"])) {
                $passwordErr = "Password is required";
                $error = true;
            } else {
                $password = ($_POST["password"]);
                if(!preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/",$password)) {
                    $passwordErr = "Password must have one of each (Capital Letter,Small Letter and Digit)";
                    $error = true;
                }
            }
        if (empty($_POST["email"])) {
                $emailErr = "Email is required";
                $error = true;
        } else {
            $email = ($_POST["email"]);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid email format";
                    $error = true;
                }
        }
        $link = mysqli_connect("localhost", "root", "", "db1");

        if($link === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
         else{
            if(!$error)
            {
                $sql = "SELECT * FROM doctors";
                
                if($result = mysqli_query($link, $sql))
                {

                    if(mysqli_num_rows($result) > 0)
                    {

                        while($row = mysqli_fetch_array($result))
                        {
                            if($row["email"]==$_POST["email"])
                            {
                                $email_check = 0;

                                if($row["password"]==$_POST["password"])
                                {
                                    $_SESSION['userinfo']['dID'] = $row["docID"];
                                    $_SESSION['userinfo']['name'] = $row["username"];
                                    $_SESSION['userinfo']['email'] = $_POST["email"];
                                    $_SESSION['userinfo']['pass'] = $_POST["password"];
                                    header('Location: index.php');
                                    //echo $_SESSION['userinfo']['dID']; echo $_SESSION['userinfo']['name'];
                                    break;
                                }
                                else{ $passwordErr="Password is wrong!!!"; break;}
                            }
                            else{/* echo "Email Not Found!!!"; break;*/}
                        }
                        if($email_check==1)
                        {
                            $emailErr = "You dont have account!!!";
                        }
                        mysqli_free_result($result);
                    } else{
                    //echo "No records matching your query were found.";
                    }
                } else{
                    //echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                }
            }
                // Close connection
            mysqli_close($link);
        }
    }
?>  

<!DOCTYPE html>
<html>
<head>
  
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet"  href="css/main.css">
      
       
   <style>

.formclass {
   
    margin: auto;
    width: 50%;
    border: 3px solid lavender;
    margin-top: 10px;
}

.formContent {
  -webkit-border-radius: 10px 10px 10px 10px;
  border-radius: 10px 10px 10px 10px;
  background: #fff  ;
  padding: 30px;
  width: 90%;
  max-width: 450px;
  position: relative;
  padding: 25px;
  -webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  text-align: center;
}





   </style>

</head>

<body>
    <div>
    <?php require "Header.php";?>
</div>
<!-- For the header otherwise all data gets added into the header -->
<div  class="formclass formContent">
        <form  id="form" method="post">
       <h1> <center > Login </center> </h1>
         <div class="wrap-input100" >
                    <span class="label-input100" > <h3>Email </h3> </span>
                     <input class="input100" type="text" name="email" placeholder="Enter Email">
                    <span class="focus-input100"></span>
                </div>

                <?php if(!empty($emailErr)): ?>
                  <div>
                    <span style="color: red;"><strong>Error!</strong> <?php echo $emailErr;?></span>
                  </div>
                  <?php endif; ?>


                 <div class="wrap-input100" >   
                    <span class="label-input100" ><h3>Password </h3></span> 
                    <input class="input100" type="password" name="password" placeholder="Enter Password">
                    <span class="focus-input100"></span>

                </div>
                 <center><a href="index.php"><button class="contact100-form-btn" name="log_in">
                        <span>
                            Login
                            <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                        </span>
                    </button></a></center>
              
       </form>  
    </div>


</div>


</body>
