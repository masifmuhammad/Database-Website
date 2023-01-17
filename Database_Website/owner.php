<style>
  
  body {
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
  }

  header {
    background-color: #333;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 80px;
  }

  .owner-details-container {
    max-width: 600px;
    margin: auto;
    text-align: center;
  }

  .owner-details {
    list-style: none;
    padding: 0;
    display: wrap;
    justify-content: center;
  }

  .owner-details li {
    margin: 25px;
    font-size: 18px ;
    background-color: #C7AD7F;
    border: 2px solid #333;
    border-radius: 5px;
    padding: 20px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    transition: all 0.3s ease;
  }

  .owner-details li:hover {
    transform: scale(1.1);
    box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 12px 40px 0 rgba(0, 0, 0, 0.19);
  }

  .btn {
    background-color: #333;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 50px;
    transition: all 0.3s ease;
  }

  .btn:hover {
    transform: scale(1.1);
    box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 12px 40px 0 rgba(0, 0, 0, 0.19);
  }
</style>

<header>
  <h1>Owner Details</h1>
</header>

<?php
  // Include connection file
  include_once('connection.php');
  
  // Check if owner ID is set and not empty
  if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
    $details = $_REQUEST['id'];
  } else {
    die('Owner not found');
  }
  
  // Query to get owner details
  $query = "SELECT * FROM owners WHERE name='$details'";
  $output = $conn->query($query);
  $data = mysqli_fetch_array($output);
?>

<div class="owner-details-container">
  <ul class="owner-details">
    <li>Name: <?php echo $data['name']; ?></li>
    <li>Email: <a href="mailto:<?php echo $data['email'];?>"><?php echo $data['email'];?></a> </li>
    <li>Phone: <?php echo $data['phone']; ?></li>
    <li>Address: <?php echo $data['address']; ?></li>
  </ul>
  <br>
  <a href='javascript:history.back()' class='btn' > Go Back</a>
</div>
