<?php 

namespace App\Game\Characters\Classes;

use App\Game\Characters\Character;
use App\Game\Characters\Classes\SpecialInterface;


class Warrior extends Character implements SpecialInterface 
{

	// CONST 
	const CLASSE = 'Warrior';
	const HP_MAX = 50;
	const MP_MAX = 10;
	const SPE_DMG = 10;
	const SPE_COST = 10;

	// ATTR 
	protected $attack;
	protected $defense;
	protected $dodge;
	protected $speed;


	// ACTIONS 
	public function __construct()
	{
		parent::__construct();
		$this->setAttack(8);
		$this->setDefense(10);
		$this->setDodge(10);
		$this->setSpeed(7);
	}

	public function special()
	{
		$this->shield();
	}

	public function passive()
	{
		$this->regenHp();
	}

	public function shield()
	{
		$this->removeMp(static::SPE_COST);
		$this->setBonus_defense($this->defense * 2);
	}

	public function regenHp()
	{
		$this->addHp(3);
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