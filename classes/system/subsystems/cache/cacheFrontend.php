<?php
 use UmiCms\Service;use UmiCms\System\Cache\iEngineFactory;use UmiCms\System\Cache\Key\iGenerator;use UmiCms\System\Cache\Key\Validator\iFactory;use UmiCms\System\Cache\Key\iValidator;use UmiCms\System\Request\Mode\iDetector;class cacheFrontend implements iCacheFrontend {private $cacheEngine;private $disabled = false;private $engineFactory;private $keyGenerator;private $configuration;private $keyValidatorFactory;private $keyValidator;private $modeDetector;public function __construct(   iEngineFactory $v8975779010887ca687ad040a39ee1e14, iGenerator $vcdb937aef8a3c67a6d81d2ea354d3cc5, iConfiguration $vccd1066343c95877b75b79d47c36bebe,   iFactory $v21693c3c9c4c71448df6686ceb8786de, iDetector $v4076631aa75ae111b33f593b0558da6a  ) {$this->engineFactory = $v8975779010887ca687ad040a39ee1e14;$this->keyGenerator = $vcdb937aef8a3c67a6d81d2ea354d3cc5;$this->configuration = $vccd1066343c95877b75b79d47c36bebe;$this->keyValidatorFactory = $v21693c3c9c4c71448df6686ceb8786de;$this->modeDetector = $v4076631aa75ae111b33f593b0558da6a;$this->init();}public function isCacheEnabled() {if ($this->getCacheEngine() instanceof nullCacheEngine) {return false;}return $this->getCacheEngine()    ->getIsConnected();}public function save(iUmiEntinty $vf5e638cc78dd325906c1298a0c21fb6b, $v7549538db7966adaeed3235f19ba26dd = null, $vcd91e7679d575a2c548bd2c889c23b9e = self::DEFAULT_TIME_TO_LIVE) {$v3c6e0b8a9c15224a8228b9a98ca1531d = $this->getKeyGenerator()    ->createKey($vf5e638cc78dd325906c1298a0c21fb6b->getId(), $v7549538db7966adaeed3235f19ba26dd);return $this->set($v3c6e0b8a9c15224a8228b9a98ca1531d, $vf5e638cc78dd325906c1298a0c21fb6b, $vcd91e7679d575a2c548bd2c889c23b9e);}public function load($vb1b26d9d245655a2cf8422f066203b2a, $v7549538db7966adaeed3235f19ba26dd = null) {$v3c6e0b8a9c15224a8228b9a98ca1531d = $this->getKeyGenerator()    ->createKey($vb1b26d9d245655a2cf8422f066203b2a, $v7549538db7966adaeed3235f19ba26dd);return $this->get($v3c6e0b8a9c15224a8228b9a98ca1531d);}public function saveSql($v1b1cc7f086b3f074da452bc3129981eb, $result, $vcd91e7679d575a2c548bd2c889c23b9e = self::DEFAULT_TIME_TO_LIVE) {$v3c6e0b8a9c15224a8228b9a98ca1531d = $this->getKeyGenerator()    ->createKeyForQuery($v1b1cc7f086b3f074da452bc3129981eb);return $this->set($v3c6e0b8a9c15224a8228b9a98ca1531d, $result, $vcd91e7679d575a2c548bd2c889c23b9e);}public function loadSql($v1b1cc7f086b3f074da452bc3129981eb) {$v3c6e0b8a9c15224a8228b9a98ca1531d = $this->getKeyGenerator()    ->createKeyForQuery($v1b1cc7f086b3f074da452bc3129981eb);return $this->get($v3c6e0b8a9c15224a8228b9a98ca1531d);}public function saveData($v3c6e0b8a9c15224a8228b9a98ca1531d, $v2063c1608d6e0baf80249c42e2be5804, $vcd91e7679d575a2c548bd2c889c23b9e = self::DEFAULT_TIME_TO_LIVE) {if (!$this->isValidKey($v3c6e0b8a9c15224a8228b9a98ca1531d)) {return false;}$v3c6e0b8a9c15224a8228b9a98ca1531d = $this->getKeyGenerator()    ->createKey($v3c6e0b8a9c15224a8228b9a98ca1531d);return $this->set($v3c6e0b8a9c15224a8228b9a98ca1531d, $v2063c1608d6e0baf80249c42e2be5804, $vcd91e7679d575a2c548bd2c889c23b9e);}public function loadData($v3c6e0b8a9c15224a8228b9a98ca1531d) {if (!$this->isValidKey($v3c6e0b8a9c15224a8228b9a98ca1531d)) {return false;}$v3c6e0b8a9c15224a8228b9a98ca1531d = $this->getKeyGenerator()    ->createKey($v3c6e0b8a9c15224a8228b9a98ca1531d);return $this->get($v3c6e0b8a9c15224a8228b9a98ca1531d);}public function setDisabled($v327a6c4304ad5938eaf0efb6cc3e53dc = true) {$this->disabled = (bool) $v327a6c4304ad5938eaf0efb6cc3e53dc;return $this;}public function del($v3c6e0b8a9c15224a8228b9a98ca1531d, $v7549538db7966adaeed3235f19ba26dd = null) {$v3c6e0b8a9c15224a8228b9a98ca1531d = $this->getKeyGenerator()    ->createKey($v3c6e0b8a9c15224a8228b9a98ca1531d, $v7549538db7966adaeed3235f19ba26dd);return $this->delete($v3c6e0b8a9c15224a8228b9a98ca1531d);}public function deleteSql($v1b1cc7f086b3f074da452bc3129981eb) {$v3c6e0b8a9c15224a8228b9a98ca1531d = $this->getKeyGenerator()    ->createKeyForQuery($v1b1cc7f086b3f074da452bc3129981eb);return $this->delete($v3c6e0b8a9c15224a8228b9a98ca1531d);}public function flush() {return $this->getCacheEngine()    ->flush();}public function getCacheEngineList() {$v10ae9fc7d453b0dd525d0edf2ede7961 = [    databaseCacheEngine::NAME,    redisCacheEngine::NAME,    memcacheCacheEngine::NAME,    memcachedCacheEngine::NAME,    fsCacheEngine::NAME   ];return array_filter($v10ae9fc7d453b0dd525d0edf2ede7961, [$this, 'checkEngine']);}public function getCacheEngineName() {return $this->getCacheEngine()    ->getName();}public function switchCacheEngine($vb068931cc450442b63f5b3d276ea4297) {if (!$vb068931cc450442b63f5b3d276ea4297) {return $this->saveCacheEngineName('');}if ($this->checkEngine($vb068931cc450442b63f5b3d276ea4297)) {$this->flush();$this->saveCacheEngineName($vb068931cc450442b63f5b3d276ea4297);}return $this;}protected function isCorrectIp() {$v1602d1c5a1707e574521a284ff1b5a81 = (array) $this->getConfiguration()    ->get('cache', 'filter.ip');$v10573b873d2fa5a365d558a45e328e47 = Service::Request();return !in_array($v10573b873d2fa5a365d558a45e328e47->remoteAddress(), $v1602d1c5a1707e574521a284ff1b5a81);}protected function isCorrectMode() {return $this->getModeDetector()->isSite();}protected function detectCacheEngine() {$vf145e0347671912be8c9595821cb3376 = $this->loadCacheEngineName();if ($this->checkEngine($vf145e0347671912be8c9595821cb3376)) {return $vf145e0347671912be8c9595821cb3376;}$vf145e0347671912be8c9595821cb3376 = ($vf145e0347671912be8c9595821cb3376 == 'auto') ? $this->autoDetectCacheEngine() : $vf145e0347671912be8c9595821cb3376;$vf145e0347671912be8c9595821cb3376 = ($vf145e0347671912be8c9595821cb3376 == 'none') ? nullCacheEngine::NAME : $vf145e0347671912be8c9595821cb3376;return $vf145e0347671912be8c9595821cb3376 ?: nullCacheEngine::NAME;}protected function autoDetectCacheEngine() {foreach ($this->getCacheEngineList() as $v7e96ab06eef9d73d30eafc3b5ae196a6) {if ($v7e96ab06eef9d73d30eafc3b5ae196a6 == fsCacheEngine::NAME) {continue;}return $v7e96ab06eef9d73d30eafc3b5ae196a6;}return nullCacheEngine::NAME;}protected function checkEngine($v6257d4194dfc0a2e1468b01b77ca82b0) {switch ($v6257d4194dfc0a2e1468b01b77ca82b0) {case memcachedCacheEngine::NAME: {return class_exists('Memcached');}case memcacheCacheEngine::NAME: {return class_exists('Memcache');}case redisCacheEngine::NAME: {return class_exists('Redis');}case nullCacheEngine::NAME:    case arrayCacheEngine::NAME:    case fsCacheEngine::NAME:    case databaseCacheEngine::NAME: {return true;}default: {return false;}}}protected function saveCacheEngineName($vb068931cc450442b63f5b3d276ea4297) {$v2245023265ae4cf87d02c8b6ba991139 = $this->getConfiguration();$v2245023265ae4cf87d02c8b6ba991139->set('cache', 'engine', $vb068931cc450442b63f5b3d276ea4297);$v2245023265ae4cf87d02c8b6ba991139->save();return $this;}protected function loadCacheEngineName() {return $this->getConfiguration()    ->get('cache', 'engine');}protected function set($v3c6e0b8a9c15224a8228b9a98ca1531d, $v8d777f385d3dfec8815d20f7496026dc, $vcd91e7679d575a2c548bd2c889c23b9e) {if (!$this->isCacheEnabled() || $this->isDisabled() || !$vcd91e7679d575a2c548bd2c889c23b9e) {return false;}$vcd91e7679d575a2c548bd2c889c23b9e = $this->getTimeToLive($vcd91e7679d575a2c548bd2c889c23b9e);return $this->getCacheEngine()    ->saveRawData($v3c6e0b8a9c15224a8228b9a98ca1531d, $v8d777f385d3dfec8815d20f7496026dc, $vcd91e7679d575a2c548bd2c889c23b9e);}protected function get($v3c6e0b8a9c15224a8228b9a98ca1531d) {if (!$this->isCacheEnabled() || $this->isDisabled()) {return false;}return $this->getCacheEngine()    ->loadRawData($v3c6e0b8a9c15224a8228b9a98ca1531d);}protected function delete($v3c6e0b8a9c15224a8228b9a98ca1531d) {if (!$this->isCacheEnabled() || $this->isDisabled()) {return false;}return $this->getCacheEngine()    ->delete($v3c6e0b8a9c15224a8228b9a98ca1531d);}private function init() {$v8975779010887ca687ad040a39ee1e14 = $this->getEngineFactory();try {$vb068931cc450442b63f5b3d276ea4297 = $this->detectCacheEngine();$v2ae9e7e5c687d5c49e0e9a4740cc9ae5 = $v8975779010887ca687ad040a39ee1e14->create($vb068931cc450442b63f5b3d276ea4297);}catch (coreException $v42552b1f133f9f8eb406d4f306ea9fd1) {umiExceptionHandler::report($v42552b1f133f9f8eb406d4f306ea9fd1);$v2ae9e7e5c687d5c49e0e9a4740cc9ae5 = $v8975779010887ca687ad040a39ee1e14->create(nullCacheEngine::NAME);}$this->setCacheEngine($v2ae9e7e5c687d5c49e0e9a4740cc9ae5);if ($this->isCacheEnabled() && !($this->isCorrectIp() && $this->isCorrectMode())) {$this->setDisabled();}$v8d6c391e7cb39133c91b73281a24f21f = $this->getKeyValidatorFactory()    ->create();$this->setKeyValidator($v8d6c391e7cb39133c91b73281a24f21f);}private function setCacheEngine(iCacheEngine $vad1943a9fd6d3d7ee1e6af41a5b0d3e7) {$this->cacheEngine = $vad1943a9fd6d3d7ee1e6af41a5b0d3e7;return $this;}private function getTimeToLive($vcd91e7679d575a2c548bd2c889c23b9e) {if ($vcd91e7679d575a2c548bd2c889c23b9e !== self::DEFAULT_TIME_TO_LIVE) {return (int) $vcd91e7679d575a2c548bd2c889c23b9e;}$v2245023265ae4cf87d02c8b6ba991139 = $this->getConfiguration();if ($v2245023265ae4cf87d02c8b6ba991139->get('cache', 'streams.cache-enabled')) {$va8b17597e9b07c20163f2edf81585218 = (int) $v2245023265ae4cf87d02c8b6ba991139->get('cache', 'streams.cache-lifetime');if ($va8b17597e9b07c20163f2edf81585218 > 0) {$vcd91e7679d575a2c548bd2c889c23b9e = $va8b17597e9b07c20163f2edf81585218;}}return $vcd91e7679d575a2c548bd2c889c23b9e;}private function getCacheEngine() {return $this->cacheEngine;}private function getEngineFactory() {return $this->engineFactory;}private function getKeyGenerator() {return $this->keyGenerator;}private function getConfiguration() {return $this->configuration;}private function getKeyValidatorFactory() {return $this->keyValidatorFactory;}private function getKeyValidator() {return $this->keyValidator;}private function isValidKey($v3c6e0b8a9c15224a8228b9a98ca1531d) {return $this->getKeyValidator()    ->isValid($v3c6e0b8a9c15224a8228b9a98ca1531d);}private function setKeyValidator(iValidator $v8d6c391e7cb39133c91b73281a24f21f) {$this->keyValidator = $v8d6c391e7cb39133c91b73281a24f21f;return $this;}private function isDisabled() {return $this->disabled;}private function getModeDetector() {return $this->modeDetector;}public function saveObject($v3c6e0b8a9c15224a8228b9a98ca1531d, $v8d777f385d3dfec8815d20f7496026dc, $vcd91e7679d575a2c548bd2c889c23b9e = self::DEFAULT_TIME_TO_LIVE) {return $this->saveData($v3c6e0b8a9c15224a8228b9a98ca1531d, $v8d777f385d3dfec8815d20f7496026dc, $vcd91e7679d575a2c548bd2c889c23b9e);}public function saveElement($v3c6e0b8a9c15224a8228b9a98ca1531d, $v8d777f385d3dfec8815d20f7496026dc, $vcd91e7679d575a2c548bd2c889c23b9e = self::DEFAULT_TIME_TO_LIVE) {return $this->saveData($v3c6e0b8a9c15224a8228b9a98ca1531d, $v8d777f385d3dfec8815d20f7496026dc, $vcd91e7679d575a2c548bd2c889c23b9e);}public function getIsConnected() {return $this->isCacheEnabled();}public function chooseCacheEngine(array $v1425dcf40be6f10e6b883fda75c07fbb = null) {$v1425dcf40be6f10e6b883fda75c07fbb = $v1425dcf40be6f10e6b883fda75c07fbb ?: $this->getCacheEngineList();return array_shift($v1425dcf40be6f10e6b883fda75c07fbb);}public function getPriorityEnginesList($v759a21c505c72b62a1823b053e65d391 = false) {return $this->getCacheEngineList();}public function getCurrentCacheEngineName() {return $this->getCacheEngineName();}public function deleteKey($v3c6e0b8a9c15224a8228b9a98ca1531d, $v29befba2e437d0e266c0ee3240492277 = false) {return $this->del($v3c6e0b8a9c15224a8228b9a98ca1531d);}public function makeSleep($v327a6c4304ad5938eaf0efb6cc3e53dc = false) {return $this->setDisabled($v327a6c4304ad5938eaf0efb6cc3e53dc);}public static function getInstance($vb068931cc450442b63f5b3d276ea4297 = null) {return Service::CacheFrontend();}public function getCacheSize() {return 0;}public function doPeriodicOperations() {return null;}}