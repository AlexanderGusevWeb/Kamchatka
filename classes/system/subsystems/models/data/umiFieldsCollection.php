<?php
 class umiFieldsCollection extends singleton implements iUmiFieldsCollection {private $loadedFieldList = [];public static function getInstance($v6f66e878c62db60568a3487869695820 = null) {return parent::getInstance(__CLASS__);}public function add($vb068931cc450442b63f5b3d276ea4297, $vd5d3db1765287eef77d7927cc956f50a, $ve2aeb4e882d60b1eb4b7c8cd97986a28) {$vb80bb7740288fda1f201890375a60c8f = $this->addField($vb068931cc450442b63f5b3d276ea4297, $vd5d3db1765287eef77d7927cc956f50a, $ve2aeb4e882d60b1eb4b7c8cd97986a28);return $this->getLoadedField($vb80bb7740288fda1f201890375a60c8f);}public function getById($vb80bb7740288fda1f201890375a60c8f) {return $this->getField($vb80bb7740288fda1f201890375a60c8f);}public function delById($vb80bb7740288fda1f201890375a60c8f) {return $this->delField($vb80bb7740288fda1f201890375a60c8f);}public function isExists($vb80bb7740288fda1f201890375a60c8f) {$vb80bb7740288fda1f201890375a60c8f = (int) $vb80bb7740288fda1f201890375a60c8f;if ($vb80bb7740288fda1f201890375a60c8f === 0) {return false;}$v1b1cc7f086b3f074da452bc3129981eb = <<<SQL
SELECT `id` FROM `cms3_object_fields` WHERE `id` = $vb80bb7740288fda1f201890375a60c8f LIMIT 0, 1;
SQL;   $result = ConnectionPool::getInstance()    ->getConnection()    ->queryResult($v1b1cc7f086b3f074da452bc3129981eb);return $result->length() == 1;}public function getFieldIdListByType(iUmiFieldType $v599dcce2998a6b40b1e38e8c6006cb0a) {$v4717d53ebfdfea8477f780ec66151dcb = ConnectionPool::getInstance()    ->getConnection();$ve2aeb4e882d60b1eb4b7c8cd97986a28 = (int) $v599dcce2998a6b40b1e38e8c6006cb0a->getId();$vac5c74b64b4b8352ef2f181affb5ac2a = <<<SQL
SELECT `id` FROM `cms3_object_fields` WHERE `field_type_id` = $ve2aeb4e882d60b1eb4b7c8cd97986a28;
SQL;   $result = $v4717d53ebfdfea8477f780ec66151dcb->queryResult($vac5c74b64b4b8352ef2f181affb5ac2a);$result->setFetchType(IQueryResult::FETCH_ASSOC);$ve491e7c03c219d563fe5073ad035bb25 = [];foreach ($result as $vf1965a857bc285d26fe22023aa5ab50d) {$ve491e7c03c219d563fe5073ad035bb25[] = $vf1965a857bc285d26fe22023aa5ab50d['id'];}return $ve491e7c03c219d563fe5073ad035bb25;}public function addField(   $vb068931cc450442b63f5b3d276ea4297,   $vd5d3db1765287eef77d7927cc956f50a,   $ve2aeb4e882d60b1eb4b7c8cd97986a28,   $v19fad0416b4b101ab72faccf4c323024 = true,   $v73b8754d45983f35756b157ea439de8c = false,   $v55e0eccc570671ca7ba7f5ef4ded0b96 = false  ) {$v4717d53ebfdfea8477f780ec66151dcb = ConnectionPool::getInstance()    ->getConnection();$vac5c74b64b4b8352ef2f181affb5ac2a = 'INSERT INTO cms3_object_fields VALUES()';$v4717d53ebfdfea8477f780ec66151dcb->query($vac5c74b64b4b8352ef2f181affb5ac2a);$vb80bb7740288fda1f201890375a60c8f = $v4717d53ebfdfea8477f780ec66151dcb->insertId();try {$v06e3d36fa30cea095545139854ad1fb9 = new umiField($vb80bb7740288fda1f201890375a60c8f);$v06e3d36fa30cea095545139854ad1fb9->setName($vb068931cc450442b63f5b3d276ea4297);$v06e3d36fa30cea095545139854ad1fb9->setTitle($vd5d3db1765287eef77d7927cc956f50a);$v06e3d36fa30cea095545139854ad1fb9->setFieldTypeId($ve2aeb4e882d60b1eb4b7c8cd97986a28);$v06e3d36fa30cea095545139854ad1fb9->setIsVisible($v19fad0416b4b101ab72faccf4c323024);$v06e3d36fa30cea095545139854ad1fb9->setIsLocked($v73b8754d45983f35756b157ea439de8c);$v06e3d36fa30cea095545139854ad1fb9->setIsInheritable($v55e0eccc570671ca7ba7f5ef4ded0b96);$v06e3d36fa30cea095545139854ad1fb9->commit();}catch (Exception $v42552b1f133f9f8eb406d4f306ea9fd1) {$this->delField($vb80bb7740288fda1f201890375a60c8f);throw $v42552b1f133f9f8eb406d4f306ea9fd1;}return $this->setLoadedField($v06e3d36fa30cea095545139854ad1fb9)    ->getLoadedField($vb80bb7740288fda1f201890375a60c8f)    ->getId();}public function getField($vb80bb7740288fda1f201890375a60c8f, $v8d777f385d3dfec8815d20f7496026dc = false) {if ($this->isLoaded($vb80bb7740288fda1f201890375a60c8f)) {return $this->getLoadedField($vb80bb7740288fda1f201890375a60c8f);}return $this->loadField($vb80bb7740288fda1f201890375a60c8f, $v8d777f385d3dfec8815d20f7496026dc);}public function getFieldList(array $v5a2576254d428ddc22a03fac145c8749) {$vcbeba6f137fc1a1a0af50bcc713cbfaf = [];foreach ($v5a2576254d428ddc22a03fac145c8749 as $vb80bb7740288fda1f201890375a60c8f) {if (!$this->isLoaded($vb80bb7740288fda1f201890375a60c8f)) {$vcbeba6f137fc1a1a0af50bcc713cbfaf[] = $vb80bb7740288fda1f201890375a60c8f;}}if (count($vcbeba6f137fc1a1a0af50bcc713cbfaf) > 0) {$this->loadFieldList($vcbeba6f137fc1a1a0af50bcc713cbfaf);}$v69fe4aec8073954bf273e3113edd24cf = [];foreach ($v5a2576254d428ddc22a03fac145c8749 as $vb80bb7740288fda1f201890375a60c8f) {$v06e3d36fa30cea095545139854ad1fb9 = $this->getLoadedField($vb80bb7740288fda1f201890375a60c8f);if ($v06e3d36fa30cea095545139854ad1fb9 instanceof iUmiField) {$v69fe4aec8073954bf273e3113edd24cf[] = $v06e3d36fa30cea095545139854ad1fb9;}}return $v69fe4aec8073954bf273e3113edd24cf;}public function delField($vb80bb7740288fda1f201890375a60c8f) {$vb80bb7740288fda1f201890375a60c8f = (int) $vb80bb7740288fda1f201890375a60c8f;if ($vb80bb7740288fda1f201890375a60c8f === 0) {return false;}$v4717d53ebfdfea8477f780ec66151dcb = ConnectionPool::getInstance()    ->getConnection();$vac5c74b64b4b8352ef2f181affb5ac2a = "DELETE FROM cms3_object_fields WHERE id = $vb80bb7740288fda1f201890375a60c8f";$v4717d53ebfdfea8477f780ec66151dcb->query($vac5c74b64b4b8352ef2f181affb5ac2a);$this->unloadField($vb80bb7740288fda1f201890375a60c8f);return $v4717d53ebfdfea8477f780ec66151dcb->affectedRows() > 0;}public function clearCache() {$this->unloadAllFields();}protected function __construct() {}private function loadFieldList(array $v5a2576254d428ddc22a03fac145c8749) {if (isEmptyArray($v5a2576254d428ddc22a03fac145c8749)) {return $this;}$v5a2576254d428ddc22a03fac145c8749 = array_map(function($vb80bb7740288fda1f201890375a60c8f){return (int) $vb80bb7740288fda1f201890375a60c8f;}, $v5a2576254d428ddc22a03fac145c8749);$v5a2576254d428ddc22a03fac145c8749 = array_unique($v5a2576254d428ddc22a03fac145c8749);$vaa9f73eea60a006820d0f8768bc8a3fc = count($v5a2576254d428ddc22a03fac145c8749);$v5a2576254d428ddc22a03fac145c8749 = implode(', ', $v5a2576254d428ddc22a03fac145c8749);$vac5c74b64b4b8352ef2f181affb5ac2a = <<<SQL
SELECT `id`, `name`, `title`, `is_locked`, `is_inheritable`, `is_visible`, `field_type_id`, `guide_id`, `in_search`, 
`in_filter`, `tip`, `is_required`, `sortable`, `is_system`, `restriction_id`, `is_important` 
FROM `cms3_object_fields`
WHERE `id` IN ($v5a2576254d428ddc22a03fac145c8749)
LIMIT 0, $vaa9f73eea60a006820d0f8768bc8a3fc
SQL;   $result = ConnectionPool::getInstance()    ->getConnection()    ->queryResult($vac5c74b64b4b8352ef2f181affb5ac2a);$result->setFetchType(IQueryResult::FETCH_ROW);foreach ($result as $vf1965a857bc285d26fe22023aa5ab50d) {$vb80bb7740288fda1f201890375a60c8f = getFirstValue($vf1965a857bc285d26fe22023aa5ab50d);$this->loadField($vb80bb7740288fda1f201890375a60c8f, $vf1965a857bc285d26fe22023aa5ab50d);}return $this;}private function unloadField($vb80bb7740288fda1f201890375a60c8f) {unset($this->loadedFieldList[$vb80bb7740288fda1f201890375a60c8f]);return $this;}private function unloadAllFields() {$this->loadedFieldList = [];return $this;}private function setLoadedField(iUmiField $v06e3d36fa30cea095545139854ad1fb9) {$this->loadedFieldList[$v06e3d36fa30cea095545139854ad1fb9->getId()] = $v06e3d36fa30cea095545139854ad1fb9;return $this;}private function getLoadedField($vb80bb7740288fda1f201890375a60c8f) {if (!$this->isLoaded($vb80bb7740288fda1f201890375a60c8f)) {return false;}return $this->loadedFieldList[$vb80bb7740288fda1f201890375a60c8f];}private function isLoaded($vb80bb7740288fda1f201890375a60c8f) {if (!is_numeric($vb80bb7740288fda1f201890375a60c8f)) {return false;}$vb80bb7740288fda1f201890375a60c8f = (int) $vb80bb7740288fda1f201890375a60c8f;return array_key_exists($vb80bb7740288fda1f201890375a60c8f, $this->loadedFieldList);}private function loadField($vb80bb7740288fda1f201890375a60c8f, $v8d777f385d3dfec8815d20f7496026dc = false) {try {$v06e3d36fa30cea095545139854ad1fb9 = new umiField($vb80bb7740288fda1f201890375a60c8f, $v8d777f385d3dfec8815d20f7496026dc);}catch(privateException $ve1671797c52e15f763380b45e841ec32) {$ve1671797c52e15f763380b45e841ec32->unregister();return false;}$this->setLoadedField($v06e3d36fa30cea095545139854ad1fb9);return $v06e3d36fa30cea095545139854ad1fb9;}public function getRestrictionIdByFieldId($vb80bb7740288fda1f201890375a60c8f) {$v06e3d36fa30cea095545139854ad1fb9 = $this->getField($vb80bb7740288fda1f201890375a60c8f);return ($v06e3d36fa30cea095545139854ad1fb9 instanceof iUmiField) ? $v06e3d36fa30cea095545139854ad1fb9->getRestrictionId() : false;}public function isFieldRequired($vb80bb7740288fda1f201890375a60c8f) {$v06e3d36fa30cea095545139854ad1fb9 = $this->getField($vb80bb7740288fda1f201890375a60c8f);return ($v06e3d36fa30cea095545139854ad1fb9 instanceof iUmiField) ? $v06e3d36fa30cea095545139854ad1fb9->getIsRequired() : false;}}