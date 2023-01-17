<html>
<style>
table {
  border-collapse: collapse;
  width: 100%;
  margin: 0 auto;
  color: #333;
  font-family: Arial;
  font-size: 16px;
  text-align: center;
}

th {
  background-color: #C7AD7F;
  color: white;
  border: 2px solid #333;
  padding: 15px;
}

td {
  border: 3px solid #333;
  padding: 15px;
  color: #333;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

tr:hover {
  background-color: #ddd;
}

.sort-btn {
  background-color: #333;
  color: white;
  border: 1px solid #333;
  padding: 5px 10px;
  cursor: pointer;
}

.sort-btn:hover {
  background-color: #C7AD7F;
}
</style>



<?php
require_once('connection.php');


$sql = "SELECT COUNT(DISTINCT o.id) AS 'Number of Owners', COUNT(DISTINCT d.id) AS 'Number of Dogs', COUNT(DISTINCT e.id) AS 'Number of Events'
FROM owners o
JOIN dogs d ON o.id = d.owner_id
JOIN entries en ON d.id = en.dog_id
JOIN competitions c ON en.competition_id = c.id
JOIN events e ON c.event_id = e.id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row1 = $result->fetch_assoc()) {
    $numOwners = $row1["Number of Owners"];
    $numDogs = $row1["Number of Dogs"];
    $numEvents = $row1["Number of Events"];
  }
} else {
  echo "0 results";
}


echo " <h1> Welcome to Poppleton Dog Show! This year $numOwners owners entered $numDogs dogs in $numEvents events! </h1>";

?>

<br>
<h2>
Top Ten Dogs List
</h2>
</br>

<?php

// To Show Top Ten Dogs
echo "<table> ";
echo "<tr>
<th>Number</th>
 <th>Dogs Name</th> 
 <th>Breed</th>
 <th>Average Score</th>
 <th>Owner's Name</th>
 <th>Owner's Email</th>
 </tr>";


 $query= ("SELECT dogs.name AS DogsName,
 breeds.name As BreedsName,
 AVG(score) AS AvgScore,
 owners.name AS OwnersName,
 owners.email as OwnersEmail
 from dogs INNER JOIN breeds
 on dogs.breed_id=breeds.id INNER JOIN entries
 on dogs.id=entries.dog_id INNER JOIN owners on owners.id=dogs.owner_id
    
Group by dog_id HAVING COUNT(competition_id)>1   ORDER BY AVG(score) DESC LIMIT 10");

$result3 = $conn->query($query);
$number=0;
while($row = mysqli_fetch_assoc($result3))
{
    $number++; ?>
    
<table1>
    <tr>
        <td><?php echo $number; ?></td>
        <td><?php echo $row['DogsName']; ?></td>
        <td><?php echo $row['BreedsName']; ?></td>
        <td><?php echo $row['AvgScore']; ?></td>
        <td><a href="owner.php?id=<?php echo $row['OwnersName']; ?>"><?php echo $row['OwnersName']; ?></a></td>
        <td><a href="mailto:<?php echo $row['OwnersEmail']; ?>"><?php echo $row['OwnersEmail']; ?></a></td>
</tr>
    </table1>
  
<?php } ?>
 
</html>