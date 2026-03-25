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
  <nav class="navbar navbar-expand-lg bg-dark "style="display:fixed">
    <div class="container-fluid">
      <a class="navbar-brand text-white fs-3" href="#">Event Hub</a>
      <ul class="nav">
        <li class="nav-item"><a class="nav-link text-white active" href="#">Home</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="#schedule">Event</a></li>
        <li class="nav-item"><a href="#about" class="btn ">About Us</a></li>
        <li class="nav-item"><a href="#contact" class="btn ">Contact Us</a></li>
<button type="button" class="nav-link text-white" data-bs-toggle="modal" data-bs-target="#exampleModal">
  User Profile
</button>
      </ul>
    </div>
  </nav>
  <!-- User_profile -->
<div class="modal fade" id="exampleModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content shadow-lg border-0">

      <!-- Header -->
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title">
          <i class="fa fa-user-circle me-2"></i> Admin Profile
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <!-- Body -->
      <div class="modal-body bg-light">
        <div class="container">
          <div class="row g-4">

          <?php

    $conn = new mysqli("localhost","root","", "eventhub");
    $p1="SELECT * FROM reg ";
    $result = $conn->query($p1);
    if(($res=mysqli_fetch_array($result)))
    {
   ?>
   

            <!-- Profile Image -->
            <div class="col-md-4 text-center">
              <div class="card border-0 shadow-sm">
                <div class="card-body">
                  <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp"
                       class="rounded-circle img-fluid mb-3"
                       style="width: 140px;">
                  <h5 class="fw-bold mb-0"><?php echo $_SESSION['email']; ?></h5>
                  <span class="badge bg-warning text-dark mt-2">Administrator</span>
                </div>
              </div>
            </div>

            <!-- Profile Details -->
            <div class="col-md-8">
              <div class="card border-0 shadow-sm">
                <div class="card-body">

                  <div class="row mb-3">
                    <div class="col-sm-4 fw-bold">
                      <i class="fa fa-user me-2 text-primary"></i> Full Name
                    </div>
                    <div class="col-sm-8 text-muted">
                      <?php echo $_SESSION['email']; ?>
                    </div>
                  </div>
                  <hr>

                  <div class="row mb-3">
                    <div class="col-sm-4 fw-bold">
                      <i class="fa fa-envelope me-2 text-danger"></i> Email
                    </div>
                    <div class="col-sm-8 text-muted">
                      <?php echo $res[1]; ?>
                    </div>
                  </div>
                  <hr>

                  <div class="row mb-3">
                    <div class="col-sm-4 fw-bold">
                      <i class="fa fa-phone me-2 text-success"></i> Phone
                    </div>
                    <div class="col-sm-8 text-muted ">
                      <?php echo $res[2]; ?>
                    </div>
                  </div>
                  <hr>

                  <div class="row">
                    <div class="col-sm-4 fw-bold">
                      <i class="fa fa-map-marker-alt me-2 text-warning"></i> Address
                    </div>
                    <div class="col-sm-8 text-muted">
                      Bay Area, San Francisco, CA
                    </div>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

      <div class="modal-footer bg-light">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<?php
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
  <section id="explore-events" class="py-5 bg-dark text-white">
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
              <a href="#upcoming-events" class="btn btn-primary btn-sm">View Events</a>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6">
          <div class="card text-center h-100 shadow-sm explore-card">
            <img src="img/workshop.webp" class="card-img-top" alt="Workshop">
            <div class="card-body">
              <h5 class="card-title">Workshops</h5>
              <p class="card-text">Learn new skills from expert-led sessions.</p>
              <a href="#upcoming-events" class="btn btn-primary btn-sm">View Events</a>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6">
          <div class="card text-center h-100 shadow-sm explore-card">
            <img src="img/seminar.jpg" class="card-img-top" alt="Seminar">
            <div class="card-body">
              <h5 class="card-title">Seminars & Talks</h5>
              <p class="card-text">Engage with inspiring speakers and thought leaders.</p>
              <a href="#upcoming-events" class="btn btn-primary btn-sm">View Events</a>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6">
          <div class="card text-center h-100 shadow-sm explore-card">
            <img src="img/esport.jpg" class="card-img-top" alt="Sports">
            <div class="card-body">
              <h5 class="card-title">E-Sports</h5>
              <p class="card-text">Join thrilling sports matches and tournaments.</p>
              <a href="#upcoming-events" class="btn btn-primary btn-sm">View Events</a>
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
          
          <td>
          <img src="uploads/<?= $rows[7] ?>" class="card-img-top"  style="height: 200px; object-fit: cover;">
        </td>

          <div class="card-body d-flex flex-column">
            <h5 class="card-title"><?php echo $rows[0]; ?></h5>
            <p class="card-text"><?php echo $rows[2]; ?> <br> <?php echo $rows[4]; ?></p>
            <a href="#" class="btn btn-primary mt-auto w-100"><?php echo $rows[0]; ?> Coming Soon!</a>
          </div>

        </div>
      </div>

    <?php 
    } ?>

  </div>
