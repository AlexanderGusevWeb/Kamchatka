<?php
 namespace UmiCms\System\Import\UmiDump\Demolisher\Type;use UmiCms\Classes\System\Entities\File\iFactory as FileFactory;use UmiCms\System\Import\UmiDump\Demolisher\FileSystem;class File extends FileSystem {private $fileFactory;public function __construct(FileFactory $ve9d2ea3c13cc8f3b974ffbe8695cba02) {$this->fileFactory = $ve9d2ea3c13cc8f3b974ffbe8695cba02;}protected function execute() {$ve9d2ea3c13cc8f3b974ffbe8695cba02 = $this->getFileFactory();foreach ($this->getFilePathList() as $vd6fe1d0be6347b8ef2427fa629c04485) {$vd6fe1d0be6347b8ef2427fa629c04485 = $this->buildAbsolutePath($vd6fe1d0be6347b8ef2427fa629c04485);$v8c7dd922ad47494fc02c388e12c00eac = $ve9d2ea3c13cc8f3b974ffbe8695cba02->create($vd6fe1d0be6347b8ef2427fa629c04485);if (!$v8c7dd922ad47494fc02c388e12c00eac->isExists()) {$this->pushLog(sprintf('File "%s" not exists', $vd6fe1d0be6347b8ef2427fa629c04485));continue;}$v8c7dd922ad47494fc02c388e12c00eac->delete();$this->pushLog(sprintf('File "%s" was deleted', $vd6fe1d0be6347b8ef2427fa629c04485));}}private function getFilePathList() {return $this->getNodeValueList('/umidump/files/file');}private function getFileFactory() {return $this->fileFactory;}}