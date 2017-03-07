The basic php logic is based on peredurabefrog's phpSecureLogin mixed with DiegoSynth forked solution.

This version of code separates the back-end and the front-end. 
So the communication between the back-end and front-end is going to happen via JSON request-response. 

>user management via php session

PHP is going to handle the session management. In case of an active session it forwards the request (+expands it with logged in user information) for anouther API and forwards the response. In this example for anouther php file.

Please note that in this solution PHP session manager is on the same machine (domain) as the front-end, this is because the session tracking.

The front-end uses jQuery and jQuery Mobile.

Test login information
Username : test_user Email : test@example.com Password : 6ZaxN2Vzm9NUJT2y

Database preparation stored under php/config.php. In case you want to move this file to a more secure place you have to add the correct path in UserManager.php before the config.php.

The session related actions are separated for performance reason. The session handling having in one php file is possible, but not adviesed, because during login the session check classes are not required. Also for development purpose it is easier to work in smaller separeted modules. If there is some issue with one module you can easily work on it without dangering the other modules.

In php for message forward curl is used. You need to install it before to use it. (On ubuntu 16.04 these packages needs to be installed: php-curl, curl ) After install if you use apache2, then you need to restart it.

Current solution workflow/functionalities:
- index.html is a login and default landing page. During page load there is a logged in user check with ProcessSession.php. If there is an active session solution navigates to securePage.html. On securePage.html same check if user do not have active session solution navigates to index.html.

- By pressing the login button on index.html page. E-mail and hashed password sent for ProcessLogin.php which check the access with help of user manager. If u/p matches it creates a login record, sends back successful auth and creates an active session for the user.  If pass not matches, but user exists creates a error record in the database.

- Logout button is on the securePage.html it closes the session and navigates back to index.html page. Logout sent for ProcessLogout.php

- OtherAPI call works from securePage. Pressing  the "Trigger other API request" button sends a request for ProcessUserAction.php which forwards the request for anouther PHP with help of curl. (curl needs to be installed). The response message is going to be displayed under the button. The button press is with timestamp. You can check the pressed timesstamp in the response.

In the configuration file you have to specify a folder for session tracking with cookies. PHP should have read and write permissions for it. (php/SessionFunction.php)


