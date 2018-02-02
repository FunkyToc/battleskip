<?php 

namespace App\Game\Characters\Classes;

use App\Game\Characters\Classes\ClassesInterface;


class WarriorFactory implements ClassesInterface
{

	public function create()  
	{
		
		return new Warrior();
	}

}
