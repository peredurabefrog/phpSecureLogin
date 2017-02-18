The basic php logic is based on peredurabefrog's phpSecureLogin mixed with DiegoSynth forked solution.

This version of code separates the back-end and the front-end. 
So the communication between the back-end and front-end is going to happen via JSON request-response. 

PHP is going to handle the session management. In case of an active session it forwards the request (+expands it with logged in user information) for anouther API and forwards the response. In this example for anouther php file.

Please note that in this solution PHP session manager is on the same machine (domain) as the front-end, this is because the session tracking.

The front-end uses jQuery and jQuery Mobile.

Test login information
Username : test_user Email : test@example.com Password : 6ZaxN2Vzm9NUJT2y

Database preparation stored under php/config.php. In case you want to move this file to a more secure place you have to add the correct path in UserManager.php for the config.php.

The session related actions are separated for performance reason. The session handling having in on php file is possible, but not adviesed, because during login the session check classes are not required. Also for development purpose is more easier to work in smaller separeted modules. If there is some issue with one module you can easily work on it without dangering the other modules.