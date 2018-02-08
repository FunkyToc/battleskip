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
	protected $allowedClass;

	public function __construct(array $units)
	{
		$this->addUnitsList($units);
		$this->setCountClasses();
		$this->setClassList();
		$this->allowedClass = ['warrior', 'archer', 'mage'];
	}

	public function __clone() 
	{
		$array = [];

		foreach ($this->unitsList as $unit) 
		{
			$array[] = clone $unit;	
		}

		$this->setUnitsList($array);
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
		$this->unitsList = $units;
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

		// Class attack 
		if (!empty($class)) 
		{
			if (array_search($class, $this->allowedClass) !== false) 
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

	public function getDefense(string $class = '')
	{
		$globalDefense = 0;

		// Class attack 
		if (!empty($class)) 
		{
			if (array_search($class, $this->allowedClass) !== false) 
			{
				$theclass = 'App\Game\Characters\Classes\\'. ucfirst($class);
				
				foreach ($this->unitsList as $unit) 
				{
					if ($unit instanceof $theclass) 
					{
						$globalDefense += $unit->getDefense();
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
				$globalDefense += $unit->getDefense();
			}
		}

		return $globalDefense;
	}

	public function getSpeed(string $class = '')
	{
		$globalSpeed = 0;

		// Class attack 
		if (!empty($class)) 
		{
			if (array_search($class, $this->allowedClass) !== false) 
			{
				$theclass = 'App\Game\Characters\Classes\\'. ucfirst($class);
				
				foreach ($this->unitsList as $unit) 
				{
					if ($unit instanceof $theclass) 
					{
						$globalSpeed += $unit->getSpeed();
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
				$globalSpeed += $unit->getSpeed();
			}
		}

		return $globalSpeed;
	}

	public function resetBonus()
	{
		foreach ($this->unitsList as $unit) 
		{
			$unit->setBonus_attack(0);
			$unit->setBonus_defense(0);
			$unit->setBonus_counter(0);
			$unit->setBonus_dodge(0);
			$unit->setStatut(0);
		}
	}

	public function getLivingUnits(string $class = '')
	{
		$array = [];

		// Class alive 
		if (!empty($class)) 
		{
			if (array_search($class, $this->allowedClass) !== false) 
			{
				$theclass = 'App\Game\Characters\Classes\\'. ucfirst($class);
				
				foreach ($this->unitsList as $unit) 
				{
					if ($unit->getDead() == false && $unit instanceof $theclass) 
					{
						$array[] = $unit;
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
			foreach ($this->unitsList as $unit) 
			{
				if ($unit->getDead() == false) 
				{
					$array[] = $unit;
				}
			}
		}

		return $array;
	}

	public function activePassives()
	{
		foreach ($this->getLivingUnits() as $unit) 
		{
			$unit->passive();
		}
	}



}