<?php
session_start();
// Add authentication check here if needed
?>
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
    .sidebar a:hover, .sidebar a.active {
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
<body>

<!-- Navbar -->
<nav class="navbar navbar-dark fixed-top shadow">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Event Hub - Admin</a>
   
  </div>
</nav>

<!-- Sidebar -->
     <div class="sidebar "> 
      <a href="#" class="active" onclick="showTab('dashboard')"><i></i> Dashboard</a> 
      <a href="#" onclick="showTab('events')"><i class="fa fa-calendar"></i> Manage Events</a> 
      <a href="#" onclick="showTab('users')"><i class="fa fa-users"></i> Users</a> 
      <a href="#" onclick="showTab('bookings')"><i class="fa fa-ticket"></i> Bookings</a> 
      <a href="#" onclick="showTab('settings')"><i class="fa fa-cog"></i> Settings</a> 
      <a href="#" onclick="showTab('upcoming')"><i class="fa fa-clock"></i> Upcoming Events</a>
  <a href="#" onclick="showTab('addupcoming')"><i class="fa fa-plus-circle"></i> Add Upcoming Event</a>
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

if(isset($_POST['update_event'])) {
    $conn = new mysqli("localhost","root","","eventhub");

    $Title   = $_POST['t'];   
    $Id      = $_POST['edit_id'];   
    $Date    = $_POST['d'];      
    $Time    = $_POST['ti'];     
    $Address = $_POST['a'];      
    $State   = $_POST['s'];      
    $City    = $_POST['c'];      
    $Price   = $_POST['p'];
$sql = "UPDATE admin SET title='$Title', date='$Date', time='$Time', address='$Address', state='$State', city='$City', price='$Price' WHERE id='$Id'";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Event updated successfully!'); </script>";
        } else {
            echo "<script>alert('Error updating event: " . $conn->error . "');</script>";
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
    <div id="add" class="tab-content d-none">
      <h2 class="mb-4">Add New Event</h2>
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
   <!-- Add Upcoming Event -->
<div id="addupcoming" class="tab-content d-none">
  <h2 class="mb-4">Add Upcoming Event</h2>
  <form action="admin.php" method="post" enctype="multipart/form-data">
       
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
            <input type="file" name="b" id="edit_banner" class="form-control" required>
          
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
<!--add upcoming event php-->
<?php
if(isset($_REQUEST["update_event"]))
{
$conn=new mysqli("localhost","root","","eventhub");
$Title   = $_REQUEST['t'];   
    $Id      = $_REQUEST['edit_id'];   
    $Date    = $_REQUEST['d'];      
    $Time    = $_REQUEST['ti'];     
    $Address = $_REQUEST['a'];      
    $State   = $_REQUEST['s'];      
    $City    = $_REQUEST['c']; 
    $Banner  =$_REQUEST['b'];     
    $Price   = $_REQUEST['p'];
$str="insert into upcoming values('$Title','$Id','$Date','$Time','$Address','$State','$City','$Banner','$Price')";
$conn->query($str);

?>
<script>alert(" Saved !!!!")</script>

<?php
}
?>

<!-- Upcoming Events -->
<div id="upcoming" class="tab-content d-none">
  <h2 class="mb-4">Upcoming Events</h2>
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
      </tr>
    </thead>
    <tbody>
      <?php
      $conn = new mysqli("localhost","root","","eventhub");
      // fetch events where date >= today
      $today = date("Y-m-d");
      $sql = "SELECT * FROM update WHERE date >= '$today' ORDER BY date ASC";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>".$row['title']."</td>";
          echo "<td>".$row['date']."</td>";
          echo "<td>".$row['time']."</td>";
          echo "<td>".$row['address']."</td>";
          echo "<td>".$row['state']."</td>";
          echo "<td>".$row['city']."</td>";
          echo "<td><img src='img/".$row['banner']."' width='50' height='50'></td>";
          echo "<td>".$row['price']."</td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='8' class='text-center'>No upcoming events found</td></tr>";
      }
      ?>
    </tbody>
  </table>
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
            <td>
              <button class="btn btn-sm btn-info">View</button>
              <button class="btn btn-sm btn-danger">Delete</button>
            </td>
          </tr>
          <tr>
            <td>2</td>
            <td>Priya Sharma</td>
            <td>priya@example.com</td>
            <td>Admin</td>
            <td>
              <button class="btn btn-sm btn-info">View</button>
              <button class="btn btn-sm btn-danger">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Bookings -->
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
        <div class="mb-3">
          <label class="form-label">Site Title</label>
          <input type="text" class="form-control" value="Event Hub">
        </div>
        <div class="mb-3">
          <label class="form-label">Admin Email</label>
          <input type="email" class="form-control" value="admin@eventhub.com">
        </div>
        <div class="mb-3">
          <label class="form-label">Theme</label>
          <select class="form-control">
            <option>Dark</option>
            <option>Light</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
      </form>
    </div>

  </div>
</div>

<script>
function showTab(tabId) {
  document.querySelectorAll('.tab-content').forEach(tab => {
    tab.classList.add('d-none');
  });
  document.getElementById(tabId).classList.remove('d-none');

  document.querySelectorAll('.sidebar a').forEach(link => {
    link.classList.remove('active');
  });
  event.target.classList.add('active');
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
