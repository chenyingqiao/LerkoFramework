<?php 
namespace App;

use App\Controller\ZanTokenController;
use League\Route\RouteCollection;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\SapiEmitter;
use Zend\Diactoros\ServerRequestFactory;
/**
 * @Author: Administrator
 * @Date:   2017-08-10 10:21:32
 * @Last Modified by:   Administrator
 * @Last Modified time: 2017-08-10 15:20:57
 */
class Route
{
	private $route;

	public function __construct()
	{
		$this->route=new RouteCollection();
	}

	public function routing()
	{	
		$this->route->map(['GET',"POST"],"/",function (ServerRequestInterface $request, ResponseInterface $response) {
		 	$response = new HtmlResponse("<h1 style='margin:0 auto'>hello world</h1>");
		    return $response;
		});
		$this->route->map(['GET'],"/token",[new ZanTokenController,"getToken"]);
		return $this;
	}

	public function dispatch(){
		$response = $this->route->dispatch(ServerRequestFactory::fromGlobals(
		        $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
		    ), new Response);
		(new SapiEmitter)->emit($response);
	}
}