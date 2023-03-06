<?php
session_start();

$servername = "";
$username = "";
$password = "";
$dbname = "";


$dsn = "mysql:host=$servername;dbname=$dbname";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES \"UTF8\""
];

$pdo = new PDO($dsn, $username, $password, $options);

if ($_SESSION["logged_in_user_login"]) {
    $login = $_SESSION["logged_in_user_login"];
    $password = $_SESSION["logged_in_user_password"];
    $id = $_POST["id"];
    $comment = $_POST["comment"];
    if (!empty($login) && !empty($password)) {
        
        $stmt = $pdo->prepare("SELECT * FROM `Manager` WHERE `username` = ?");
        if (!$stmt->execute(array($login))) {
            printf("Сообщение ошибки: %s\n", $stmt->errorInfo());
          } else {
            $user = $stmt->fetch();
            if ($user["password"] != $password) {
                session_destroy();
                header("Location: ../manager/");
            } else {
                $stmt = $pdo->prepare("SELECT * FROM `Client` WHERE `id` = ?");
                if ($stmt->execute(array($id))) {
                    $request = $stmt->fetch();
                    $comments = json_decode($request["comment"]);
                    if ($comments == null) {
                        $comments = array();
                    }
                    array_push($comments, $comment);


                    $stmt = $pdo->prepare("UPDATE `Client` SET `comment` = ? WHERE `id` = ?");
                    $stmt->execute(array(json_encode($comments), $id));
                } 
                header("Location: ../home/");
            }
          }
    }

} else {
    header("Location: ../manager/");
}
?>