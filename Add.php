
<html>

<head>

<basefont face="Arial">

</head>

<body>

<?php

if (!isset($_POST['submit'])) {

// form not submitted

?>



    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">

    Country: <input type="text" name="country">

    National animal: <input type="text" name="animal">

    <input type="submit" name="submit">

    </form>

<?php

}

else {

// form submitted

// set server access variables

    $host = "localhost";

    $user = "";

    $pass = "";

    $db = "test";

    

// get form input

    // check to make sure it's all there

    // escape input values for greater safety

    $country = empty($_POST['country']) ? die ("ERROR: Enter a country") : mysql_escape_string($_POST['country']);

    $animal = empty($_POST['animal']) ? die ("ERROR: Enter an animal") : mysql_escape_string($_POST['animal']);

    // open connection

    $connection = mysql_connect($host, $user, $pass) or die ("Unable to connect!");

    

    // select database

    mysql_select_db($db) or die ("Unable to select database!");

    

    // create query

    $query = "INSERT INTO symbols (country, animal) VALUES ('$country', '$animal')";

    

    // execute query

    $result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());

    

    // print message with ID of inserted record

    echo "New record inserted with ID ".mysql_insert_id();

    

    // close connection

    mysql_close($connection);

}

?>


</body>

</html>