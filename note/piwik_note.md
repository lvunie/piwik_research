The CLI tool has created a new file Reports/GetLastVisitsByBrowser.php within your plugin folder. 
We recommend to take the time to have a look at all the methods and comments to get an idea how a report is defined.


//////////////////////////////////////////////
Statistics logger（）
Users & Permissions（）
Site（）
Archived data（data）
Debug / Info log（test/info record）
SQL query profiling（SQL)
///////////////////////////////////////////////

######1. Statistics logger
--- log, from js, cookie, php

--- each visitor will be mark as unique "visitor_idcookie"

--- "log_visit" record user's each visit, eg a user visit a web twice, that will be
a two record.

--- each page as an "action", with a name and a type (log_action)

--- each user's new action will be recorded in "log_link_visit_action", also include
("idaction" and "idvisit"). This table also contain "idaction_ref" and "time_spent_ref_action"
for recording last action.
 
---If we require second page, program will get the last page's "idaction" from cookie and save it
as "action_ref", and record the time "time_spent_ref_action". That means we don't need to update 
the time of last record, only need to record current father page's infomation.


######2. Site
--- idsite, main_url
main_url point to site_url, so it can have many url.


######3.Archived data
---float, blob
archive_numeric_* : for storing numeric value， use FLOAT.
example to store given URL's visitor in a period

archive_blob



##############################################################################
About Tracking

Three types of tracking request:

##Visit Tracking Request
#####Track visit related information: pageview, outlink, download.

	~check if this visit is from a returning visitor
	~if this is not a returning visitor, a new visit is tracked
	~if this is a returning visitor, the tracker examines the last visit action of the visitor. If the action currently being tracked occurred over 30 minutes after the last known action of the visitor, a new visit is created. If not, the ongoing visit is queried.
	~the visit action is recorded

#####visitor Detection
Returning visitors are detected, by checking if the visitor ID  sent with the tracking request,
is a known visitor ID or if the visit configuration used by the visitor has been seen before.

The visitor ID is set by the tracking client and stored as a cookie.
When the tracker finds a visitor ID in the database that matches the one in the cookie, we know there is a returning visit.

**we also try to match a visit's configuration.**

	~the operating system used,
	~the browser's version,
	~the visitor's IP address,
	~the language used in the browser
	~and the browser plugins enabled

Action Type Creation

Visit actions are not recorded with the URLs and page titles of the actions. Instead, the URLs and page titles are stored in
***Action Type*** entities and visit actions link to these entities by ID.
http://developer.piwik.org/guides/persistence-and-the-mysql-backend#action-types

Action Types are created when visit actions with new URLs, page titles or other action data are found.

Referrer Detection

	
#######################################################################
http://developer.piwik.org/guides/persistence-and-the-mysql-backend#action-types
Piwik persists two main types of data: log data and archive data. 

**Log** data is everything that Piwik tracks
and **archive** data is analytics data that is cached.

Piwik also persists other simpler forms of data including:

	~websites,
	~users,
	~goals,
	~and options.


## Log Data
There are four types of log data, "visits", "action types", "conversions" and "ecommerce items"
new data is constantly added to the set at high volume and updates are non-existant (except for visits)
(Visit data is updated while visits are active. So until a visit ends it is possible that Piwik will try and update it.)

Log data is read when calculating analytics data and old data will sometimes be deleted (via the data purging feature).

Backends must ensure that inserting new log data is as fast as possible and aggregating log data is not too slow (though obviously, faster is better).

**Visits**

Value information:
http://developer.piwik.org/guides/persistence-and-the-mysql-backend#action-types









