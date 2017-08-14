<?php 
namespace App;

use App\Controller\ZanTokenController;
use App\System\Route\RouteCollectionVersion;
use App\System\Route\V1\TestRoute;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\SapiEmitter;
use Zend\Diactoros\ServerRequestFactory;
/**
 * @Author: Lerko
 * @Date:   2017-08-10 10:21:32
 * @Last Modified by:   Administrator
 * @Last Modified time: 2017-08-11 14:21:51
 */
class Route
{
	private $route;

	public function __construct()
	{
		$this->route=new RouteCollectionVersion("V1");//版本号V1
	}

	public function routing()
	{	
		$this->route->addRouter([
				"TestRoute",
				"SercurityRoute"
			])->routing();
		return $this;
	}
	public function dispatch(){
		$response = $this->route->dispatch(ServerRequestFactory::fromGlobals(
		        $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
		    ), new Response);
		(new SapiEmitter)->emit($response);
	}
}