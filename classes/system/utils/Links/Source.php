<?php
namespace UmiCms\Classes\System\Utils\Links;use UmiCms\Classes\System\Enums\EnumElementNotExistsException;class Source implements iSource, \iUmiDataBaseInjector, \iUmiConstantMapInjector, \iClassConfigManager{use \tUmiDataBaseInjector;use \tCommonCollectionItem;use \tUmiConstantMapInjector;use \tClassConfigManager;private $linkId;private $place;private $type;private static $classConfig = [  'fields' => [   [    'name' => 'ID_FIELD_NAME',    'required' => true,    'unchangeable' => true,    'setter' => 'setId',    'getter' => 'getId',   ],   [    'name' => 'LINK_ID_FIELD_NAME',    'required' => true,    'setter' => 'setLinkId',    'getter' => 'getLinkId',   ],   [    'name' => 'PLACE_FIELD_NAME',    'required' => true,    'setter' => 'setPlace',    'getter' => 'getPlace',   ],   [    'name' => 'TYPE_FIELD_NAME',    'required' => true,    'setter' => 'setType',    'getter' => 'getType'   ]  ] ];public function setLinkId($vab4d719bb5871955352ccf0727db833e) {if (!is_numeric($vab4d719bb5871955352ccf0727db833e)) {throw new \wrongParamException('Wrong value for link id given');}if ($this->getLinkId() != $vab4d719bb5871955352ccf0727db833e) {$this->linkId = (int) $vab4d719bb5871955352ccf0727db833e;$this->setUpdatedStatus(true);}return $this;}public function getLinkId() {return $this->linkId;}public function setPlace($vebed715e82a0a0f3e950ef6565cdc4a8) {if (!is_string($vebed715e82a0a0f3e950ef6565cdc4a8)) {throw new \wrongParamException('Wrong value for place given');}$vd03a214eb49a69662502686baa6d5571 = trim($vebed715e82a0a0f3e950ef6565cdc4a8);if (mb_strlen($vd03a214eb49a69662502686baa6d5571) === 0 ) {throw new \wrongParamException('Empty value for place given');}$v9d8a79577f5c4b15c07028e599d37533 = is_file($vd03a214eb49a69662502686baa6d5571) ? $this->getLocalFilePath($vd03a214eb49a69662502686baa6d5571) : $vd03a214eb49a69662502686baa6d5571;if ($this->getPlace() != $v9d8a79577f5c4b15c07028e599d37533) {$this->place = $v9d8a79577f5c4b15c07028e599d37533;$this->setUpdatedStatus(true);}return $this;}public function getPlace() {return $this->place;}public function setType($v599dcce2998a6b40b1e38e8c6006cb0a) {try {$v5ab77627345a0347f34da97a041920c9 = new SourceTypes($v599dcce2998a6b40b1e38e8c6006cb0a);}catch (EnumElementNotExistsException $ve1671797c52e15f763380b45e841ec32) {throw new \wrongParamException('Wrong value for type given');}if ($this->getType() != $v599dcce2998a6b40b1e38e8c6006cb0a) {$this->type = (string) $v5ab77627345a0347f34da97a041920c9;$this->setUpdatedStatus(true);}return $this;}public function getType() {return $this->type;}public function commit() {if (!$this->isUpdated()) {return $this;}$v80071f37861c360a27b7327e132c911a = $this->getColumnName('TABLE_NAME');$vbb1df230a5150b8ac17121321b3b514c = $this->getColumnName('ID_FIELD_NAME');$v3c3bd88d09eb13276568c6fbb690a500 = $this->getColumnName('LINK_ID_FIELD_NAME');$v08eafb2445e09e935a785d2153aec7e9 = $this->getColumnName('PLACE_FIELD_NAME');$vce6ba6b4afd61be6d0f21f1e2a995213 = $this->getColumnName('TYPE_FIELD_NAME');$v4717d53ebfdfea8477f780ec66151dcb = $this->getConnection();$vb80bb7740288fda1f201890375a60c8f = (int) $this->getId();$vab4d719bb5871955352ccf0727db833e = (int) $this->getLinkId();$vebed715e82a0a0f3e950ef6565cdc4a8 = $v4717d53ebfdfea8477f780ec66151dcb->escape($this->getPlace());$v599dcce2998a6b40b1e38e8c6006cb0a = $v4717d53ebfdfea8477f780ec66151dcb->escape($this->getType());$vac5c74b64b4b8352ef2f181affb5ac2a = <<<SQL
UPDATE
	`$v80071f37861c360a27b7327e132c911a`
SET
	`$v3c3bd88d09eb13276568c6fbb690a500` = $vab4d719bb5871955352ccf0727db833e, `$v08eafb2445e09e935a785d2153aec7e9` = '$vebed715e82a0a0f3e950ef6565cdc4a8', `$vce6ba6b4afd61be6d0f21f1e2a995213` = '$v599dcce2998a6b40b1e38e8c6006cb0a'
WHERE
	`$vbb1df230a5150b8ac17121321b3b514c` = $vb80bb7740288fda1f201890375a60c8f;
SQL;  $v4717d53ebfdfea8477f780ec66151dcb->query($vac5c74b64b4b8352ef2f181affb5ac2a);return $this;}private function getLocalFilePath($vcc698f1c6ddbd3eb9ff201b77db2703d) {$v9b10042c3abb040c5a7cf29d2b883c07 = mb_strlen(CURRENT_WORKING_DIR);return mb_substr($vcc698f1c6ddbd3eb9ff201b77db2703d, $v9b10042c3abb040c5a7cf29d2b883c07);}}