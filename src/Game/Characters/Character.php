<?php 

namespace App\Game\Characters;

use App\Game\Characters\CharacterInterface;

abstract class Character implements CharacterInterface 
{

	protected $id;
	protected $dead;
	protected $lvl;
	protected $hp;
	protected $mp;
	protected $bonus_attack;
	protected $bonus_defense;
	protected $bonus_counter;


	// ACTIONS 
	public function __construct() 
	{
		$this->setDead(false);
		$this->setLvl(1);
		$this->setHp(static::HP_MAX);
		$this->setMp(static::MP_MAX);
		$this->setBonus_attack(0);
		$this->setBonus_defense(0);
		$this->setBonus_counter(0);
	}

	public function attack()
	{
		$attackForce = $this->attack + $this->bonus_attack;

		return $attackForce;
	}

	public function defend()
	{
		$defenseForce = $this->defense + $this->bonus_defense;

		return $defenseForce;
	}

	public function counter()
	{
		
	}

	public function death()
	{
		$this->setDead(true);
	}

	public function addHp(int $amount)
	{
		$this->hp = $this->hp + $amount;

		if ($this->hp > static::HP_MAX) 
		{
			$this->hp = static::HP_MAX;
		}
	}

	public function removeHp(int $amount)
	{
		$this->hp = $this->hp - $amount;

		if ($this->hp <= 0) 
		{
			$this->hp = 0;
			$this->death();
		}	
	}

	public function addMp(int $amount)
	{
		$this->mp += $amount;

		if ($this->mp > static::MP_MAX) 
		{
			$this->mp = static::MP_MAX;
		}	
	}

	public function removeMp(int $amount)
	{
		$this->mp -= $amount;

		if ($this->mp < 0) 
		{
			$this->mp = 0;
		}	
	}


	// GETTERS 
	public function getId() 
	{
		return $this->id;
	}

	public function getClass() 
	{
		return static::CLASSE;
	}

	public function getLvl() 
	{
		return $this->lvl;
	}

	public function getHp()
	{
		return $this->hp;
	}

	public function getMp()
	{
		return $this->mp;
	}

	public function getBonus_attack()
	{
		return $this->bonus_attack;
	}

	public function getBonus_defense()
	{
		return $this->bonus_defense;
	}

	public function getBonus_counter()
	{
		return $this->bonus_counter;
	}	


	// SETTERS
	public function setId(int $id)
	{
		$this->id = $id;
	}

	public function setDead(bool $dead)
	{
		$this->dead = $dead;
	}

	public function setLvl(int $lvl)
	{
		$this->lvl = $lvl;
	}

	public function setHp(int $hp)
	{
		$this->hp = $hp;
	}

	public function setMp(int $mp)
	{
		$this->mp = $mp;
	}

	public function setBonus_attack(float $bonus_attack) 
	{
		$this->bonus_attack = $bonus_attack;
	}

	public function setBonus_defense(float $bonus_defense) 
	{
		$this->bonus_defense = $bonus_defense;
	}

	public function setBonus_counter(float $bonus_counter) 
	{
		$this->bonus_counter = $bonus_counter;
	}	

}