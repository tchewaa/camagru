# camagru
Camagru is an Instagram like web application, purely created with html, css, php and a bit of ajax.  The aim of the project is to allow users to capture fun moments by allowing them to make basic photo and video editing using your webcam and some predefined images.

## Getting Started
### Prerequisites
A local server to host the application:

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
        <li>To complete the setup, you need to setup a 2 factor varifaction and also create an app password with Gmail, which then it will allow you to send email.</li>
        <li>Restart apache and mysql</li>
        <li>Open browser and Go to url http://localhost/camagru, this will create a database and tables</li>
</ol>

## Tests
### Project Requirements:
<ul>
     <li>Preliminary Checks
        <ul>
            <li>This application is develpoed in PHP.</li>
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
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
</ul>