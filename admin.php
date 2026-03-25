<?php session_start(); // Add authentication check here if needed ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Hub - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .sidebar {
            height: 100vh;
            background-color: #1f1f1f;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            padding-top: 60px;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            transition: 0.3s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #ffc107;
            color: #000;
            border-radius: 8px;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .navbar {
            background: #212529;
        }

        .navbar-brand {
            font-weight: bold;
            color: #fff !important;
        }

        .card {
            border-radius: 15px;
        }
    </style>
</head>

<body> <!-- Navbar -->
    <nav class="navbar navbar-dark fixed-top shadow">
        <div class="container-fluid"> <a class="navbar-brand" href="#">Event Hub - Admin</a>
            <div> <a href="logout.php" class="btn btn-sm btn-warning">Logout</a> </div>
        </div>
    </nav> <!-- Sidebar -->
    <div class="sidebar "> <a href="#" class="active" onclick="showTab('dashboard')"><i></i> Dashboard</a> <a href="#"
            onclick="showTab('events')"><i class="fa fa-calendar"></i> Manage Events</a> <a href="#"
            onclick="showTab('users')"><i class="fa fa-users"></i> Users</a> <a href="#"
            onclick="showTab('bookings')"><i class="fa fa-ticket"></i> Bookings</a>
        <a href="#" onclick="showTab('upcoming')"><i class="fa fa-clock"></i> Upcoming Events</a>
        <a href="#" onclick="showTab('about')"><i class="fa fa-info-circle"></i> About Event</a>

        <a href="#" onclick="showTab('settings')"><i class="fa fa-cog"></i> Settings</a>
    </div>
    <!-- Content -->
    <div class="content">
        <div class="container-fluid mt-4">
            <!-- Dashboard -->
            <div id="dashboard" class="tab-content ">
                <h2 class="mb-4">Dashboard</h2>
            </div>
          <!-- Events -->
    <div id="events" class="tab-content d-none">
      <h2 class="mb-4">Manage Events</h2>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">
        <i class="fa fa-plus"></i> Add Event
        
</button>
     <table class="table table-striped">
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
        <button class='btn btn-sm btn-primary' 
          data-bs-toggle='modal' 
          data-bs-target='#editEventModal'
          onclick='fillEditForm(".$ans['1'].",\"".$ans['0']."\",\"".$ans['2']."\",\"".$ans['3']."\",\"".$ans['4']."\",\"".$ans['5']."\",\"".$ans['6']."\",\"".$ans['7']."\",\"".$ans['8']."\")'>
          <i class='fa fa-edit'></i> Edit
        </button>
        <button class='btn btn-sm btn-danger'><i class='fa fa-trash'></i> Delete</button>
      </td>";
                  echo "</tr>";
              }
          ?>
            </tr>
        <tbody>
        </tbody>
      </table>

    </div>    

<!-- Edit event Modal -->
<div class="modal fade" id="editEventModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="admin.php" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Event</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">

          <!-- Hidden ID field -->
          
          <div class="mb-3">
            <label class="form-label">Event Title</label>
            <input type="text" name="t" id="edit_title" class="form-control" required>
          </div>
          <input type="hidden" name="edit_id" id="edit_id">

          <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="d" id="edit_date" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Time</label>
            <input type="time" name="ti" id="edit_time" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Address</label>
            <input type="text" name="a" id="edit_address" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">State</label>
            <input type="text" name="s" id="edit_state" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">City</label>
            <input type="text" name="c" id="edit_city" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Banner</label>
            <input type="file" name="i" id="edit_banner" class="form-control">
            <small>Leave blank if you don’t want to change</small>
          </div>

          <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number" name="p" id="edit_price" class="form-control" required>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" name="update_event" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- edit event-->
<?php
if (isset($_POST['update_event'])) {

    $conn = new mysqli("localhost","root","","eventhub");

    $Id      = $_POST['edit_id'];
    $Title   = $_POST['t'];
    $Date    = $_POST['d'];
    $Time    = $_POST['ti'];
    $Address = $_POST['a'];
    $State   = $_POST['s'];
    $City    = $_POST['c'];
    $Price   = $_POST['p'];

    if (empty($Id)) {
        die("Event ID missing");
    }

    // Banner handling
    if (!empty($_FILES['i']['name'])) {
        $img = $_FILES['i']['name'];
        move_uploaded_file($_FILES['i']['tmp_name'], "uploads/".$img);

        $sql = "UPDATE admin 
                SET title=?, `date`=?, `time`=?, address=?, state=?, city=?, price=?, banner=? 
                WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssisi", $Title,$Date,$Time,$Address,$State,$City,$Price,$img,$Id);
    } else {
        $sql = "UPDATE admin 
                SET title=?, `date`=?, `time`=?, address=?, state=?, city=?, price=? 
                WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssii", $Title,$Date,$Time,$Address,$State,$City,$Price,$Id);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Event updated successfully');</script>";
    } else {
        echo "<script>alert('Update failed');</script>";
    }
}
?>

