<?php
    function login($email, $password, $connection){
        if (session_status() === PHP_SESSION_NONE){
            session_start();
        }

        $encryptedPsw = md5($password);

        $parametricQuery = $connection->prepare("SELECT * FROM `users` WHERE `email` = ? AND `password` = ?;");
        $parametricQuery->bind_param('ss', $email, $encryptedPsw);
        $parametricQuery->execute();
        $results = $parametricQuery->get_result();

        if ($results && $results->num_rows > 0) {
            while($row = $results->fetch_assoc()) {
                // var_dump($row);
                echo "Benvenuta!";
                $_SESSION['userId'] = $row['id'];
                $_SESSION['userEmail'] = $row['email'];
            }
        } else {
            $_SESSION['userId'] = 0;
            $_SESSION['userEmail'] = '';
            echo "Non sei autorrizata! Mi dispiace";
        }

        session_write_close();
    }