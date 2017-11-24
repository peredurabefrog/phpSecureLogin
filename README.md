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

>user management via JWT

In the past years application authentication started to move toward JWT (JSON Web Token). For example Angular2 is not supporting php's session handling mechanism in the old fashion way. In order to authenticate we have to set up a such an authentication mechanism as well. 

There are pretty good JWT implementations for example:
https://github.com/lcobucci/jwt
https://www.sitepoint.com/php-authorization-jwt-json-web-tokens/

In this solution I used "lcobucci/jwt" 3.2.1 version. 
On their github repository (linked above) the developers wrote that they change the usage way.

Please note that if you want use the php-jwt you have to install that component first (composer php repository manager installation needs to be done first) and only after it you can use it. 

You can do that in the next way:
Navigate to "php-jwt" and in the command line execute the next command: 
~> composer require lcobucci/jwt --update-no-dev
This will install the vendor package. 

After installation you have to link the "vendor/autoload.php" to your php file.
Example done in "JWTManager.php" .

Please note that namespaces can be tricky 
In "JWTManager.php" you can find a line on the top like this: "use Lcobucci\JWT\Builder;" 
This means after you have imported the vendor solution (require / include) then you have to add this line which will tell that from the "Lcobucci\JWT" namespace it will use the "Builder" class. Which means after the "use" you do not declare a physical path you just specify a namespace within the solution.

With php-jwt there is one url called which will forward the requests based on messagename to the right php process. This simplifies the url management at the front-end side. 