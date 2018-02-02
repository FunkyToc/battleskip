<?php 

namespace App\Game\Characters\Classes;

use App\Game\Characters\Character;
use App\Game\Characters\Classes\SpecialInterface;


class Mage extends Character implements SpecialInterface 
{

	// CONST 
	const CLASSE = 'Mage';
	const HP_MAX = 60;
	const MP_MAX = 30;
	const SPE_DMG = 30;
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
		$this->setAttack(5);
		$this->setDefense(5);
		$this->setDodge(5);
		$this->setSpeed(50);
	}

	public function special($target)
	{
		$this->removeMp(static::SPE_COST);
		$this->fireball($target);
	}

	public function passive()
	{
		$this->regenMp();
	}

	public function fireball()
	{

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