<?php 

namespace App\Game\Combat;

use App\Game\Army\Army;


class CombatManager 
{

	protected $army1;
	protected $army2;
	protected $currentTurn;
	protected $maxTurn;


	public function __construct(Army $army1, Army $army2)
	{
		$this->army1 = $army1;
		$this->army2 = $army2;
		$this->currentTurn = 1;
		$this->maxTurn = 5;
	}


	// COMBAT 
	public function fight()
	{
		// X tours
		for ($i=0; $i < $this->maxTurn; $i++) 
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

			// Check équipe dead 
			
			

			$this->currentTurn++;
		}

		// Winner 
	}

	public function attack(Army $attacker, Army $defenser)
	{
		foreach ($attacker->getUnitsList() as $unit) 
		{
			$defenserUnit = $defenser->getUnitsList()[rand(0, count($defenser->getUnitsList())-1)];
			$defenserUnit->setHp($defenserUnit->getHp() - $unit->getAttack());
			
			if ($defenserUnit->getHp() <= 0) 
			{
				$defenserUnit->death();
			}
		}
	}


	// GETTERS 
	public function getCurrentTurn()
	{
		return $this->currentTurn;
	}

	public function getMaxTurn()
	{
		return $this->maxTurn;
	}

	public function getArmy1()
	{
		return $this->army1;
	}

	public function getArmy2()
	{
		return $this->army2;
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

}
