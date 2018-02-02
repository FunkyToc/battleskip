<?php 

namespace App\Game;


interface FactoryInterface 
{

	public function create(string $class_name);

}