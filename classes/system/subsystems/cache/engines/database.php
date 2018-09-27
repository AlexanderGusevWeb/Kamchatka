<?php
 class databaseCacheEngine implements iCacheEngine {private $connection;private $configuration;const NAME = 'database';public function __construct() {$this->connection = ConnectionPool::getInstance()    ->getConnection();$this->configuration = mainConfiguration::getInstance();}public function getName() {return self::NAME;}public function getIsConnected() {return $this->getConnection() instanceof IConnection;}public function saveRawData($v3c6e0b8a9c15224a8228b9a98ca1531d, $v8d777f385d3dfec8815d20f7496026dc, $vcd91e7679d575a2c548bd2c889c23b9e) {$v4717d53ebfdfea8477f780ec66151dcb = $this->getConnection();$v3cefd9aef386420529ff9dac810270e0 = $v4717d53ebfdfea8477f780ec66151dcb->escape($v3c6e0b8a9c15224a8228b9a98ca1531d);$v8d777f385d3dfec8815d20f7496026dc = $v4717d53ebfdfea8477f780ec66151dcb->escape(serialize($v8d777f385d3dfec8815d20f7496026dc));$v1ed2e1b19b6e55d52d2473be17a4afd9 = time();$vcd91e7679d575a2c548bd2c889c23b9e = time() + (int) $vcd91e7679d575a2c548bd2c889c23b9e;$vac5c74b64b4b8352ef2f181affb5ac2a = <<<sql
INSERT INTO `cms3_data_cache` (`key`, `value`, `create_time`, `expire_time`, `entry_time`, `entries_number`)
	VALUES('$v3cefd9aef386420529ff9dac810270e0', '$v8d777f385d3dfec8815d20f7496026dc', $v1ed2e1b19b6e55d52d2473be17a4afd9, $vcd91e7679d575a2c548bd2c889c23b9e, 0, 0)
		ON DUPLICATE KEY UPDATE `value` = '$v8d777f385d3dfec8815d20f7496026dc', `create_time` = $v1ed2e1b19b6e55d52d2473be17a4afd9, `expire_time` = $vcd91e7679d575a2c548bd2c889c23b9e;
sql;   $v4717d53ebfdfea8477f780ec66151dcb->query($vac5c74b64b4b8352ef2f181affb5ac2a);return true;}public function loadRawData($v3c6e0b8a9c15224a8228b9a98ca1531d) {$v4717d53ebfdfea8477f780ec66151dcb = $this->getConnection();$v3cefd9aef386420529ff9dac810270e0 = $v4717d53ebfdfea8477f780ec66151dcb->escape($v3c6e0b8a9c15224a8228b9a98ca1531d);$vac5c74b64b4b8352ef2f181affb5ac2a = <<<SQL
SELECT `value`, `expire_time`
	FROM `cms3_data_cache`
		WHERE `key` = '$v3cefd9aef386420529ff9dac810270e0';
SQL;   $v9e4c7eb5e905e34e9b91cd40f1695b90 = $v4717d53ebfdfea8477f780ec66151dcb->queryResult($vac5c74b64b4b8352ef2f181affb5ac2a);if ($v9e4c7eb5e905e34e9b91cd40f1695b90->length() == 0) {return null;}$vdddee4c873643a2925f88d9acbf24133 = $v9e4c7eb5e905e34e9b91cd40f1695b90->fetch();if (time() > $vdddee4c873643a2925f88d9acbf24133['expire_time']) {$this->delete($v3c6e0b8a9c15224a8228b9a98ca1531d);return null;}$v6c1e7ed6aa9e34238651f285fa30aa74 = (bool) $this->getConfiguration()    ->get('cache', 'engine.debug');if ($v6c1e7ed6aa9e34238651f285fa30aa74) {$this->updateEntry($v3c6e0b8a9c15224a8228b9a98ca1531d);}return unserialize($vdddee4c873643a2925f88d9acbf24133['value']);}public function delete($v3c6e0b8a9c15224a8228b9a98ca1531d) {$v4717d53ebfdfea8477f780ec66151dcb = $this->getConnection();$v3cefd9aef386420529ff9dac810270e0 = $v4717d53ebfdfea8477f780ec66151dcb->escape($v3c6e0b8a9c15224a8228b9a98ca1531d);$vac5c74b64b4b8352ef2f181affb5ac2a = <<<SQL
DELETE FROM `cms3_data_cache`
	WHERE `key` = '$v3cefd9aef386420529ff9dac810270e0';
SQL;   $v4717d53ebfdfea8477f780ec66151dcb->query($vac5c74b64b4b8352ef2f181affb5ac2a);return true;}public function flush() {$vac5c74b64b4b8352ef2f181affb5ac2a = <<<SQL
TRUNCATE TABLE `cms3_data_cache`;
SQL;   $this->getConnection()    ->query($vac5c74b64b4b8352ef2f181affb5ac2a);return true;}private function getConnection() {return $this->connection;}private function getConfiguration() {return $this->configuration;}private function updateEntry($v3c6e0b8a9c15224a8228b9a98ca1531d) {$v4717d53ebfdfea8477f780ec66151dcb = $this->getConnection();$v3cefd9aef386420529ff9dac810270e0 = $v4717d53ebfdfea8477f780ec66151dcb->escape($v3c6e0b8a9c15224a8228b9a98ca1531d);$vef852f572bc3e815ebf3e44c4f9ef42f = time();$vac5c74b64b4b8352ef2f181affb5ac2a = <<<SQL
UPDATE `cms3_data_cache`
	SET `entry_time` = $vef852f572bc3e815ebf3e44c4f9ef42f, `entries_number` = `entries_number` + 1
		WHERE `key` = '$v3cefd9aef386420529ff9dac810270e0';
SQL;   $v4717d53ebfdfea8477f780ec66151dcb->query($vac5c74b64b4b8352ef2f181affb5ac2a);return true;}public function dropExpired() {$v07cc694b9b3fc636710fa08b6922c42b = (int) time();$vac5c74b64b4b8352ef2f181affb5ac2a = <<<SQL
DELETE FROM `cms3_data_cache`
	WHERE `expire_time` < $v07cc694b9b3fc636710fa08b6922c42b;
SQL;   $this->getConnection()    ->query($vac5c74b64b4b8352ef2f181affb5ac2a);return true;}public function optimise() {$vac5c74b64b4b8352ef2f181affb5ac2a = <<<SQL
OPTIMIZE TABLE `cms3_data_cache`;
SQL;   $this->getConnection()    ->query($vac5c74b64b4b8352ef2f181affb5ac2a);return true;}}