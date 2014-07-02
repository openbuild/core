<?php

/*
 * This file is part of the OpenBuild framework https://github.com/openbuild/core
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenBuild\Bundle\Contact\Entity\Unknown;

use OpenBuild\Bundle\Contact\Entity\Unknown\Attribute\Id;
use OpenBuild\Bundle\Contact\Entity\Unknown\Attribute\FirstName;
use OpenBuild\Bundle\Contact\Entity\Unknown\Attribute\LastName;
use OpenBuild\Bundle\Contact\Entity\Unknown\Attribute\Email;
use OpenBuild\Bundle\Contact\Entity\Unknown\Attribute\Phone;
use OpenBuild\Bundle\Contact\Entity\Unknown\Attribute\Message;

class Entity
{
    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $phone;
    private $message;

    public function __construct(Id $id, FirstName $firstName, LastName $lastName, Email $email, Phone $phone, Message $message)
    {
		$this->id = $id;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->email = $email;
		$this->phone = $phone;
		$this->message = $message;
    }

	public function getId()
	{
		return $this->id;
	}

	public function getFirstName()
	{
		return $this->firstName;
	}

	public function getLastName()
	{
		return $this->lastName;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getPhone()
	{
		return $this->phone;
	}

	public function getMessage()
	{
		return $this->message;
	}

}