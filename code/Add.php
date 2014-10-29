
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

	login: 		<input type="text" name="login">
	password: 	<input type="text" name="password">
	alias: 		<input type="text" name="alias">
	email: 		<input type="text" name="email">

	<input type="submit" name="submit">
		
    </form>

<?php

}

else {

// form submitted

// set server access variables

$host = "localhost";

$user = "lvunie";

$pass = "40vBgV";

$db = "lvunie";

    

// get form input

    // check to make sure it's all there

    // escape input values for greater safety
	
	$login = empty($_POST['login']) ? die ("ERROR: Enter a login") : mysql_escape_string($_POST['login']);
	$password = empty($_POST['password']) ? die ("ERROR: Enter a password") : mysql_escape_string($_POST['password']);
	$alias = empty($_POST['alias']) ? die ("ERROR: Enter a alias") : mysql_escape_string($_POST['alias']);
	$email = empty($_POST['email']) ? die ("ERROR: Enter a email") : mysql_escape_string($_POST['email']);

    // open connection

    $connection = mysql_connect($host, $user, $pass) or die ("Unable to connect!");

    

    // select database

    mysql_select_db($db) or die ("Unable to select database!");

    

    // create query

    $query = "INSERT INTO piwik_user (login, password, alias, email, superuser_access) VALUES ('$login', '$password','$alias','$email',0 )";

    

    // execute query

    $result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());

    

    // print message with ID of inserted record

    echo "New user created ";

    

    // close connection

    mysql_close($connection);

}

?>


</body>

</html>