<script>
function fillEditForm(id, title, date, time, address, state, city, banner, price) {
  document.getElementById("edit_id").value = id;
  document.getElementById("edit_title").value = title;
  document.getElementById("edit_date").value = date;
  document.getElementById("edit_time").value = time;
  document.getElementById("edit_address").value = address;
  document.getElementById("edit_state").value = state;
  document.getElementById("edit_city").value = city;
  document.getElementById("edit_price").value = price;
}
</script>

<!-- Add Event -->
  <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add event</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="admin.php">
      <div class="mb-3">
       <label for="eventTitle" class="form-label">Event Title</label>
      <input type="text" name="t" placeholder="Enter Title" class="form-control" id="eventTitle" required>
      </div>
      <div class="mb-3">
        <label for="eventId" class="form-label">Event ID</label>
      <input type="text" name="i_d" class="form-control" placeholder="Enter id" id="eventId" required>
      </div>
      <div class="mb-3">
        <label for="eventDate" class="form-label">Date</label>
      <input type="date"  name="d" class="form-control" id="eventDate" required>
      </div>
      <div class="mb-3">
        <label for="eventTime" class="form-label">Time</label>
      <input type="time" name="ti" class="form-control" id="eventTime" required>
      </div>
      <div class="mb-3">
        <label for="eventAddress" class="form-label">Address</label>
      <input type="text" name="a" class="form-control" id="eventAddress" placeholder="Enter Address" required>
      </div>
       <div class="col-md-4">
      <label for="inputState" class="form-label">State</label>
      <select id="inputState" name="s" class="form-select" required>
        <option value="" selected>Choose...</option>
         <option>Bihar</option>
        <option>Delhi</option>
        <option>Mumbai</option>
        <option>Bangalore</option>
      </select>
    </div>
    <div class="mb-3">
        <label for="inputCity" class="form-label">City</label>
      <input type="text" placeholder="Enter city" name="c" class="form-control" id="inputCity" required>
      </div>

      <div class="mb-3">
        <label for="inputBanner" class="form-label">Banner</label>
      <input type="file" name="i"  class="form-control" id="inputBanner" required>
      </div>
      <div class="mb-3">
         <label for="inputPrice" class="form-label">Price</label>
      <input type="number"  name="p" placeholder="Enter Price" class="form-control" id="inputPrice" required>
      </div>
      <div class="col-12">
      <button type="submit" name="y" class="btn btn-primary">Add Event</button>
    </div>
    </form>

      </div>
    </div>
  </div>
</div>
 
<!--add event php-->
        
<?php
if(isset($_REQUEST["y"]))
{
$conn=new mysqli("localhost","root","","eventhub");
$Title = $_REQUEST['t'];   
    $Id = $_REQUEST['i_d'];   
    $Date = $_REQUEST['d'];      
    $Time = $_REQUEST['ti'];     
    $Address = $_REQUEST['a'];      
    $State = $_REQUEST['s'];      
    $City = $_REQUEST['c'];      
    $Banner = $_REQUEST['i'];
    $Price = $_REQUEST['p'];

$str="insert into admin values('$Title','$Id','$Date','$Time','$Address','$State','$City','$Banner','$Price')";
$conn->query($str);

?>
<script>alert(" Saved !!!!")</script>

<?php
}
?>

 <!-- Upcoming Event -->
