<?php
 abstract class baseException extends Exception {protected $stringCode;protected $id;public static $catchedExceptions = [];public function __construct ($v78e731027d8fd50ed642340b7c9a63b3, $vc13367945d5d4c91047b3b50234aa7ab = 0, $v990212f8ef70507a61ec72b2ae25732a = '') {baseException::$catchedExceptions[$this->getId()] = $this;$this->stringCode = $v990212f8ef70507a61ec72b2ae25732a;$v78e731027d8fd50ed642340b7c9a63b3 = def_module::parseTPLMacroses($v78e731027d8fd50ed642340b7c9a63b3);parent::__construct($v78e731027d8fd50ed642340b7c9a63b3, $vc13367945d5d4c91047b3b50234aa7ab);}public function getStrCode() {return (string) $this->stringCode;}public function unregister() {$vb80bb7740288fda1f201890375a60c8f = $this->getId();if (isset(baseException::$catchedExceptions[$vb80bb7740288fda1f201890375a60c8f])) {unset(baseException::$catchedExceptions[$vb80bb7740288fda1f201890375a60c8f]);}}protected function getId() {static $vb80bb7740288fda1f201890375a60c8f = 0;if ($this->id === null)  {$this->id = $vb80bb7740288fda1f201890375a60c8f++;}return $this->id;}}