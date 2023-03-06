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

function getRequests($type) {
    global $pdo;
    
    if ($type == 1) {
        $stmt = $pdo->prepare("SELECT * FROM `Client` WHERE ( ID % 2 ) = 0 ORDER BY time DESC");
    }

    if ($type == 2) {
        $stmt = $pdo->prepare("SELECT * FROM `Client` WHERE ( ID % 2 ) = 1 ORDER BY time DESC");
    }

    if (!$stmt->execute()) {
        printf("Сообщение ошибки: %s\n", $stmt->errorInfo());
    } else {
        return $stmt->fetchAll();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST["login"];
    $password = $_POST["password"];
    if (!empty($login) && !empty($password)) {
        $stmt = $pdo->prepare("SELECT * FROM `Manager` WHERE `username` = ?");
        if (!$stmt->execute(array($login))) {
            printf("Сообщение ошибки: %s\n", $stmt->errorInfo());
        } else {
            $user = $stmt->fetch();
            if ($user["password"] == md5($password)) {
                $_SESSION["logged_in_user_login"] = $login;
                $_SESSION["logged_in_user_password"] = md5($password);
            } else {
                header("Location: ../manager/?password=wrong");
            }
        }
    }

} elseif ($_SESSION["logged_in_user_login"]) {
    $login = $_SESSION["logged_in_user_login"];
    $password = $_SESSION["logged_in_user_password"];
    if (!empty($login) && !empty($password)) {
        $stmt = $pdo->prepare("SELECT * FROM `Manager` WHERE `username` = ?");
        if (!$stmt->execute(array($login))) {
            printf("Сообщение ошибки: %s\n", $stmt->errorInfo());
          } else {
            $user = $stmt->fetch();
            if ($user["password"] != $password) {
                session_destroy();
                header("Location: ../manager/");
            }
          }
    }

} else {
    header("Location: ../manager/");
}

if ($login == "admin1") {
    $requests = getRequests(1);
}

if ($login == "admin2") {
    $requests = getRequests(2);
}

?>

<!DOCTYPE html>
<html>
<head>
 <title>Личный кабинет</title>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" href="style.css">
 <script src="main.js" defer></script>
</head>
<body>
    <div class="container">
        <h1>Личный кабинет</h1>
        <div class="desc">
            Администратор: <b><?php printf($login) ?></b>
        </div>
        <div class="table">
            <?php for ($i = 0; $i < count($requests); ++$i): ?>
                <div class="item">
                        <div class="item__id"><?php printf($requests[$i]["id"]) ?></div>
                        <div class="item__name"><?php printf($requests[$i]["name"]) ?></div>
                        <div class="item__lastName"><?php printf($requests[$i]["lastName"]) ?></div>
                        <div class="item__phone"><?php printf($requests[$i]["phone"]) ?></div>
                        <div class="item__email"><?php printf($requests[$i]["email"]) ?></div>
                        <div class="item__date"><?php  printf(gmdate("d.m.Y", $requests[$i]["time"])); ?></div>
                        <div class="item__comment">
                            <ul>
                                <?php foreach (json_decode($requests[$i]["comment"]) as $elem): ?>
                                    <li><?php printf($elem) ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <?php echo "<button class='item__button' data-id={$requests[$i]['id']}>Добавить комментарий</button>" ?>
                        </div>
                    </div>
            <?php endfor; ?>
        </div>
    </div>
    <div class="popup-wrapper">
        <div class="popup">
            <form action="addComment.php" method="POST">
                <textarea placeholder="Введите комментарий" class="textarea" name="comment" required></textarea>
                <input type="number" class="popup__id" name="id" hidden>
                <button class="popup__button">Добавить</button>
            </form>
        </div>
        <div class="popup-wrapper-for-click"></div>
    </div>
    
</body>
</html>