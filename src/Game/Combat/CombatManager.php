<?php 

namespace App\Game\Combat;

use App\Game\Army\Army;


class CombatManager 
{

	protected $army1;
	protected $army2;
	protected $currentTurn;
	protected $maxTurn;
	protected $winner;


	public function __construct(Army $army1, Army $army2)
	{
		$this->army1 = $army1;
		$this->army2 = $army2;
		$this->currentTurn = 1;
		$this->maxTurn = 100;
	}


	// COMBAT 
	public function fight()
	{
		// X tours
		for ($i=1; $i < $this->maxTurn; $i++) 
		{
			// initiative 
			if ($this->army1->getAttack() > $this->army2->getAttack()) 
			{
				$attacker = $this->army1;
				$defenser = $this->army2;
			}
			else 
			{
				$attacker = $this->army2;
				$defenser = $this->army1;	
			}

			// Attack 
			$this->attack($attacker, $defenser);

			// Contre attack 
			$this->attack($defenser, $attacker);
			
			// Reset Bonus 
			$attacker->resetBonus();
			$defenser->resetBonus();

			// Passives 
			$attacker->activePassives();
			$defenser->activePassives();

			// Check team dead 
			if ((count($attacker->getLivingUnits()) == 0) || (count($defenser->getLivingUnits()) == 0)) 
			{
				break;
			}
			
			// Turn stuff 
			$this->naturalRegen();
			$this->currentTurn++;
		}

		// Winner 
		$this->winner = $this->defineWinner();
	}

	public function attack(Army $attacker, Army $defenser)
	{
		foreach ($attacker->getLivingUnits() as $unit) 
		{
			// Choose Defender 
			$defenserUnits = $defenser->getLivingUnits();

			if (count($defenserUnits) == 0) 
			{
				break;
			}

			// Defenser Unit 
			$defenserUnit = $defenserUnits[rand(0, (count($defenserUnits)-1))];

			// Special 
			if ($unit->getMp() > $unit::SPE_COST) 
			{
				$unit->special();
			}

			// Attack / Dodge 
			$damage = $unit->getAttack() - ($defenserUnit->getDefense() / 5);

			if ($defenserUnit->getDodge() > rand(1, 100)) 
			{
				// Dodge 

			}
			else 
			{
				// Attack 
				$defenserUnit->removeHp($damage);
			}
		}
	}

	public function naturalRegen()
	{
		foreach ($this->army1->getLivingUnits() as $unit) 
		{
			$unit->addMp(1);
		}

		foreach ($this->army2->getLivingUnits() as $unit) 
		{
			$unit->addMp(1);
		}
	}

	public function defineWinner()
	{
		$army1UnitsCount = count($this->army1->getLivingUnits());
		$army2UnitsCount = count($this->army2->getLivingUnits());

		if ($army1UnitsCount == $army2UnitsCount)  
		{
			return 'Egalité';
		}
		else if ($army1UnitsCount > $army2UnitsCount)
		{
			return 'Army 1';
		}
		else 
		{
			return 'Army 2';
		}
	}


	// GETTERS 
	public function getArmy1()
	{
		return $this->army1;
	}

	public function getArmy2()
	{
		return $this->army2;
	}

	public function getCurrentTurn()
	{
		return $this->currentTurn;
	}

	public function getMaxTurn()
	{
		return $this->maxTurn;
	}

	public function getWinner()
	{
		return $this->winner;
	}


	// SETTERS 
	public function setCurrentTurn(int $currentTurn)
	{
		$this->currentTurn = $currentTurn;
	}

	public function setMaxTurn(int $maxTurn)
	{
		$this->maxTurn = $maxTurn;
	}
	
	public function setArmy1(Army $army1)
	{
		$this->army1 = $army1;
	}
	
	public function setArmy2(Army $army2)
	{
		$this->army2 = $army2;
	}

	public function setWinner(string $winner)
	{
		$this->winner = $winner;
	}

}
