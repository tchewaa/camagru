# Camagru
Camagru is an Instagram like web application, purely created with html, css, php and a bit of ajax.  The aim of the project is to allow users to capture fun moments by allowing them to make basic photo and video editing using your webcam and some predefined images.

## Getting Started
### Pre-requisites
<ol>
    <li>HTML</li>
    <li>CSS</li>
    <li>Javascript</li>
    <li>Xampp</li>
    <li>MySQL</li>
</ol>

### Windows
Install <a href="https://www.apachefriends.org/index.html"> XAMPP </a>

### Linux
Install <a href="https://bitnami.com/stack/lamp">Bitnami LAMP</a>

### MacOS
Install <a href="https://bitnami.com/stack/mamp">Bitnami MAMP</a>

> **_NOTE:_**  
>This application was developed to run on Windows Operating System.

### Steps to run the project on your machine
<ol>
    <li>Download and install Xampp for Windows <a href="https://www.apachefriends.org/index.html"> XAMPP </a></li>
        <li>After Installation, start apache and mysql server.</li>
        <li>Clone the project into htdoc directory. (C://xampp/htdocs/).</li>
        <li>Configure xampp to send email notification, the list of steps can be found on <a href="https://meetanshi.com/blog/send-mail-from-localhost-xampp-using-gmail/">How to Send Mail from Localhost XAMPP Using Gmail.</a></li>
        <li>To complete the setup, you need to setup a 2 factor verifaction and also create an app password with Gmail, which then it will allow you to send email.</li>
        <li>Restart apache and mysql</li>
        <li>Open browser and Go to url http://localhost/camagru, this will create a database and tables</li>
</ol>

## Project Structure
<ul>
    
<li>config - database configuration </li>
<li>css - contains css files for styling</li>
<li>images - contains images</li>
<li>includes - contains partial files</li>
<li>js - contains javascript files for dynamic content</li>
<li>stickers - contains sticker images</li>
<li>upload - contains uploaded images of users</li>
<li>[root directory] - contains views/php files</li>
</ul>


## Tests
### Project Requirements:
<ul>
     <li>Preliminary Checks
        <ul>
            <li>This application is developed in PHP.</li>
            <li>No Framework or micro framework used.</li>
            <li>Does not have npm packages of composer.</li>
            <li>files configured correctly:
                <ul>
                    <li>index.php</li>
                    <li>config/database.php</li>
                    <li>config/setup.php</li>
                </ul>
            </li>
            <li>Queries are managed through PDO instances.</li>
        </ul>
    </li>
    <li>User Creation
        <ul>
            <li>Application must be able to create users.</li>
            <li>Form inputs must have validations.</li>
            <li>User must receive an email to confirm/activate the account with a unique link.</li>
            <li>User cannot login unless the link has been conformed</li>
        </ul>
    </li>
    <li>User Authentication
        <ul>
            <li>Can a user connect with credentials once they have confirmed.</li>
            <li>Can user reset their password.</li>
        </ul>
    </li>
    <li>ft_snapshots / ft_instagram
        <ul>
            <li>Application should have a decent header, main section and footer</li>
            <li>Editing the view:
                <ul>
                    <li>A Webcam view</li>
                    <li>A way to save the image with or without stickers</li>
                    <li>List of stickers</li>
                    <li>A way to upload an image without the use of camera view</li>
                </ul>
            </li>
            <li>Public gallery the view the images withput authentication</li>
            <li>Gallery displays all images taken by alll users</li>
            <li>The list of images must be paginated with at least images per page</li>
            <li>Authenticated user must be able to like and comment on an image</li>
            <li>For each comment on the image, the user must be able to receive an email notification on if it was set to true in the user preference.</li>
        </ul>
    </li>
    <li>User Preferences
        <ul>
            <li>Once logged in, a user must be able to edit
                <ul>
                    <li>their username</li>
                    <li>their email address</li>
                    <li>their password</li>
                    <li>their notification preferences</li>
                </ul>
            </li>
        </ul>
    </li>
    <li>Can Can Can
        <ul>
            <li>Can a user can delete its own editing but not the others.</li>
            <li>The editing view is only accessible if the user is correctly logged in.</li>
            <li>Trying to reach the view anonymously redirects you to the login view.</li>
            <li>Gallery is public, but only a logged user can like and comment photos.</li>
        </ul>
    </li>
    <li>UI/UX
        <ul>
            <li>The app must be compatible on Firefox( >= 41 ) and Chrome ( >= 46 ). All
features aboves must work, without any warning, error or log ( except as always for getUserMedia ).</li>
        </ul>
    </li>
    <li>Mobile
        <ul>
            <li>When you set the app on mobile mode ( you can do it on Chrome ), elements
must not overlap each other and have a correct layout.</li>
        </ul>
    </li>
    <li>Security
        <ul>
            <li>Password Encryption</li>
            <li>SQL Injections</li>
        </ul>
    </li>
    <li>BONUS
        <ul>
            <li>Did exchanges between client and server are AJAX-ified ?</li>
            <li>Render it as an animated GIF</li>
        </ul>
    </li>
</ul>
