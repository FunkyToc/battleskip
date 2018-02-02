<?php 

namespace App\Game\Characters;

use App\Game\FactoryInterface;
//use App\Game\Characters\Classes\WarriorFactory;
//use App\Game\Characters\Classes\ArcherFactory;
//use App\Game\Characters\Classes\MageFactory;



class CharacterFactory implements FactoryInterface
{

	protected $classes = ['warrior', 'archer', 'mage'];

	public function create(string $class_name) 
	{
		if (array_search($class_name, $this->classes) !== false) 
		{
			$factory = 'App\Game\Characters\Classes\\' . ucfirst($class_name) . 'Factory';

			return new $factory;
		}

		return null;
	}

}

