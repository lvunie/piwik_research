##Menu
######Purpose
######Usage
######Notes
######Piwik API Reference
######Database & Tables
######Class and Function Reference 
######API Class Detail
######Examples
######Question List


##[Purpose]
######Create code to manage "User" and "Website" as piwik administer.  

more info:  
	piwik user management: (http://piwik.org/docs/manage-users)   
	Analytics Web API :    (http://piwik.org/docs/analytics-api/)  

##[Usage]
Detail and Functions in the script might include:  

1. New piwik user creation  
2. Piwik user account management (add,edit,delete)  
3. Superuser can assign administration authority to lower user  
4. Tracking website management (add, edit, delete )   
5. Other website setting option  
6. "user" associate "website", with permission to access data, information  
7.  ...more?  


##[Notes]:
Here for adding idea or notes that came up during research

The function of this project should include: 
   
1. Access piwik database to add or modify the correspond table (Database management)  
2. Call related piwik API to get/set data.   *Call piwik API (http://developer.piwik.org/guides/querying-the-reporting-api)  
3. when there is new website added to piwik tracking, need to generate tracking code for new website
4. more....  


##[Piwik API reference]

**following modal/API is necessary to be used:

######For User Management:	
- Access;(http://developer.piwik.org/api-reference/Piwik/Access)  
- Common;(http://developer.piwik.org/api-reference/Piwik/Common)  
- Config;(http://developer.piwik.org/api-reference/Piwik/Config)  
- Date;(http://developer.piwik.org/api-reference/Piwik/Date)  
- Option;(http://developer.piwik.org/api-reference/Piwik/Option)  
- Piwik;(http://developer.piwik.org/api-reference/Piwik/Piwik)  
- Site;(http://developer.piwik.org/api-reference/Piwik/Site)  
	
######For Site Management;
- Access;(http://developer.piwik.org/api-reference/Piwik/Access)  
- Common;(http://developer.piwik.org/api-reference/Piwik/Common)  
- Date;(http://developer.piwik.org/api-reference/Piwik/Date)  
- Db;(http://developer.piwik.org/api-reference/Piwik/Db)  
- IP;(http://developer.piwik.org/api-reference/Piwik/IP)  
- MetricsFormatter;(http://developer.piwik.org/api-reference/Piwik/MetricsFormatter)  
- Option;(http://developer.piwik.org/api-reference/Piwik/Option)  
- Piwik;(http://developer.piwik.org/api-reference/Piwik/Piwik)  
- SettingsPiwik;(http://developer.piwik.org/api-reference/Piwik/SettingsPiwik)  
- SettingsServer;(http://developer.piwik.org/api-reference/Piwik/SettingsServer)  
- Site;(http://developer.piwik.org/api-reference/Piwik/Site)  
- TaskScheduler;(http://developer.piwik.org/api-reference/Piwik/TaskScheduler)  
- Url;(http://developer.piwik.org/api-reference/Piwik/Url)  
- UrlHelper;(http://developer.piwik.org/api-reference/Piwik/UrlHelper)  

Here is link for API list(http://developer.piwik.org/api-reference/classes)

##[Database & Tables]
######User database
**"piwik_user":**
The table of "piwik_user" in database stores user information include:
````````````````````````````````````````
1. login
2. password
3. alias
4. email
5. token_auth
6. superuser_access
7. date_registered
``````````````````````````````````````````````

###### Website database
**"piwik_site":**
The table of "piwik_site" in database stores website information include:
``````````````````````````````````
1. idsite
2. name
3. main_url
4. ts_created
5. ecommerce
6. sitesearch
7. sitesearch_keyword_parameters
8. sitesearch_category_parameters
9. timezone
10. currency
11. excluded_ips
12. excluded_parameters
13. excluded_user_agents
14. group
15. type
16. keep_url_fragment
``````````````````````````````````````````````

##[Class Reference]  
*Those class is necessary for reference!

#### User Manager:
**C:\xampp\htdocs\piwik\piwik\plugins\UsersManager\Model.php** 
**C:\xampp\htdocs\piwik\piwik\plugins\UsersManager\API.php** 

The UsersManager API lets you Manage Users and their permissions to access specific websites.

You can create users via "addUser", update existing users via "updateUser" and delete users via "deleteUser".
There are many ways to list users based on their login "getUser" and "getUsers", their email "getUserByEmail",
or which users have permission (view or admin) to access the specified websites "getUsersWithSiteAccess".

Existing Permissions are listed given a login via "getSitesAccessFromUser", or a website ID via "getUsersAccessFromSite",
or you can list all users and websites for a given permission via "getUsersSitesFromAccess". Permissions are set and updated
via the method "setUserAccess".
See also the documentation about <a href='http://piwik.org/docs/manage-users/' target='_blank'>Managing Users</a> in Piwik.

######Class: model    
Functions in this class
````````````````````````````````````````````````````
getUsers(array $userLogins)  
getUsersLogin()  
getUsersSitesFromAccess($access)  
getUsersAccessFromSite($idSite)  
getUsersLoginWithSiteAccess($idSite, $access)  
getSitesAccessFromUser($userLogin)  
getUser($userLogin)  
getUserByEmail($userEmail)  
getUserByTokenAuth($tokenAuth)  
addUser($userLogin, $passwordTransformed, $email, $alias, $tokenAuth, $dateRegistered)   
setSuperUserAccess($userLogin, $hasSuperUserAccess)  
getUsersHavingSuperUserAccess()  
updateUser($userLogin, $password, $email, $alias, $tokenAuth)  
userExists($userLogin)  
userEmailExists($userEmail)  
addUserAccess($userLogin, $access, $idSites)  
deleteUserOnly($userLogin)  
deleteUserAccess($userLogin, $idSites = null)  
getDb()  
``````````````````````````````````````````````

######Class: API  
Functions in this class  
``````````````````````````````````````````````
// get preference  
setUserPreference($userLogin, $preferenceName, $preferenceValue)  
getUserPreference($userLogin, $preferenceName)  
getPreferenceId($login, $preference)  
getDefaultUserPreference($preferenceName, $login)  

// user login  
getUsers($userLogins = '')  
getUsersLogin()  
getUsersSitesFromAccess($access)  
getUsersAccessFromSite($idSite)  
getUsersWithSiteAccess($idSite, $access)  
getSitesAccessFromUser($userLogin)  
getUser($userLogin)  
getUserByEmail($userEmail)  
checkLogin($userLogin)  
checkEmail($email)  
getCleanAlias($alias, $userLogin)  

//user operation  
addUser($userLogin, $password, $email, $alias = false, $_isPasswordHashed = false)  
setSuperUserAccess($userLogin, $hasSuperUserAccess)  
hasSuperUserAccess()  
getUsersHavingSuperUserAccess()  
updateUser($userLogin, $password = false, $email = false, $alias = false, $_isPasswordHashed = false)  
deleteUser($userLogin)  
  
// user status   
userExists($userLogin)  
userEmailExists($userEmail)  
setUserAccess($userLogin, $access, $idSites)  
checkUserExists($userLogin)  
checkUserEmailExists($userEmail)  
checkUserIsNotAnonymous($userLogin)  
checkUserHasNotSuperUserAccess($userLogin)  
checkAccessType($access)  
isUserTheOnlyUserHavingSuperUserAccess($userLogin)  
getTokenAuth($userLogin, $md5Password)  
`````````````````````````````````````````````````````````  

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
#### Website Manager:
**C:\xampp\htdocs\piwik\piwik\plugins\SitesManager\model.php**
**C:\xampp\htdocs\piwik\piwik\plugins\SitesManager\API.php**

The SitesManager API gives you full control on Websites in Piwik (create, update and delete), and many methods to retrieve websites based on various attributes.

This API lets you create websites via "addSite", update existing websites via "updateSite" and delete websites via "deleteSite".
When creating websites, it can be useful to access internal codes used by Piwik for currencies via "getCurrencyList", or timezones via "getTimezonesList".

There are also many ways to request a list of websites: from the website ID via "getSiteFromId" or the site URL via "getSitesIdFromSiteUrl".
Often, the most useful technique is to list all websites that are known to a current user, based on the token_auth, via
"getSitesWithAdminAccess", "getSitesWithViewAccess" or "getSitesWithAtLeastViewAccess" (which returns both).

Some methods will affect all websites globally: "setGlobalExcludedIps" will set the list of IPs to be excluded on all websites,
"setGlobalExcludedQueryParameters" will set the list of URL parameters to remove from URLs for all websites.
The existing values can be fetched via "getExcludedIpsGlobal" and "getExcludedQueryParametersGlobal".
See also the documentation about <a href='http://piwik.org/docs/manage-websites/' target='_blank'>Managing Websites</a> in Piwik.

	
######Class: Model  
Functions in this class
`````````````````````````````````````````````````````````
createSite($site)
getSitesFromGroup($group)
getSitesGroups()
getAllSites()
getSitesWithVisits($time, $now)
getAllSitesIdFromSiteUrl($url, $urlBis)
getSitesIdFromSiteUrlHavingAccess($url, $urlBis, $login)
getSitesFromTimezones($timezones)
deleteSite($idSite)
getSitesFromIds($idSites, $limit = false)
getSiteFromId($idSite)
getSitesId()
getSiteUrlsFromId($idSite)
getAliasSiteUrlsFromId($idSite)
updateSite($site, $idSite)
getUniqueSiteTimezones()
updateSiteCreatedTime($idSites, $minDateSql)
insertSiteUrl($idSite, $url)
getPatternMatchSites($ids, $pattern, $limit)
deleteSiteAliasUrls($idsite)
getDb()

`````````````````````````````````````````````````````````

######Class: API (too many, no need to display all here)  
Part of important functions in this class
```````````````````````````````````````````````````````````
getImageTrackingCode($idSite, $piwikUrl = '', $actionName = false, $idGoal = false, $revenue = false)
getSitesFromGroup($group) 
getSitesGroups()
getSiteFromId($idSite)
getModel() ???????
getSiteUrlsFromId($idSite)
getSitesId()
getAllSites()
getAllSitesId()
getSitesIdWithVisits($timestamp = false)
getSitesWithAdminAccess($fetchAliasUrls = false)
getSitesWithViewAccess()
getSitesWithAtLeastViewAccess($limit = false, $_restrictSitesToLogin = false)
getSitesIdWithAdminAccess()
getSitesIdWithViewAccess()
getSitesIdWithAtLeastViewAccess($_restrictSitesToLogin = false)
getSitesFromIds($idSites, $limit = false)
getNormalizedUrls($url)
getSitesIdFromSiteUrl($url)
getSitesIdFromTimezones($timezones)
addSite($siteName, ....)
......
`````````````````````````````````````````````````````````````  

##[API Function Detail]
######addUser(API):
`````````````````````````````````````
1. check superuser
2. check and get login name
3. check and get email
4. Verify password($_isPasswordHashed....)
5. Get alias
6. Get token_auth
7. Call model "addUseer"
8. Access::getInstance()->reloadAccess();(????)
9. Cache::deleteTrackerCache();(????)
10. Piwik::postEvent('UsersManager.addUser.end', array($userLogin, $email, $password, $alias));(????)
``````````````````````````````````````````````````

######updateUser(modify user information)
````````````````````
.........
```````````````````````````

######deleteUser
``````````````````````
..........
``````````````````````


##[Example]
**Other related example or files:**

`````````
C:\xampp\htdocs\piwik\piwik\core\Settings\.....
C:\xampp\htdocs\piwik\piwik\core\Access.php
C:\xampp\htdocs\piwik\piwik\plugins\UsersManager\....  
C:\xampp\htdocs\piwik\piwik\plugins\SitesManager\.....
```````````````
	
**example:** add a users into the piwik_users table: (http://forum.piwik.org/read.php?2,61811)
``````````````````````````````````````````````````````````````````
           $host = 'http://' . $_SERVER['HTTP_HOST'];

           //Adds new user to piwik_users using piwik API
            $httpClient = new Zend_Http_Client($host . '/piwik/index.php');
            $httpClient->setParameterGet(array(
                'module'        => 'API',
                'method'        => 'UsersManager.addUser',
                'format'        => 'PHP',
                'prettyDisplay' => 'true',
                'userLogin'     => $userSettings['username'], //username in the database
                'password'      => $userSettings['password'], //password from db
                'email'         => $dealerSettings['email_address'], //email adress from db
                'alias'         => 'Partner',
                'token_auth'    => 'ee93b283772be8fd9b4a6138ea1f336b' //admin token_auth for permission to do this API
            ));

            $permResponse = $httpClient->request();	
```````````````````````````````````````````````````````````````````

####Here is a sample for showing all users from "piwik_user" table (My local's sample)
```````````````````````````````````````````````````````````````````````
<html>

<head>

<basefont face="Arial">

</head>

<body>

<?php

// set database server access variables:

$host = "localhost";

$user = "piwik";

$pass = "password";

$db = "piwik_db_wpic";

// open connection

$connection = mysql_connect($host, $user, $pass) or die ("Unable to connect!");

// select database

mysql_select_db($db) or die ("Unable to select database!");

// create query

$query = "SELECT * FROM piwik_user";

// execute query

$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());

// see if any rows were returned

if (mysql_num_rows($result) > 0) {

    // yes

    // print them one after another

    echo "<table cellpadding=10 border=1>";

    while($row = mysql_fetch_row($result)) {

        echo "<tr>";

        echo "<td>".$row[0]."</td>";

        echo "<td>" . $row[1]."</td>";

        echo "<td>".$row[2]."</td>";
		
		echo "<td>".$row[3]."</td>";
		
		echo "<td>".$row[4]."</td>";
		
		echo "<td>".$row[5]."</td>";
		
		echo "<td>".$row[6]."</td>";

        echo "</tr>";

    }

    echo "</table>";

}

else {

    // no

    // print status message

    echo "No rows found!";

}

// free result set memory

mysql_free_result($result);

// close connection

mysql_close($connection);

?>

</body>

</html>


``````````````````````````````````````````````````````````````````````

**token_auth**
````````````````````````````````````````````````
What is the token_auth and where can I find this token to use in the API calls?

The token_auth acts as your password and is used to authenticate in API requests. You can find the token_auth by logging in Piwik, then go the page “API” by clicking on the link in the top of the screen.

The token_auth is secret and should be handled very carefully: do not share it with anyone. Each Piwik user has a different token_auth. When a user changes its password, the token_auth will be regenerated automatically.
`````````````````````````````````````````````````
####Here is the example for creating new "user"

````````````````````````````````````````````````````````````````

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

$user = "piwik";

$pass = "password";

$db = "piwik_db_wpic";

    

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

    echo "New record inserted with ID ".mysql_insert_id();

    

    // close connection

    mysql_close($connection);

}

?>


</body>

</html>
````````````````````````````````````````````````````````````````
####Here is the example for deleting "user"

````````````````````````````````````````````````````````````````
<html>

<head>

<basefont face="Arial">

</head>

<body>

<?php

// set server access variables

$host = "localhost";

$user = "piwik";

$pass = "password";

$db = "piwik_db_wpic";

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
````````````````````````````````````````````````````````````````
	
##[Other]
Other file might related with user account management in "plugin" folder

	Dashboard 
	Login 

##[Question sum up]：
1. What's the relationshoip between API.php and Model.php for both siteManager and userManager?
("Model.php" provide basic functions and called by "API.php")  

2. controller.php's?

3. Each user(not Superuser) will have a limited permission for accessing different website, so where this info store?
(check "setUserAccess" function in C:\xampp\htdocs\piwik\piwik\plugins\UsersManager\API.php  )

4. So now my ideas is: is it just need to simply create a script for inserting or modifying sql commend for "user" and "website" table that as finish user/website management?   
(User/Website operation in Piwik UI == User/website database operation???)

5. Error "Duplicate entry '' for key 'uniq_keytoken'"