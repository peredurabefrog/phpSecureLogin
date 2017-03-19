<?php

    //import configuration settings
    require_once 'config.php';

    //import all vendor solution
    require_once('vendor/autoload.php');

    //use "Builder" class from namespace "Lcobucci\JWT"
    use Lcobucci\JWT\Builder;
    use Lcobucci\JWT\Signer\Hmac\Sha256;
    use Lcobucci\JWT\Parser;
    use Lcobucci\JWT\ValidationData;


    class JWTManager{
        public static function createToken($userId){

            //add array into the token
            $coool = array("uid" => $userId, "extra" => "Here you can add extra info if you want.");

            //generate unique jti
            $jti = md5(microtime().$_SERVER['REMOTE_ADDR']);

            //define signing algorithym
            $signer = new Sha256();

            $token = (new Builder())
                    ->setIssuer('http://example.com') // Configures the issuer (iss claim)
                    ->setAudience('http://example.org') // Configures the audience (aud claim)
                    ->setId($jti, true) // Configures the id (jti claim), replicating as a header item
                    ->setIssuedAt(time()) // Configures the time that the token was issue (iat claim)
                    ->setNotBefore(time() + 60) // Configures the time that the token can be used (nbf claim)
                    ->setExpiration(time() + 3600) // Configures the expiration time of the token (nbf claim)
                    ->set('uid', $userId) // Configures a new claim, called "uid"
                    ->set('coool', $coool) // Configures a new claim, called "coool"
                    ->sign($signer, JWTENVIRONMENT) // creates a signature using $environemnt as key
                    ->getToken(); // Retrieves the generated token

            return((string)$token);
		}

        public static function tokenParseAndValidate($receivedToken){
            $returnArray = array();

            //Parse received token
            $token = (new Parser())->parse((string) $receivedToken); // Parses from a string
            $tokenJTI = $token->getHeader('jti');
            $tokenISS = $token->getClaim('iss');
            $tokenAUD = $token->getClaim('aud');

            //check signiture
            $signer = new Sha256();
            if($token->verify($signer, JWTENVIRONMENT)){

                // validate token
                $data = new ValidationData(); // It will use the current time to validate (iat, nbf and exp)
                $data->setIssuer($tokenISS);
                $data->setAudience($tokenAUD);
                $data->setId($tokenJTI);
                $data->setCurrentTime(time()+60);

                if($token->validate($data)){
                    $returnArray['status'] = 0;
                    // here return the token stored information
                    $returnArray['other'] = $token->getClaim('coool');
                    $returnArray['uid'] = $token->getClaim('uid');
                }else{
                    $returnArray['status'] = -3;
                    $returnArray['msg'] = "Sorry token is not valid or expired. Please sign in!";
                }
            }else{
                $returnArray['status'] = -3;
                $returnArray['msg'] = "Sorry signer is invalid, nice try.";
            }
            return($returnArray);
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
