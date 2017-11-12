<?php>
session_start();

if(!isset($_SESSION["validated"])){
    session_destroy();
    header("Location: login.php");
    die();
}

extract($_POST);
$previousSolution = $_SESSION["solution"];

if (!isset($_SESSION["questionCount"]) || !isset($_SESSION["correctCount"])) {
    $_SESSION["questionCount"] = 0;
    $_SESSION["correctCount"] = 0;
    $_SESSION["firstNum"] = rand(0,50);
    $_SESSION["secondNum"] = rand(0,50);
    $_SESSION["operator"] = ((rand(0,1) == 0) ? "+" : "-");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Play Math Game</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="style/math.css" type="text/css" />
    <meta charset="utf-8">
</head>
<body>
    <div class="container-fluid text-center">
        <h2>Enjoy the math game!</h2>
    </div>

    <div class="container-fluid col-sm-6">
        <form class="form-horizontal" action="index.php" method="post">
            <div class="form-group">
                <?php
                if (!isset($response) || empty($response)) {
                    echo "<span class='wrong'>Please input a response.</span>";
                } else if (!is_numeric($response)) {
                    echo "<span class='wrong'>Response must be a number. Try again.</span>";
                } else if ($previousSolution == $response) {
                    echo "<span id='correct'>Correct!</span>";
                    $_SESSION["correctCount"]++;
                    $_SESSION["questionCount"]++;
                    $_SESSION["firstNum"] = rand(0,50);
                    $_SESSION["secondNum"] = rand(0,50);
                    $_SESSION["operator"] = ((rand(0,1) == 0) ? "+" : "-");
                } else {
                    echo "<span class='wrong'>Incorrect." . " " . $_SESSION["firstNum"] . " " .
                    $_SESSION["operator"] . " " . $_SESSION["secondNum"] . " is $previousSolution</span>";
                    $_SESSION["questionCount"]++;
                    $_SESSION["firstNum"] = rand(0,50);
                    $_SESSION["secondNum"] = rand(0,50);
                    $_SESSION["operator"] = ((rand(0,1) == 0) ? "+" : "-");
                }
                ?>
            </div>
            <div class="form-group">
                Question:
                <?php
                switch ($_SESSION["operator"]) {
                    case "+":
                        echo $_SESSION["firstNum"] . " " . $_SESSION["operator"] . " " . $_SESSION["secondNum"];
                        $_SESSION["solution"] = $_SESSION["firstNum"] + $_SESSION["secondNum"];
                        break;
                    case "-":
                        echo $_SESSION["firstNum"] . " " . $_SESSION["operator"] . " " . $_SESSION["secondNum"];
                        $_SESSION["solution"] = $_SESSION["firstNum"] - $_SESSION["secondNum"];
                        break;
                }
                ?>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Enter Answer" name="response" id="response">
            </div>
            <div class="text-center">
                <button class="btn btn-success" id="submit" type="submit">Submit</button>
                <a href="logout.php" class="btn btn-danger" role="button">Logout</a>
            </div>
            <div class="form-group">
                Score:
                <?php
                echo $_SESSION['correctCount'] . "/" . $_SESSION["questionCount"];
                ?>
            </div>
        </form>
    </div>
</body>
</html>
