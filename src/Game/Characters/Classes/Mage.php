<?php 

namespace App\Game\Characters\Classes;

use App\Game\Characters\Character;
use App\Game\Characters\Classes\SpecialInterface;


class Mage extends Character implements SpecialInterface 
{

	// CONST 
	const CLASSE = 'Mage';
	const HP_MAX = 50;
	const MP_MAX = 30;
	const SPE_DMG = 20;
	const SPE_COST = 12;

	// ATTR 
	protected $attack;
	protected $defense;
	protected $dodge;
	protected $speed;


	// ACTIONS 
	public function __construct()
	{
		parent::__construct();
		$this->setAttack(9);
		$this->setDefense(5);
		$this->setDodge(5);
		$this->setSpeed(50);
	}

	public function special()
	{
		$this->fireball();
	}

	public function passive()
	{
		$this->regenMp();
	}

	public function fireball()
	{
		$this->removeMp(static::SPE_COST);
		$this->setBonus_attack(static::SPE_DMG);
	}

	public function regenMp()
	{
		$this->addMp(5);
	}


	// GETTERS 
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