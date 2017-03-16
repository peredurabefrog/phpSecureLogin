<?php

    //import all vendor solution
    require_once('vendor/autoload.php');

    //use "Builder" class from namespace "Lcobucci\JWT"
    use Lcobucci\JWT\Builder;

    class JWTManager{
        public static function createToken($userId){

            $token = (new Builder())
                    ->setIssuer('http://example.com') // Configures the issuer (iss claim)
                    ->setAudience('http://example.org') // Configures the audience (aud claim)
                    ->setId('4f1g23a12aa', true) // Configures the id (jti claim), replicating as a header item
                    ->setIssuedAt(time()) // Configures the time that the token was issue (iat claim)
                    ->setNotBefore(time() + 60) // Configures the time that the token can be used (nbf claim)
                    ->setExpiration(time() + 3600) // Configures the expiration time of the token (nbf claim)
                    ->set('uid', $userId) // Configures a new claim, called "uid"
                    ->getToken(); // Retrieves the generated token

            return((string)$token);
		}

        public static function getToken(){

            $token = (new Builder())
                    ->setIssuer('http://example.com') // Configures the issuer (iss claim)
                    ->setAudience('http://example.org') // Configures the audience (aud claim)
                    ->setId('4f1g23a12aa', true) // Configures the id (jti claim), replicating as a header item
                    ->setIssuedAt(time()) // Configures the time that the token was issue (iat claim)
                    ->setNotBefore(time() + 60) // Configures the time that the token can be used (nbf claim)
                    ->setExpiration(time() + 3600) // Configures the expiration time of the token (nbf claim)
                    ->set('uid', 1) // Configures a new claim, called "uid"
                    ->getToken(); // Retrieves the generated token

            return((string)$token);
		}
    }
?>
