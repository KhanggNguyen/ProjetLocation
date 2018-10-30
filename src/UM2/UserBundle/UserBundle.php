<?php 
namespace UserBundle;

use Symfony\Component\HtttpKernel\Bundle\Bundle;

class UserBundle extends Bundle
{
	public function getParent()
	{
		return "FOSUserBundle";
	}
}

?>