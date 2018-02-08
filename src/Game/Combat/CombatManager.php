<?php 

namespace App\Game\Combat;

use App\Game\Army\Army;


class CombatManager 
{

	protected $army1;
	protected $army2;
	protected $currentTurn;
	protected $maxTurn;
	protected $unitsTurn;
	protected $winner;


	public function __construct(Army $army1, Army $army2)
	{
		$this->army1 = $army1;
		$this->army2 = $army2;
		$this->currentTurn = 1;
		$this->maxTurn = 10;
		$this->unitsTurn = [];
	}


	// COMBAT 
	public function fight()
	{
		// X tours
		for ($i=1; $i < $this->maxTurn; $i++) 
		{
			// initiative 
			if (($this->army1->getSpeed() / count($this->army1->getLivingUnits())) > ($this->army2->getSpeed() / count($this->army2->getLivingUnits()))) 
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
			$this->round($attacker, $defenser);

			// Get score by turn 
			$this->unitsTurn[$this->currentTurn]['army1'] = clone $this->army1;
			$this->unitsTurn[$this->currentTurn]['army2'] = clone $this->army2;

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

	public function round(Army $attacker, Army $defenser)
	{
		$attackerClasses = $attacker->getClassList();
		$defenserClasses = $defenser->getClassList();

		// Archer 
		$this->attack($attacker->getLivingUnits('archer'), $defenser->getLivingUnits());
		$this->attack($defenser->getLivingUnits('archer'), $attacker->getLivingUnits());
		
		// Warrior 
		$this->attack($attacker->getLivingUnits('warrior'), $defenser->getLivingUnits());
		$this->attack($defenser->getLivingUnits('warrior'), $attacker->getLivingUnits());
		
		// Mage 
		$this->attack($attacker->getLivingUnits('mage'), $defenser->getLivingUnits());
		$this->attack($defenser->getLivingUnits('mage'), $attacker->getLivingUnits());
	}

	public function attack(array $attackers, array $defenserUnits)
	{
		// Attack 
		foreach ($attackers as $unit) 
		{
			// Choose Defender 
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
		// Score Army 1 
		$army1UnitsCount = count($this->army1->getLivingUnits());
		$army2UnitsCount = count($this->army2->getLivingUnits());

		if ($army1UnitsCount == 0 && $army2UnitsCount == 0) 
		{
			return 'Tous le monde est mort. Bravo.';
		}
		else if ($army1UnitsCount == 0) 
		{
			return 'Army 2';
		}
		else if ($army2UnitsCount == 0)
		{
			return 'Army 1';
		}
		else
		{		
			$army1UnitsCount = $army1UnitsCount ? $army1UnitsCount : 1;
			$army1UnitsHp = 0;
			$army1UnitsAtk = 0;

			foreach ($this->army1->getLivingUnits() as $unit) 
			{
				$army1UnitsHp += $unit->getHp();
				$army1UnitsAtk += $unit->getAttack();
			}

			$army1UnitsHp = $army1UnitsHp / $army1UnitsCount;
			$army1UnitsAtk = $army1UnitsAtk / $army1UnitsCount;

			// Score Army 2 
			$army2UnitsCount = $army2UnitsCount ? $army2UnitsCount : 1;
			$army2UnitsHp = 0;
			$army2UnitsAtk = 0;
			
			foreach ($this->army2->getLivingUnits() as $unit) 
			{
				$army2UnitsHp += $unit->getHp();
				$army2UnitsAtk += $unit->getAttack();
			}

			$army2UnitsHp = $army2UnitsHp / $army2UnitsCount;
			$army2UnitsAtk = $army2UnitsAtk / $army2UnitsCount;


			// Points 
			$army1Points = 0;
			$army2Points = 0;

			// Units number  
			if ($army1UnitsCount == $army2UnitsCount)  
			{
				$army1Points++;
				$army2Points++;
			}
			else if ($army1UnitsCount > $army2UnitsCount)
			{
				$army1Points;
			}
			else if ($army1UnitsCount < $army2UnitsCount)
			{
				$army2Points++;
			}

			// Total HP 
			if ($army1UnitsHp == $army2UnitsHp)  
			{
				$army1Points++;
				$army2Points++;
			}
			else if ($army1UnitsHp > $army2UnitsHp)
			{
				$army1Points;
			}
			else if ($army1UnitsHp < $army2UnitsHp)
			{
				$army2Points++;
			}

			// Total Atk 
			if ($army1UnitsAtk == $army2UnitsAtk)  
			{
				$army1Points++;
				$army2Points++;
			}
			else if ($army1UnitsAtk > $army2UnitsAtk)
			{
				$army1Points;
			}
			else if ($army1UnitsAtk < $army2UnitsAtk)
			{
				$army2Points++;
			}


			// Decide 
			if ($army1Points == $army2Points) 
			{
				return 'Égalité';
			}
			else if ($army1Points > $army2Points)
			{
				return 'Army 1';
			}
			else if ($army1Points < $army2Points)
			{
				return 'Army 2';
			}
		}

		return 'Error';
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

	public function getUnitsTurn()
	{
		return $this->unitsTurn;
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
