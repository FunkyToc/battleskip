<?php 

namespace App\Game\Characters\Classes;

use App\Game\Characters\Classes\ClassesInterface;


class MageFactory implements ClassesInterface
{

	public function create()  
	{
		
		return new Mage();
	}

	public function createMany(int $number)  
	{
		$army = [];
		
		for ($i=0; $i < $number; $i++) 
		{ 
			$army[] = new Mage();
		}

		return $army;
	}


}
