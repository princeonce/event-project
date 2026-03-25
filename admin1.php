<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
   <!-- Navbar -->
<nav class="navbar navbar-dark bg-dark fixed-top shadow">
  <div class="container-fluid">
    <a class="navbar-brand " href="#">Event Hub - Admin</a>
    <div>
      <a class="btn  text-white ms-2" data-bs-toggle="modal" data-bs-target="#signupModal">Sign Up</a>
      <a class="btn  text-white ms-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
    </div>
  </div>
</nav>




  <!-- Sign Up Modal -->
 <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="signupModalLabel">Create an Account</h5>
        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form action="index.php" method="post">

          <div class="mb-3">
            <label for="signupName" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="signupName" name="n" required>
          </div>

          <div class="mb-3">
            <label for="signupPhone" class="form-label">Mobile Number:</label>
        <input type="text" class="form-control" id="signupPhone" name="m1" placeholder="Enter Phone Number..." />
          </div>

          <div class="mb-3">
            <label for="signupEmail" class="form-label">Email</label>
            <input type="email" class="form-control" name="e" id="signupEmail" required>
          </div>
          <div class="mb-3">
            <label for="signupPassword" class="form-label">Password</label>
            <input type="password" class="form-control" name="p" id="signupPassword" required>
          </div>
          <div class="mb-3">
            <label for="signupConfirm" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="cp" id="signupConfirm" required>
          </div>
          <input type="submit" class="btn btn-dark w-100" name="x" value="Sign Up">
        </form>
        <p class="text-center mt-3">
          Already have an account?
          <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">Login</a>
        </p>
      </div>
    </div>
  </div>
</div>

<!-- signup PHP -->
<?php
if (isset($_REQUEST['x'])) {
    $conn = new mysqli("localhost", "root", "", "eventhub");

    $name= $_REQUEST['n'];
    $phone= $_REQUEST['m1'];
    $email= $_REQUEST['e'];
    $password= $_REQUEST['p'];
    $confirm= $_REQUEST['cp'];
echo"Mobile no=".$phone;
$str="insert into reg values('$name','$phone','$email','$password','$confirm')";
$conn->query($str);
?>

     <script>
    

      alert('Registration successful!');
    
  </script>
  <?php
}
?>



  <!--login php-->
  <?php
if(isset($_REQUEST["y"]))
{
$conn=new mysqli("localhost","root","","eventhub");
$p1=$_REQUEST["e"];
$p2=$_REQUEST["a"];
$str="select * from reg where email='$p1' and password='$p2'";
$result=$conn->query($str);
if($result->num_rows>0)
{
$rows=mysqli_fetch_array($result);
$_SESSION["email"]=$rows[0];
header('location:main.php');
}
else
{
?>
  <script>alert("Invalid Login!!!!");</script>
  <?php
}
}
?>

  <!-- Login Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-dark text-white">
          <h5 class="modal-title" id="loginModalLabel">Welcome Back</h5>
          <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">


          <form action="index.php">
            <div class="mb-3">
              <label for="loginEmail" class="form-label">Email</label>
              <input type="email" class="form-control" id="loginEmail" name="e" required>
            </div>
            <div class="mb-3">
              <label for="loginPassword" class="form-label">Password</label>
              <input type="password" class="form-control" id="loginPassword" name="a" required>
            </div>
            <div class="text-end mb-3">
              <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal"
                data-bs-dismiss="modal">
                Forgot Password?
              </a>
            </div>
            <input type="submit" class="btn btn-dark w-100" value="Login" name="y">
          </form>
          <p class="text-center mt-3">
            Don't have an account?
            <a href="#" data-bs-toggle="modal" data-bs-target="#signupModal" data-bs-dismiss="modal">Sign Up</a>
          </p>
        </div>
      </div>
    </div>
  </div>


  <!-- Forgot Password Modal -->
  <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-dark text-white">
          <h5 class="modal-title" id="forgotPasswordModalLabel">Reset Password</h5>
          <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form action="index.php" method="post">

            <div class="mb-3">
              <label for="forgotEmail" class="form-label">Enter your registered email</label>
              <input type="email" class="form-control" id="forgotEmail" name="forgotEmail" required>
            </div>

            <div class="mb-3">
              <label for="newPassword" class="form-label">New Password</label>
              <input type="password" class="form-control" id="newPassword" name="newPassword" required>
            </div>

            <div class="mb-3">
              <label for="confirmPassword" class="form-label">Confirm Password</label>
              <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
            </div>
            <button type="submit" class="btn btn-dark w-100" name="resetPassword">Reset Password</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!--reset password php-->
  <?php
if(isset($_REQUEST['resetPassword'])){ 
  $conn = new mysqli("localhost","root", "", "eventhub");
  $email = $_REQUEST['forgotEmail'];
  $newPassword = $_REQUEST['newPassword'];
  $confirmPassword = $_REQUEST['confirmPassword'];
  if($newPassword === $confirmPassword){
    $str = "UPDATE reg SET password='$newPassword', confirm='$confirmPassword' WHERE email='$email'";
    if($conn->query($str) === TRUE){
      ?>
  <script>alert('Password reset successful! Please login with your new password.');</script>
  <?php
    } else {
      ?>
  <script>alert('Error updating password. Please try again.');</script>
  <?php
    }
  } else {
    ?>
  <script>alert('Passwords do not match! Please try again.');</script>
  <?php
  }
}
?>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>