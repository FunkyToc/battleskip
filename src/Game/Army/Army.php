<?php 

namespace App\Game\Army;

use App\Game\Characters\Character;
use App\Game\Characters\Classes\Warrior;
use App\Game\Characters\Classes\Archer;
use App\Game\Characters\Classes\Mage;


class Army extends \ArrayIterator 
{

	protected $name;
	protected $unitsList;
	protected $classList = [];

	public function __construct(array $units)
	{
		$this->addUnitsList($units);
		$this->setCountClasses();
		$this->setClassList();
	}

	public function addUnit(Character $unit)
	{
		$this->unitsList[] = $unit;
	}

	public function addUnitsList(array $units)
	{
		foreach ($units as $unit) 
		{
			$this->addUnit($unit);
		}
	}


	/* 
	 * SETTERS  
	 */ 
	public function setName($name)
	{
		$this->name = $name;
	}

	public function setUnitsList(array $units)
	{
		$this->addUnitsList($units);
	}

	public function setClassList()
	{
		$array = [];

		foreach ($this->unitsList as $unit) 
		{
			$class = explode('\\', get_class($unit));
			$class = $class[count($class)-1];

			if (array_search($class, $this->classList) === false) 
			{
				$this->classList[] = $class;
			}
		}
	}

	public function setCountClasses()
	{
		$array = [];

		foreach ($this->unitsList as $unit) 
		{
			$class = explode('\\', get_class($unit));
			$class = $class[count($class)-1];
		}

		foreach ($array as $classname => $count) 
		{
			$this->$classname = $count;
		}
	}	


	/* 
	 * GETTERS 
	 */ 
	public function getName()
	{
		return $this->name;
	}

	public function getUnitsList()
	{
		return $this->unitsList;
	}

	public function getClassList()
	{
		return $this->classList;
	}

	public function getUnitsByClass(string $classname)
	{

	}

	public function getWarriors() 
	{
		$array = [];

		foreach ($this->unitsList as $unit) 
		{
			if ($unit instanceof Warrior) 
			{
				$array[] = $unit;
			}
		}

		return $array;
	}	

	public function getArchers() 
	{
		$array = [];

		foreach ($this->unitsList as $unit) 
		{
			if ($unit instanceof Archer) 
			{
				$array[] = $unit;
			}
		}

		return $array;
	}

	public function getMages() 
	{
		$array = [];

		foreach ($this->unitsList as $unit) 
		{
			if ($unit instanceof Mage) 
			{
				$array[] = $unit;
			}
		}

		return $array;
	}


	public function getAttack(string $class = '')
	{
		$globalAttack = 0;
		$allowedClass = ['warrior', 'archer', 'mage'];

		// Class attack 
		if (!empty($class)) 
		{
			if (array_search($class, $allowedClass) !== false) 
			{
				$theclass = 'App\Game\Characters\Classes\\'. ucfirst($class);
				
				foreach ($this->unitsList as $unit) 
				{
					if ($unit instanceof $theclass) 
					{
						$globalAttack += $unit->getAttack();
					}
				}
			}
			else 
			{
				return 'Error';
			}

		}
		else 
		{
			// Army attack 
			foreach ($this->unitsList as $unit) 
			{
				$globalAttack += $unit->getAttack();
			}
		}


		return $globalAttack;
	}


}