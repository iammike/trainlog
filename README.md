**INSTALLATION INSTRUCTIONS**

1. You will need a MySQL database setup in order to use this script. If 
you do not have one, create one before you begin the installation (make 
certain you note  your MySQL username, password and database name - you 
will need them in step 2). If you do not know how to create one, 
contact your website host.

2. Open 'trainlog_variables.php' in a text editor (such as Notepad or Vi)
, and set your variables.

3. Upload 'trainlog.php', 'trainlog_admin.php', 'trainlog_variables.php' 
and 'trainlog_includes.php' via FTP in ASCII mode.

4. Go to http://www.YOURSITE.com/trainlog_install.php to create the MySQL 
database tables neccessary for the script to work.

5. Go to http://www.YOURSITE.com/trainlog_admin.php to start adding 
entries.

6. Place the following on any PHP parsed page to show a the table:

   `<?php include('trainlog.php'); ?>`

Or if the trainlog.php file is not in the same directory as the page you 
want to show the table on:

    <?php include('/path/to/trainlog.php'); ?>

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

**LICENSE INFO**

This program is free software; you can redistribute it and/or modify it 
under the terms of the GNU General Public License as published by the 
Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful, but 
WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY 
or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License 
for more details.

You should have received a copy of the GNU General Public License along 
with this program; if not, write to the Free Software Foundation, Inc., 59
Temple Place, Suite 330, Boston, MA 02111-1307 USA
