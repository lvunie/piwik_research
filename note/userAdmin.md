
####Goal: create code to manage "User" and "Website" as piwik administer.
more info:  
	piwik user management: (http://piwik.org/docs/manage-users)   
	Analytics Web API :    (http://piwik.org/docs/analytics-api/)  

#####Detail and Functions in the script might include:
1. New piwik user creation  
2. Piwik user account management (add,edit,delete)  
3. Superuser can assign administration authority to lower user  
4. Tracking website management (add, edit, delete )   
5. Other website setting option  
6. "user" associate "website", with permission to view data, information  
7.  ...more?  
  
**Attention: when there is new website added to piwik tracking, need to generate tracking code for new website

##Key notes:
The function of this project should include: 
   
1. Access piwik database to add or modify the correspond table (Database management)  
2. Call piwik API to get/set data.   *Call piwik API (http://developer.piwik.org/guides/querying-the-reporting-api)  
3. more....  


**following modal/API might be use in the project:

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


##Reference class  
*Those class is necessary for reference!

### User Manager:
**C:\xampp\htdocs\piwik\piwik\plugins\UsersManager\Model.php** 
**C:\xampp\htdocs\piwik\piwik\plugins\UsersManager\API.php** 
 
######Class: model  

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

### Website Manager:
**C:\xampp\htdocs\piwik\piwik\plugins\SitesManager\model.php**
**C:\xampp\htdocs\piwik\piwik\plugins\SitesManager\API.php**
######Class: Model
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
addSite($siteName,
                            $urls,
                            $ecommerce = null,
                            $siteSearch = null,
                            $searchKeywordParameters = null,
                            $searchCategoryParameters = null,
                            $excludedIps = null,
                            $excludedQueryParameters = null,
                            $timezone = null,
                            $currency = null,
                            $group = null,
                            $startDate = null,
                            $excludedUserAgents = null,
                            $keepURLFragments = null,
                            $type = null)
postUpdateWebsite($idSite)
deleteSite($idSite)
checkAtLeastOneUrl($urls)
checkValidTimezone($timezone)
checkValidCurrency($currency)
checkAndReturnType($type)
checkAndReturnExcludedIps($excludedIps)
addSiteAliasUrls($idSite, $urls)
setSiteAliasUrls($idSite, $urls = array())
getIpsForRange($ipRange)
setGlobalExcludedIps($excludedIps)
setGlobalSearchParameters($searchKeywordParameters, $searchCategoryParameters)
......
`````````````````````````````````````````````````````````````  
####Database
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

####**Other related example or files:**

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

	
####Other file might related with user account management in "plugin" folder

	Dashboard 
	Login 






