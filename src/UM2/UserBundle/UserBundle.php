<?php 
namespace UserBundle;
//auteur : Huu Khang NGUYEN - Hoai Nam NGUYEN
use Symfony\Component\HtttpKernel\Bundle\Bundle;

class UserBundle extends Bundle
{
	public function getParent()
	{
		return "FOSUserBundle";
	}
}

?>