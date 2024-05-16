<?php

// Check for id in the URL
// if (!isset($_GET['role'])) {
//   die('You should not access this page');
// }

// Handle query
require_once 'database.php';
if (isset($_GET['role'])) {
  $role = mysqli_real_escape_string($conn, $_GET['role']);
  // echo "Debug: role = $role";

  $query = "SELECT * FROM services WHERE role = '$role'";
} else {
  // If no role parameter, select all services
  $query = "SELECT * FROM services";
}


// $role = mysqli_real_escape_string($conn, $_GET['role']);

// $query = "SELECT * FROM services WHERE role = '$role'";

// Check if user search
if (isset($_POST['search']))
  $query .= " WHERE name LIKE '%" . $_POST['search'] . "%' or address LIKE '%" . $_POST['search'] . "%'";


$result = mysqli_query($conn, $query);

//var_dump($result);

//Check if results are found
if (mysqli_num_rows($result) == 0) {
  die('No services found for this role.');
}
$services = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_close($conn);
//var_dump($services);
?>


<table class="services-table">
  <thead>
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Address</th>
      <th>Phone Number</th>
      <th>Role</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($services as $service) : ?>
      <tr>
        <td><?= htmlspecialchars($service['name']) ?></td>
        <td><?= htmlspecialchars($service['email']) ?></td>
        <td><?= htmlspecialchars($service['address']) ?></td>
        <td><?= htmlspecialchars($service['phone_number']) ?></td>
        <td><?= htmlspecialchars($service['role']) ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>