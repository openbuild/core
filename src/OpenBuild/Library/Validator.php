<?php

/*
 * This file is part of the OpenBuild framework https://github.com/openbuild/core
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenBuild\Library;

class Validator{

	public function isNotEmpty($id, $message, $thing){
	
		if(! empty($thing)){
			return true;
		}else{
			$this->errors[$id] = $message;
			return false;
		}
	
	}

	public function isLength($id, $message, $thing, $min = 1, $max = 255){
	
		if(strlen($thing) >= $min && strlen($thing) <= $max){
			return true;
		}else{
			$this->errors[$id] = $message . " between $min and $max characters";
			return false;
		}
	
	}

	public function isMatch($id, $message, $thing1, $thing2){
	
		if($thing1 == $thing2){
			return true;
		}else{
			$this->errors[$id] = $message;
			return false;
		}
	
	}

	public function isEmail($id, $message, $email){
	
		if(filter_var($email, FILTER_VALIDATE_EMAIL)){
			return true;
		}else{
			$this->errors[$id] = $message;
			return false;
		}
	
	}

	/*
	 * URI must not contain http:// or https:// 
	*/	
	public function isUrl($id, $message, $url){

		$urlWithHTTP = 'http://' . $url;

		if(filter_var($urlWithHTTP, FILTER_VALIDATE_URL)){
			return true;
		}else{
			$this->errors[$id] = $message;
			return false;
		}
	}
	
	public function isIp($thing){
	
	}
	
	public function isAlpha($id, $message, $thing, $min = 1, $max = 255){
		
		$pattern = '/^[a-z]{' . $min . ',' . $max . '}$/i';

		if(preg_match($pattern, $thing)){
			return true;
		}else{
			$this->errors[$id] = $message . " between $min and $max in length";
			return false;
		}
		
	}
	
	public function isMD5($id, $message, $thing){
		
		$pattern = '/^[a-z0-9]{32}$/i';

		if(preg_match($pattern, $thing)){
			return true;
		}else{
			$this->errors[$id] = $message;
			return false;
		}
		
	}
	
	public function isShorttext($id, $message, $thing, $min = 1, $max = 255){
	
		$pattern = '/^[-.,;\'":\/@() a-z0-9]{' . $min . ',' . $max . '}$/i';

		if(preg_match($pattern, $thing)){
			return true;
		}else{
			$this->errors[$id] = $message . " between $min and $max in length";
			return false;
		}
	
	}
	
	public function isLongtext($id, $message, $thing, $min = 1, $max = 65535){
	
		$thing = str_replace("\n"," ", $thing);
		$thing = str_replace("\r"," ", $thing);
		$thing = str_replace("\cr"," ", $thing);
	
		$pattern = '/^[-.,;\'":\/@() a-z0-9]{' . $min . ',' . $max . '}$/i';

		if(preg_match($pattern, $thing)){
			return true;
		}else{
			$this->errors[$id] = $message . " between $min and $max in length";
			return false;
		}
	
	}
	
	public function isAlphanumeric($id, $message, $thing, $min = 1, $max = 255){
	
		$pattern = '/^[a-z0-9]{' . $min . ',' . $max . '}$/i';

		if(preg_match($pattern, $thing)){
			return true;
		}else{
			$this->errors[$id] = $message . " between $min and $max in length";
			return false;
		}
	
	}
	
	public function isNumeric($id, $message, $thing){

		if(is_numeric($thing)){
			return true;
		}else{
			$this->errors[$id] = $message;
			return false;
		}

	}
	
	public function isLowercase($thing){
	
	}
	
	public function isUppercase($thing){
	
	}
	
	public function isInt($thing){
	
	}
	
	public function isDecimal($thing){
	
	}
	
	public function isFloat($thing){
	
	}
	
	public function isDivisibleBy($thing, $number){
	
	}
	
	public function isNull($thing){
	
	}
	
	public function isRegex($id, $message, $thing, $pattern){
	
		if(preg_match($pattern, $thing)){
			return true;
		}else{
			$this->errors[$id] = $message;
			return false;
		}
	
	}
	
	public function isUuid($thing, $version){
	
	}
	
	public function isDate($thing){
	
	}
	
	public function isAfter($thing, $date){
	
	}
	
	public function isBefore($thing, $date){
	
	}
	
	public function isInArray($id, $message, $thing, $array){
	
		if(in_array($thing, $array)){
			return true;
		}else{
			$this->errors[$id] = $message;
			return false;
		}
	
	}
	
	public function isArray($thing){
	
	}
	
	public function isCreditCard($thing){
	
	}
	
	public function isPostcode($thing){
	
	}
	
	public function isUsername($id, $thing){
		
		$pattern = '/^[a-z0-9]{4,255}$/i';

		if(preg_match($pattern, $thing)){
			return true;
		}else{
			$this->errors[$id] = $this->message_username;
			return false;
		}
		
	}

}
