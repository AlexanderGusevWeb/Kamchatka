<?php
 class umiObjectPropertyBoolean extends umiObjectProperty {protected function loadValue() {$v9b207167e5381c47682c6b4f58a623fb = [];$v945100186b119048837b9859c2c46410 = $this->field_id;$v8d777f385d3dfec8815d20f7496026dc = $this->getPropData();if ($v8d777f385d3dfec8815d20f7496026dc) {foreach ($v8d777f385d3dfec8815d20f7496026dc['int_val'] as $v3a6d0284e743dc4a9b86f97d6dd1a3bf) {if ($v3a6d0284e743dc4a9b86f97d6dd1a3bf === null) {continue;}$v9b207167e5381c47682c6b4f58a623fb[] = (int) $v3a6d0284e743dc4a9b86f97d6dd1a3bf;}return $v9b207167e5381c47682c6b4f58a623fb;}$v4717d53ebfdfea8477f780ec66151dcb = $this->getConnection();$v80071f37861c360a27b7327e132c911a = $this->getTableName();$vac5c74b64b4b8352ef2f181affb5ac2a = "SELECT int_val FROM {$v80071f37861c360a27b7327e132c911a} WHERE obj_id = '{$this->object_id}' AND field_id = '{$v945100186b119048837b9859c2c46410}' LIMIT 1";$result = $v4717d53ebfdfea8477f780ec66151dcb->queryResult($vac5c74b64b4b8352ef2f181affb5ac2a);$result->setFetchType(IQueryResult::FETCH_ROW);foreach ($result as $vf1965a857bc285d26fe22023aa5ab50d) {$v3a6d0284e743dc4a9b86f97d6dd1a3bf = array_shift($vf1965a857bc285d26fe22023aa5ab50d);if ($v3a6d0284e743dc4a9b86f97d6dd1a3bf === null) {continue;}$v9b207167e5381c47682c6b4f58a623fb[] = (int) $v3a6d0284e743dc4a9b86f97d6dd1a3bf;}return $v9b207167e5381c47682c6b4f58a623fb;}protected function saveValue() {$this->deleteCurrentRows();$v4717d53ebfdfea8477f780ec66151dcb = $this->getConnection();foreach ($this->value as $v3a6d0284e743dc4a9b86f97d6dd1a3bf) {if (!$v3a6d0284e743dc4a9b86f97d6dd1a3bf) {continue;}$v3a6d0284e743dc4a9b86f97d6dd1a3bf = (int) $this->boolval($v3a6d0284e743dc4a9b86f97d6dd1a3bf, true);$v80071f37861c360a27b7327e132c911a = $this->getTableName();$vac5c74b64b4b8352ef2f181affb5ac2a = "INSERT INTO {$v80071f37861c360a27b7327e132c911a} (obj_id, field_id, int_val) VALUES ('{$this->object_id}', '{$this->field_id}', '{$v3a6d0284e743dc4a9b86f97d6dd1a3bf}')";$v4717d53ebfdfea8477f780ec66151dcb->query($vac5c74b64b4b8352ef2f181affb5ac2a);}}protected function boolval($v13b5bfe96f3e2fe411c9f66f4a582adf, $v2133fd717402a7966ee88d06f9e0b792 = false) {$vc68271a63ddbc431c307beb7d2918275 = null;if (in_array($v13b5bfe96f3e2fe411c9f66f4a582adf, ['false', 'False', 'FALSE', 'no', 'No', 'n', 'N', '0', 'off', 'Off', 'OFF', false, 0, null], true)) {$vc68271a63ddbc431c307beb7d2918275 = false;}else {if ($v2133fd717402a7966ee88d06f9e0b792) {if (in_array($v13b5bfe96f3e2fe411c9f66f4a582adf, ['true', 'True', 'TRUE', 'yes', 'Yes', 'y', 'Y', '1', 'on', 'On', 'ON', true, 1], true)) {$vc68271a63ddbc431c307beb7d2918275 = true;}}else {$vc68271a63ddbc431c307beb7d2918275 = ($v13b5bfe96f3e2fe411c9f66f4a582adf ? true : false);}}return $vc68271a63ddbc431c307beb7d2918275;}protected function isNeedToSave(array $v7f7cfde5ec586119b48911a2c75851e5) {$v0382b9fd9ef50b6a335f35e0aaaebf99 = $this->value;if (isset($v0382b9fd9ef50b6a335f35e0aaaebf99[0])) {$v0382b9fd9ef50b6a335f35e0aaaebf99 = $this->boolval($v0382b9fd9ef50b6a335f35e0aaaebf99[0]);}else {$v0382b9fd9ef50b6a335f35e0aaaebf99 = false;}if (isset($v7f7cfde5ec586119b48911a2c75851e5[0])) {$v7f7cfde5ec586119b48911a2c75851e5 = $this->boolval($v7f7cfde5ec586119b48911a2c75851e5[0]);}else {$v7f7cfde5ec586119b48911a2c75851e5 = false;}return $v0382b9fd9ef50b6a335f35e0aaaebf99 !== $v7f7cfde5ec586119b48911a2c75851e5;}}