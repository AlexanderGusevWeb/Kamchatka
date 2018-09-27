<?php
 use UmiCms\Service;use UmiCms\System\Data\Object\Type\Hierarchy\iRelation;use UmiCms\System\Data\Object\Type\Hierarchy\Relation\iRepository;class umiObjectTypesCollection extends singleton implements iSingleton, iUmiObjectTypesCollection {private $types = [];protected function __construct() {}public static function getInstance($v4a8a08f09d37b73795649038408b5f33 = null) {return parent::getInstance(__CLASS__);}public function getType($vb80bb7740288fda1f201890375a60c8f) {if (!$vb80bb7740288fda1f201890375a60c8f) {return false;}if (!is_numeric($vb80bb7740288fda1f201890375a60c8f)) {$vb80bb7740288fda1f201890375a60c8f = $this->getTypeIdByGUID($vb80bb7740288fda1f201890375a60c8f);}if ($this->isLoaded($vb80bb7740288fda1f201890375a60c8f)) {return $this->types[$vb80bb7740288fda1f201890375a60c8f];}$this->loadType($vb80bb7740288fda1f201890375a60c8f);return getArrayKey($this->types, $vb80bb7740288fda1f201890375a60c8f);}public function getTypeByGUID($v1e0ca5b1252f1f6b1e0ac91be7e7219e) {$vb80bb7740288fda1f201890375a60c8f = $this->getTypeIdByGUID($v1e0ca5b1252f1f6b1e0ac91be7e7219e);return $this->getType($vb80bb7740288fda1f201890375a60c8f);}public function getTypeIdByFieldId($vb80bb7740288fda1f201890375a60c8f) {static $v0fea6a13c52b4d4725368f24b045ca84 = [];$vb80bb7740288fda1f201890375a60c8f = (int) $vb80bb7740288fda1f201890375a60c8f;if (isset($v0fea6a13c52b4d4725368f24b045ca84[$vb80bb7740288fda1f201890375a60c8f])) {return $v0fea6a13c52b4d4725368f24b045ca84[$vb80bb7740288fda1f201890375a60c8f];}$vac5c74b64b4b8352ef2f181affb5ac2a = <<<SQL
SELECT  MIN(fg.type_id)
	FROM cms3_fields_controller fc, cms3_object_field_groups fg
	WHERE fc.field_id = {$vb80bb7740288fda1f201890375a60c8f} AND fg.id = fc.group_id
SQL;   $v4717d53ebfdfea8477f780ec66151dcb = ConnectionPool::getInstance()->getConnection();$result = $v4717d53ebfdfea8477f780ec66151dcb->queryResult($vac5c74b64b4b8352ef2f181affb5ac2a);$result->setFetchType(IQueryResult::FETCH_ROW);if ($result->length() > 0) {$v54851b009c5c647ca3e77cc517b8c76c = $result->fetch();$v6301cee35ea764a1e241978f93f01069 = array_shift($v54851b009c5c647ca3e77cc517b8c76c);}else {$v6301cee35ea764a1e241978f93f01069 = false;}return $v0fea6a13c52b4d4725368f24b045ca84[$vb80bb7740288fda1f201890375a60c8f] = $v6301cee35ea764a1e241978f93f01069;}public function getTypeIdByGUID($v1e0ca5b1252f1f6b1e0ac91be7e7219e, $vece42746c2b3aa1e585809fa739602ae = false) {if (!is_string($v1e0ca5b1252f1f6b1e0ac91be7e7219e) || empty($v1e0ca5b1252f1f6b1e0ac91be7e7219e)) {return false;}foreach ($this->types as $v599dcce2998a6b40b1e38e8c6006cb0a) {if ($v599dcce2998a6b40b1e38e8c6006cb0a->getGUID() == $v1e0ca5b1252f1f6b1e0ac91be7e7219e) {return $v599dcce2998a6b40b1e38e8c6006cb0a->getId();}}$v4717d53ebfdfea8477f780ec66151dcb = ConnectionPool::getInstance()    ->getConnection();$v1e0ca5b1252f1f6b1e0ac91be7e7219e = $v4717d53ebfdfea8477f780ec66151dcb->escape($v1e0ca5b1252f1f6b1e0ac91be7e7219e);$v8bc4403642c02217dc1341694acb244d = <<<SQL
SELECT `id` FROM `cms3_object_types` WHERE `guid` = '{$v1e0ca5b1252f1f6b1e0ac91be7e7219e}' LIMIT 0,1
SQL;   $result = $v4717d53ebfdfea8477f780ec66151dcb->queryResult($v8bc4403642c02217dc1341694acb244d);$result->setFetchType(IQueryResult::FETCH_ROW);if ($result->length() == 0) {return false;}$v54851b009c5c647ca3e77cc517b8c76c = $result->fetch();return (int) array_shift($v54851b009c5c647ca3e77cc517b8c76c);}public function addType($vbfa030fe63bacd523dd70a76cfaed98a, $vb068931cc450442b63f5b3d276ea4297, $v73b8754d45983f35756b157ea439de8c = false, $va0913828f00eefe560bcf007c7ae015a = false) {$vbfa030fe63bacd523dd70a76cfaed98a = (int) $vbfa030fe63bacd523dd70a76cfaed98a;$v4717d53ebfdfea8477f780ec66151dcb = ConnectionPool::getInstance()->getConnection();$v4717d53ebfdfea8477f780ec66151dcb->startTransaction(sprintf('Create object type "%s" with parent id = %d', $vb068931cc450442b63f5b3d276ea4297, $vbfa030fe63bacd523dd70a76cfaed98a));try {$vac5c74b64b4b8352ef2f181affb5ac2a = "INSERT INTO cms3_object_types (parent_id) VALUES('{$vbfa030fe63bacd523dd70a76cfaed98a}')";$v4717d53ebfdfea8477f780ec66151dcb->query($vac5c74b64b4b8352ef2f181affb5ac2a);$v5f694956811487225d15e973ca38fbab = $v4717d53ebfdfea8477f780ec66151dcb->insertId();if (!$va0913828f00eefe560bcf007c7ae015a) {$vac5c74b64b4b8352ef2f181affb5ac2a = "SELECT * FROM cms3_object_field_groups WHERE type_id = '{$vbfa030fe63bacd523dd70a76cfaed98a}'";$result = $v4717d53ebfdfea8477f780ec66151dcb->queryResult($vac5c74b64b4b8352ef2f181affb5ac2a);$result->setFetchType(IQueryResult::FETCH_ASSOC);foreach ($result as $vf1965a857bc285d26fe22023aa5ab50d) {$vac5c74b64b4b8352ef2f181affb5ac2a = <<<SQL
INSERT INTO cms3_object_field_groups (name, title, type_id, is_active, is_visible, ord, is_locked)
VALUES (
		'{$v4717d53ebfdfea8477f780ec66151dcb->escape($vf1965a857bc285d26fe22023aa5ab50d['name'])}',
		'{$v4717d53ebfdfea8477f780ec66151dcb->escape($vf1965a857bc285d26fe22023aa5ab50d['title'])}',
		'{$v5f694956811487225d15e973ca38fbab}',
		'{$vf1965a857bc285d26fe22023aa5ab50d['is_active']}',
		'{$vf1965a857bc285d26fe22023aa5ab50d['is_visible']}',
		'{$vf1965a857bc285d26fe22023aa5ab50d['ord']}',
		'{$vf1965a857bc285d26fe22023aa5ab50d['is_locked']}'
);
SQL;      $v4717d53ebfdfea8477f780ec66151dcb->query($vac5c74b64b4b8352ef2f181affb5ac2a);$v390e5b152c952a92ad629c3c8b06663f = $vf1965a857bc285d26fe22023aa5ab50d['id'];$vff9cf219aa220e28c4427f9f02a4b294 = $v4717d53ebfdfea8477f780ec66151dcb->insertId();$vac5c74b64b4b8352ef2f181affb5ac2a = <<<SQL
INSERT INTO cms3_fields_controller
SELECT ord, field_id, '{$vff9cf219aa220e28c4427f9f02a4b294}' FROM cms3_fields_controller WHERE group_id = '{$v390e5b152c952a92ad629c3c8b06663f}';
SQL;      $v4717d53ebfdfea8477f780ec66151dcb->query($vac5c74b64b4b8352ef2f181affb5ac2a);}}$v3a36824e16d1b7b22a785231a1138898 = false;if ($vbfa030fe63bacd523dd70a76cfaed98a) {$v2d167696e35bbbaa2b026d0ffbbeaf68 = $this->getType($vbfa030fe63bacd523dd70a76cfaed98a);if ($v2d167696e35bbbaa2b026d0ffbbeaf68) {$v3a36824e16d1b7b22a785231a1138898 = $v2d167696e35bbbaa2b026d0ffbbeaf68->getHierarchyTypeId();}}$v599dcce2998a6b40b1e38e8c6006cb0a = new umiObjectType($v5f694956811487225d15e973ca38fbab);$v599dcce2998a6b40b1e38e8c6006cb0a->setName($vb068931cc450442b63f5b3d276ea4297);$v599dcce2998a6b40b1e38e8c6006cb0a->setIsLocked($v73b8754d45983f35756b157ea439de8c);if ($v3a36824e16d1b7b22a785231a1138898) {$v599dcce2998a6b40b1e38e8c6006cb0a->setHierarchyTypeId($v3a36824e16d1b7b22a785231a1138898);}$v599dcce2998a6b40b1e38e8c6006cb0a->commit();$this->getHierarchyRelationRepository()     ->createRecursively($v599dcce2998a6b40b1e38e8c6006cb0a->getParentId(), $v599dcce2998a6b40b1e38e8c6006cb0a->getId());}catch (databaseException $v42552b1f133f9f8eb406d4f306ea9fd1) {$v4717d53ebfdfea8477f780ec66151dcb->rollbackTransaction();throw $v42552b1f133f9f8eb406d4f306ea9fd1;}$v4717d53ebfdfea8477f780ec66151dcb->commitTransaction();$this->types[$v5f694956811487225d15e973ca38fbab] = $v599dcce2998a6b40b1e38e8c6006cb0a;umiBranch::saveBranchedTablesRelations();return $v5f694956811487225d15e973ca38fbab;}public function delType($v5f694956811487225d15e973ca38fbab) {$v599dcce2998a6b40b1e38e8c6006cb0a = $this->getType($v5f694956811487225d15e973ca38fbab);if (!$v599dcce2998a6b40b1e38e8c6006cb0a instanceof iUmiObjectType) {return false;}if ($v599dcce2998a6b40b1e38e8c6006cb0a->getIsLocked()) {throw new publicAdminException(getLabel('error-object-type-locked'));}$v9a62e3947dc2b94af4417a8390e58cc3 = $this->getChildTypeIds($v5f694956811487225d15e973ca38fbab);$v9a62e3947dc2b94af4417a8390e58cc3[] = (int) $v5f694956811487225d15e973ca38fbab;foreach ($v9a62e3947dc2b94af4417a8390e58cc3 as $v5f694956811487225d15e973ca38fbab) {$v599dcce2998a6b40b1e38e8c6006cb0a = $this->getType($v5f694956811487225d15e973ca38fbab);if (!$v599dcce2998a6b40b1e38e8c6006cb0a instanceof iUmiObjectType) {continue;}foreach ($v599dcce2998a6b40b1e38e8c6006cb0a->getFieldsGroupsList(true) as $vdb0f6f37ebeb6ea09489124345af2a45) {$v599dcce2998a6b40b1e38e8c6006cb0a->delFieldsGroup($vdb0f6f37ebeb6ea09489124345af2a45->getId());}$this->unloadType($v5f694956811487225d15e973ca38fbab);}$v9a62e3947dc2b94af4417a8390e58cc3 = implode(', ', $v9a62e3947dc2b94af4417a8390e58cc3);$v4717d53ebfdfea8477f780ec66151dcb = ConnectionPool::getInstance()->getConnection();$vac5c74b64b4b8352ef2f181affb5ac2a = "DELETE FROM cms3_objects WHERE type_id IN ({$v9a62e3947dc2b94af4417a8390e58cc3})";$v4717d53ebfdfea8477f780ec66151dcb->query($vac5c74b64b4b8352ef2f181affb5ac2a);$vac5c74b64b4b8352ef2f181affb5ac2a = "DELETE FROM cms3_object_types WHERE id IN ({$v9a62e3947dc2b94af4417a8390e58cc3})";$v4717d53ebfdfea8477f780ec66151dcb->query($vac5c74b64b4b8352ef2f181affb5ac2a);$vac5c74b64b4b8352ef2f181affb5ac2a = "DELETE FROM cms3_import_types WHERE new_id IN ({$v9a62e3947dc2b94af4417a8390e58cc3})";$v4717d53ebfdfea8477f780ec66151dcb->query($vac5c74b64b4b8352ef2f181affb5ac2a);umiBranch::saveBranchedTablesRelations();return true;}public function unloadType($vb80bb7740288fda1f201890375a60c8f) {if ($this->isLoaded($vb80bb7740288fda1f201890375a60c8f)) {unset($this->types[$vb80bb7740288fda1f201890375a60c8f]);}return $this;}private function isLoaded($v5f694956811487225d15e973ca38fbab) {if (!is_string($v5f694956811487225d15e973ca38fbab) && !is_int($v5f694956811487225d15e973ca38fbab)) {return false;}return (bool) array_key_exists($v5f694956811487225d15e973ca38fbab, $this->types);}private function loadType($v5f694956811487225d15e973ca38fbab) {if ($this->isLoaded($v5f694956811487225d15e973ca38fbab)) {return true;}try {$v599dcce2998a6b40b1e38e8c6006cb0a = new umiObjectType($v5f694956811487225d15e973ca38fbab);$this->types[$v5f694956811487225d15e973ca38fbab] = $v599dcce2998a6b40b1e38e8c6006cb0a;return true;}catch (privateException $ve1671797c52e15f763380b45e841ec32) {$ve1671797c52e15f763380b45e841ec32->unregister();return false;}}public function getSubTypesList($v5f694956811487225d15e973ca38fbab) {return $this->getHierarchyRelationRepository()    ->getNearestChildIdList($v5f694956811487225d15e973ca38fbab);}public function getSubTypeListByDomain($v5f694956811487225d15e973ca38fbab, $v72ee76c5c29383b7c9f9225c1fa4d10b) {return $this->getHierarchyRelationRepository()    ->getNearestChildIdListWithDomain($v5f694956811487225d15e973ca38fbab, $v72ee76c5c29383b7c9f9225c1fa4d10b);}public function getParentTypeId($v5f694956811487225d15e973ca38fbab) {if ($this->isLoaded($v5f694956811487225d15e973ca38fbab)) {return $this->getType($v5f694956811487225d15e973ca38fbab)->getParentId();}return $this->getHierarchyRelationRepository()    ->getNearestAncestorId($v5f694956811487225d15e973ca38fbab);}public function getChildTypeIds($v5f694956811487225d15e973ca38fbab, $v268184c12df027f536154d099d497b31 = false) {$va8d8b14c2944fa96236c337c3305270f = $this->getHierarchyRelationRepository()    ->getChildList($v5f694956811487225d15e973ca38fbab);return $this->buildChildIdList($va8d8b14c2944fa96236c337c3305270f);}public function getChildIdListByDomain($v5f694956811487225d15e973ca38fbab, $v72ee76c5c29383b7c9f9225c1fa4d10b) {$va8d8b14c2944fa96236c337c3305270f = $this->getHierarchyRelationRepository()    ->getChildListWithDomain($v5f694956811487225d15e973ca38fbab, $v72ee76c5c29383b7c9f9225c1fa4d10b);return $this->buildChildIdList($va8d8b14c2944fa96236c337c3305270f);}public function getChildIdListByParentIdList(array $v5a2576254d428ddc22a03fac145c8749) {$va8d8b14c2944fa96236c337c3305270f = $this->getHierarchyRelationRepository()    ->getChildListByAncestorIdList($v5a2576254d428ddc22a03fac145c8749);return $this->buildChildIdList($va8d8b14c2944fa96236c337c3305270f);}public function getIdListByNameLike($vb068931cc450442b63f5b3d276ea4297, $v72ee76c5c29383b7c9f9225c1fa4d10b) {if (!is_string($vb068931cc450442b63f5b3d276ea4297) || isEmptyString($vb068931cc450442b63f5b3d276ea4297)) {return [];}$v62d065196a8bc83904c512f52c2300ed = $this->getNameCondition($vb068931cc450442b63f5b3d276ea4297);$vbf14d04db94110ef7eb9bf81e6cda0af = $this->getDomainIdCondition($v72ee76c5c29383b7c9f9225c1fa4d10b);$vac5c74b64b4b8352ef2f181affb5ac2a = <<<SQL
SELECT `id`
FROM `cms3_object_types`
WHERE `name` LIKE '%$vb068931cc450442b63f5b3d276ea4297%' $v62d065196a8bc83904c512f52c2300ed AND $vbf14d04db94110ef7eb9bf81e6cda0af
SQL;   $result = ConnectionPool::getInstance()    ->getConnection()    ->queryResult($vac5c74b64b4b8352ef2f181affb5ac2a);return $this->buildTypeIdList($result);}public function getGuidesList($v848510e91f02f04fc5edf94f85f248d8 = false, $va08f2aee9de301619776deb6fee83e50 = null) {$v694bf03dedba7859b504b64bab1f68fc = $v848510e91f02f04fc5edf94f85f248d8 ? "AND is_public = '1'" : '';$vac5c74b64b4b8352ef2f181affb5ac2a = "SELECT id, name FROM cms3_object_types WHERE is_guidable = '1' {$v694bf03dedba7859b504b64bab1f68fc}";if ($va08f2aee9de301619776deb6fee83e50) {$va08f2aee9de301619776deb6fee83e50 = (int) $va08f2aee9de301619776deb6fee83e50;$vac5c74b64b4b8352ef2f181affb5ac2a .= " AND parent_id = '{$va08f2aee9de301619776deb6fee83e50}'";}$v4717d53ebfdfea8477f780ec66151dcb = ConnectionPool::getInstance()->getConnection();$result = $v4717d53ebfdfea8477f780ec66151dcb->queryResult($vac5c74b64b4b8352ef2f181affb5ac2a);$result->setFetchType(IQueryResult::FETCH_ROW);$v09dd7000e9f9fa14141eea8ea8edc13c = [];foreach ($result as $vf1965a857bc285d26fe22023aa5ab50d) {list($vb80bb7740288fda1f201890375a60c8f, $vb068931cc450442b63f5b3d276ea4297) = $vf1965a857bc285d26fe22023aa5ab50d;$v09dd7000e9f9fa14141eea8ea8edc13c[$vb80bb7740288fda1f201890375a60c8f] = $this->translateLabel($vb068931cc450442b63f5b3d276ea4297);}return $v09dd7000e9f9fa14141eea8ea8edc13c;}public function getTypesByHierarchyTypeId($vaa0bb62d762a477cc976e0a1bf0ce827, $v35507ea46d2c0b049d7ed968c449223d = false) {static $v0fea6a13c52b4d4725368f24b045ca84 = [];$vaa0bb62d762a477cc976e0a1bf0ce827 = (int) $vaa0bb62d762a477cc976e0a1bf0ce827;if (isset($v0fea6a13c52b4d4725368f24b045ca84[$vaa0bb62d762a477cc976e0a1bf0ce827]) && !$v35507ea46d2c0b049d7ed968c449223d) {return $v0fea6a13c52b4d4725368f24b045ca84[$vaa0bb62d762a477cc976e0a1bf0ce827];}$v4717d53ebfdfea8477f780ec66151dcb = ConnectionPool::getInstance()->getConnection();$vac5c74b64b4b8352ef2f181affb5ac2a = "SELECT id, name FROM cms3_object_types WHERE hierarchy_type_id = '{$vaa0bb62d762a477cc976e0a1bf0ce827}'";$result = $v4717d53ebfdfea8477f780ec66151dcb->queryResult($vac5c74b64b4b8352ef2f181affb5ac2a);$result->setFetchType(IQueryResult::FETCH_ROW);$v9a62e3947dc2b94af4417a8390e58cc3 = [];foreach ($result as $vf1965a857bc285d26fe22023aa5ab50d) {list($vb80bb7740288fda1f201890375a60c8f, $vb068931cc450442b63f5b3d276ea4297) = $vf1965a857bc285d26fe22023aa5ab50d;$v9a62e3947dc2b94af4417a8390e58cc3[$vb80bb7740288fda1f201890375a60c8f] = $this->translateLabel($vb068931cc450442b63f5b3d276ea4297);}return $v0fea6a13c52b4d4725368f24b045ca84[$vaa0bb62d762a477cc976e0a1bf0ce827] = $v9a62e3947dc2b94af4417a8390e58cc3;}public function getListByBaseTypeAndDomain($vaa0bb62d762a477cc976e0a1bf0ce827, $v72ee76c5c29383b7c9f9225c1fa4d10b) {$vaa0bb62d762a477cc976e0a1bf0ce827 = (int) $vaa0bb62d762a477cc976e0a1bf0ce827;$vbf14d04db94110ef7eb9bf81e6cda0af = $this->getDomainIdCondition($v72ee76c5c29383b7c9f9225c1fa4d10b);$vac5c74b64b4b8352ef2f181affb5ac2a = <<<SQL
SELECT `id`, `name`, `guid`, `is_locked`, `parent_id`, `is_guidable`, `is_public`, `hierarchy_type_id`, `sortable`, 
`domain_id`
FROM `cms3_object_types`
WHERE `hierarchy_type_id` = $vaa0bb62d762a477cc976e0a1bf0ce827 AND $vbf14d04db94110ef7eb9bf81e6cda0af
SQL;   $result = ConnectionPool::getInstance()    ->getConnection()    ->queryResult($vac5c74b64b4b8352ef2f181affb5ac2a);return $this->buildTypeList($result);}public function getTypeIdByHierarchyTypeId($vb80bb7740288fda1f201890375a60c8f, $v35507ea46d2c0b049d7ed968c449223d = false) {static $v0fea6a13c52b4d4725368f24b045ca84 = [];$vb80bb7740288fda1f201890375a60c8f = (int) $vb80bb7740288fda1f201890375a60c8f;if (isset($v0fea6a13c52b4d4725368f24b045ca84[$vb80bb7740288fda1f201890375a60c8f]) && !$v35507ea46d2c0b049d7ed968c449223d && !cmsController::$IGNORE_MICROCACHE) {return $v0fea6a13c52b4d4725368f24b045ca84[$vb80bb7740288fda1f201890375a60c8f];}$v4717d53ebfdfea8477f780ec66151dcb = ConnectionPool::getInstance()->getConnection();$vac5c74b64b4b8352ef2f181affb5ac2a = "SELECT id FROM cms3_object_types WHERE hierarchy_type_id = '{$vb80bb7740288fda1f201890375a60c8f}' LIMIT 1";$result = $v4717d53ebfdfea8477f780ec66151dcb->queryResult($vac5c74b64b4b8352ef2f181affb5ac2a);$result->setFetchType(IQueryResult::FETCH_ROW);$v5f694956811487225d15e973ca38fbab = false;if ($result->length() > 0) {$v54851b009c5c647ca3e77cc517b8c76c = $result->fetch();$v5f694956811487225d15e973ca38fbab = array_shift($v54851b009c5c647ca3e77cc517b8c76c);}return $v0fea6a13c52b4d4725368f24b045ca84[$vb80bb7740288fda1f201890375a60c8f] = $v5f694956811487225d15e973ca38fbab;}public function getAllTypes() {static $v0fea6a13c52b4d4725368f24b045ca84 = [];if (!empty($v0fea6a13c52b4d4725368f24b045ca84)) {return $v0fea6a13c52b4d4725368f24b045ca84;}$v4717d53ebfdfea8477f780ec66151dcb = ConnectionPool::getInstance()->getConnection();$vac5c74b64b4b8352ef2f181affb5ac2a = <<<SQL
SELECT id, name, guid, is_locked, parent_id, is_guidable, is_public, hierarchy_type_id, sortable, domain_id
FROM cms3_object_types;
SQL;   $result = $v4717d53ebfdfea8477f780ec66151dcb->queryResult($vac5c74b64b4b8352ef2f181affb5ac2a);$result->setFetchType(IQueryResult::FETCH_ASSOC);$vd14a8022b085f9ef19d479cbdd581127 = [];foreach ($result as $vf1965a857bc285d26fe22023aa5ab50d) {$vf1965a857bc285d26fe22023aa5ab50d['name'] = $this->translateLabel($vf1965a857bc285d26fe22023aa5ab50d['name']);$vd14a8022b085f9ef19d479cbdd581127[$vf1965a857bc285d26fe22023aa5ab50d['id']] = $vf1965a857bc285d26fe22023aa5ab50d;}return $v0fea6a13c52b4d4725368f24b045ca84 = $vd14a8022b085f9ef19d479cbdd581127;}public function getTypeIdByHierarchyTypeName($v22884db148f0ffb0d830ba431102b0b5, $vea9f6aca279138c58f705c8d4cb4b8ce = '') {$v89b0b9deff65f8b9cd1f71bc74ce36ba = selector::get('hierarchy-type')->name($v22884db148f0ffb0d830ba431102b0b5, $vea9f6aca279138c58f705c8d4cb4b8ce);if (!$v89b0b9deff65f8b9cd1f71bc74ce36ba) {return false;}$vacf567c9c3d6cf7c6e2cc0ce108e0631 = $v89b0b9deff65f8b9cd1f71bc74ce36ba->getId();$v5f694956811487225d15e973ca38fbab = $this->getTypeIdByHierarchyTypeId($vacf567c9c3d6cf7c6e2cc0ce108e0631);return (int) $v5f694956811487225d15e973ca38fbab;}public function clearCache() {$this->types = [];}public function getHierarchyTypeIdByObjectTypeId($vb80bb7740288fda1f201890375a60c8f) {static $v0fea6a13c52b4d4725368f24b045ca84 = [];$vb80bb7740288fda1f201890375a60c8f = (int) $vb80bb7740288fda1f201890375a60c8f;if (isset($v0fea6a13c52b4d4725368f24b045ca84[$vb80bb7740288fda1f201890375a60c8f])) {return $v0fea6a13c52b4d4725368f24b045ca84[$vb80bb7740288fda1f201890375a60c8f];}$v4717d53ebfdfea8477f780ec66151dcb = ConnectionPool::getInstance()->getConnection();$vac5c74b64b4b8352ef2f181affb5ac2a = "SELECT `hierarchy_type_id` as id FROM `cms3_object_types` WHERE `id` = {$vb80bb7740288fda1f201890375a60c8f};";$result = $v4717d53ebfdfea8477f780ec66151dcb->queryResult($vac5c74b64b4b8352ef2f181affb5ac2a);$result->setFetchType(IQueryResult::FETCH_ASSOC);$vacf567c9c3d6cf7c6e2cc0ce108e0631 = false;if ($result->length() > 0) {$v54851b009c5c647ca3e77cc517b8c76c = $result->fetch();$vacf567c9c3d6cf7c6e2cc0ce108e0631 = array_shift($v54851b009c5c647ca3e77cc517b8c76c);}return $v0fea6a13c52b4d4725368f24b045ca84[$vb80bb7740288fda1f201890375a60c8f] = $vacf567c9c3d6cf7c6e2cc0ce108e0631;}public function getIdList($vaa9f73eea60a006820d0f8768bc8a3fc = 15, $v7a86c157ee9713c34fbd7a1ee40f0c5a = 0) {$v5a0f217f54927dfb5cb016b73d657e97 = (int) $vaa9f73eea60a006820d0f8768bc8a3fc;$v8c9b5763e67cd287e1e815fffa4de408 = (int) $v7a86c157ee9713c34fbd7a1ee40f0c5a;$vac5c74b64b4b8352ef2f181affb5ac2a = <<<SQL
SELECT `id`
FROM `cms3_object_types`
LIMIT $v8c9b5763e67cd287e1e815fffa4de408, $v5a0f217f54927dfb5cb016b73d657e97;
SQL;   $result = ConnectionPool::getInstance()    ->getConnection()    ->queryResult($vac5c74b64b4b8352ef2f181affb5ac2a);$result->setFetchType(IQueryResult::FETCH_ROW);$v5a2576254d428ddc22a03fac145c8749 = [];foreach ($result as $vf1965a857bc285d26fe22023aa5ab50d) {$v5a2576254d428ddc22a03fac145c8749[] = getFirstValue($vf1965a857bc285d26fe22023aa5ab50d);}return $v5a2576254d428ddc22a03fac145c8749;}private function getHierarchyRelationRepository() {return Service::get('ObjectTypeHierarchyRelationRepository');}private function buildChildIdList(array $v8f860260e98c7b73cb53d4d3eba7f7f8) {$v5a2576254d428ddc22a03fac145c8749 = [];foreach ($v8f860260e98c7b73cb53d4d3eba7f7f8 as $v2617c9384e4bb1af369e034ffd4490c9) {$v5a2576254d428ddc22a03fac145c8749[] = $v2617c9384e4bb1af369e034ffd4490c9->getChildId();}return $v5a2576254d428ddc22a03fac145c8749;}private function buildTypeIdList(\IQueryResult $result) {if ($result->length() === 0) {return [];}$result->setFetchType(\IQueryResult::FETCH_ASSOC);$v5a2576254d428ddc22a03fac145c8749 = [];foreach ($result as $vf1965a857bc285d26fe22023aa5ab50d) {$v5a2576254d428ddc22a03fac145c8749[] = array_shift($vf1965a857bc285d26fe22023aa5ab50d);}return $v5a2576254d428ddc22a03fac145c8749;}private function buildTypeList(\IQueryResult $result) {if ($result->length() === 0) {return [];}$result->setFetchType(\IQueryResult::FETCH_ROW);$va9e2e7908a1f06effc849966dcf44b1c = [];foreach ($result as $vf1965a857bc285d26fe22023aa5ab50d) {try {$vb80bb7740288fda1f201890375a60c8f = array_shift($vf1965a857bc285d26fe22023aa5ab50d);$va9e2e7908a1f06effc849966dcf44b1c[] = new umiObjectType($vb80bb7740288fda1f201890375a60c8f, $vf1965a857bc285d26fe22023aa5ab50d);}catch (privateException $v42552b1f133f9f8eb406d4f306ea9fd1) {$v42552b1f133f9f8eb406d4f306ea9fd1->unregister();continue;}}return $va9e2e7908a1f06effc849966dcf44b1c;}private function getNameCondition($vb068931cc450442b63f5b3d276ea4297) {$vb068931cc450442b63f5b3d276ea4297 = ConnectionPool::getInstance()    ->getConnection()    ->escape($vb068931cc450442b63f5b3d276ea4297);$v8b4d1617f55e9404b749d88dc02ee6a4 = ulangStream::getI18n($vb068931cc450442b63f5b3d276ea4297, '', true);$v3bb5a38a4859f1304153b3a8edcc8d82 = (is_array($v8b4d1617f55e9404b749d88dc02ee6a4) && isEmptyArray($v8b4d1617f55e9404b749d88dc02ee6a4)) ? '' : ' OR `name` %s';return sprintf($v3bb5a38a4859f1304153b3a8edcc8d82, $this->buildInCondition($v8b4d1617f55e9404b749d88dc02ee6a4));}private function getDomainIdCondition($v72ee76c5c29383b7c9f9225c1fa4d10b) {$v72ee76c5c29383b7c9f9225c1fa4d10b = (int) $v72ee76c5c29383b7c9f9225c1fa4d10b;$vc3693ef984d5072b023dbedd71d1ef0e = ($v72ee76c5c29383b7c9f9225c1fa4d10b > 0) ? '(`domain_id` %s OR `domain_id` IS NULL)' : '`domain_id` %s';return sprintf($vc3693ef984d5072b023dbedd71d1ef0e, $this->getNullOrIdCondition($v72ee76c5c29383b7c9f9225c1fa4d10b));}private function getNullOrIdCondition($vb80bb7740288fda1f201890375a60c8f) {$vb80bb7740288fda1f201890375a60c8f = (int) $vb80bb7740288fda1f201890375a60c8f;return ($vb80bb7740288fda1f201890375a60c8f === 0) ? 'IS NULL' : "= $vb80bb7740288fda1f201890375a60c8f";}private function buildInCondition(array $v10ae9fc7d453b0dd525d0edf2ede7961) {return "IN ('" . implode("', '", $v10ae9fc7d453b0dd525d0edf2ede7961) . "')";}public function getParentClassId($v5f694956811487225d15e973ca38fbab) {return $this->getParentTypeId($v5f694956811487225d15e973ca38fbab);}public function getChildClasses($v5f694956811487225d15e973ca38fbab, $v268184c12df027f536154d099d497b31 = false) {return $this->getChildTypeIds($v5f694956811487225d15e973ca38fbab, $v268184c12df027f536154d099d497b31);}public function getTypeByHierarchyTypeId($vacf567c9c3d6cf7c6e2cc0ce108e0631, $v35507ea46d2c0b049d7ed968c449223d = false) {return $this->getTypeIdByHierarchyTypeId($vacf567c9c3d6cf7c6e2cc0ce108e0631, $v35507ea46d2c0b049d7ed968c449223d);}public function getBaseType($v22884db148f0ffb0d830ba431102b0b5, $vea9f6aca279138c58f705c8d4cb4b8ce = '') {return $this->getTypeIdByHierarchyTypeName($v22884db148f0ffb0d830ba431102b0b5, $vea9f6aca279138c58f705c8d4cb4b8ce);}public function isExists($v94757cae63fd3e398c0811a976dd6bbe) {return true;}}