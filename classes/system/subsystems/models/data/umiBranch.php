<?php
 class umiBranch {const DEFAULT_TABLE_NAME = 'cms3_object_content';static protected $branchedObjectTypes = false;public static function saveBranchedTablesRelations() {$v376c55509588b18566c9f05e98f82a34 = self::getCacheDirPath();$v87a0860e170e57ac18a827962ccd6816 = $v376c55509588b18566c9f05e98f82a34 . self::getCacheFileName();$v9b81909fd0da3add2602a8d0ede0e4e7 = umiObjectTypesCollection::getInstance();self::$branchedObjectTypes = [];clearstatcache();if (file_exists($v87a0860e170e57ac18a827962ccd6816)) {unlink($v87a0860e170e57ac18a827962ccd6816);}$v4717d53ebfdfea8477f780ec66151dcb = ConnectionPool::getInstance()->getConnection();$vac5c74b64b4b8352ef2f181affb5ac2a = "SHOW TABLES LIKE 'cms3_object_content%'";$result = $v4717d53ebfdfea8477f780ec66151dcb->queryResult($vac5c74b64b4b8352ef2f181affb5ac2a);$v8587774de94e7ee1616350d82cc72317 = [];$result->setFetchType(IQueryResult::FETCH_ROW);foreach ($result as $vf1965a857bc285d26fe22023aa5ab50d) {if (preg_match('/cms3_object_content_([0-9]+)/', array_shift($vf1965a857bc285d26fe22023aa5ab50d), $vc68271a63ddbc431c307beb7d2918275)) {$v8587774de94e7ee1616350d82cc72317[] = (int) $vc68271a63ddbc431c307beb7d2918275[1];}}$vf9ecb86fe4446d46abf44c1f55be3d43 = [];foreach ($v8587774de94e7ee1616350d82cc72317 as $vacf567c9c3d6cf7c6e2cc0ce108e0631) {$v0e8133eb006c0f85ed9444ae07a60842 = array_keys($v9b81909fd0da3add2602a8d0ede0e4e7->getTypesByHierarchyTypeId($vacf567c9c3d6cf7c6e2cc0ce108e0631));if (is_array($v0e8133eb006c0f85ed9444ae07a60842)) {foreach ($v0e8133eb006c0f85ed9444ae07a60842 as $v6301cee35ea764a1e241978f93f01069) {$vf9ecb86fe4446d46abf44c1f55be3d43[$v6301cee35ea764a1e241978f93f01069] = $vacf567c9c3d6cf7c6e2cc0ce108e0631;}}}if (is_dir($v376c55509588b18566c9f05e98f82a34) && is_writable($v376c55509588b18566c9f05e98f82a34)) {file_put_contents($v87a0860e170e57ac18a827962ccd6816, serialize($vf9ecb86fe4446d46abf44c1f55be3d43));}if (is_file($v87a0860e170e57ac18a827962ccd6816)) {chmod($v87a0860e170e57ac18a827962ccd6816, 0777);}return self::$branchedObjectTypes = $vf9ecb86fe4446d46abf44c1f55be3d43;}public static function getBranchedTableByTypeId($v6301cee35ea764a1e241978f93f01069) {$vf9ecb86fe4446d46abf44c1f55be3d43 = self::$branchedObjectTypes;if (!is_array($vf9ecb86fe4446d46abf44c1f55be3d43)) {$vf9ecb86fe4446d46abf44c1f55be3d43 = self::getBranchedTablesRelations();}if (isset($vf9ecb86fe4446d46abf44c1f55be3d43[$v6301cee35ea764a1e241978f93f01069])) {$vacf567c9c3d6cf7c6e2cc0ce108e0631 = $vf9ecb86fe4446d46abf44c1f55be3d43[$v6301cee35ea764a1e241978f93f01069];return 'cms3_object_content_' . $vacf567c9c3d6cf7c6e2cc0ce108e0631;}return self::DEFAULT_TABLE_NAME;}public static function getBranchedTableByObjectId($vb80bb7740288fda1f201890375a60c8f) {$va8cfde6331bd59eb2ac96f8911c4b666 = umiObjectsCollection::getInstance()    ->getObject($vb80bb7740288fda1f201890375a60c8f);if ($va8cfde6331bd59eb2ac96f8911c4b666 instanceof iUmiObject) {return self::getBranchedTableByTypeId($va8cfde6331bd59eb2ac96f8911c4b666->getTypeId());}return self::DEFAULT_TABLE_NAME;}public static function getBranchedTableByHierarchyTypeId($vacf567c9c3d6cf7c6e2cc0ce108e0631) {$vacf567c9c3d6cf7c6e2cc0ce108e0631 = (int) $vacf567c9c3d6cf7c6e2cc0ce108e0631;$v2d4981d1b44d7e5fbd57e776487353c0 = self::$branchedObjectTypes;if (is_array($v2d4981d1b44d7e5fbd57e776487353c0) && in_array($vacf567c9c3d6cf7c6e2cc0ce108e0631, $v2d4981d1b44d7e5fbd57e776487353c0)) {return 'cms3_object_content_' . $vacf567c9c3d6cf7c6e2cc0ce108e0631;}return self::DEFAULT_TABLE_NAME;}public static function checkIfBranchedByHierarchyTypeId($vacf567c9c3d6cf7c6e2cc0ce108e0631) {$vf9ecb86fe4446d46abf44c1f55be3d43 = self::$branchedObjectTypes;if (!is_array($vf9ecb86fe4446d46abf44c1f55be3d43)) {$vf9ecb86fe4446d46abf44c1f55be3d43 = self::getBranchedTablesRelations();}return (bool) in_array($vacf567c9c3d6cf7c6e2cc0ce108e0631, $vf9ecb86fe4446d46abf44c1f55be3d43);}public static function getDatabaseStatus() {$v3b456fa454c7082ea105317817db60eb = umiHierarchyTypesCollection::getInstance();$v3527525cd11a98e16f6c1d31fe7d89dd = $v3b456fa454c7082ea105317817db60eb->getTypesList();$result = [];foreach ($v3527525cd11a98e16f6c1d31fe7d89dd as $v89b0b9deff65f8b9cd1f71bc74ce36ba) {$vacf567c9c3d6cf7c6e2cc0ce108e0631 = $v89b0b9deff65f8b9cd1f71bc74ce36ba->getId();$v4aa3988e15afb9618423a0c2961a469f = self::checkIfBranchedByHierarchyTypeId($vacf567c9c3d6cf7c6e2cc0ce108e0631);$v8be74552df93e31bbdd6b36ed74bdb6a = new selector('pages');$v8be74552df93e31bbdd6b36ed74bdb6a->types('hierarchy-type')->id($vacf567c9c3d6cf7c6e2cc0ce108e0631);$ve2942a04780e223b215eb8b663cf5353 = $v8be74552df93e31bbdd6b36ed74bdb6a->length();$result[] = [      'id' => $vacf567c9c3d6cf7c6e2cc0ce108e0631,      'isBranched' => $v4aa3988e15afb9618423a0c2961a469f,      'count' => $ve2942a04780e223b215eb8b663cf5353    ];}return $result;}protected static function getBranchedTablesRelations() {$v47826cacc65c665212b821e6ff80b9b0 = self::getCacheDirPath() . self::getCacheFileName();if (is_file($v47826cacc65c665212b821e6ff80b9b0)) {$vf9ecb86fe4446d46abf44c1f55be3d43 = unserialize(file_get_contents($v47826cacc65c665212b821e6ff80b9b0));if (is_array($vf9ecb86fe4446d46abf44c1f55be3d43)) {return self::$branchedObjectTypes = $vf9ecb86fe4446d46abf44c1f55be3d43;}}return self::saveBranchedTablesRelations();}protected static function getCacheFileName() {return 'branchedTablesRelations.rel';}protected static function getCacheDirPath() {return mainConfiguration::getInstance()    ->includeParam('system.runtime-cache');}}