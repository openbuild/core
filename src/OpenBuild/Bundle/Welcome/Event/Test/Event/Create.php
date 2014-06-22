<?php

namespace OpenBuild\Bundle\Welcome\Event\Test\Event;

use Symfony\Component\EventDispatcher\Event AS SymfonyEvent;

class Create extends SymfonyEvent
{

	protected $data;
	protected $date;

	public function __construct($data)
	{
		$this->data = $data;
		$this->date = date('Y-m-d h:i:s');
	}
	
	public function getData(){
		return $this->data;
	}
	
	public function getDate()
	{
		return $this->date;
	}

}