<?php
 namespace UmiCms\System\Protection;use UmiCms\System\Session\iSession;use UmiCms\Classes\System\Utils\Idn\iConverter;use UmiCms\System\Hierarchy\Domain\iDetector;class CsrfProtection {const TOKEN_KEY = 'csrf_token';private $session;private $domainDetector;private $idnConverter;private $domainCollection;private $token;public function __construct(   iSession $v21d6f40cfb511982e4424e0e250a9557, iDetector $v45651ec82e45766b3d707ee33df1a61a, iConverter $vb9d9a209340c95b228b7a557bd6ec030, \iDomainsCollection $v0d771fa031fb27561ed207afa6cf9983  ) {$this->session = $v21d6f40cfb511982e4424e0e250a9557;$this->domainDetector = $v45651ec82e45766b3d707ee33df1a61a;$this->idnConverter = $vb9d9a209340c95b228b7a557bd6ec030;$this->domainCollection = $v0d771fa031fb27561ed207afa6cf9983;}public function generateToken() {return md5(mt_rand() . microtime());}public function checkTokenMatch($v94a08da1fecbb6e8b46990538c7b50b2) {return $this->checkCondition($this->getToken() === $v94a08da1fecbb6e8b46990538c7b50b2);}public function checkOriginCorrect($v7c49b153d4b59f8c0cf8c3e18dc80cb7) {$this->checkNotEmpty($v7c49b153d4b59f8c0cf8c3e18dc80cb7);$v7c49b153d4b59f8c0cf8c3e18dc80cb7 = $this->removeProtocol($v7c49b153d4b59f8c0cf8c3e18dc80cb7);$vd460c7cfcc7383a21c37895af635c538 = [    $v7c49b153d4b59f8c0cf8c3e18dc80cb7,    $this->getIdnConverter()->decode($v7c49b153d4b59f8c0cf8c3e18dc80cb7)   ];$vad5f82e879a9c5d6b5b442eb37e50551 = $this->getCurrentDomain();$v67b3dba8bc6778101892eb77249db32e = $vad5f82e879a9c5d6b5b442eb37e50551->getHost();$v386b57b31b47d6f4c4db10ad20de899c = in_array($v67b3dba8bc6778101892eb77249db32e, $vd460c7cfcc7383a21c37895af635c538);if (!$v386b57b31b47d6f4c4db10ad20de899c) {foreach ($vad5f82e879a9c5d6b5b442eb37e50551->getMirrorsList() as $vfbe322a89bc0ba531c3f0050e3935f28) {$v386b57b31b47d6f4c4db10ad20de899c =in_array($vfbe322a89bc0ba531c3f0050e3935f28->getHost(), $vd460c7cfcc7383a21c37895af635c538);if ($v386b57b31b47d6f4c4db10ad20de899c) {$v67b3dba8bc6778101892eb77249db32e = $vfbe322a89bc0ba531c3f0050e3935f28->getHost();break;}}}return $this->checkCondition($v67b3dba8bc6778101892eb77249db32e && $v386b57b31b47d6f4c4db10ad20de899c);}public function checkReferrerCorrect($vcea75f8cd36a4f8567d5068b7e7e05e8) {$v67b3dba8bc6778101892eb77249db32e = $this->getHostFromReferrer($vcea75f8cd36a4f8567d5068b7e7e05e8);$this->checkNotEmpty($v67b3dba8bc6778101892eb77249db32e);$v9190e0220e2f6aedd93ae416ce61f4f1 = [];$v9190e0220e2f6aedd93ae416ce61f4f1[] = $v67b3dba8bc6778101892eb77249db32e;$v9190e0220e2f6aedd93ae416ce61f4f1[] = 'www.' . $v67b3dba8bc6778101892eb77249db32e;$v9190e0220e2f6aedd93ae416ce61f4f1[] = (string) preg_replace('/(:\d+)/', '', $v67b3dba8bc6778101892eb77249db32e);$v14a0ffee308315f250f040d5b4d48560 = $this->getDomainCollection();foreach ($v9190e0220e2f6aedd93ae416ce61f4f1 as $v5c0fdb20cf04b897f94a38d17bf717f8) {if (is_numeric($v14a0ffee308315f250f040d5b4d48560->getDomainId($v5c0fdb20cf04b897f94a38d17bf717f8))) {return true;}}$this->checkCondition(false);}private function removeProtocol($v572d4e421e5e6b9bc11d815e8a027112) {return preg_replace('|(^https?:\/\/)|', '', $v572d4e421e5e6b9bc11d815e8a027112);}private function getToken() {if ($this->token === null) {$this->loadToken();}if (!$this->token) {throw new \coreException('CSRF token cannot be empty');}return $this->token;}private function getSession() {return $this->session;}private function loadToken() {$v21d6f40cfb511982e4424e0e250a9557 = $this->getSession();$this->token = $v21d6f40cfb511982e4424e0e250a9557->get(self::TOKEN_KEY);return $this->token;}private function getHostFromReferrer($vcea75f8cd36a4f8567d5068b7e7e05e8) {preg_match('|^http(?:s)?:\/\/(?:www\.)?([^\/]+)|ui', $vcea75f8cd36a4f8567d5068b7e7e05e8, $v9c28d32df234037773be184dbdafc274);if (isset($v9c28d32df234037773be184dbdafc274[1]) && umiCount($v9c28d32df234037773be184dbdafc274[1]) == 1) {return $v9c28d32df234037773be184dbdafc274[1];}return '';}private function getCurrentDomain() {return $this->getDomainDetector()->detect();}private function getDomainDetector() {return $this->domainDetector;}private function getIdnConverter() {return $this->idnConverter;}private function getDomainCollection() {return $this->domainCollection;}private function checkCondition($v3f9178c25b78ed8bed19091bcb62e266) {if (!$v3f9178c25b78ed8bed19091bcb62e266) {throw new CsrfException('Csrf protection check failed');}return true;}private function checkNotEmpty($vb45cffe084dd3d20d928bee85e7b0f21) {if (!$vb45cffe084dd3d20d928bee85e7b0f21) {throw new \InvalidArgumentException("Empty argument {$vb45cffe084dd3d20d928bee85e7b0f21}");}}}