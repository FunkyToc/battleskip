<?php 

namespace App\Entity;

class BattleForm 
{

	public $p1_warrior;
	public $p1_archer;
	public $p1_mage;
	public $p2_warrior;
	public $p2_archer;
	public $p2_mage;



	// P1 
	public function getP1_warrior()
	{
		return $this->getP1_warrior;
	}

	public function getP1_archer()
	{
		return $this->getP1_archer;
	}

	public function getP1_mage()
	{
		return $this->getP1_mage;
	}

	public function setP1_warrior(int $p1_warrior)
	{
		$this->p1_warrior = $p1_warrior;
	}

	public function setP1_archer(int $p1_archer)
	{
		$this->p1_archer = $p1_archer;
	}

	public function setP1_mage(int $p1_mage)
	{
		$this->p1_mage = $p1_mage;
	}


	// P2 
	public function getP2_warrior()
	{
		return $this->getP1_warrior;
	}

	public function getP2_archer()
	{
		return $this->getP1_archer;
	}

	public function getP2_mage()
	{
		return $this->getP1_mage;
	}

	public function setP2_warrior(int $p1_warrior)
	{
		$this->p1_warrior = $p1_warrior;
	}

	public function setP2_archer(int $p1_archer)
	{
		$this->p1_archer = $p1_archer;
	}

	public function setP2_mage(int $p1_mage)
	{
		$this->p1_mage = $p1_mage;
	}

}