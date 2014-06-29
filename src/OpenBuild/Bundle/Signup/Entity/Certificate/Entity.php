<?php

/*
 * This file is part of the OpenBuild framework https://github.com/openbuild/core
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenBuild\Bundle\Signup\Entity\Certificate;

use OpenBuild\Bundle\Signup\Entity\Certificate\Attribute\Id;
use OpenBuild\Bundle\Signup\Entity\Certificate\Attribute\FirstName;
use OpenBuild\Bundle\Signup\Entity\Certificate\Attribute\LastName;
use OpenBuild\Bundle\Signup\Entity\Certificate\Attribute\Email;
use OpenBuild\Bundle\Signup\Entity\Certificate\Attribute\Password;
use OpenBuild\Bundle\Signup\Entity\Certificate\Attribute\PasswordRepeat;
use OpenBuild\Bundle\Signup\Entity\Certificate\Attribute\City;
use OpenBuild\Bundle\Signup\Entity\Certificate\Attribute\County;
use OpenBuild\Bundle\Signup\Entity\Certificate\Attribute\Country;

class Entity
{
    private $id;
    private $title;
    private $body;

    public function __construct(Id $id, FirstName $firstName, LastName $lastName, Email $email, Password $password, PasswordRepeat $passwordRepeat, City $city, County $county, Country $country)
    {
		$this->id = $id;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->email = $email;
		$this->password = $password;
		$this->passwordRepeat = $passwordRepeat;
		$this->city = $city;
		$this->county = $county;
		$this->country = $country;
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

	public function getPassword()
	{
		return $this->password;
	}

	public function getPasswordRepeat()
	{
		return $this->passwordRepeat;
	}

	public function getCity()
	{
		return $this->city;
	}

	public function getCounty()
	{
		return $this->county;
	}

	public function getCountry()
	{
		return $this->country;
	}

}