<?php
namespace App;
use App\Route;
/**
 * @Author: Administrator
 * @Date:   2017-08-10 10:30:36
 * @Last Modified by:   Administrator
 * @Last Modified time: 2017-08-10 15:05:50
 */
class Bootstrap
{
	public function init(){
		define("WEB_APP_PATH",dirname(__FILE__));
		$this->_err_handle();
		(new Route)->routing()->dispatch();
	}

	private function _err_handle(){
		$whoops = new \Whoops\Run;
		$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
		$whoops->register();
	}
}

