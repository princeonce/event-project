<?php ob_start(); ?>
<?php session_start(); ?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Event Hub</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

  <!-- Custom CSS -->
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
    }

    .explore-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .explore-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .explore-card img {
      height: 200px;
      object-fit: cover;
    }

    /* Navbar */

    .navbar a {
      color: white !important;
      font-weight: 500;
    }

    .navbar-brand {
      font-weight: 700;
      letter-spacing: 1px;
    }

    /* Carousel Text */
    .carousel-caption h5 {
      font-size: 2rem;
      font-weight: bold;
      text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.8);
    }

    .carousel-caption form {
      background: rgba(0, 0, 0, 0.5);
      padding: 15px;
      border-radius: 10px;
    }

    /* Cards */
    .card {
      border: none;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-8px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .card img {
      object-fit: cover;
      height: 200px;
    }

    /* Buttons */
    .btn-primary {
      background: linear-gradient(90deg, #0d6efd, #6610f2);
      border: none;
      font-weight: 600;
      textdecoration: none;
    }

    .btn-primary:hover {
      background: linear-gradient(90deg, #6610f2, #0d6efd);
    }

    .carousel-item {
      height: 60vh;
    }



    /* Footer */
    footer {
      background: rgba(59, 58, 58, 0.99);
      color: white;
    }

    footer h5 {
      font-weight: 600;
    }

    footer a {
      color: #ffc107;
      text-decoration: none;
    }

    footer a:hover {
      text-decoration: underline;
    }

    .carousel-img {
      height: 20%;
      object-fit: cover;
    }

    .card-hover:hover {
      transform: translateY(-10px);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand text-white fs-3" href="#">Event Hub</a>
      <ul class="nav">
        <li class="nav-item"><a class="nav-link text-white active" href="#">Home</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="#schedule">Event</a></li>
        <li class="nav-item"><a href="#about" class="btn ">About Us</a></li>
          
        <li class="nav-item">
          <a class="btn  text-dark ms-2" data-bs-toggle="modal" data-bs-target="#signupModal">Sign Up</a>
        </li>
        <li class="nav-item">
          <a class="btn  text-dark ms-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- Sign Up Modal -->
  <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="signupModalLabel">Create an Account</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form action="index.php">
            <div class="mb-3">
              <label for="signupName" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="signupName" name="n" required>
            </div>
            <div class="mb-3">
              <label for="signupEmail" class="form-label">Email</label>
              <input type="email" class="form-control" name="e" id="signupEmail" required>
            </div>
             <div class="mb-3">
              <label for="phone" class="form-label">Phone</label>
              <input type="text" class="form-control" name="ph" id="phone" required>
            </div>
            <div class="mb-3">
              <label for="signupPassword" class="form-label">Password</label>
              <input type="password" class="form-control" name="p" id="signupPassword" required>
            </div>
            <div class="mb-3">
              <label for="signupConfirm" class="form-label">Confirm Password</label>
              <input type="password" class="form-control" name="cp" id="signupConfirm" required>
            </div>
            <input type="submit" class="btn btn-primary w-100" name="x"></button>
          </form>
          <p class="text-center mt-3">
            Already have an account?
            <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">Login</a>
          </p>
        </div>
      </div>
    </div>
  </div>
  <?php
if(isset($_REQUEST['x'])){
  $conn = new mysqli("localhost","root", "", "eventhub");
  $name = $_REQUEST['n'];
  $email = $_REQUEST['e'];
  $phone = $_REQUEST['ph'];
  $password = $_REQUEST['p'];
  $confirm = $_REQUEST['cp'];
$str="insert into reg values('$name','$email','$phone','$password','$confirm')";
$conn->query($str);
?>
  <script>
    if ($password == $confirm) {

      alert('Registration successful!');
    } else {
      alert('Passwords do not match!');
    }
  </script>
  <?php
}
?>
  <!-- Login Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title" id="loginModalLabel">Welcome Back</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form action="index.php">
            <div class="mb-3">
              <label for="loginEmail" class="form-label">Email</label>
              <input type="email" class="form-control" id="loginEmail" name="e" required>
            </div>
            <div class="mb-3">
              <label for="loginPassword" class="form-label">Password</label>
              <input type="password" class="form-control" id="loginPassword" name="p" required>
            </div>
           <div class="text-end mb-3">
  <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal" data-bs-dismiss="modal">
    Forgot Password?
  </a>
</div>
            <input type="submit" class="btn btn-primary w-100" value="Login" name="a">
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
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning text-dark">
        <h5 class="modal-title" id="forgotPasswordModalLabel">Reset Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
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
          <button type="submit" class="btn btn-primary w-100" name="resetPassword">Reset Password</button>
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





  <!--login php-->
  <?php
if(isset($_REQUEST["a"]))
{
$conn=new mysqli("localhost","root","","eventhub");
$p1=$_REQUEST["e"];
$p2=$_REQUEST["p"];
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



  

  <!-- Carousel -->
  <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <!-- Slide 1 -->
      <div class="carousel-item active">
        <img src="img/wedding.jpg" class="d-block w-100 carousel-img" alt="Wedding Event" style="height: 100%;">
        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center h-100">
          <h5>Find and Join Exciting Events</h5>
          <form class="d-flex mt-3">
            <input class="form-control me-2" type="search" placeholder="Search events">
            <input class="form-control me-2" type="date">
            <button class="btn btn-warning">Search</button>
          </form>
        </div>
      </div>

      <!-- Slide 2 -->
      <div class="carousel-item">
        <img src="img/Wedding-Event.webp" class="d-block w-100 carousel-img" alt="Discover Events"
          style="height: 100%;">
        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center h-100">
          <h5>Discover, Book, and Enjoy</h5>
          <form class="d-flex mt-3">
            <input class="form-control me-2" type="search" placeholder="Search events">
            <input class="form-control me-2" type="date">
            <button class="btn btn-warning">Search</button>
          </form>
        </div>
      </div>

      <!-- Slide 3 -->
      <div class="carousel-item">
        <img src="img/memorable.jpg" class="d-block w-100 carousel-img" alt="Party Event" style="height: 100%;">
        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center h-100">
          <h5>Enjoy Memorable Moments</h5>
          <form class="d-flex mt-3">
            <input class="form-control me-2" type="search" placeholder="Search events">
            <input class="form-control me-2" type="date">
            <button class="btn btn-warning">Search</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>



  <!-- Home Section -->
  <section id="home" class="py-5 bg-light">
    <div class="container">
      <div class="row align-items-center">
        <!-- Left Text -->
        <div class="col-md-6 mb-4 mb-md-0">
          <h2 class="fw-bold mb-3">Welcome to Event Hub</h2>
          <p class="text-muted">
            Event Hub is your go-to platform for discovering, booking, and enjoying the best events around you.
            Whether it's a college fest, seminar, workshop, or cultural night — we connect you with the moments
            that matter. Join a vibrant community, explore exciting opportunities, and never miss out on the fun.
          </p>
          <a href="#explore-events" class="btn btn-primary mt-3">Explore Events</a>
          <a href="#upcoming-events" class="btn btn-secondary mt-3 ms-2">Upcoming Events</a>
          <a href="#contact" class="btn btn-success mt-3 ms-2">Contact Us</a>
          <a href="#about" class="btn btn-info mt-3 ms-2">About Us</a>
        </div>
        <!-- Right Image -->
        <div class="col-md-6">
          <img src="img/i8.jpg" alt="Welcome to Event Hub" class="img-fluid rounded shadow">
        </div>
      </div>
    </div>
  </section>
  <hr>
  <!-- Explore Events Section -->
  <section id="explore-events" class="py-5 bg-dark text-white" ">
    <div class="container">
      <h2 class="text-center fw-bold mb-4">Explore Events</h2>
      <p class="text-center text-white mb-5">
        Discover the best events in town — music, sports, workshops, and more.
      </p>
      <div class="row g-4">

        <div class="col-md-3 col-sm-6">
          <div class="card text-center h-100 shadow-sm explore-card">
            <img src="img/music event.jpg" class="card-img-top" alt="Music Event">
            <div class="card-body">
              <h5 class="card-title">Music & Concerts</h5>
              <p class="card-text">Enjoy live performances and music festivals.</p>
              
              <a href="" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#loginModal" onclick="alert('Login first to view events!!')">View Events</a>
              
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6">
          <div class="card text-center h-100 shadow-sm explore-card">
            <img src="img/workshop.webp" class="card-img-top" alt="Workshop">
            <div class="card-body">
              <h5 class="card-title">Workshops</h5>
              <p class="card-text">Learn new skills from expert-led sessions.</p>
              <a href="#upcoming-events" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#loginModal" onclick="alert('Login first to view events!!')">View Events</a>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6">
          <div class="card text-center h-100 shadow-sm explore-card">
            <img src="img/seminar.jpg" class="card-img-top" alt="Seminar">
            <div class="card-body">
              <h5 class="card-title">Seminars & Talks</h5>
              <p class="card-text">Engage with inspiring speakers and thought leaders.</p>
              <a href="#upcoming-events" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#loginModal" onclick="alert('Login first to view events!!')">View Events</a>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6">
          <div class="card text-center h-100 shadow-sm explore-card">
            <img src="img/esport.jpg" class="card-img-top" alt="Sports">
            <div class="card-body">
              <h5 class="card-title">E-Sports</h5>
              <p class="card-text">Join thrilling sports matches and tournaments.</p>
              <a href="#upcoming-events" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#loginModal" onclick="alert('Login first to view events!!')">View Events</a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <hr>
  <!-- Upcoming Events -->
  <div id="upcoming-events" class="py-5">
    <div class="container">
      <h2 class="text-center mb-4">Upcoming Events</h2>
      <p class="text-center text-muted mb-5">
        Don't miss out on the exciting events happening soon. Join us and be part of the action!
      </p>
    </div>

<?php
$conn = new mysqli("localhost","root","","eventhub");
$str  = "SELECT * FROM upcoming";
$res  = $conn->query($str);
?>

<div class="container">
  <div class="row">

    <?php while ($rows = mysqli_fetch_array($res)) { ?>

      <div class="col-md-4 mb-4">
        <div class="card h-100" style="margin:20px;">
          
          <img src="img/<?php echo $rows[7]; ?>" class="card-img-top" alt="Event Image">

          <div class="card-body d-flex flex-column">
            <h5 class="card-title"><?php echo $rows[0]; ?></h5> <br>
            <p class="card-text"><?php echo $rows[2]; ?> <br> <?php echo $rows[4]; ?></p>
            <a href="#" class="btn btn-primary mt-auto w-100"  data-bs-toggle="modal" data-bs-target="#loginModal" onclick="alert('Login first to book events!!')">Join <?php echo $rows[0]; ?> Event</a>
          </div>

        </div>
      </div>

    <?php 
    }
     ?>

  </div>
</div>

      </div>
    </div>
  </div>
  <hr>
  
  <!--about section-->
  <section id="about" class="py-5 bg-dark text-white ">
    <div class="container">
      <h2 class="text-4xl font-bold text-center mb-5">About the Event</h2>

      <div class="row g-3">

       <div class="col-md-3 col-sm-6">
          <div class="card text-center h-100 shadow-sm explore-card">
            <img
              src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/ddf01f53-2bfe-4ad1-8a51-c9d397b622ab.png"
              alt="Diverse group of innovators collaborating around a conference table discussing AI project ideas with laptops and whiteboards visible"
              class="mb-4 rounded" />
            <h3 class="text-xl font-semibold mb-2">Networking</h3>
            <p>Connect with industry leaders, innovators, and thought leaders in AI and technology.</p>
          </div>
        </div>

        
        <div class="col-md-3 col-sm-6">
          <div class="card text-center h-100 shadow-sm explore-card">
            <img
              src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/ddf01f53-2bfe-4ad1-8a51-c9d397b622ab.png"
              alt="Diverse group of innovators collaborating around a conference table discussing AI project ideas with laptops and whiteboards visible"
              class="mb-4 rounded" />
            <h3 class="text-xl font-semibold mb-2">Networking</h3>
            <p>Connect with industry leaders, innovators, and thought leaders in AI and technology.</p>
          </div>
        </div>

        <div class="col-md-3 col-sm-6">
          <div class="card text-center h-100 shadow-sm explore-card">
            <img
                src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/43a726e5-2c97-4b62-9fec-6ab65abd7c31.png"
                alt="Dynamic presentation on stage with speaker using interactive neural network visualization on a giant screen"
                class="mb-4 rounded" />
              <h3 class="text-xl font-semibold mb-2">Keynote Sessions</h3>
              <p>World-renowned speakers sharing insights on the future of AI and its implications.</p>
          </div>
        </div>

       <div class="col-md-3 col-sm-6">
          <div class="card text-center h-100 shadow-sm explore-card">
             <img
                src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/8115e26a-d038-4b5a-a07b-e5185e740eeb.png"
                alt="Interactive workshop where participants are building AI prototypes on their devices in a collaborative environment"
                class="mb-4 rounded" />
              <h3 class="text-xl font-semibold mb-2">Workshops</h3>
              <p>Hands-on sessions to dive deep into AI development and emerging technologies.</p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <section id="schedule" class="py-20 bg-gray-800">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-center mb-5">Event Schedule</h2>
            <div class="overflow-x-auto" >
                <table class="w-full bg-gray-700 rounded-lg text-center" style="max-height: 400px; overflow-y: auto;justify-content: center;">
                    <thead>
                        <tr class="bg-gray-600">
                            <th class="py-3 px-4">Time</th>
                            <th class="py-3 px-4">Session</th>
                            <th class="py-3 px-4">Speaker</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-500">
                            <td class="py-3 px-4">9:00 AM</td>
                            <td class="py-3 px-4">Opening Keynote: AI Revolution</td>
                            <td class="py-3 px-4">Dr. Sophia Chen</td>
                        </tr>
                        <tr class="border-b border-gray-500">
                            <td class="py-3 px-4">11:00 AM</td>
                            <td class="py-3 px-4">Machine Learning Workshop</td>
                            <td class="py-3 px-4">Alex Rodriguez</td>
                        </tr>
                        <tr class="border-b border-gray-500">
                            <td class="py-3 px-4">2:00 PM</td>
                            <td class="py-3 px-4">Ethics in AI</td>
                            <td class="py-3 px-4">Maya Patel</td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4">4:00 PM</td>
                            <td class="py-3 px-4">Closing Panel</td>
                            <td class="py-3 px-4">Panel of Experts</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
<hr>


  <!-- Contact Us Section -->
  <section id="contact" class="py-5 bg-light">
    <div class="container">
      <h2 class="text-center fw-bold mb-4">Contact Us</h2>
      <p class="text-center text-muted mb-5">
        Have questions or want to collaborate? We’d love to hear from you!
      </p>
      <div class="row g-4">
        <!-- Contact Info -->
        <div class="col-md-5">
          <div class="bg-white p-4 rounded shadow-sm h-100">
            <h5 class="mb-3">Get in Touch</h5>
            <p><strong>Email:</strong> <a href="mailto:princeonce2@gmail.com">princeonce2@gmail.com</a></p>
            <p><strong>Phone:</strong> +91 8541098445</p>
            <p><strong>Address:</strong> Bihar, India</p>
            <hr>
            <h6>Follow Us</h6>
            <a href="#" class="me-3 text-dark"><i class="bi bi-facebook"></i></a>
            <a href="#" class="me-3 text-dark"><i class="bi bi-instagram"></i></a>
            <a href="#" class="me-3 text-dark"><i class="bi bi-twitter"></i></a>
          </div>
        </div>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Contact Form -->
        <div class="col-md-7">
          <div class="bg-white p-4 rounded shadow-sm">
            <form action="index.php">
              <div class="mb-3">
                <label for="contactName" class="form-label">Your Name</label>
                <input type="text" class="form-control" id="contactName" name="n" placeholder="Enter your name" required>
              </div>
              <div class="mb-3">
                <label for="contactEmail" class="form-label">Your Email</label>
                <input type="email" class="form-control" id="contactEmail" placeholder="Enter your email"  name="e"required>
              </div>
              <div class="mb-3">
                <label for="contactMessage" class="form-label">Message</label>
                <textarea class="form-control" id="contactMessage" rows="4" placeholder="Write your message..." name="m"
                  required></textarea>
              </div>
              <button type="submit" class="btn btn-primary w-100" name="y">Send Message</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php
if(isset($_GET['y'])){
  $conn = new mysqli("localhost","root", "", "eventhub");
  $name = $_GET['n'];
  $email = $_GET['e'];
  $message = $_GET['m'];
  
$str="insert into contact values('$name','$email','$message')";
$conn->query($str);
?>
  <script>
      alert('Message sent successfully!');
  </script>
  <?php
}
?>

  <!-- Footer -->
  <footer class="mt-5 p-4">
    <div class="row">
      <div class="col-md-4">
        <h5>About Us</h5>
        <p>Event Hub isn't just about organizing events—it's about creating moments that matter.</p>
      </div>
      <div class="col-md-4">
        <h5>Quick Links</h5>
        <a href="#">Home</a><br>
        <a href="#about">About</a><br>
        <a href="#contact">Contact</a>
      </div>
      <div class="col-md-4">
        <h5>Contact</h5>
        <p>Email: princeonce2@gmail.com</p>
        <p>Phone: +91 8541098445</p>
        <p>Bihar, India</p>
      </div>
    </div>
    <div class="text-center mt-3">
      © 2025 Event Hub. All Rights Reserved.
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>