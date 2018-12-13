<?php 
namespace UserBundle;
//auteur : Khang NGUYEN - Licence 3 
use Symfony\Component\HtttpKernel\Bundle\Bundle;

class UserBundle extends Bundle
{
	public function getParent()
	{
		return "FOSUserBundle";
	}
}

?>