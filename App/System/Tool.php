<?php 

namespace App\System;

use Lib\Zan\YZGetTokenClient;
/**
 * @Author: Administrator
 * @Date:   2017-08-10 11:41:13
 * @Last Modified by:   Administrator
 * @Last Modified time: 2017-08-10 15:41:40
 */
class Tool
{
	public static function getZanPlantformAT()
	{
		$client_id=Config::get("client_id");
		$client_secret=Config::get("client_secret");
		$token=new YZGetTokenClient($client_id,$client_secret);
		$type='platform_init';
		return $token->get_token($type);
	}

	public static function getZanStoreAt($kdt_id){
		$client_id=Config::get("client_id");
		$client_secret=Config::get("client_secret");
		$token=new YZGetTokenClient($client_id,$client_secret);
		$type='platform';
		$keys['kdt_id'] = $kdt_id;
		return $token->get_token($type);
	}
}