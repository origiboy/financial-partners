<?php
// Connect to the database
$servername = "";
$username = "";
$password = "";
$dbname = "";


$dsn = "mysql:host=$servername;dbname=$dbname";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
];

$pdo = new PDO($dsn, $username, $password, $options);


// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["firstName"];
  $lastName = $_POST["lastName"];
  $phone = $_POST["phone"];
  $email = $_POST["email"];

  // Validate data
  $time = time();
  $stmt = $pdo->prepare("INSERT INTO Client (name, lastName, phone, email, comment, time) VALUES (?, ?, ?, ?, '[]', ?)");

  if (!empty($name) && !empty($lastName) && !empty($phone) && !empty($email)) {
    
    if (!$stmt->execute(array($name, $lastName, $phone, $email, $time))) {
      printf("Сообщение ошибки: %s\n", $mysqli->error);
    } else {
      header("Location: ./?success=true");
    }
  }
}

?>