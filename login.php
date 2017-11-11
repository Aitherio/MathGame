<?php
if (!empty($_GET['message'])){
    $error = $_GET['message'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login to Math Game</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="style/math.css" type="text/css" />
    <meta charset="utf-8">
</head>
<body>
    <div class="container-fluid text-center">
        <h2>Login to enjoy our math game</h2>
    </div>
    <div class="container-fluid col-sm-6">
        <form class="form-horizontal" role="form" action="validate.php" method="post">
            <div class="form-group">
                <?php
                    echo "<p style='color: red;'>" . $error . "</p>";
                ?>
                <label for="email">Email:</label>
                <input type="Email" class="form-control" name="email" id="email">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="text" class="form-control" name="password" id="password">
            </div>
            <div class="text-center">
                <button class="btn btn-success" id="login" type="submit">Login</button>
            </div>
        </form>
    </div>
</body>
</html>
