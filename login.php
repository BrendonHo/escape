<?php

session_start();

$username = $_POST['username'];
$password = $_POST['password'];
$hostName = 'localhost';
$dbUserName = 'id6511594_username';
$dbPassword = 'password';
$databaseName = 'id6511594_login_information';

if ($username && $password)
{
    $connect = mysqli_connect($hostName, $dbUserName, $dbPassword, $databaseName) or die ("Couldn't connect to database");

    $query = mysqli_query($connect, "SELECT * FROM users WHERE username='$username'");

    $numrows = mysqli_num_rows($query);

    if($numrows)
    {
        while ($row = mysqli_fetch_assoc($query))
        {
            $dbuser = $row['username'];
            $dbpass = $row['password'];
        }

        if ($username==$dbuser && $password==$dbpass)
        {
            echo "Login successful. <a href='loggedin.php'>Click here to return to home page</a>";
            $_SESSION['username']=$dbuser;
        
        }
        else
        {
            echo "Incorrect password";
        }
    }

    else
    {
        die ("That username doesn't exist");
    }
}

else if (!$username && !$password)
{
    die ("Please enter a username and password");
}

else if (!$username)
{
    die ("Please enter a username");
}

else if (!$password)
{
    die ("Please enter a password");
}

?>
