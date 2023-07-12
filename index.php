<?php

    // ? se non esiste una sessione la creo
    if (session_status() === PHP_SESSION_NONE){
        session_start();
    }

    include_once __DIR__ . '/utilities/functions.php';

    define('DB_ADDRESS', 'localhost:3306');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'root');
    define('DB_NAME', 'university_98');

    $connection = new mysqli(DB_ADDRESS, DB_USERNAME, DB_PASSWORD, DB_NAME);


    if ( $connection && $connection->connect_error){
        var_dump("Failed connection with the database, with error $connection->connect_error" );
    }

    $sqlQuery = "SELECT `id`, `name` FROM departments";
    $results = $connection->query($sqlQuery);


    if (isset($_GET['email']) && isset($_GET['password'])){
        login($_GET['email'], $_GET['password'], $connection);
    }

    $connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP + SQL</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>
                    PHP & SQL with mysqli
                </h1>
            </div>
        </div>

        <?php if (!empty($_SESSION['userID']) && $_SESSION['userID'] > 0) {  ?>
            <div class="row">
                <div class="col-12">
                    <h2>
                        Benvenuto utente o utentessa!!
                    </h2>
                </div>
                <div class="col-12">

                </div>
            </div>

        <?php } else {  ?>
            <div class="row">
                <form action="./index.php" method="GET">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>

        <?php } ?>

    </div>

</body>
</html>