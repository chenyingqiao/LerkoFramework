<?php 

namespace App\Controller;

use App\System\Tool;
use Lib\Zan\YZGetTokenClient;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

/**
 * @Author: Administrator
 * @Date:   2017-08-10 10:57:42
 * @Last Modified by:   Administrator
 * @Last Modified time: 2017-08-10 15:25:59
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
}