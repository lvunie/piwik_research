
##Goal: development a php script that can add new "User" and "Website" as piwik administer
more info:  
	piwik user management: (http://piwik.org/docs/manage-users) 
	Analytics Web API :    (http://piwik.org/docs/analytics-api/)  

####Detail:
######1. Create new piwik user
######2. User account management (add,edit,delete)
######3. Superuser can assign administration authority to lower user
######4. Website management (add, edit, delete ) 
######5.	Other website setting option
######6. "user" associate "website", with permission to view data, information
######7.  ...more?

**Attention: when each website added, need to generate tracking code for new website


####Key notes:
1. need to access piwik database to add or modify the correspond table(such as add "user" and "website" log)  
2. need to know how to call piwik API in php or other script(????)
Call piwik API (http://developer.piwik.org/guides/querying-the-reporting-api)
3. find out what modal/APIs/functions might need.   

	following modal/API might be use in the project:

		-"acess" (http://developer.piwik.org/api-reference/Piwik/Access)
		- ...
		- ...
Here is link for API list(http://developer.piwik.org/api-reference/classes)
		
		**other related example or files:**
		
        $view->isSuperUser = Access::getInstance()->hasSuperUserAccess();
        $view->hasSomeAdminAccess = Piwik::isUserHasSomeAdminAccess();
        $view->hasSomeViewAccess  = Piwik::isUserHasSomeViewAccess();
        $view->isUserIsAnonymous  = Piwik::isUserIsAnonymous();
        $view->hasSuperUserAccess = Piwik::hasUserSuperUserAccess();
		
		if (!Piwik::isUserIsAnonymous()) {
            $view->emailSuperUser = implode(',', Piwik::getAllSuperUserAccessEmailAddresses());
        }
		
		
	**C:\xampp\htdocs\piwik\piwik\core\Settings\.....**  
	**C:\xampp\htdocs\piwik\piwik\core\Access.php**  
	**C:\xampp\htdocs\piwik\piwik\plugins\UsersManager\**  
		(The UsersManager API lets you Manage Users and their permissions to access specific websites.)  
	**C:\xampp\htdocs\piwik\piwik\plugins\SitesManager\.....**  
		(SitesManager API gives you full control on Websites in Piwik (create, update and delete), and many methods to retrieve websites based on various attributes.)
	
	
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

	

####Some other file might related with user account management in "..\piwik\plugin" folder

	Dashboard 
	Login 



