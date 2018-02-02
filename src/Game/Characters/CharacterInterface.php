<?php 

namespace App\Game\Characters;


interface CharacterInterface 
{
	
	public function attack($target);
	public function defend($target);
	public function counter($target);
}
