<?php 

namespace App\Resource\OAuth\Entity;

use App\Resource\OAuth\Entity\Db\PftUserAccessToken;
use League\OAuth2\Server\Entities\RefreshTokenEntityInterface;
use League\OAuth2\Server\Entities\Traits\EntityTrait;
use League\OAuth2\Server\Entities\Traits\RefreshTokenTrait;
/*
CREATE TABLE `pft_user_refresh_token` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `access_token` VARCHAR(225) NULL,
  `expiry_time` DATETIME NULL,
  PRIMARY KEY (`id`));
 */


/**
 * @Author: lerko
 * @Date:   2017-08-13 11:58:42
 * @Last Modified by:   Administrator
 * @Last Modified time: 2017-08-14 09:24:09
 */
class RefreshTokenEntity implements RefreshTokenEntityInterface
{
	use RefreshTokenTrait;
	use EntityTrait;

	/**
	 * @Author   Lerko
	 * @DateTime 2017-08-14T10:46:36+0800
	 * @param    [type]                   $data [RefreshToken查询的数据]
	 * @return   [type]                         [description]
	 */
	public function init($data)
	{
		if(is_set($data['id']))
			$this->setIdentifier();
		$access_token=new AccessTokenEntity();
		$access_token->init(PftUserAccessToken::Inc(['id'=>$data['access_token']])->find());
		$this->setAccessToken($access_token);
		$this->setExpiryDateTime(new \DateTime($data['expiry_time']));
	}
}