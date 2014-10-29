<html>

<head>

<basefont face="Arial">

</head>

<body>

<?php

// set server access variables

$host = "localhost";

$user = "lvunie";

$pass = "40vBgV";

$db = "lvunie";

// create mysqli object

// open connection

$mysqli = new mysqli($host, $user, $pass, $db);

// check for connection errors

if (mysqli_connect_errno()) {

    die("Unable to connect!");

}

// if provided, then delete that record

if (isset($_GET['login'])) {

// create query to delete record

    $query = "DELETE FROM piwik_user WHERE login = ".$_GET['login'];

    

// execute query

    if ($mysqli->query($query)) {

    // print number of affected rows

    echo $mysqli->affected_rows." row(s) affected";

    }

    else {

    // print error message

    echo "Error in query: $query. ".$mysqli->error;

    }

}

// query to get records

$query = "SELECT * FROM piwik_user";

// execute query

if ($result = $mysqli->query($query)) {

    // see if any rows were returned

    if ($result->num_rows > 0) {

		//if(){}
        // yes

        // print them one after another

        echo "<table cellpadding=10 border=1>";

        while($row = $result->fetch_array()) {

            echo "<tr>";

            echo "<td>".$row[0]."</td>";

            echo "<td>".$row[1]."</td>";

            echo "<td>".$row[2]."</td>";
			
			echo "<td>".$row[3]."</td>";
			 
			echo "<td>".$row[4]."</td>";
			  
			echo "<td>".$row[5]."</td>";

            echo "<td><a href=".$_SERVER['PHP_SELF']."?login=".$row[0].">Delete</a></td>";

            echo "</tr>";

        }

    }

    // free result set memory

    $result->close();

}

else {

    // print error message

    echo "Error in query: $query. ".$mysqli->error;

}

// close connection

$mysqli->close();

?>



</body>

</html>