<?php 

namespace App\Game\Characters;


interface CharacterInterface 
{
	
	public function attack();
	public function defend();
	public function counter();
}
