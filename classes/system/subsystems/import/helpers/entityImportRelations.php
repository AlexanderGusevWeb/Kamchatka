<?php
 use UmiCms\System\Import\UmiDump\Helper\Entity\iSourceIdBinder;class entityImportRelations implements iSourceIdBinder {private $sourceId;public function __construct($v52195dae0174459c5f066fa0df053c26) {if (!is_numeric($v52195dae0174459c5f066fa0df053c26)) {throw new InvalidArgumentException('Source id is not numeric');}$this->sourceId = (int) $v52195dae0174459c5f066fa0df053c26;}public function getSourceId() {return $this->sourceId;}public function defineRelation($v32a9d3c9a4b1449499e182e90d04fcc9, $v1c043be0eed6949c174fcf4359f7c601, $vaab9e1de16f38176f86d7a92ba337a8d) {$v4717d53ebfdfea8477f780ec66151dcb = ConnectionPool::getInstance()    ->getConnection();$v32a9d3c9a4b1449499e182e90d04fcc9 = (int) $v32a9d3c9a4b1449499e182e90d04fcc9;$v1c043be0eed6949c174fcf4359f7c601 = (int) $v1c043be0eed6949c174fcf4359f7c601;$vaab9e1de16f38176f86d7a92ba337a8d = $v4717d53ebfdfea8477f780ec66151dcb->escape($vaab9e1de16f38176f86d7a92ba337a8d);$v52195dae0174459c5f066fa0df053c26 = (int) $this->getSourceId();if (!$vaab9e1de16f38176f86d7a92ba337a8d) {throw new InvalidArgumentException('Empty table');}$vac5c74b64b4b8352ef2f181affb5ac2a = <<<SQL
INSERT INTO `{$vaab9e1de16f38176f86d7a92ba337a8d}`
	(`external_id`, `internal_id`, `source_id`) VALUES
	($v32a9d3c9a4b1449499e182e90d04fcc9, $v1c043be0eed6949c174fcf4359f7c601, $v52195dae0174459c5f066fa0df053c26)
SQL;   $v4717d53ebfdfea8477f780ec66151dcb->queryResult($vac5c74b64b4b8352ef2f181affb5ac2a);}public function getInternalId($v32a9d3c9a4b1449499e182e90d04fcc9, $vaab9e1de16f38176f86d7a92ba337a8d) {$v4717d53ebfdfea8477f780ec66151dcb = ConnectionPool::getInstance()    ->getConnection();$v32a9d3c9a4b1449499e182e90d04fcc9 = (int) $v32a9d3c9a4b1449499e182e90d04fcc9;$vaab9e1de16f38176f86d7a92ba337a8d = $v4717d53ebfdfea8477f780ec66151dcb->escape($vaab9e1de16f38176f86d7a92ba337a8d);$v52195dae0174459c5f066fa0df053c26 = (int) $this->getSourceId();if (!$vaab9e1de16f38176f86d7a92ba337a8d) {throw new InvalidArgumentException('Empty table');}$vac5c74b64b4b8352ef2f181affb5ac2a = <<<SQL
SELECT `internal_id`
FROM `{$vaab9e1de16f38176f86d7a92ba337a8d}`
WHERE
	`external_id` = $v32a9d3c9a4b1449499e182e90d04fcc9 AND `source_id` = $v52195dae0174459c5f066fa0df053c26
LIMIT 0,1
SQL;   $result = $v4717d53ebfdfea8477f780ec66151dcb->queryResult($vac5c74b64b4b8352ef2f181affb5ac2a);$result->setFetchType(IQueryResult::FETCH_ROW);$v1c043be0eed6949c174fcf4359f7c601 = null;if ($result->length() > 0) {$v54851b009c5c647ca3e77cc517b8c76c = $result->fetch();$v1c043be0eed6949c174fcf4359f7c601 = (int) array_shift($v54851b009c5c647ca3e77cc517b8c76c);}return $v1c043be0eed6949c174fcf4359f7c601;}public function getExternalId($v1c043be0eed6949c174fcf4359f7c601, $vaab9e1de16f38176f86d7a92ba337a8d) {$v4717d53ebfdfea8477f780ec66151dcb = ConnectionPool::getInstance()    ->getConnection();$v1c043be0eed6949c174fcf4359f7c601 = (int) $v1c043be0eed6949c174fcf4359f7c601;$vaab9e1de16f38176f86d7a92ba337a8d = $v4717d53ebfdfea8477f780ec66151dcb->escape($vaab9e1de16f38176f86d7a92ba337a8d);$v52195dae0174459c5f066fa0df053c26 = (int) $this->getSourceId();if (!$vaab9e1de16f38176f86d7a92ba337a8d) {throw new InvalidArgumentException('Empty table');}$vac5c74b64b4b8352ef2f181affb5ac2a = <<<SQL
SELECT `external_id`
FROM `{$vaab9e1de16f38176f86d7a92ba337a8d}`
WHERE `internal_id` = $v1c043be0eed6949c174fcf4359f7c601 AND `source_id` = $v52195dae0174459c5f066fa0df053c26
LIMIT 0,1
SQL;   $result = $v4717d53ebfdfea8477f780ec66151dcb->queryResult($vac5c74b64b4b8352ef2f181affb5ac2a);$result->setFetchType(IQueryResult::FETCH_ROW);$v32a9d3c9a4b1449499e182e90d04fcc9 = null;if ($result->length() > 0) {$v54851b009c5c647ca3e77cc517b8c76c = $result->fetch();$v32a9d3c9a4b1449499e182e90d04fcc9 = (string) array_shift($v54851b009c5c647ca3e77cc517b8c76c);}return $v32a9d3c9a4b1449499e182e90d04fcc9;}public function isRelatedToAnotherSource($v1c043be0eed6949c174fcf4359f7c601, $vaab9e1de16f38176f86d7a92ba337a8d) {$v4717d53ebfdfea8477f780ec66151dcb = ConnectionPool::getInstance()    ->getConnection();$v1c043be0eed6949c174fcf4359f7c601 = (int) $v1c043be0eed6949c174fcf4359f7c601;$vaab9e1de16f38176f86d7a92ba337a8d = $v4717d53ebfdfea8477f780ec66151dcb->escape($vaab9e1de16f38176f86d7a92ba337a8d);$v52195dae0174459c5f066fa0df053c26 = (int) $this->getSourceId();if (!$vaab9e1de16f38176f86d7a92ba337a8d) {throw new InvalidArgumentException('Empty table');}$v8bc4403642c02217dc1341694acb244d = <<<SQL
SELECT `external_id` FROM `{$vaab9e1de16f38176f86d7a92ba337a8d}` 
	WHERE `source_id` != $v52195dae0174459c5f066fa0df053c26 AND `internal_id` = $v1c043be0eed6949c174fcf4359f7c601 LIMIT 0,1
SQL;   $result = ConnectionPool::getInstance()    ->getConnection()    ->queryResult($v8bc4403642c02217dc1341694acb244d);return $result->length() > 0;}}