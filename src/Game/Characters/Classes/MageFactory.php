<?php 

namespace App\Game\Characters\Classes;

use App\Game\Characters\Classes\ClassesInterface;


class MageFactory implements ClassesInterface
{

	public function create()  
	{
		
		return new Mage();
	}

}
