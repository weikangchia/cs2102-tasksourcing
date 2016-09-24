# CS2102 Task Sourcing

The system is a catalog of tasks submitted by users. Users can either submit a task or pick a task. Tasks are general chores such washing a car on Kent Vale’s carpark on Sunday, or delivering a parcel on Tuesday between 17:00 and 19:00, etc. Each user has an account managed by the system. Administrators can create, modify and delete all entries.

## Getting started

1. Download and install Bitnami Stack <b>5.6.25</b>

   > For Windows: https://bitnami.com/stack/wapp  
   > For Mac: https://bitnami.com/stack/mapp

2. Activate Laravel

   1. Edit the Apache configuration file at

      > For Windows: C:\Bitnami\wappstack-5.6.25-0\apache2\conf\bitnami\bitnami-apps-prefix.conf  
      > For Mac: ../Applications/mappstack-5.6.25-0/apache2/conf/bitnami/bitnami-apps-prefix.conf
      
      and uncomment the following line
      
      > Include "/Applications/mappstack-5.6.25-0/frameworks/laravel/conf/httpd-prefix.conf"
      
  2. Then, restart the Apache server.
  3. You can now verify that the example application is working by visiting its URL using your browser.
  
      > Access the example application via your brower at http://<i></i>127.0.0.1:[port number]/laravel
    
3. Move the Laravel example application such that it is available at the root URL of the server (without the /laravel URL suffix), follow these steps:

   1. Edit
   
      > For Windows: C:\Bitnami\wappstack-5.6.25-0\frameworks\laravel\conf\httpd-prefix.conf  
      > For Mac: ../Applications/mappstack-5.6.25-0/frameworks/laravel/conf/httpd-prefix.conf  
      
      so that it looks like this:

      > DocumentRoot "/opt/bitnami/frameworks/laravel/public"  
      > \#Alias /laravel/ "/opt/bitnami/frameworks/laravel/public/"  
      > \#Alias /laravel "/opt/bitnami/frameworks/laravel/public"  
      > Include "/opt/bitnami/frameworks/laravel/conf/httpd-app.conf"
      
      \* note please replace `/opt/bitnami` with the correct installation path.
      
   2. Edit
   
      > For Windows: C:\Bitnami\wappstack-5.6.25-0\frameworks\laravel\conf\httpd-app.conf  
      > For Mac: ../Applications/mappstack-5.6.25-0/frameworks/laravel/conf/httpd-app.conf  

      and replace the `AllowOverride None` directive with the `AllowOverride All` directive:
      
      > AllowOverride All
      
   3. Restart the Apache server.
   
   You should now be able to access the example application at the root URL of your server.

4. Access PostgreSQL, use phpPgAdmin application at http://<i></i>127.0.0.1:[port number]/phppgadmin.
   1. Create a new role
   
      * Select `Roles` tab
      * Click role
      * Enter the following:
      
        > Name: forge  
        > Password: P@ssw0rd  
        > Check all the options  
      * Click create
   2. Logout and login with the new account `forge`
   3. Create a new database
   
      * Select `Databases` tab
      * Click create database
      * Enter the following:  
      
        > Name: task_db  
        > Encoding: UTF-8  
      * Click create
   4. Download the dump [file](database/dump.sql)
   5. Import the dump file into task_db database
   
      * Select task_db
      * Select `SQL` tab
      * Click `Choose File` and select the dump file that you have just downloaded
      * Click `Execute`
5. Go to

    > For Windows: C:\Bitnami\wappstack-5.6.25-0\frameworks\laravel\  
    > For Mac: ../Applications/mappstack-5.6.25-0/frameworks/laravel/

    and remove all files except for  
    > /vendor  
    > /conf
  
6. Clone this repo onto  

    > For Windows: C:\Bitnami\wappstack-5.6.25-0\frameworks\laravel\  
    > For Mac: ../Applications/mappstack-5.6.25-0/frameworks/laravel/

7. Copy all the files from the `cs2102-tasksourcing` folder to the parent and remove this folder.
8. Enter http://<i></i>127.0.0.1:[port number] and you should be able to see the homepage.

## Notes
* This guide uses /opt/bitnami to refer to the installation directory for the Bitnami Stack. This is the default installation directory for Bitnami Cloud Hosting, Google Cloud Platform and Microsoft Azure servers and for virtual servers. If you're using a native installer and have installed the Bitnami Stack to a different folder, replace /opt/bitnami in the examples below with your actual installation directory.   
* <b>[Default port number]</b>  
  Windows: 80  
  Mac OS X and Linux: 8080

## Errors
| Error | How to fix |
|:----- | :----- |
| FatalErrorException</b> in ProviderRepository.php ... Class 'Collective\Html\HtmlServiceProvider' not found | 1. Install composer: https://getcomposer.org/doc/00-intro.md<br>2. Open your command prompt -> cd to the laravel folder -> Execute `composer update` |
 
