<?php
 namespace UmiCms\System\Cache\Statical;use UmiCms\Classes\System\Entities\File\iFactory as FileFactory;use UmiCms\Classes\System\Entities\Directory\iFactory as DirectoryFactory;class Storage implements iStorage {private $config;private $fileFactory;private $directoryFactory;public function __construct(\iConfiguration $v2245023265ae4cf87d02c8b6ba991139, FileFactory $ve9d2ea3c13cc8f3b974ffbe8695cba02, DirectoryFactory $vb7a82c37d8c13db7202ec4890aa47a7d) {$this->config = $v2245023265ae4cf87d02c8b6ba991139;$this->fileFactory = $ve9d2ea3c13cc8f3b974ffbe8695cba02;$this->directoryFactory = $vb7a82c37d8c13db7202ec4890aa47a7d;}public function save($vd6fe1d0be6347b8ef2427fa629c04485, $v9a0364b9e99bb480dd25e1f0284c8555) {if (!$this->isValidString($vd6fe1d0be6347b8ef2427fa629c04485) || !$this->isValidString($v9a0364b9e99bb480dd25e1f0284c8555)) {return false;}$v8c7dd922ad47494fc02c388e12c00eac = $this->getFile($vd6fe1d0be6347b8ef2427fa629c04485);$v06f0066e65410a0a1c9f39991a3f3b01 = $v8c7dd922ad47494fc02c388e12c00eac->getDirName() . '/';$v5f8f22b8cdbaeee8cf857673a9b6ba20 = $this->getDirectoryFactory()    ->create($v06f0066e65410a0a1c9f39991a3f3b01);if (!$v5f8f22b8cdbaeee8cf857673a9b6ba20->isExists()) {$v5f8f22b8cdbaeee8cf857673a9b6ba20::requireFolder($v5f8f22b8cdbaeee8cf857673a9b6ba20->getPath());$v5f8f22b8cdbaeee8cf857673a9b6ba20->refresh();}return (bool) $v8c7dd922ad47494fc02c388e12c00eac->putContent($v9a0364b9e99bb480dd25e1f0284c8555);}public function load($vd6fe1d0be6347b8ef2427fa629c04485) {if (!$this->isValidString($vd6fe1d0be6347b8ef2427fa629c04485)) {return false;}$v8c7dd922ad47494fc02c388e12c00eac = $this->getFile($vd6fe1d0be6347b8ef2427fa629c04485);if (!$v8c7dd922ad47494fc02c388e12c00eac->isExists() || !$v8c7dd922ad47494fc02c388e12c00eac->isReadable()) {return false;}if ($v8c7dd922ad47494fc02c388e12c00eac->getModifyTime() + $this->getTimeToLive() < time()) {$this->delete($vd6fe1d0be6347b8ef2427fa629c04485);return false;}return (string) $v8c7dd922ad47494fc02c388e12c00eac->getContent();}public function delete($vd6fe1d0be6347b8ef2427fa629c04485) {if (!$this->isValidString($vd6fe1d0be6347b8ef2427fa629c04485)) {return false;}$v8c7dd922ad47494fc02c388e12c00eac = $this->getFile($vd6fe1d0be6347b8ef2427fa629c04485);if (!$v8c7dd922ad47494fc02c388e12c00eac->isExists()) {return false;}$va18b1057c4327b9cc46abc9fcf952bd8 = $v8c7dd922ad47494fc02c388e12c00eac->delete();$v06f0066e65410a0a1c9f39991a3f3b01 = $v8c7dd922ad47494fc02c388e12c00eac->getDirName() . '/';$this->deleteEmptyDirectory($v06f0066e65410a0a1c9f39991a3f3b01);return $va18b1057c4327b9cc46abc9fcf952bd8;}public function deleteForEveryQuery($vd6fe1d0be6347b8ef2427fa629c04485) {if (!$this->isValidString($vd6fe1d0be6347b8ef2427fa629c04485)) {return false;}$v06f0066e65410a0a1c9f39991a3f3b01 = $this->getFile($vd6fe1d0be6347b8ef2427fa629c04485)    ->getDirName() . '/';$v5f8f22b8cdbaeee8cf857673a9b6ba20 = $this->getDirectoryFactory()    ->create($v06f0066e65410a0a1c9f39991a3f3b01);if (!$v5f8f22b8cdbaeee8cf857673a9b6ba20->isExists()) {return false;}$ve9d2ea3c13cc8f3b974ffbe8695cba02 = $this->getFileFactory();foreach ($v5f8f22b8cdbaeee8cf857673a9b6ba20->getFiles() as $v47826cacc65c665212b821e6ff80b9b0) {$v8c7dd922ad47494fc02c388e12c00eac = $ve9d2ea3c13cc8f3b974ffbe8695cba02->create($v47826cacc65c665212b821e6ff80b9b0);if (!$v8c7dd922ad47494fc02c388e12c00eac->isExists()) {continue;}$v8c7dd922ad47494fc02c388e12c00eac->delete();}$this->deleteEmptyDirectory($v06f0066e65410a0a1c9f39991a3f3b01);return true;}public function flush() {$v5f8f22b8cdbaeee8cf857673a9b6ba20 = $this->getRootDirectory();if ($v5f8f22b8cdbaeee8cf857673a9b6ba20->isExists() && $v5f8f22b8cdbaeee8cf857673a9b6ba20->isWritable()) {return $v5f8f22b8cdbaeee8cf857673a9b6ba20->deleteContent();}return false;}public function getTimeToLive() {switch ($this->getConfig()->get('cache', 'static.mode')) {case 'test': {return 10;}case 'short': {return 10 * 60;}case 'long': {return 3600 * 2 * 365;}default: {return 3600 * 24;}}}private function isValidString($v2063c1608d6e0baf80249c42e2be5804) {if (!is_string($v2063c1608d6e0baf80249c42e2be5804)) {return false;}$v13f055fdc29cde00f77f4ff0bcb09d49 = trim($v2063c1608d6e0baf80249c42e2be5804);return mb_strlen($v13f055fdc29cde00f77f4ff0bcb09d49) !== 0;}private function deleteEmptyDirectory($vd6fe1d0be6347b8ef2427fa629c04485) {$v06f0066e65410a0a1c9f39991a3f3b01 = rtrim($vd6fe1d0be6347b8ef2427fa629c04485,  '/') . '/';$v5f8f22b8cdbaeee8cf857673a9b6ba20 = $this->getDirectoryFactory()    ->create($v06f0066e65410a0a1c9f39991a3f3b01);if ($v5f8f22b8cdbaeee8cf857673a9b6ba20->isExists() && $v5f8f22b8cdbaeee8cf857673a9b6ba20->isWritable()) {$v2405a5d61f2f462a1371b33338295c09 = realpath($v5f8f22b8cdbaeee8cf857673a9b6ba20->getPath() . '/../');$v5f8f22b8cdbaeee8cf857673a9b6ba20->deleteEmptyDirectory();return $this->deleteEmptyDirectory($v2405a5d61f2f462a1371b33338295c09);}return true;}private function getFile($vd6fe1d0be6347b8ef2427fa629c04485) {$v7051f8628ab15951a8db3f5d8b3bfcd4 = parse_url($vd6fe1d0be6347b8ef2427fa629c04485);$v5f8f22b8cdbaeee8cf857673a9b6ba20 = $this->getDirectory($v7051f8628ab15951a8db3f5d8b3bfcd4);$vd6fe1d0be6347b8ef2427fa629c04485 = $v5f8f22b8cdbaeee8cf857673a9b6ba20->getPath() . '/' . $this->getFileName($v7051f8628ab15951a8db3f5d8b3bfcd4);return $this->getFileFactory()    ->create($vd6fe1d0be6347b8ef2427fa629c04485);}private function getDirectory(array $v7051f8628ab15951a8db3f5d8b3bfcd4) {$vd6fe1d0be6347b8ef2427fa629c04485 = isset($v7051f8628ab15951a8db3f5d8b3bfcd4['path']) ? trim($v7051f8628ab15951a8db3f5d8b3bfcd4['path'], '/') : '';$vd6fe1d0be6347b8ef2427fa629c04485 = empty($vd6fe1d0be6347b8ef2427fa629c04485) ? $vd6fe1d0be6347b8ef2427fa629c04485 : $vd6fe1d0be6347b8ef2427fa629c04485 . '/';$vbc7c5b7825005b7063a3e1a8b2ad5e2d = $this->getRootDirectory();if (!$vbc7c5b7825005b7063a3e1a8b2ad5e2d->isExists()) {$vbc7c5b7825005b7063a3e1a8b2ad5e2d::requireFolder($vbc7c5b7825005b7063a3e1a8b2ad5e2d->getPath());$vbc7c5b7825005b7063a3e1a8b2ad5e2d->refresh();}$vd6fe1d0be6347b8ef2427fa629c04485 = $vbc7c5b7825005b7063a3e1a8b2ad5e2d->getPath() . '/' . $vd6fe1d0be6347b8ef2427fa629c04485;return $this->getDirectoryFactory()    ->create($vd6fe1d0be6347b8ef2427fa629c04485);}private function getFileName(array $v7051f8628ab15951a8db3f5d8b3bfcd4) {$vb068931cc450442b63f5b3d276ea4297 = isset($v7051f8628ab15951a8db3f5d8b3bfcd4['query']) ? md5($v7051f8628ab15951a8db3f5d8b3bfcd4['query']) : 'index';return $vb068931cc450442b63f5b3d276ea4297 . '.html';}private function getConfig() {return $this->config;}private function getFileFactory() {return $this->fileFactory;}private function getDirectoryFactory() {return $this->directoryFactory;}private function getRootDirectory() {$v2245023265ae4cf87d02c8b6ba991139 = $this->getConfig();$vd6fe1d0be6347b8ef2427fa629c04485 = (string) $v2245023265ae4cf87d02c8b6ba991139->includeParam('system.static-cache');if (empty($vd6fe1d0be6347b8ef2427fa629c04485)) {$vd6fe1d0be6347b8ef2427fa629c04485 = (string) $v2245023265ae4cf87d02c8b6ba991139->includeParam('sys-temp-path');$vd6fe1d0be6347b8ef2427fa629c04485 = rtrim($vd6fe1d0be6347b8ef2427fa629c04485, '/') . '/static-cache';}$vd6fe1d0be6347b8ef2427fa629c04485 = rtrim($vd6fe1d0be6347b8ef2427fa629c04485, '/') . '/';return $this->getDirectoryFactory()    ->create($vd6fe1d0be6347b8ef2427fa629c04485);}}