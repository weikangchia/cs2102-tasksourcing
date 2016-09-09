# CS2102 Task Sourcing

The system is a catalog of tasks submitted by users. Users can either submit a task or pick a task. Tasks are general chores such washing a car on Kent Vale’s carpark on Sunday, or delivering a parcel on Tuesday between 17:00 and 19:00, etc. Each user has an account managed by the system. Administrators can create, modify and delete all entries.

## Setup

1. Download Bitnami Stack 5.6.25
  
  For Windows: https://bitnami.com/stack/wapp  
  For MAC: https://bitnami.com/stack/mapp

2. Fork this project to replace the original files in /opt/bitnami/frameworks/laravel
3. Create a new database user <b>forge</b> and set the password to <b>P@ssw0rd</b>
4. Create a new database and called it <b>task_db</b>
5. Import the dump file, which can be found at /opt/bitnami/frameworks/laravel/database/dump.sql
6. Enter http://<i></i>127.0.0.1:[port number] and you should be able to see the homepage.

## Others
* To access PostgreSQL, use phpPgAdmin application at http://<i></i>127.0.0.1:[port number]/phppgadmin.

## Notes
* This guide uses /opt/bitnami to refer to the installation directory for the Bitnami Stack. This is the default installation directory for Bitnami Cloud Hosting, Google Cloud Platform and Microsoft Azure servers and for virtual servers. If you're using a native installer and have installed the Bitnami Stack to a different folder, replace /opt/bitnami in the examples below with your actual installation directory.   
* <b>[Default port number]</b>  
  Windows: 80  
  Mac OS X and Linux: 8080
