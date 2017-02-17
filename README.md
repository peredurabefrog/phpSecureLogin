The basic php logic is based on peredurabefrog's phpSecureLogin.

This version of code separates the back-end code and the front-end. 
So the communication between the back-end and front-end is going to happen via JSON request-response. 

PHP is going to handle the session management. In case of an active session it forwards the request (+expands it with logged in user information) for anouther API and forwards the response.

Please note that in this solution PHP session manager is on the same machine (domain) as the login front-end. In order to avoid CORS issue.

The front-end code is written in JQM.

Test login information
Username : test_user Email : test@example.com Password : 6ZaxN2Vzm9NUJT2y