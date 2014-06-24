<?php

namespace OpenBuild\Security\Certificate;

class Generate{

	private $days = 365;

	private $dn = array();
	private $privkey;
	private $sslcert;
	
	private $password;
	
	private $csrout;
	private $certout;
	private $pkeyout;
	
	private $errors;

	public function __construct(){
		
	}

	// Fill in data for the distinguished name to be used in the cert
	// You must change the values of these keys to match your name and
	// company, or more precisely, the name and company of the person/site
	// that you are generating the certificate for.
	// For SSL certificates, the commonName is usually the domain name of
	// that will be using the certificate, but for S/MIME certificates,
	// the commonName will be the name of the individual who will use the
	// certificate.

	public function setDnCountryName($countryName){
		$this->dn['countryName'] = $countryName;
	}

	public function setDnStateOrProvinceName($stateOrProvinceName){
		$this->dn['stateOrProvinceName'] = $stateOrProvinceName;
	}

	public function setDnLocalityName($localityName){
		$this->dn['localityName'] = $localityName;
	}

	public function setDnOrganizationName($organizationName){
		$this->dn['organizationName'] = $organizationName;
	}
	
	public function setDnOrganizationalUnitName($organizationalUnitName){
		$this->dn['organizationalUnitName'] = $organizationalUnitName;
	}
	
	public function setDnCommonName($commonName){
		$this->dn['commonName'] = $commonName;
	}
	
	public function setDnEmailAddress($emailAddress){
		$this->dn['emailAddress'] = $emailAddress;
	}
	
	public function setPassword($password){
		$this->password = $password;
	}
	
	public function setDays($days){
		$this->days = (int) $days;
	}
	
	public function export(){
		
		// Generate a new private (and public) key pair
		$config = array(
			"digest_alg" => "sha512",
			"private_key_bits" => 4096,
			"private_key_type" => OPENSSL_KEYTYPE_RSA,
		);
		
		$this->privkey = openssl_pkey_new($config);
		
		// Generate a certificate signing request
		$this->csr = openssl_csr_new($this->dn, $this->privkey);
		
		// You will usually want to create a self-signed certificate at this
		// point until your CA fulfills your request.
		// This creates a self-signed cert that is valid for 365 days
		$this->sslcert = openssl_csr_sign($this->csr, null, $this->privkey, $this->days, $config);
		
		// Now you will want to preserve your private key, CSR and self-signed
		// cert so that they can be installed into your web server, mail server
		// or mail client (depending on the intended use of the certificate).
		// This example shows how to get those things into variables, but you
		// can also store them directly into files.
		// Typically, you will send the CSR on to your CA who will then issue
		// you with the "real" certificate.
		openssl_csr_export($this->csr, $this->csrout);
		openssl_x509_export($this->sslcert, $this->certout);
		openssl_pkey_export($this->privkey, $this->pkeyout, $this->password);

		// Show any errors that occurred here
		while(($e = openssl_error_string()) !== false){
			$this->errors[] = $e;
		}
		
	}
	
}

/*
// Fill in data for the distinguished name to be used in the cert
// You must change the values of these keys to match your name and
// company, or more precisely, the name and company of the person/site
// that you are generating the certificate for.
// For SSL certificates, the commonName is usually the domain name of
// that will be using the certificate, but for S/MIME certificates,
// the commonName will be the name of the individual who will use the
// certificate.
$dn = array(
    "countryName" => "UK",
    "stateOrProvinceName" => "Somerset",
    "localityName" => "Glastonbury",
    "organizationName" => "The Brain Room Limited",
    "organizationalUnitName" => "PHP Documentation Team",
    "commonName" => "Wez Furlong",
    "emailAddress" => "wez@example.com"
);

// Generate a new private (and public) key pair
$privkey = openssl_pkey_new();

// Generate a certificate signing request
$csr = openssl_csr_new($dn, $privkey);

// You will usually want to create a self-signed certificate at this
// point until your CA fulfills your request.
// This creates a self-signed cert that is valid for 365 days
$sscert = openssl_csr_sign($csr, null, $privkey, 365);

// Now you will want to preserve your private key, CSR and self-signed
// cert so that they can be installed into your web server, mail server
// or mail client (depending on the intended use of the certificate).
// This example shows how to get those things into variables, but you
// can also store them directly into files.
// Typically, you will send the CSR on to your CA who will then issue
// you with the "real" certificate.
openssl_csr_export($csr, $csrout) and var_dump($csrout);
openssl_x509_export($sscert, $certout) and var_dump($certout);
openssl_pkey_export($privkey, $pkeyout, "mypassword") and var_dump($pkeyout);

// Show any errors that occurred here
while (($e = openssl_error_string()) !== false) {
    echo $e . "\n";
}
*/