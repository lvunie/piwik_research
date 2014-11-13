
##GUIDE
**1) create website**  
**2) get website code to embed on tracked page (javascript code!)**  
**3) create user with admin for website created in 1)**  
**4) set user password (not sure if this is 4) or 3.1))**  
  
##1) Create website  
API:      **SitesManager**  
method:	  **addSite**  

Usage:
**Add a website.**
Requires Super User access.
	 
parameter:  
@param string string      **$siteName** Site name  
@param array|string      **$urls** The URLs array must contain at least one URL called the 'main_url' ; if several URLs are provided in the array, they will be recorded as Alias URLs for this website.  
@param int **$ecommerce**    Is Ecommerce Reporting enabled for this website?  
@param null     **$siteSearch**  
@param string    **$searchKeywordParameters** Comma separated list of search keyword parameter names  
@param string    **$searchCategoryParameters** Comma separated list of search category parameter names  
@param string     **$excludedIps** Comma separated list of IPs to exclude from the reports (allows wildcards)  
@param null     **$excludedQueryParameters**  
@param string     **$timezone** Timezone string, eg. 'Europe/London'  
@param string     **$currency** Currency, eg. 'EUR'  
@param string     **$group** Website group identifier  
@param string     **$startDate** Date at which the statistics for this website will start. Defaults to today's date in YYYY-MM-DD format  
@param null|string     **$excludedUserAgents**  
@param int     **$keepURLFragments** If 1, URL fragments will be kept when tracking. If 2, they will be removed. If 0, the default global behavior will be used.    
@param string     **$type** The website type, defaults to "website" if not set.   
   
@return int     the website ID created  
  
**！need to attention**  
excludedIps=127.0.0.1  (here cannot be null)  
startDate=today        (here need to assign a date, YYYY-MM-DD, or 'today' or 'yesterday')

`````````````````````````````````````
http://localhost/piwik/piwik/?module=API&method=SitesManager.addSite&format=JSON&token_auth=3da68c1254ba2eafe904432d81a9fffc&siteName=thisistest&urls=www.thisistest.com&ecommerce=null&siteSearch=null&searchKeywordParameters=null&searchCategoryParameters=null&excludedIps=182.9.9.9&excludedQueryParameters=null&timezone=Europe/London&currency=EUR&group=null&startDate=today&excludedUserAgents=null&keepURLFragments=null&type=null
`````````````````````````````````````

return: {"value":5}  
int the website ID created(idSite)


##2) Get website code to embed on tracked page (javascript code!)  
API:      **SitesManager**  
method:	  **getJavascriptTag**  

usage：
**Returns the javascript tag for the given idSite.**  
This tag must be included on every page to be tracked by Piwik

parameter:  
@param int **$idSite**  
@param string **$piwikUrl**  
@param bool **$mergeSubdomains**  
@param bool **$groupPageTitlesByDomain**  
@param bool **$mergeAliasUrls**  
@param bool **$visitorCustomVariables**  
@param bool **$pageCustomVariables**  
@param bool **$customCampaignNameQueryParam**  
@param bool **$customCampaignKeywordParam**  
@param bool **$doNotTrack**  
@param bool **$disableCookies**  
  
@return string The Javascript tag ready to be included on the HTML pages  

**! need attention**  
basically, here just need assigning a "idSite" value that can generate the javascript code
 
``````````````````````````````````````
http://localhost/piwik/piwik/?module=API&method=SitesManager.getJavascriptTag&format=JSON&token_auth=3da68c1254ba2eafe904432d81a9fffc&idSite=5
````````````````````````````````````````````

**!need to attention**   
the return tag will with html code and need to be decode.  

##3) Create user with admin for website created in 1)

###3.1) Create, update, delete user
API:      **UsersManager**  
method:	  **addUser**  

usage:  
Add a user in the database.  
 A user is defined by  
 - a login that has to be unique and valid  
 - a password that has to be valid  
 - an alias  
 - an email that has to be in a correct format  

parameter:   
@param string **$userLogin**  
@param string **$password**  
@param string **$email**  
@param.   

````````````````````````````````````````````````````````````````
http://lvunie.wpic-demo.com/piwik/?module=API&method=UsersManager.addUser&format=JSON&token_auth=46733a12807bbee50b81e85826ad2444&userLogin=NEWUSERNAME2&password=jj722722722&email=new2@email.com
``````````````````````````````````````````````````````````````````

**updateUser** & **deleteUser** are very similar as **addUser**

`````````````````````````````````````````````````````````````````````````````
updateUser:
http://lvunie.wpic-demo.com/piwik/?module=API&method=UsersManager.updateUser&format=JSON&token_auth=46733a12807bbee50b81e85826ad2444&userLogin=NEWUSERNAME&password=123123123123&email=123@email.com

deleteUser:
http://lvunie.wpic-demo.com/piwik/?module=API&method=UsersManager.deleteUser&format=JSON&token_auth=46733a12807bbee50b81e85826ad2444&userLogin=NEWUSERNAME2
```````````````````````````````````````````````````````````````````````````````

###3.2) User access setting
API:      **UsersManager**  
method:	  **setUserAccess**  

Usage:
Set an access level to a given user for a list of websites ID.  

	If access = 'noaccess' the current access (if any) will be deleted.  
	If access = 'view' or 'admin' the current access level is deleted and updated with the new value.

parameter:   
@param string **$userLogin** The user login  
@param string **$access** Access to grant. Must have one of the following value : noaccess, view, admin  
@param int|array **$idSites** The array of idSites on which to apply the access level for the user. If the value is "all" then we apply the access level to all the websites ID for which the current authentificated user has an 'admin' access.

@return bool true on success  

**!need to attention**  
Superuser cannot be set for access, it already have all access  
  
````````````````````````````````````````````````
http://lvunie.wpic-demo.com/piwik/?module=API&method=UsersManager.setUserAccess&format=JSON&token_auth=46733a12807bbee50b81e85826ad2444&userLogin=KFC&access=view&idSites=1
````````````````````````````````````````````````


###3.3) Superuser setting  
API:       **UsersManager**  
method:    **setSuperUserAccess**  

Usage:  
Enable or disable Super user access to the given user login. Note: When granting Super User access all previous permissions of the user will be removed as the user gains access to everything.
  
parameter:   
@param string   **$userLogin**          the user login.  
@param bool|int **$hasSuperUserAccess** true or '1' to grant Super User access, false or '0' to remove Super User
 
``````````````````````````````````
http://lvunie.wpic-demo.com/piwik/?module=API&method=UsersManager.setSuperUserAccess&format=JSON&token_auth=46733a12807bbee50b81e85826ad2444&userLogin=NEWUSERNAME&hasSuperUserAccess=1
```````````````````````````````````





