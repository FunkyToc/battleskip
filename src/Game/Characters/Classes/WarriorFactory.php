<?php 

namespace App\Game\Characters\Classes;

use App\Game\Characters\Classes\ClassesInterface;


class WarriorFactory implements ClassesInterface
{

	public function create()  
	{
		
		return new Warrior();
	}

	public function createMany(int $number)  
	{
		for ($i=0; $i < $number; $i++) 
		{ 
			$army[] = new Warrior();
		}

		return $army;
	}


}