<div id="upcoming" class="tab-content d-none">
  <h2 class="mb-4">Upcoming Event</h2>
 <a href="#" onclick="showTab('addupcoming')"><i class="fa fa-plus-circle"></i> Add Upcoming Event</a>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Event Name</th>
        <th>Date</th>
        <th>Time</th>
        <th>Location</th>
        <th>State</th>
        <th>City</th>
        <th>Banner</th>
        <th>Price</th>
        <th>Actions</th>
      </tr>
    </thead>

    <tbody>
      <?php
      $conn = new mysqli("localhost","root","","eventhub");
      $result = $conn->query("SELECT * FROM upcoming");

      while($ans = mysqli_fetch_array($result)) {
      ?>
      <tr>
        <td><?= $ans[0] ?></td>
        <td><?= $ans[2] ?></td>
        <td><?= $ans[3] ?></td>
        <td><?= $ans[4] ?></td>
        <td><?= $ans[5] ?></td>
        <td><?= $ans[6] ?></td>
        <td>
          <img src="uploads/<?= $ans[7] ?>" height="50" width="50">
        </td>
        <td><?= $ans[8] ?></td>
        <td>
          <button class="btn btn-sm btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#editupcomingModal"
            onclick="fillUpcomingEditForm(
              <?= $ans[1] ?>,
              '<?= addslashes($ans[0]) ?>',
              '<?= $ans[2] ?>',
              '<?= $ans[3] ?>',
              '<?= addslashes($ans[4]) ?>',
              '<?= $ans[5] ?>',
              '<?= $ans[6] ?>',
              '<?= $ans[8] ?>'
            )">
            Edit
          </button>
        </td>
      </tr>
      <?php 
      }
 ?>
    </tbody>
  </table>
</div>
   

<!-- Edit upcoming Modal -->
<div class="modal fade" id="editupcomingModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <form method="post" enctype="multipart/form-data">

        <div class="modal-header">
          <h5>Update Upcoming Event</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

          <input type="hidden" name="edit_id" id="edit_id">

          <input class="form-control mb-2" name="ut" id="edit_utitle" required>
          <input type="date" class="form-control mb-2" name="ud" id="edit_udate" required>
          <input type="time" class="form-control mb-2" name="uti" id="edit_utime" required>
          <input class="form-control mb-2" name="ua" id="edit_uaddress" required>
          <input class="form-control mb-2" name="us" id="edit_ustate" required>
          <input class="form-control mb-2" name="uc" id="edit_ucity" required>
          <input type="file" class="form-control mb-2" name="ub">
          <input type="number" class="form-control mb-2" name="up" id="edit_uprice" required>

        </div>

        <div class="modal-footer">
          <button type="submit" name="update_upcoming" class="btn btn-primary">Save</button>
        </div>

      </form>

    </div>
  </div>
</div>
<script>
function fillUpcomingEditForm(id, title, date, time, address, state, city, price) {
  document.getElementById("edit_id").value = id;
  document.getElementById("edit_utitle").value = title;
  document.getElementById("edit_udate").value = date;
  document.getElementById("edit_utime").value = time;
  document.getElementById("edit_uaddress").value = address;
  document.getElementById("edit_ustate").value = state;
  document.getElementById("edit_ucity").value = city;
  document.getElementById("edit_uprice").value = price;
}
</script>



<!-- edit upcoming-->
<?php
if(isset($_POST['update_upcoming'])) {

  $conn = new mysqli("localhost","root","","eventhub");

  $sql = "UPDATE upcoming 
          SET title=?, date=?, time=?, address=?, state=?, city=?, price=?, banner=IFNULL(?,banner)
          WHERE id=?";

  $img = null;
  if(!empty($_FILES['ub']['name'])){
    $img = $_FILES['ub']['name'];
    move_uploaded_file($_FILES['ub']['tmp_name'], "uploads/".$img);
  }

  $stmt = $conn->prepare($sql);
  $stmt->bind_param(
    "ssssssisi",
    $_POST['ut'], $_POST['ud'], $_POST['uti'],
    $_POST['ua'], $_POST['us'], $_POST['uc'],
    $_POST['up'], $img, $_POST['edit_id']
  );

  $stmt->execute();
}

?>
</div>
  <!-- Add Upcoming Event -->
<div id="addupcoming" class="tab-content d-none">
  <h2 class="mb-4">Add Upcoming Event</h2>
  <form action="admin.php" method="post" enctype="multipart/form-data">

  <div class="mb-3">
    <label>Event Title</label>
    <input type="text" name="t" class="form-control" required>
  </div>

  <div class="mb-3">
    <label>Date</label>
    <input type="date" name="d" class="form-control" required>
  </div>

  <div class="mb-3">
    <label>Time</label>
    <input type="time" name="ti" class="form-control" required>
  </div>

  <div class="mb-3">
    <label>Address</label>
    <input type="text" name="a" class="form-control" required>
  </div>

  <div class="mb-3">
    <label>State</label>
    <input type="text" name="s" class="form-control" required>
  </div>

  <div class="mb-3">
    <label>City</label>
    <input type="text" name="c" class="form-control" required>
  </div>

  <div class="mb-3">
    <label>Banner</label>
    <input type="file" name="b" class="form-control" required>
  </div>

  <div class="mb-3">
    <label>Price</label>
    <input type="number" name="p" class="form-control" required>
  </div>

  <button type="submit" name="add_event" class="btn btn-primary">Save</button>
