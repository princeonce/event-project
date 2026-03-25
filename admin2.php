<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Admin Panel - Event Hub</title>
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
<nav class="navbar navbar-dark bg-dark fixed-top shadow">
  <div class="container-fluid">
    <a class="navbar-brand ">Event Hub - Admin</a>
  
  </div>
</nav>

<div class="sidebar ">
  <a href="#" class="active" onclick="showTab('dashboard')"><i ></i> Dashboard</a>
  <a href="#" onclick="showTab('events')"><i class="fa fa-calendar"></i> Manage Events</a>
  <a href="#" onclick="showTab('users')"><i class="fa fa-users"></i> Users</a>
  <a href="#" onclick="showTab('bookings')"><i class="fa fa-ticket"></i> Bookings</a>
  
</div>

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
                          <button class='btn btn-sm btn-primary mr-2'><i class='fa fa-edit'></i> Edit</button>
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


    <!-- event manage -->
    <div class="content">
  <div class="container-fluid mt-4">
              
  <div id="add event" class="container mt-500 p-4 bg-white rounded shadow-sm" style="margin-top: 80px;">
    <h2>Manage Events</h2>
    <form action="admin2.php">
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