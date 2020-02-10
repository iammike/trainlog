**INSTALLATION INSTRUCTIONS**

1. You will need a MySQL database setup in order to use this script. If you do not have one, create one before you begin the installation (make certain you note  your MySQL username, password and database name - you will need them in step 2). If you do not know how to create one, contact your website host.

2. Open 'trainlog_variables.php' in a text editor (such as Notepad or Vi), and set your variables.

3. Upload 'trainlog.php', 'trainlog_admin.php', 'trainlog_variables.php' and 'trainlog_includes.php' via FTP in ASCII mode.

4. Go to http://www.YOURSITE.com/trainlog_install.php to create the MySQL database tables neccessary for the script to work.

5. Go to http://www.YOURSITE.com/trainlog_admin.php to begin adding entries.

6. Place the following on any PHP parsed page to show the table (use full path if file is not in the same directory):

   `<?php include('trainlog.php'); ?>`

**PROBLEMS?**

If you are having any problems with using this script, please contact the 
author by e-mail: mike@iammike.org

**VERSION HISTORY**

1.03 -- Lost to the annals of history

1.02 -- Lost to the annals of history

1.01 -- March 22, 2005
Fixed PHP rounding error
Note: It has been discovered that you cannot use apostrophes or quotes in any input fields. I will try to find a fix for this, but there may be none.

1.0 -- March 21, 2005
Fixed editing functionality, released as originally intended.

0.9 -- March 18, 2005
First public version, no functionality for editing fields with spaces.

Title: TrainLog
Version: 1.01
Created: March 18, 2005
Release: March 22, 2005
Author: Mike C (mike@iammike.org)
Site: http://www.iammike.org/trainlog