</form>

</div>
<!--add upcoming event php-->
<?php
if (isset($_POST['add_event'])) {

    $conn = new mysqli("localhost","root","","eventhub");

    $Title   = $_POST['t'];
    $Date    = $_POST['d'];
    $Time    = $_POST['ti'];
    $Address = $_POST['a'];
    $State   = $_POST['s'];
    $City    = $_POST['c'];
    $Price   = $_POST['p'];

    // Image upload
    $Banner = $_FILES['b']['name'];
    $tmp    = $_FILES['b']['tmp_name'];

    move_uploaded_file($tmp, "uploads/".$Banner);

    $sql = "INSERT INTO upcoming 
            (title, `date`, `time`, address, state, city, banner, price)
            VALUES 
            ('$Title','$Date','$Time','$Address','$State','$City','$Banner','$Price')";

    if ($conn->query($sql)) {
        echo "<script>alert('Saved Successfully!');</script>";
    } else {
        echo "<script>alert('Error!');</script>";
    }
}
?>
<!-- About Event -->
<!-- About Event -->
<div id="about" class="tab-content d-none">
  <h2 class="mb-4">About Event Hub</h2>

  <div class="row g-4">

    <!-- Intro Card -->
    <div class="col-md-12">
      <div class="card shadow-sm border-0">
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
      <div class="card shadow-sm border-0 h-100 text-center">
        <div class="card-body">
          <i class="fa fa-calendar-check fa-3x text-warning mb-3"></i>
          <h5 class="fw-bold">Event Management</h5>
          <p>Create, update, and manage all events with banners, pricing, and locations.</p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow-sm border-0 h-100 text-center">
        <div class="card-body">
          <i class="fa fa-clock fa-3x text-info mb-3"></i>
          <h5 class="fw-bold">Upcoming Events</h5>
          <p>Highlight future events separately to increase visibility and engagement.</p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow-sm border-0 h-100 text-center">
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
        <div class="card-body">
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

</div>

            <!-- Users -->
            <div id="users" class="tab-content d-none">
                <h2 class="mb-4">Manage Users</h2>
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Amit Kumar</td>
                            <td>amit@example.com</td>
                            <td>User</td>
                            <td> <button class="btn btn-sm btn-info">View</button> <button
                                    class="btn btn-sm btn-danger">Delete</button> </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Priya Sharma</td>
                            <td>priya@example.com</td>
                            <td>Admin</td>
                            <td> <button class="btn btn-sm btn-info">View</button> <button
                                    class="btn btn-sm btn-danger">Delete</button> </td>
                        </tr>
                    </tbody>
                </table>
            </div> <!-- Bookings -->
            <div id="bookings" class="tab-content d-none">
                <h2 class="mb-4">Manage Bookings</h2>
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Event</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Amit Kumar</td>
                            <td>Cultural Fest</td>
                            <td>22-09-2025</td>
                            <td><span class="badge bg-success">Confirmed</span></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Priya Sharma</td>
                            <td>Music Night</td>
                            <td>01-10-2025</td>
                            <td><span class="badge bg-warning">Pending</span></td>
                        </tr>
                    </tbody>
                </table>
            </div> 
            <!-- Settings -->
            <div id="settings" class="tab-content d-none">
                <h2 class="mb-4">Settings</h2>
                <form class="w-50">
                    <div class="mb-3"> <label class="form-label">Site Title</label> <input type="text"
                            class="form-control" value="Event Hub"> </div>
                    <div class="mb-3"> <label class="form-label">Admin Email</label> <input type="email"
                            class="form-control" value="admin@eventhub.com"> </div>
                    <div class="mb-3"> <label class="form-label">Theme</label> <select class="form-control">
                            <option>Dark</option>
                            <option>Light</option>
                        </select> </div> <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
    <script> function showTab(tabId) { document.querySelectorAll('.tab-content').forEach(tab => { tab.classList.add('d-none'); }); document.getElementById(tabId).classList.remove('d-none'); document.querySelectorAll('.sidebar a').forEach(link => { link.classList.remove('active'); }); event.target.classList.add('active'); } </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>