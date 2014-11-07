##Notes
http://curl.haxx.se/docs/manpage.html


-b  
(HTTP) Pass the data to the HTTP server as a cookie. It is supposedly 
the data previously received from the server in a "Set-Cookie:" line. 
The data should be in the format "NAME1=VALUE1; NAME2=VALUE2"

-c (common.cookie)  write current operation to cookie

-d  
(HTTP) Sends the specified data in a POST request to the HTTP server, 
in the same way that a browser does when a user has filled in an HTML 
form and presses the submit button. This will cause curl to pass the 
data to the server using the content-type application/x-www-form-urlencoded. 
Compare to -F, --form.

-e  
(HTTP) Sends the "Referrer Page" information to the HTTP server. 
This can also be set with the -H, --header flag of course. When used 
with -L, --location you can append ";auto" to the --referer URL to make 
curl automatically set the previous URL when it follows a Location: header. 
The ";auto" string can be used alone, even if you don't set an initial --referer

-L (???)
(HTTP/HTTPS) If the server reports that the requested page has moved to a different location (indicated with a Location: header and a 3XX response code), this option will make curl redo the request on the new place. If used together with -i, --include or -I, --head, headers from all requested pages will be shown. When authentication is used, curl only sends its credentials to the initial host. If a redirect takes curl to a different host, it won't be able to intercept the user+password. See also --location-trusted on how to change this. You can limit the amount of redirects to follow by using the --max-redirs option.

When curl follows a redirect and the request is not a plain GET (for example POST or PUT), it will do the following request with a GET if the HTTP response was 301, 302, or 303. If the response code was any other 3xx code, curl will re-send the following request using the same unmodified method.

You can tell curl to not change the non-GET request method to GET after a 30x response by using the dedicated options for that: --post301, --post302 and -


-------------------------------------------------------------------------------------
##For curl operation:

login:(example)
`````````````````````````````````````````````````````````````````````
curl -c common.cookie http://lvunie.wpic-demo.com/piwik/

check the output, find: <input type="hidden" name="form_nonce" id="login_form_nonce" value="89dcb335d1ff3f2f477f5f9f7a79ccc8"/> remember the value.

then:
curl -L -b common.cookie -d form_nonce=89dcb335d1ff3f2f477f5f9f7a79ccc8 -d form_login=lvunie -d form_password=(your password) -e "http://lvunie.wpic-demo.com/piwik/index.php?module=CoreHome&action=" http://lvunie.wpic-demo.com/piwik/index.php?module=CoreHome&action=
``````````````````````````````````````````````````````````````````````

-------------------------------------------------------------------------------------------
##Question:

1. after login to home, how can I go to subpage....

