##Notes
http://curl.haxx.se/docs/manpage.html


####-b  
(HTTP) Pass the data to the HTTP server as a cookie. It is supposedly 
the data previously received from the server in a "Set-Cookie:" line. 
The data should be in the format "NAME1=VALUE1; NAME2=VALUE2"

####-c (common.cookie)  
write current operation to cookie

####-d  (POST)
(HTTP) Sends the specified data in a POST request to the HTTP server, 
in the same way that a browser does when a user has filled in an HTML 
form and presses the submit button. This will cause curl to pass the 
data to the server using the content-type application/x-www-form-urlencoded. 
Compare to **-F**, --form.

-F: often for uploading local file

####-e  
(HTTP) Sends the "Referrer Page" information to the HTTP server. 
This can also be set with the -H, --header flag of course. When used 
with -L, --location you can append ";auto" to the --referer URL to make 
curl automatically set the previous URL when it follows a Location: header. 
The ";auto" string can be used alone, even if you don't set an initial --referer

so my understand is that if u need to go to a new page from current page, u need 
current page as "reference" to link to a new page.  

####-L  
(???)


-------------------------------------------------------------------------------------
##For curl operation:

login:(example)
`````````````````````````````````````````````````````````````````````
curl -c common.cookie http://lvunie.wpic-demo.com/piwik/

check the output, find: <input type="hidden" name="form_nonce" id="login_form_nonce" value="89dcb335d1ff3f2f477f5f9f7a79ccc8"/> remember the value.

then:
curl -L -b common.cookie -d form_nonce=89dcb335d1ff3f2f477f5f9f7a79ccc8 -d form_login=lvunie -d form_password=(your password) -e "http://lvunie.wpic-demo.com/piwik/index.php?module=CoreHome&action=" http://lvunie.wpic-demo.com/piwik/index.php?module=CoreHome&action=
``````````````````````````````````````````````````````````````````````


go to piwik setting:
`````````````````````````````````````````````````````````
######From homepage to setting menu:
http://lvunie.wpic-demo.com/piwik/index.php?module=UsersManager&action=userSettings&idSite=1&period=day&date=yesterday

######From setting to user administration:
http://lvunie.wpic-demo.com/piwik/index.php?module=UsersManager&action=index&idSite=1&period=day&date=yesterday

######From setting to website administration:
http://lvunie.wpic-demo.com/piwik/index.php?module=SitesManager&action=index&idSite=1&period=day&date=yesterday
`````````````````````````````````````````````````````````

-------------------------------------------------------------------------------------------
##Question:

1. after login to home, how can I go to subpage....

