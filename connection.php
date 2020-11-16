<?php
    function OpenCon() {
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $db = "crud";
        $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
        
        return $conn;
    }
 
    function CloseCon($conn) {
        $conn -> close();
    }
    
    function getUsers($conn) {
        $sql = "SELECT username, email, gender FROM users";
        return $conn->query($sql);
    }

    function getUser($conn, $username) {
        $sql = "SELECT username, email, gender FROM users WHERE username='$username'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $result = $result->fetch_assoc();        
            return (object) $result;
        } else {
            return false;
        }
    }

    function insertUser($conn, $username, $email, $password, $gender) {
        $password = md5($password);
        $sql = "INSERT INTO users (username, email, password, gender) values ('$username', '$email', '$password', '$gender')";
        return $conn->query($sql);
    }

    function updateUser($conn, $username, $email, $password, $gender) {
        $password = md5($password);
        $sql = "UPDATE users SET email='$email', password='$password', gender='$gender' WHERE username='$username'";
        return $conn->query($sql);
    }

    function removeUser($conn, $username) {
        $sql = "DELETE FROM users WHERE username='$username'";
        return $conn->query($sql);
    }
?>