<?php
 use UmiCms\Service;use UmiCms\System\Cache\iEngineFactory;class regedit implements iRegedit {private $connection;private $storage;public function __construct(\IConnection $v4717d53ebfdfea8477f780ec66151dcb, iEngineFactory $vca5b029cca5bc5a8172614682ba282cb) {$this->connection = $v4717d53ebfdfea8477f780ec66151dcb;$this->storage = $vca5b029cca5bc5a8172614682ba282cb->create(arrayCacheEngine::NAME);}public function contains($vd6fe1d0be6347b8ef2427fa629c04485) {$vd6fe1d0be6347b8ef2427fa629c04485 = trim($vd6fe1d0be6347b8ef2427fa629c04485, '/');return isset($this->getRegistry()[$vd6fe1d0be6347b8ef2427fa629c04485]);}public function get($vd6fe1d0be6347b8ef2427fa629c04485) {$vd6fe1d0be6347b8ef2427fa629c04485 = trim($vd6fe1d0be6347b8ef2427fa629c04485, '/');if (!$this->contains($vd6fe1d0be6347b8ef2427fa629c04485)) {return null;}$va9205dcfd4a6f7c2cbe8be01566ff84a = $this->getRegistry();$vb80bb7740288fda1f201890375a60c8f = $va9205dcfd4a6f7c2cbe8be01566ff84a[$vd6fe1d0be6347b8ef2427fa629c04485];$vf1965a857bc285d26fe22023aa5ab50d = $va9205dcfd4a6f7c2cbe8be01566ff84a[$this->getIdKey($vb80bb7740288fda1f201890375a60c8f)];return $vf1965a857bc285d26fe22023aa5ab50d['val'];}public function getList($vd6fe1d0be6347b8ef2427fa629c04485) {if ($vd6fe1d0be6347b8ef2427fa629c04485 !== '//' && !$this->contains($vd6fe1d0be6347b8ef2427fa629c04485)) {return [];}$va9205dcfd4a6f7c2cbe8be01566ff84a = $this->getRegistry();$vb80bb7740288fda1f201890375a60c8f = ($vd6fe1d0be6347b8ef2427fa629c04485 == '//') ? 0 : $va9205dcfd4a6f7c2cbe8be01566ff84a[trim($vd6fe1d0be6347b8ef2427fa629c04485, '/')];$vf1965a857bc285d26fe22023aa5ab50d = isset($va9205dcfd4a6f7c2cbe8be01566ff84a[$this->getIdKey($vb80bb7740288fda1f201890375a60c8f)]) ? $va9205dcfd4a6f7c2cbe8be01566ff84a[$this->getIdKey($vb80bb7740288fda1f201890375a60c8f)] : [];$v268184c12df027f536154d099d497b31 = isset($vf1965a857bc285d26fe22023aa5ab50d['children']) ? $vf1965a857bc285d26fe22023aa5ab50d['children'] : [];$v10ae9fc7d453b0dd525d0edf2ede7961 = [];foreach ($v268184c12df027f536154d099d497b31 as $vf4f40123eb510dd3290125b38f4eb898) {$v150cb14af5734bbebd660b04828e2c38 = $va9205dcfd4a6f7c2cbe8be01566ff84a[$this->getIdKey($vf4f40123eb510dd3290125b38f4eb898)];$v10ae9fc7d453b0dd525d0edf2ede7961[] = [     $v150cb14af5734bbebd660b04828e2c38['var'],     $v150cb14af5734bbebd660b04828e2c38['val'],    ];}return $v10ae9fc7d453b0dd525d0edf2ede7961;}public function set($vd6fe1d0be6347b8ef2427fa629c04485, $v2063c1608d6e0baf80249c42e2be5804) {$v2063c1608d6e0baf80249c42e2be5804 = (string) $v2063c1608d6e0baf80249c42e2be5804;$v2eab9afb79adb09af3cd4cb0693c0805 = $this->get($vd6fe1d0be6347b8ef2427fa629c04485);if ($v2063c1608d6e0baf80249c42e2be5804 === $v2eab9afb79adb09af3cd4cb0693c0805) {return true;}$vbb90bf734107ea3b2f4c14a5d4bc4f91 = $this->getKeyId($vd6fe1d0be6347b8ef2427fa629c04485);if (!$vbb90bf734107ea3b2f4c14a5d4bc4f91) {$vbb90bf734107ea3b2f4c14a5d4bc4f91 = $this->createKey($vd6fe1d0be6347b8ef2427fa629c04485);}$v4717d53ebfdfea8477f780ec66151dcb = $this->getConnection();$v2063c1608d6e0baf80249c42e2be5804 = $v4717d53ebfdfea8477f780ec66151dcb->escape($v2063c1608d6e0baf80249c42e2be5804);$vbb90bf734107ea3b2f4c14a5d4bc4f91 = (int) $vbb90bf734107ea3b2f4c14a5d4bc4f91;$vac5c74b64b4b8352ef2f181affb5ac2a = "UPDATE `cms_reg` SET `val` = '{$v2063c1608d6e0baf80249c42e2be5804}' WHERE `id` = $vbb90bf734107ea3b2f4c14a5d4bc4f91";$v4717d53ebfdfea8477f780ec66151dcb->query($vac5c74b64b4b8352ef2f181affb5ac2a);$va9205dcfd4a6f7c2cbe8be01566ff84a = $this->getRegistry();$va9205dcfd4a6f7c2cbe8be01566ff84a[$this->getIdKey($vbb90bf734107ea3b2f4c14a5d4bc4f91)]['val'] = (string) $v2063c1608d6e0baf80249c42e2be5804;$this->saveRegistry($va9205dcfd4a6f7c2cbe8be01566ff84a);return true;}public function delete($vd6fe1d0be6347b8ef2427fa629c04485) {$vbb90bf734107ea3b2f4c14a5d4bc4f91 = $this->getKeyId($vd6fe1d0be6347b8ef2427fa629c04485);if (!$vbb90bf734107ea3b2f4c14a5d4bc4f91) {return false;}$vbb90bf734107ea3b2f4c14a5d4bc4f91 = (int) $vbb90bf734107ea3b2f4c14a5d4bc4f91;$vac5c74b64b4b8352ef2f181affb5ac2a = "DELETE FROM `cms_reg` WHERE `rel` = $vbb90bf734107ea3b2f4c14a5d4bc4f91 OR `id` = $vbb90bf734107ea3b2f4c14a5d4bc4f91";$this->getConnection()    ->query($vac5c74b64b4b8352ef2f181affb5ac2a);$this->clearCache();return true;}public function clearCache() {return $this->saveRegistry([]);}protected function createKey($vd6fe1d0be6347b8ef2427fa629c04485) {$vd6fe1d0be6347b8ef2427fa629c04485 = trim($vd6fe1d0be6347b8ef2427fa629c04485, '/');$vf961aedab905271a350c4e6eb6d7b6b9 = '//';$va722790b49e8eb1f37a1c672326ec501 = 0;$vbb90bf734107ea3b2f4c14a5d4bc4f91 = null;$v4717d53ebfdfea8477f780ec66151dcb = $this->getConnection();foreach (explode('/', $vd6fe1d0be6347b8ef2427fa629c04485) as $v3c6e0b8a9c15224a8228b9a98ca1531d) {$vf961aedab905271a350c4e6eb6d7b6b9 .= $v3c6e0b8a9c15224a8228b9a98ca1531d . '/';$vbb90bf734107ea3b2f4c14a5d4bc4f91 = $this->getKeyId($vf961aedab905271a350c4e6eb6d7b6b9);if ($vbb90bf734107ea3b2f4c14a5d4bc4f91) {$va722790b49e8eb1f37a1c672326ec501 = $vbb90bf734107ea3b2f4c14a5d4bc4f91;continue;}$va722790b49e8eb1f37a1c672326ec501 = (int) $va722790b49e8eb1f37a1c672326ec501;$v3c6e0b8a9c15224a8228b9a98ca1531d = $v4717d53ebfdfea8477f780ec66151dcb->escape($v3c6e0b8a9c15224a8228b9a98ca1531d);$vac5c74b64b4b8352ef2f181affb5ac2a = "INSERT INTO `cms_reg` (`rel`, `var`, `val`) VALUES ($va722790b49e8eb1f37a1c672326ec501, '{$v3c6e0b8a9c15224a8228b9a98ca1531d}', '')";$v4717d53ebfdfea8477f780ec66151dcb->query($vac5c74b64b4b8352ef2f181affb5ac2a);$vbb90bf734107ea3b2f4c14a5d4bc4f91 = (int) $v4717d53ebfdfea8477f780ec66151dcb->insertId();$va9205dcfd4a6f7c2cbe8be01566ff84a = $this->getRegistry();$va9205dcfd4a6f7c2cbe8be01566ff84a[$this->getIdKey($vbb90bf734107ea3b2f4c14a5d4bc4f91)] = [     'id' => $vbb90bf734107ea3b2f4c14a5d4bc4f91,     'var' => $v3c6e0b8a9c15224a8228b9a98ca1531d,     'val' => null,     'rel' => $va722790b49e8eb1f37a1c672326ec501,     'children' => []    ];$va9205dcfd4a6f7c2cbe8be01566ff84a[trim($vf961aedab905271a350c4e6eb6d7b6b9, '/')] = $vbb90bf734107ea3b2f4c14a5d4bc4f91;$va9205dcfd4a6f7c2cbe8be01566ff84a[$this->getIdKey($va722790b49e8eb1f37a1c672326ec501)]['children'][] = $vbb90bf734107ea3b2f4c14a5d4bc4f91;$this->saveRegistry($va9205dcfd4a6f7c2cbe8be01566ff84a);$va722790b49e8eb1f37a1c672326ec501 = $vbb90bf734107ea3b2f4c14a5d4bc4f91;}return $vbb90bf734107ea3b2f4c14a5d4bc4f91;}private function getKeyId($vd6fe1d0be6347b8ef2427fa629c04485) {$vd6fe1d0be6347b8ef2427fa629c04485 = trim($vd6fe1d0be6347b8ef2427fa629c04485, '/');$vbb90bf734107ea3b2f4c14a5d4bc4f91 = 0;$v4717d53ebfdfea8477f780ec66151dcb = $this->getConnection();foreach (explode('/', $vd6fe1d0be6347b8ef2427fa629c04485) as $v3c6e0b8a9c15224a8228b9a98ca1531d) {$v3c6e0b8a9c15224a8228b9a98ca1531d = $v4717d53ebfdfea8477f780ec66151dcb->escape($v3c6e0b8a9c15224a8228b9a98ca1531d);$vac5c74b64b4b8352ef2f181affb5ac2a = "SELECT `id` FROM `cms_reg` WHERE `rel` = $vbb90bf734107ea3b2f4c14a5d4bc4f91 AND `var` = '{$v3c6e0b8a9c15224a8228b9a98ca1531d}'";$result = $v4717d53ebfdfea8477f780ec66151dcb->queryResult($vac5c74b64b4b8352ef2f181affb5ac2a);$result->setFetchType(IQueryResult::FETCH_ROW);if ($result->length() == 0) {return false;}list($vbb90bf734107ea3b2f4c14a5d4bc4f91) = $result->fetch();$vbb90bf734107ea3b2f4c14a5d4bc4f91 = (int) $vbb90bf734107ea3b2f4c14a5d4bc4f91;}return $vbb90bf734107ea3b2f4c14a5d4bc4f91;}private function saveRegistry(array $va9205dcfd4a6f7c2cbe8be01566ff84a) {$this->getStorage()    ->saveRawData('registry', $va9205dcfd4a6f7c2cbe8be01566ff84a, time());return $this;}private function getRegistry() {$vddecebdea58b5f264d27f1f7909bab74 = $this->getStorage();$va9205dcfd4a6f7c2cbe8be01566ff84a = (array) $vddecebdea58b5f264d27f1f7909bab74->loadRawData('registry');if (empty($va9205dcfd4a6f7c2cbe8be01566ff84a)) {$this->saveRegistry($this->loadRegistry());}return (array) $vddecebdea58b5f264d27f1f7909bab74->loadRawData('registry');}private function loadRegistry() {$vac5c74b64b4b8352ef2f181affb5ac2a = <<<SQL
SELECT `id`, `var`, `val`, `rel` FROM `cms_reg` ORDER BY `id`
SQL;   $result = $this->getConnection()    ->queryResult($vac5c74b64b4b8352ef2f181affb5ac2a);$result->setFetchType(IQueryResult::FETCH_ASSOC);$va9205dcfd4a6f7c2cbe8be01566ff84a = [];foreach ($result as $vf1965a857bc285d26fe22023aa5ab50d) {$vb80bb7740288fda1f201890375a60c8f = $vf1965a857bc285d26fe22023aa5ab50d['id'];$vbfa030fe63bacd523dd70a76cfaed98a = $vf1965a857bc285d26fe22023aa5ab50d['rel'];$vaec2ea5e2278c7c470c41b1efb442218 = $this->getIdKey($vbfa030fe63bacd523dd70a76cfaed98a);if (isset($va9205dcfd4a6f7c2cbe8be01566ff84a[$vaec2ea5e2278c7c470c41b1efb442218])) {$vd6fe1d0be6347b8ef2427fa629c04485 = ($vbfa030fe63bacd523dd70a76cfaed98a == 0) ? $vf1965a857bc285d26fe22023aa5ab50d['var'] : $va9205dcfd4a6f7c2cbe8be01566ff84a[$vaec2ea5e2278c7c470c41b1efb442218]['path'] . '/' . $vf1965a857bc285d26fe22023aa5ab50d['var'];$va9205dcfd4a6f7c2cbe8be01566ff84a[$vaec2ea5e2278c7c470c41b1efb442218]['children'][] = $vb80bb7740288fda1f201890375a60c8f;}else {$vd6fe1d0be6347b8ef2427fa629c04485 = $vf1965a857bc285d26fe22023aa5ab50d['var'];$va9205dcfd4a6f7c2cbe8be01566ff84a[$vbfa030fe63bacd523dd70a76cfaed98a] = [      'id' => $vbfa030fe63bacd523dd70a76cfaed98a,      'children' => [       $vb80bb7740288fda1f201890375a60c8f      ]     ];}$vf1965a857bc285d26fe22023aa5ab50d['path'] = $vd6fe1d0be6347b8ef2427fa629c04485;$vf1965a857bc285d26fe22023aa5ab50d['children'] = [];$va9205dcfd4a6f7c2cbe8be01566ff84a[$this->getIdKey($vb80bb7740288fda1f201890375a60c8f)] = $vf1965a857bc285d26fe22023aa5ab50d;$va9205dcfd4a6f7c2cbe8be01566ff84a[$vd6fe1d0be6347b8ef2427fa629c04485] = $vb80bb7740288fda1f201890375a60c8f;}return $va9205dcfd4a6f7c2cbe8be01566ff84a;}private function getConnection() {return $this->connection;}private function getStorage() {return $this->storage;}private function getIdKey($vb80bb7740288fda1f201890375a60c8f) {return sprintf('id_%d', $vb80bb7740288fda1f201890375a60c8f);}public function getVal($vd6fe1d0be6347b8ef2427fa629c04485, $va07215b2c2cd85efc495d5e465026aed = false) {return $this->get($vd6fe1d0be6347b8ef2427fa629c04485);}public function setVal($vd6fe1d0be6347b8ef2427fa629c04485, $v2063c1608d6e0baf80249c42e2be5804) {return $this->set($vd6fe1d0be6347b8ef2427fa629c04485, $v2063c1608d6e0baf80249c42e2be5804);}public function setVar($vd6fe1d0be6347b8ef2427fa629c04485, $v2063c1608d6e0baf80249c42e2be5804) {return $this->set($vd6fe1d0be6347b8ef2427fa629c04485, $v2063c1608d6e0baf80249c42e2be5804);}public function delVar($vd6fe1d0be6347b8ef2427fa629c04485) {return $this->delete($vd6fe1d0be6347b8ef2427fa629c04485);}public function getKey($vd6fe1d0be6347b8ef2427fa629c04485, $v5809e03a3657bacd238321e736b9e85d = 0, $va07215b2c2cd85efc495d5e465026aed = false) {return $this->getKeyId($vd6fe1d0be6347b8ef2427fa629c04485);}final public static function checkSomething($v0cc175b9c0f1b6a831c399e269772661, $v92eb5ffee6ae2fec3ad71c777531578f, $ve70c4df10ef0983b9c8c31bd06b2a2c3 = false) {if (isLocalMode()) {return true;}$v7123a699d77db6479a1d8ece2c4f1c16 = Service::Registry();$v03355d867dcc3a38043185573f43b600 = $v7123a699d77db6479a1d8ece2c4f1c16->get('//modules/autoupdate/system_edition') == 'commerce_enc';foreach ($v92eb5ffee6ae2fec3ad71c777531578f as $vc65f234fae60d823c1f1bf00566248a0 => $v0a3d72134fb3d6c024db4c510bc1605b) {$vce74825b5a01c99b06af231de0bd667d = (mb_substr($v0cc175b9c0f1b6a831c399e269772661, -12, 12) == mb_substr($v0a3d72134fb3d6c024db4c510bc1605b, -12, 12));if ($vce74825b5a01c99b06af231de0bd667d === true) {if (!defined('CURRENT_VERSION_LINE')) {define('CURRENT_VERSION_LINE', $vc65f234fae60d823c1f1bf00566248a0);}if ($vc65f234fae60d823c1f1bf00566248a0 == 'trial' || $v03355d867dcc3a38043185573f43b600) {if ((int) $v7123a699d77db6479a1d8ece2c4f1c16->get('//settings/install') === 0) {$v7123a699d77db6479a1d8ece2c4f1c16->delete('//settings/keycode');}if (file_exists(SYS_CACHE_RUNTIME . 'trash')) {unlink(SYS_CACHE_RUNTIME . 'trash');}if ($v7123a699d77db6479a1d8ece2c4f1c16->getDaysLeft() <= 0) {if ($ve70c4df10ef0983b9c8c31bd06b2a2c3) {return false;}$v7f2db423a49b305459147332fb01cf87 = Service::Response()        ->getCurrentBuffer();$v7f2db423a49b305459147332fb01cf87->status(500);$v7f2db423a49b305459147332fb01cf87->push(file_get_contents(CURRENT_WORKING_DIR . '/errors/trial_expired.html'));$v7f2db423a49b305459147332fb01cf87->end();}}return true;}}return false;}final public function checkSelfKeycode() {if (isDemoMode()) {return false;}$v1a54c1036ccb10069e9c06281d52007a = $this->get('//settings/keycode');if (mb_strlen($v1a54c1036ccb10069e9c06281d52007a) == 0) {return false;}$v903931b3a9d25a70683f51ab9d363d2e = $this->get('//settings/system_edition');$v1f0f70bf2b5ad94c7387e64c16dc455a = ['commerce', 'business', 'corporate', 'ultimate', 'commerce_enc', 'business_enc', 'corporate_enc'];$v45cee5e0fe2cae080c44e7a4ffc70361 = in_array($v903931b3a9d25a70683f51ab9d363d2e, $v1f0f70bf2b5ad94c7387e64c16dc455a) ? 'pro' : $v903931b3a9d25a70683f51ab9d363d2e;$v92eb5ffee6ae2fec3ad71c777531578f = [$v45cee5e0fe2cae080c44e7a4ffc70361 => umiTemplater::getSomething($v45cee5e0fe2cae080c44e7a4ffc70361)];return self::checkSomething($v1a54c1036ccb10069e9c06281d52007a, $v92eb5ffee6ae2fec3ad71c777531578f, true);}final public function doTesting($vc703b927a0c5d56e5a33c4b834053bd4) {$v6a6524f1269ef3af3f9a045687177e04 = base64_decode('aHR0cDovL3VwZGF0ZXMudW1pLWNtcy5ydS91cGRhdGVzZXJ2ZXIvP3R5cGU9YWRkLWNtcy1zdGF0');$vc703b927a0c5d56e5a33c4b834053bd4 = ['message' => json_decode($vc703b927a0c5d56e5a33c4b834053bd4, true)];$vd1fc8eaf36937be0c3ba8cfe0a2c1bfe = umiRemoteFileGetter::get($v6a6524f1269ef3af3f9a045687177e04, false, false, $vc703b927a0c5d56e5a33c4b834053bd4, false, 'POST', 3);$v6b717e04005642c3cc68a2f74a5cca1b = new DOMDocument();if (!$v6b717e04005642c3cc68a2f74a5cca1b->loadXML($vd1fc8eaf36937be0c3ba8cfe0a2c1bfe)) {return false;}$v3d788fa62d7c185a1bee4c9147ee1091 = new DOMXPath($v6b717e04005642c3cc68a2f74a5cca1b);$v78e731027d8fd50ed642340b7c9a63b3 = $v3d788fa62d7c185a1bee4c9147ee1091->evaluate('/response/message');if (!$v78e731027d8fd50ed642340b7c9a63b3 instanceof DOMNodeList) {return false;}if ($v78e731027d8fd50ed642340b7c9a63b3->length == 0) {return false;}$this->set('//settings/last_mess_time', time());return true;}public function getDaysLeft() {return self::SOME_NUMBER - floor((time() - (int) $this->get('//settings/install')) / (3600 * 24));}public function __destruct() {}public function resetCache($v14f802e1fba977727845e8872c1743a7 = false) {$this->clearCache();}public static function getInstance($v4a8a08f09d37b73795649038408b5f33 = null) {return Service::Registry();}}