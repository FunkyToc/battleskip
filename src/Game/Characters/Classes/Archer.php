<?php 

namespace App\Game\Characters\Classes;

use App\Game\Characters\Character;
use App\Game\Characters\Classes\SpecialInterface;


class Archer extends Character implements SpecialInterface 
{

	// CONST 
	const CLASSE = 'Archer';
	const HP_MAX = 50;
	const MP_MAX = 20;
	const SPE_DMG = 20;
	const SPE_COST = 10;

	// ATTR 
	protected $attack;
	protected $defense;
	protected $dodge;
	protected $speed;


	// ACTIONS 
	public function __construct(array $options = [])
	{
		parent::__construct();
		$this->setAttack(10);
		$this->setDefense(7);
		$this->setDodge(20);
		$this->setSpeed(80);
	}

	public function special()
	{
		$this->focus();
	}

	public function passive()
	{
		$this->critical();
	}

	public function focus()
	{
		$this->removeMp(static::SPE_COST);
		$this->setBonus_dodge(20);

	}

	public function critical()
	{
		$rand = rand(1, 100);

		if ($rand <= 10) 
		{
			$this->setBonus_attack($this->attack / 2);
		}
	}


	// GETTERS 
	public function getClass() 
	{
		return static::CLASSE;
	}

	public function getAttack() 
	{
		return $this->attack;
	}

	public function getDefense() 
	{
		return $this->defense;
	}	

	public function getDodge() 
	{
		return $this->dodge;
	}

	public function getSpeed() 
	{
		return $this->speed;
	}


	// SETTERS
	public function setAttack(float $attack)
	{
		$this->attack = $attack;
	}

	public function setDefense(float $defense)
	{
		$this->defense = $defense;
	}

	public function setDodge(float $dodge)
	{
		$this->dodge = $dodge;
	}

	public function setSpeed(float $speed)
	{
		$this->speed = $speed;
	}

}