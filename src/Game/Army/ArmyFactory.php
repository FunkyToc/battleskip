<?php 

namespace App\Game\Army;

use App\Game\Army\Army;


class ArmyFactory implements ArmyInterface 
{

	public function create(array $units)
	{
		return new Army($units);
	}


}
