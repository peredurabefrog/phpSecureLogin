<?php

    //import configuration settings
    require_once 'config.php';

    //import all vendor solution
    require_once('vendor/autoload.php');

    //use "Builder" class from namespace "Lcobucci\JWT"
    use Lcobucci\JWT\Builder;
    use Lcobucci\JWT\Signer\Hmac\Sha256;

    class JWTManager{
        public static function createToken($userId){

            $coool= array("uid" => $userId, "extra" => "Here you can add extra info if you want.");

            $signer = new Sha256();

            $token = (new Builder())
                    ->setIssuer('http://example.com') // Configures the issuer (iss claim)
                    ->setAudience('http://example.org') // Configures the audience (aud claim)
                    ->setId('4f1g23a12aa', true) // Configures the id (jti claim), replicating as a header item
                    ->setIssuedAt(time()) // Configures the time that the token was issue (iat claim)
                    ->setNotBefore(time() + 60) // Configures the time that the token can be used (nbf claim)
                    ->setExpiration(time() + 3600) // Configures the expiration time of the token (nbf claim)
                    ->set('uid', $userId) // Configures a new claim, called "uid"
                    ->set('coool', $coool) // Configures a new claim, called "coool"
                    ->sign($signer, JWTENVIRONMENT) // creates a signature using $environemnt as key
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
