<?php
 namespace UmiCms\System\Protection;use UmiCms\Service;class Security {private static $instance;private $csrfProtection;public static function getInstance() {if (self::$instance !== null) {return self::getInstance();}return new self();}private function __construct() {}private function __clone() {}public function checkCsrf() {if (!\mainConfiguration::getInstance()->get('kernel', 'csrf_protection')) {return true;}try {$this->checkOrigin();$this->checkReferrer();}catch (\InvalidArgumentException $ve1671797c52e15f763380b45e841ec32) {}catch (\Exception $ve1671797c52e15f763380b45e841ec32) {throw new CsrfException($ve1671797c52e15f763380b45e841ec32->getMessage());}$this->getCsrfProtection()    ->checkTokenMatch(getRequest('csrf'));return true;}public function checkOrigin() {try {return $this->getCsrfProtection()     ->checkOriginCorrect(getServer('HTTP_ORIGIN'));}catch(CsrfException $ve1671797c52e15f763380b45e841ec32) {throw new OriginException(getLabel('error-no-domain-permissions'));}}public function checkReferrer() {try {return $this->getCsrfProtection()     ->checkReferrerCorrect(getServer('HTTP_REFERER'));}catch(CsrfException $ve1671797c52e15f763380b45e841ec32) {throw new ReferrerException(getLabel('error-no-domain-permissions'));}}private function getCsrfProtection() {if ($this->csrfProtection instanceof CsrfProtection) {return $this->csrfProtection;}return $this->loadCsrfProtection();}private function loadCsrfProtection() {$ve8925c7db313b3366ba6f2d2bd078a83 = Service::CsrfProtection();$this->csrfProtection = $ve8925c7db313b3366ba6f2d2bd078a83;return $this->csrfProtection;}}