# Camagru
Project of school 42:  small web application allowing you to make basic photo and video editing using your webcam and some predefined images.

# Overview
App’s users should be able to select an image in a list of superposable images (for instance a picture frame), take a picture with his/her webcam and admire the result that should be mixing both pictures.

# Getting Started
## Getting MAMP/XAMP
1. If you don't have a server, you can get it [here] (https://bitnami.com/stack/mamp/installer)
2. Configutre your server.
Configurations should look like this:
```
Listen 8100
<VirtualHost *:8100>
    DocumentRoot "/Users/imelnych/Documents/camagru/"
    ServerName localhost
   <Directory "/Users/imelnych/Documents/camagru/">
 Options Indexes FollowSymLinks
 AllowOverride All
 <IfVersion < 2.3 >
            Order allow,deny
            Allow from all
        </IfVersion>
        <IfVersion >= 2.3 >
            Require all granted
        </IfVersion>
</Directory>
</VirtualHost>
```
## Starting the app
1. Clone the repository and provide the path in the config file of your MAMP/XAMPP.
2. Start the server and database.
3. Go to php myadmin and create db named 'camagru'. Configure your password in config.php file.
4. Go to localhost/setup page to create nesesary tables.
5. Enjoy the app!


## Bugs
1. Styles for error management when user tries to change the password in their profile.
2. Notify users about error when they try to login with not valid email.
3. Likes/comments events don't work in Firefox.
4. Handle case when user upload no file for avatar.
5. Hashtags don't work when there're cyrillic letters.
