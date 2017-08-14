<?php 

namespace App\System\Route\V1;

use App\Controller\ZanTokenController;
use App\System\Interfaces\RouteComponentInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
/**
 * @Author: Administrator
 * @Date:   2017-08-11 11:54:22
 * @Last Modified by:   Administrator
 * @Last Modified time: 2017-08-11 14:26:09
 */
class TestRoute implements RouteComponentInterface
{
	public function register(&$route)
	{
		$route->map(['GET',"POST"],"/",function (ServerRequestInterface $request, ResponseInterface $response) {
		 	$response = new HtmlResponse("<h1 style='margin:0 auto'>hello world</h1>");
		    return $response;
		});

		$route->group("/test",function($route){
			$route->map(['GET'],"/token",[new ZanTokenController,"getToken"]);
			$route->map(['POST'],"/access_token",[new ZanTokenController,"getAccessToken"]);
		});
	}
}