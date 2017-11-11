<?php
session_start();
extract($_POST);

if (empty($email)) {
    header("Location: login.php?message=Please input an email.");
    die();
}

if (empty($password)) {
    header("Location: login.php?message=Please input a password.");
    die();
}

$file = fopen("credentials.config", "r");
$credArray = file("credentials.config", FILE_IGNORE_NEW_LINES);
for ($i = 0; $i < count($credArray); $i++) {
    $parts = explode(", ", $credArray[$i]);
    if ($parts[0] == $email && $parts[1] == $password) {
        $_SESSION["validated"] = true;;
    }
}

fclose($file);

if ($_SESSION["validated"]) {
    header("Location: index.php");
    die();
} else {
    header("Location: login.php?message=Invalid login credentials.");
    die();
}
?>
