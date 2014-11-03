##Menu
######Purpose
######Usage
######Piwik API Reference
######Piwik Database & Tables
######Class and Function Reference 
######API Class Detail
######Examples
######Notes
######Question List

##[Purpose]
######Create code to manage "User" and "Website" as piwik administer.    

piwik user management: (http://piwik.org/docs/manage-users)   
Analytics Web API :    (http://piwik.org/docs/analytics-api/)  

	
##[Usage]
The usage of this project might include following functions:  

1. New piwik user creation  
2. Piwik user account management (add,edit,delete)  
3. Superuser can assign administration authority to lower non-superuser  
4. Tracking website management (add, edit, delete )   
5. Other website setting option  
6. "user" associate "website", with permission to access data, information  
7.  ...more?  

*when there is new website added to piwik tracking, need to generate tracking code for new website

##[Piwik API reference]

**following piwik APIs are needed:

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


##[Piwik Database & Tables]
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

###### Access premission
```````````````````````````````````````
1. login
2. idsite
3. access
```````````````````````````````````````

##[Classes & Function Detail]  
*Those classes/script are necessary for reference!

#### For User Manager:
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

####[Function Detail]

######-- addUser(API):
`````````````````````````````````````
1. check superuser   [Piwik::checkUserHasSuperUserAccess()]
2. check user exists [checkLogin]
3. check vaild email [checkEmail]
4. Verify password   (valid input & password transfer to "TokenAuth" )
	- [Common::unsanitizeInputValue($password)]
	- [UsersManager::checkPassword($password)]
	- [UsersManager::getPasswordHash($password)]
5. Get alias         [getCleanAlias]
6. Get token_auth    [getTokenAuth]
7. Get the input value above sent them to "model.php" 
8. Set user access   [Access::getInstance()->reloadAccess()](????)
9. ????              [Cache::deleteTrackerCache()]
10. Triggered after a new user is created.  [Piwik::postEvent]
``````````````````````````````````````````````````

######-- updateUser(to modify user information)
`````````````````````````````
1. check superuser   [Piwik::checkUserHasSuperUserAccessOrIsTheUser]
2. check anonymous   [checkUserIsNotAnonymous]
3. get user info     [getUser]
4. password setting
	- if password no change, use the previous one
	- if change, password verify  
	[Common::unsanitizeInputValue]
	[UsersManager::checkPassword($password)]
	[UsersManager::getPasswordHash($password)]
	- set "passwordHasBeenUpdated" to "true"
5. set alias
6. set/check email [checkEmail]
7. Get the input value above set them to "model.php" 
8. ??? [Cache::deleteTrackerCache()]
9. [Piwik::postEvent()]
	Triggered after an existing user has been updated.
    Event notify about password change.
`````````````````````````````

######-- deleteUser
`````````````````````````````
1. check superuser   [Piwik::checkUserHasSuperUserAccess]
2. check Anonymous	 [checkUserIsNotAnonymous]
3. check user exists [userExists]
4. delete condition 
5. delete permission check [isUserTheOnlyUserHavingSuperUserAccess]
	- .....[Piwik::translate] (???)
6. delete access 
	- [deleteUserOnly]
	- [deleteUserAccess]
7. [Cache::deleteTrackerCache()](???)
`````````````````````````````
######-- setSuperUserAccess
`````````````````````````````````````
1. check superuser   [Piwik::checkUserHasSuperUserAccess]
2. check Anonymous	 [checkUserIsNotAnonymous]
3. check user exists [userExists]
4. if have superuser Authority, then [Piwik::translate]
5. [model->deleteUserAccess] (why need delete first???)
6. [model->setSuperUserAccess]
`````````````````````````````````````

######-- setUserAccess
``````````````````````````````
1. check access type    [checkAccessType]
2. check user exist		[checkUserExists]
3. check superuser		[checkUserHasNotSuperUserAccess]
4. check anonymous && administer Authority
4. in case idSites is all we grant access to all the websites on which the current connected user has an 'admin' access, in case the idSites is an integer we build an array
5. check whether idSite is empty if so, "Specify at least one website ID in &idSites="
6.  it is possible to set user access on websites only for the websites admin
    basically an admin can give the view or the admin access to any user for the websites he manages
	[Piwik::checkUserHasAdminAccess]
7. Some as last method above [model: deleteUserAccess]
8. if the access is noaccess then we don't save it as this is the default value
   when no access are specified
   - if can access[model->addUserAccess]
   - if no, build array
   - [] Piwik::postEvent
8. we reload the access list which doesn't yet take in consideration this new user access
   - [Access::getInstance()->reloadAccess()]
   - [Cache::deleteTrackerCache()]
``````````````````````````````

######-- setUserPreference
``````````````````````````````````
......
````````````````````````````````````

######-- isUserTheOnlyUserHavingSuperUserAccess
``````````````````````````````````
......
````````````````````````````````````

######-- getTokenAuth
``````````````````````````````````
Generates a unique MD5 for the given login & password
````````````````````````````````````  

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
#### For Website Manager:
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


####Functions for "website" management

######-- addSite
```````````````````````
1. check superuser      [Piwik::checkUserHasSuperUserAccess()]
2. check siteName       [checkName]
3. get url              [cleanParameterUrls]
4. check url          
	- [checkUrls]
	- [checkAtLeastOneUrl]
5. get site search(???) [checkSiteSearch]
6. list(???)
	 list($searchKeywordParameters, $searchCategoryParameters) = $this->checkSiteSearchParameters($searchKeywordParameters, $searchCategoryParameters);
7. 	(???)  [self::checkKeepURLFragmentsValue]
8. set/check time zone
9. set/check currency(?)
10. **bind()**
	- .....
11. set idSite          [getModel()->createSite($bind)]
12. set urls to idSite  [insertSiteUrls]
13. we reload the access list which doesn't yet take in consideration this new website
	- [Access::getInstance()->reloadAccess()]
	- [postUpdateWebsite]
14. Triggered after a site has been added.
	[Piwik::postEvent]

return: (int) $idSite
`````````````````````````
######-- postUpdateWebsite
````````````````````````````````
	Site::clearCache();
    Cache::regenerateCacheWebsiteAttributes($idSite);
    SiteUrls::clearSitesCache();
`````````````````````````````````

######-- deleteSite
``````````````````````````````````
1. check superuser      [Piwik::checkUserHasSuperUserAccess()]
2. get idSites 			[API::getInstance()->getSitesId()]
3. check website ID
4. ...
5. delete site          [getModel()->deleteSite]
6. we do not delete logs here on purpose (you can run these queries on the log_ tables to delete all data)
	[Cache::deleteCacheWebsiteAttributes($idSite);]
7. Triggered after a site has been deleted.
	Plugins can use this event to remove site specific values or settings, such as removing all
    goals that belong to a specific website. If you store any data related to a website you
    should clean up that information here.
	[Piwik::postEvent]

``````````````````````````````````


######-- addSiteAliasUrls
`````````````````````````````````
Add a list of alias Urls to the given idSite
If some URLs given in parameter are already recorded as alias URLs for this website,
they won't be duplicated. The 'main_url' of the website won't be affected by this method.

1. check        [Piwik::checkUserHasAdminAccess]
2. get urls 	[cleanParameterUrls]
3. check urls   [checkUrls]
4. init urls    [getSiteUrlsFromId]
5. map "urls" with "urlsInit" 
	($toInsert = array_diff($urls, $urlsInit);)
6. [insertSiteUrls]
7. [postUpdateWebsite]

return: count($toInsert);
````````````````````````````````

######-- setSiteAliasUrls
`````````````````````````````````````
Set the list of alias Urls for the given idSite
Completely overwrites the current list of URLs with the provided list.
The 'main_url' of the website won't be affected by this method.

1. check             [Piwik::checkUserHasAdminAccess]
2. get urls 	     [cleanParameterUrls]
3. check urls        [checkUrls]
4. delete alias urls [getModel()->deleteSiteAliasUrls]
5. [insertSiteUrls]
6. [postUpdateWebsite]

return: count($urls);
````````````````````````````````````
######-- setGlobalExcludedIps
````````````````````````````````````````
Sets IPs to be excluded from all websites. IPs can contain wildcards.
Will also apply to websites created in the future.
````````````````````````````````````````

######-- setGlobalSearchParameters
`````````````````````````````
Sets Site Search keyword/category parameter names, to be used on websites which have not specified these values
Expects Comma separated list of query params names
`````````````````````````````

######-- setGlobalExcludedUserAgents
`````````````````````````````
Sets list of user agent substrings to look for when excluding visits. For more info,
`````````````````````````````

######-- setSiteSpecificUserAgentExcludeEnabled
`````````````````````````````
Sets whether it should be allowed to exclude different user agents for different websites.
`````````````````````````````

######-- setKeepURLFragmentsGlobal
`````````````````````````````
    /**
     * Sets whether the default behavior should be to keep URL fragments when
     * tracking or not.
     *
     * @param $enabled bool If true, the default behavior will be to keep URL
     *                      fragments when tracking. If false, the default
     *                      behavior will be to remove them.
     */
`````````````````````````````
######-- setGlobalExcludedQueryParameters
`````````````````````````````
    /**
     * Sets list of URL query parameters to be excluded on all websites.
     * Will also apply to websites created in the future.
     *
     * @param string $excludedQueryParameters Comma separated list of URL query parameters to exclude from URLs
     * @return bool
     */
`````````````````````````````

######-- setDefaultCurrency
`````````````````````````````
Sets the default currency that will be used when creating websites
`````````````````````````````

######-- setDefaultTimezone
`````````````````````````````
Sets the default timezone that will be used when creating websites
`````````````````````````````

######-- updateSite
`````````````````````````````
    /**
     * Update an existing website.
     * If only one URL is specified then only the main url will be updated.
     * If several URLs are specified, both the main URL and the alias URLs will be updated.
     *
     * @param int $idSite website ID defining the website to edit
     * @param string $siteName website name
     * @param string|array $urls the website URLs
     * @param int $ecommerce Whether Ecommerce is enabled, 0 or 1
     * @param null|int $siteSearch Whether site search is enabled, 0 or 1
     * @param string $searchKeywordParameters Comma separated list of search keyword parameter names
     * @param string $searchCategoryParameters Comma separated list of search category parameter names
     * @param string $excludedIps Comma separated list of IPs to exclude from being tracked (allows wildcards)
     * @param null|string $excludedQueryParameters
     * @param string $timezone Timezone
     * @param string $currency Currency code
     * @param string $group Group name where this website belongs
     * @param string $startDate Date at which the statistics for this website will start. Defaults to today's date in YYYY-MM-DD format
     * @param null|string $excludedUserAgents
     * @param int|null $keepURLFragments If 1, URL fragments will be kept when tracking. If 2, they
     *                                   will be removed. If 0, the default global behavior will be used.
     * @param string $type The Website type, default value is "website"
     * @throws Exception
     * @see getKeepURLFragmentsGlobal. If null, the existing value will
     *                                   not be modified.
     *
     * @return bool true on success
     */
`````````````````````````````

######-- updateSiteCreatedTime
`````````````````````````````
Updates the field ts_created for the specified websites.
`````````````````````````````

######-- removeTrailingSlash
`````````````````````````````
Remove the final slash in the URLs if found
`````````````````````````````

######-- cleanParameterUrls
`````````````````````````````
Clean the parameter URLs:
     - if the parameter is a string make it an array
     - remove the trailing slashes if found
`````````````````````````````

######-- renameGroup
`````````````````````````````
Utility function that throws if a value is not valid for the 'keep_url_fragment'
column of the piwik_site table.
`````````````````````````````


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

####Here is a sample for showing all users from "piwik_user" table (sample from laptop localhost)
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
	
	
##[Notes]:
Here for adding idea or notes that came up during research

The function of this project should include: 
   
1. Access piwik database to add or modify the correspond table (Database management)  
2. Call related piwik API to get/set data.   *Call piwik API (http://developer.piwik.org/guides/querying-the-reporting-api)  
3. when there is new website added to piwik tracking, need to generate tracking code for new website
4. more....  


##[Question sum up]：
1. What's the relationshoip between API.php and Model.php for both siteManager and userManager?
("Model.php" provide basic functions and called by "API.php")  

2. controller.php's?

3. Each user(not Superuser) will have a limited permission for accessing different website, so where this info store?
(check "setUserAccess" function in C:\xampp\htdocs\piwik\piwik\plugins\UsersManager\API.php  )

4. So now my ideas is: is it just need to simply create a script for inserting or modifying sql commend for "user" and "website" table that as finish user/website management?   
(User/Website operation in Piwik UI == User/website database operation???)

5. Error "Duplicate entry '' for key 'uniq_keytoken'"

6. What is "user preference"? in userManager API.php