</div>

      </div>
    </div>
  </div>
  <hr>

  
 

  <!--event schedule-->
  <section id="schedule" class="py-20 bg-gray-800">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-center mb-5">Event Schedule</h2>
            <div class="overflow-x-auto" >
                <table class="w-full bg-gray-700 rounded-lg text-center" style="max-height: 400px; overflow-y: auto;justify-content: center;">
                    <thead>
          <tr class="bg-gray-600">
              <th class="py-3 px-4">Event Name</th>
              <th class="py-3 px-4">Date</th>
              <th class="py-3 px-4">Time</th>
              <th class="py-3 px-4">Location</th>
              <th class="py-3 px-4">State</th>
              <th class="py-3 px-4">City</th>
              <th class="py-3 px-4">Banner</th>
              <th class="py-3 px-4">Price</th>
              <th class="py-3 px-4">Actions</th>
            </tr>
        </thead>
         <?php
          $conn = new mysqli("localhost", "root", "", "eventhub"); // Change DB name

          $sql = "SELECT * FROM admin"; // Change table name
          $result = $conn->query($sql);
          $i=1;
          $row=$result->num_rows;
              while ($ans=mysqli_fetch_array($result)) {
                  echo "<tr class='border-b border-gray-500 '>";
                  echo "<td class='py-3 px-4'>" . $ans['0'] . "</td>";
                  echo "<td class='py-3 px-4'>" . $ans['2'] . "</td>";
                  echo "<td class='py-3 px-4'>" . $ans['3'] . "</td>";
                  echo "<td class='py-3 px-4'>" . $ans['4'] . "</td>";
                   echo "<td class='py-3 px-4'>" . $ans['5'] . "</td>";
                    echo "<td class='py-3 px-4'>" . $ans['6'] . "</td>";
                     echo "<td class='py-3 px-4'><img src='img/".$ans['7']."' height='50' width='50'></td>";
                      echo "<td class='py-3 px-4'>" . $ans['8'] . "</td>";
                  echo "<td class='py-3 px-4'>
                          <button class='btn btn-sm btn-primary mr-2' data-bs-toggle='modal' data-bs-target='#staticBackdrop'><i class='bi bi-ticket'></i> Book</button>
                        </td>";
                  echo "</tr>";
              }
          ?>
            </tr>
                </table>
            </div>
        </div>
    </section>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Book</button>
      </div>
    </div>
  </div>
</div>
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
            <form action="main.php">
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
<hr>
 <!--about section-->
  <section id="about" class=" bg-white text-dark">
    <div class="container">
      <h2 class="text-4xl font-bold text-center mb-5">About the Event</h2>

      <div class="row g-4">

    <!-- Intro Card -->
    <div class="col-md-12 ">
      <div class="card shadow-sm border-0 bg-light">
        <div class="card-body">
          <h4 class="fw-bold text-primary">Event Hub – Event Management System</h4>
          <p class="mt-2">
            Event Hub is a centralized platform designed to manage, organize, and promote events efficiently.
            It allows administrators to control event listings, upcoming events, bookings, and users from a
            single dashboard.
          </p>
        </div>
      </div>
    </div>

    <!-- Features -->
    <div class="col-md-4">
      <div class="card shadow-sm border-0 h-100 text-center bg-light ">
        <div class="card-body">
          <i class="fa fa-calendar-check fa-3x text-warning mb-3"></i>
          <h5 class="fw-bold">Event Management</h5>
          <p>Create, update, and manage all events with banners, pricing, and locations.</p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow-sm border-0 h-100 text-center bg-light">
        <div class="card-body">
          <i class="fa fa-clock fa-3x text-info mb-3"></i>
          <h5 class="fw-bold">Upcoming Events</h5>
          <p>Highlight future events separately to increase visibility and engagement.</p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow-sm border-0 h-100 text-center  bg-light">
        <div class="card-body">
          <i class="fa fa-users fa-3x text-success mb-3"></i>
          <h5 class="fw-bold">User & Booking Control</h5>
          <p>Manage registered users, bookings, and event participation seamlessly.</p>
        </div>
      </div>
    </div>

    <!-- Stats -->
    <div class="col-md-12">
      <div class="card shadow-sm border-0">
        <div class="card-body bg-light">
          <div class="row text-center">
            <div class="col-md-3">
              <h3 class="text-primary fw-bold">100+</h3>
              <p>Total Events</p>
            </div>
            <div class="col-md-3">
              <h3 class="text-success fw-bold">50+</h3>
              <p>Upcoming Events</p>
            </div>
            <div class="col-md-3">
              <h3 class="text-warning fw-bold">1K+</h3>
              <p>Users</p>
            </div>
            <div class="col-md-3">
              <h3 class="text-danger fw-bold">500+</h3>
              <p>Bookings</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Mission -->
    <div class="col-md-12">
      <div class="card shadow-sm border-0 bg-light">
        <div class="card-body">
          <h5 class="fw-bold">Our Mission</h5>
          <p>
            To simplify event management by providing a powerful, easy-to-use platform
            that connects organizers and attendees while ensuring smooth operations and
            memorable experiences.
          </p>
        </div>
      </div>
    </div>

  </div>
    </div>
  </section>

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