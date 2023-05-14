<?php

$servername = "localhost";
$username = "anas";
$password = "";
$dbname = "student";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO students (full_name, email, gender) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $full_name, $email, $gender);

$full_name = $_POST['full_name'];
$email = $_POST['email'];
$gender = $_POST['gender'];

if (!empty($full_name) && !empty($email) && !empty($gender)) {
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    echo "All fields are required.";
}

$stmt->close();
$conn->close();

?>

<h2>Registered Students</h2>

<?php

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT id, full_name, email, gender FROM students";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Name: " . $row["full_name"]. " - Email: " . $row["email"]. " - Gender: " . $row["gender"]. "<br>";
  }
} else {
  echo "error";
}
$conn->close();
?>
