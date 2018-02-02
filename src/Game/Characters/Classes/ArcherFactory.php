<?php 

namespace App\Game\Characters\Classes;

use App\Game\Characters\Classes\ClassesInterface;


class ArcherFactory implements ClassesInterface
{

	public function create()  
	{
		
		return new Archer();
	}

	public function createMany(int $number)  
	{
		for ($i=0; $i < $number; $i++) 
		{ 
			$army[] = new Archer();
		}

		return $army;
	}

}
