<?php
 class umiObjectPropertyRelation extends umiObjectProperty {const DELIMITER_ID = ',';protected function loadValue() {$v9b207167e5381c47682c6b4f58a623fb = [];$v945100186b119048837b9859c2c46410 = $this->field_id;$v80071f37861c360a27b7327e132c911a = $this->getTableName();$v8d777f385d3dfec8815d20f7496026dc = $this->getPropData();if ($v8d777f385d3dfec8815d20f7496026dc) {foreach ($v8d777f385d3dfec8815d20f7496026dc['rel_val'] as $v3a6d0284e743dc4a9b86f97d6dd1a3bf) {if ($v3a6d0284e743dc4a9b86f97d6dd1a3bf === null) {continue;}$v9b207167e5381c47682c6b4f58a623fb[] = $v3a6d0284e743dc4a9b86f97d6dd1a3bf;}return $v9b207167e5381c47682c6b4f58a623fb;}if ($this->getIsMultiple()) {$vac5c74b64b4b8352ef2f181affb5ac2a = "SELECT rel_val FROM {$v80071f37861c360a27b7327e132c911a} WHERE obj_id = '{$this->object_id}' AND field_id = '{$v945100186b119048837b9859c2c46410}'";}else {$vac5c74b64b4b8352ef2f181affb5ac2a = "SELECT rel_val FROM {$v80071f37861c360a27b7327e132c911a} WHERE obj_id = '{$this->object_id}' AND field_id = '{$v945100186b119048837b9859c2c46410}' LIMIT 1";}$v4717d53ebfdfea8477f780ec66151dcb = $this->getConnection();$result = $v4717d53ebfdfea8477f780ec66151dcb->queryResult($vac5c74b64b4b8352ef2f181affb5ac2a);$result->setFetchType(IQueryResult::FETCH_ROW);foreach ($result as $vf1965a857bc285d26fe22023aa5ab50d) {$v3a6d0284e743dc4a9b86f97d6dd1a3bf = array_shift($vf1965a857bc285d26fe22023aa5ab50d);if ($v3a6d0284e743dc4a9b86f97d6dd1a3bf === null) {continue;}$v9b207167e5381c47682c6b4f58a623fb[] = $v3a6d0284e743dc4a9b86f97d6dd1a3bf;}return $v9b207167e5381c47682c6b4f58a623fb;}protected function saveValue() {$this->deleteCurrentRows();if ($this->value === null) {return;}$vfa816edb83e95bf0c8da580bdfd491ef = [];foreach ($this->value as $v3a6d0284e743dc4a9b86f97d6dd1a3bf) {if (!$v3a6d0284e743dc4a9b86f97d6dd1a3bf) {continue;}if (is_string($v3a6d0284e743dc4a9b86f97d6dd1a3bf) && mb_strpos($v3a6d0284e743dc4a9b86f97d6dd1a3bf, '|') !== false) {$v2e3a8d3f3d1c742f7234c3d6dd74cc3c = explode('|', $v3a6d0284e743dc4a9b86f97d6dd1a3bf);foreach ($v2e3a8d3f3d1c742f7234c3d6dd74cc3c as $v9e3669d19b675bd57058fd4664205d2a) {$v9e3669d19b675bd57058fd4664205d2a = trim($v9e3669d19b675bd57058fd4664205d2a);if ($v9e3669d19b675bd57058fd4664205d2a) {$vfa816edb83e95bf0c8da580bdfd491ef[] = $v9e3669d19b675bd57058fd4664205d2a;}unset($v9e3669d19b675bd57058fd4664205d2a);}unset($v2e3a8d3f3d1c742f7234c3d6dd74cc3c);$this->getField()->setFieldTypeId(umiFieldTypesCollection::getInstance()->getFieldTypeByDataType('relation', 1)->getId());}else {$vfa816edb83e95bf0c8da580bdfd491ef[] = $v3a6d0284e743dc4a9b86f97d6dd1a3bf;}}$this->value = $vfa816edb83e95bf0c8da580bdfd491ef;unset($vfa816edb83e95bf0c8da580bdfd491ef);$v4717d53ebfdfea8477f780ec66151dcb = $this->getConnection();$v80071f37861c360a27b7327e132c911a = $this->getTableName();foreach ($this->value as $v3c6e0b8a9c15224a8228b9a98ca1531d => $v3a6d0284e743dc4a9b86f97d6dd1a3bf) {if ($v3a6d0284e743dc4a9b86f97d6dd1a3bf) {$v3a6d0284e743dc4a9b86f97d6dd1a3bf = $this->prepareRelationValue($v3a6d0284e743dc4a9b86f97d6dd1a3bf);$this->values[$v3c6e0b8a9c15224a8228b9a98ca1531d] = $v3a6d0284e743dc4a9b86f97d6dd1a3bf;}if (!$v3a6d0284e743dc4a9b86f97d6dd1a3bf) {continue;}$vac5c74b64b4b8352ef2f181affb5ac2a = "INSERT INTO {$v80071f37861c360a27b7327e132c911a} (obj_id, field_id, rel_val) VALUES('{$this->object_id}', '{$this->field_id}', '{$v3a6d0284e743dc4a9b86f97d6dd1a3bf}')";$v4717d53ebfdfea8477f780ec66151dcb->query($vac5c74b64b4b8352ef2f181affb5ac2a);}}protected function isNeedToSave(array $v7f7cfde5ec586119b48911a2c75851e5) {$v0382b9fd9ef50b6a335f35e0aaaebf99 = $this->value;$v0382b9fd9ef50b6a335f35e0aaaebf99 = $this->normaliseValue($v0382b9fd9ef50b6a335f35e0aaaebf99);$v7f7cfde5ec586119b48911a2c75851e5 = $this->normaliseValue($v7f7cfde5ec586119b48911a2c75851e5);if (umiCount($v0382b9fd9ef50b6a335f35e0aaaebf99) !== umiCount($v7f7cfde5ec586119b48911a2c75851e5)) {return true;}if (!$this->getIsMultiple()) {if (isset($v0382b9fd9ef50b6a335f35e0aaaebf99[0])) {$v0382b9fd9ef50b6a335f35e0aaaebf99 = $v0382b9fd9ef50b6a335f35e0aaaebf99[0];}else {$v0382b9fd9ef50b6a335f35e0aaaebf99 = null;}if (isset($v7f7cfde5ec586119b48911a2c75851e5[0])) {$v7f7cfde5ec586119b48911a2c75851e5 = $v7f7cfde5ec586119b48911a2c75851e5[0];}else {$v7f7cfde5ec586119b48911a2c75851e5 = null;}return $v0382b9fd9ef50b6a335f35e0aaaebf99 !== $v7f7cfde5ec586119b48911a2c75851e5;}foreach ($v7f7cfde5ec586119b48911a2c75851e5 as $vc9c8ccdd606fb2cec373822c9253eed3) {if (!in_array($vc9c8ccdd606fb2cec373822c9253eed3, $v0382b9fd9ef50b6a335f35e0aaaebf99)) {return true;}}return false;}private function normaliseValue(array $vf09cc7ee3a9a93273f4b80601cafb00c) {if (umiCount($vf09cc7ee3a9a93273f4b80601cafb00c) == 0) {return $vf09cc7ee3a9a93273f4b80601cafb00c;}$v538eb62c1deb2956e1a9e6c8a9f40352 = [];foreach ($vf09cc7ee3a9a93273f4b80601cafb00c as $v2063c1608d6e0baf80249c42e2be5804) {switch (true) {case $v2063c1608d6e0baf80249c42e2be5804 instanceof iUmiEntinty: {$v538eb62c1deb2956e1a9e6c8a9f40352[] = (int) $v2063c1608d6e0baf80249c42e2be5804->getId();break;}case is_numeric($v2063c1608d6e0baf80249c42e2be5804) && (int) $v2063c1608d6e0baf80249c42e2be5804 > 0 : {$v538eb62c1deb2956e1a9e6c8a9f40352[] = (int) $v2063c1608d6e0baf80249c42e2be5804;break;}case is_string($v2063c1608d6e0baf80249c42e2be5804) && !empty($v2063c1608d6e0baf80249c42e2be5804): {$v538eb62c1deb2956e1a9e6c8a9f40352[] = (string) $v2063c1608d6e0baf80249c42e2be5804;break;}}}return $v538eb62c1deb2956e1a9e6c8a9f40352;}}