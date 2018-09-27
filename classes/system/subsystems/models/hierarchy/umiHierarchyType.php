<?php
 class umiHierarchyType extends umiEntinty implements iUmiHierarchyType {private $name, $title, $ext;protected $store_type = 'element_type';public function getName() {return $this->name;}public function getTitle() {return $this->translateLabel($this->title);}public function getModule() {return $this->getName();}public function getMethod() {return $this->getExt();}public function getExt() {return $this->ext;}public function setName($vb068931cc450442b63f5b3d276ea4297) {if ($this->getName() != $vb068931cc450442b63f5b3d276ea4297) {$this->name = $vb068931cc450442b63f5b3d276ea4297;$this->setIsUpdated();}}public function setTitle($vd5d3db1765287eef77d7927cc956f50a) {if ($this->getTitle() != $vd5d3db1765287eef77d7927cc956f50a) {$vd5d3db1765287eef77d7927cc956f50a = $this->translateI18n($vd5d3db1765287eef77d7927cc956f50a, 'hierarchy-type-');$this->title = $vd5d3db1765287eef77d7927cc956f50a;$this->setIsUpdated();}}public function setExt($vabf77184f55403d75b9d51d79162a7ca) {if ($this->getExt() != $vabf77184f55403d75b9d51d79162a7ca) {$this->ext = $vabf77184f55403d75b9d51d79162a7ca;$this->setIsUpdated();}}protected function loadInfo($vf1965a857bc285d26fe22023aa5ab50d = false) {if (!is_array($vf1965a857bc285d26fe22023aa5ab50d) || count($vf1965a857bc285d26fe22023aa5ab50d) < 4) {$v4717d53ebfdfea8477f780ec66151dcb = ConnectionPool::getInstance()->getConnection();$v817f7de13f58df29b13a9570082097da = (int) $this->getId();$vac5c74b64b4b8352ef2f181affb5ac2a = "SELECT id, name, title, ext FROM cms3_hierarchy_types WHERE id = $v817f7de13f58df29b13a9570082097da LIMIT 0,1";$result = $v4717d53ebfdfea8477f780ec66151dcb->queryResult($vac5c74b64b4b8352ef2f181affb5ac2a);$result->setFetchType(IQueryResult::FETCH_ROW);$vf1965a857bc285d26fe22023aa5ab50d = $result->fetch();}if (!is_array($vf1965a857bc285d26fe22023aa5ab50d) || count($vf1965a857bc285d26fe22023aa5ab50d) < 4) {return false;}list($vb80bb7740288fda1f201890375a60c8f, $vb068931cc450442b63f5b3d276ea4297, $vd5d3db1765287eef77d7927cc956f50a, $vabf77184f55403d75b9d51d79162a7ca) = $vf1965a857bc285d26fe22023aa5ab50d;$this->name = $vb068931cc450442b63f5b3d276ea4297;$this->title = $vd5d3db1765287eef77d7927cc956f50a;$this->ext = $vabf77184f55403d75b9d51d79162a7ca;return true;}protected function save() {$vb068931cc450442b63f5b3d276ea4297 = self::filterInputString($this->name);$vd5d3db1765287eef77d7927cc956f50a = self::filterInputString($this->title);$vabf77184f55403d75b9d51d79162a7ca = self::filterInputString($this->ext);$v4717d53ebfdfea8477f780ec66151dcb = ConnectionPool::getInstance()->getConnection();$vac5c74b64b4b8352ef2f181affb5ac2a = "UPDATE cms3_hierarchy_types SET name = '{$vb068931cc450442b63f5b3d276ea4297}', title = '{$vd5d3db1765287eef77d7927cc956f50a}', ext = '{$vabf77184f55403d75b9d51d79162a7ca}' WHERE id = '{$this->id}'";$v4717d53ebfdfea8477f780ec66151dcb->query($vac5c74b64b4b8352ef2f181affb5ac2a);return true;}}