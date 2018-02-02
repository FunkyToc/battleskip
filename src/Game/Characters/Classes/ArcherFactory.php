<?php 

namespace App\Game\Characters\Classes;

use App\Game\Characters\Classes\ClassesInterface;


class ArcherFactory implements ClassesInterface
{

	public function create()  
	{
		
		return new Archer();
	}

}