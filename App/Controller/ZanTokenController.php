<?php 

namespace App\Controller;

use App\Resource\OAuth\AccessTokenRepository;
use App\Resource\OAuth\ClientRepository;
use App\Resource\OAuth\Entity\Db\PftUserAccessToken;
use App\Resource\OAuth\RefreshTokenRepository;
use App\Resource\OAuth\ScopeRepository;
use App\Resource\OAuth\UserRepository;
use App\System\Tool;
use League\OAuth2\Server\CryptKey;
use Lib\Zan\YZGetTokenClient;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

/**
 * @Author: Administrator
 * @Date:   2017-08-10 10:57:42
 * @Last Modified by:   Administrator
 * @Last Modified time: 2017-08-14 09:42:30
 */
class ZanTokenController
{
	public function getToken(ServerRequestInterface  $request,ResponseInterface $response)
	{
		$token=Tool::getZanPlantformAT();
		$data=[
			"token"=>$token
		];
		return new JsonResponse($data);
	}

	public function getAccessToken(ServerRequestInterface  $request,ResponseInterface $response){
		$server=$this->getServer();
		$server->enableGrantType(
				$this->getGrade(), 
				new \DateInterval('P6D')
			);
		return $server->respondToAccessTokenRequest($request, $response);
	}

	private function getServer(){
		// Init our repositories
		$clientRepository = new ClientRepository(); // instance of ClientRepositoryInterface
		$scopeRepository = new ScopeRepository(); // instance of ScopeRepositoryInterface
		$accessTokenRepository = new AccessTokenRepository(); // instance of AccessTokenRepositoryInterface
		$userRepository = new UserRepository(); // instance of UserRepositoryInterface
		$refreshTokenRepository = new RefreshTokenRepository(); // instance of RefreshTokenRepositoryInterface

		// Path to public and private keys
		$privateKey=WEB_APP_PATH."/Resource/OAuth/key/private.key";
		//$privateKey = new CryptKey('file://path/to/private.key', 'passphrase'); // if private key has a pass phrase
		$encryptionKey = 'lxZFUEsBCJ2Yb14IF2ygAHI5N4+ZAUXXaSeeJm6+twsUmIen'; // generate using base64_encode(random_bytes(32))

		// Setup the authorization server
		$server = new \League\OAuth2\Server\AuthorizationServer(
		    $clientRepository,
		    $accessTokenRepository,
		    $scopeRepository,
		    new CryptKey($privateKey,null,false),
		    $encryptionKey
		);
		return $server;
	}

	public function getGrade()
	{
		$userRepository = new UserRepository(); // instance of UserRepositoryInterface
		$refreshTokenRepository = new RefreshTokenRepository(); // instance of RefreshTokenRepositoryInterface

		$grant = new \League\OAuth2\Server\Grant\PasswordGrant(
		     $userRepository,
		     $refreshTokenRepository
		);

		$grant->setRefreshTokenTTL(new \DateInterval('P1M')); // refresh tokens will expire after 1 month
		return $grant;
	}
}