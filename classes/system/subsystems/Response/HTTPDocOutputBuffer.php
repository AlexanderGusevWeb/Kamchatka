<?php
 class HTTPDocOutputBuffer extends HTTPOutputBuffer {public function clear() {parent::clear();$vc9e9a848920877e76685b2e4e76de38d = ob_get_level();for ($v865c0c0b4ab0e063e5caa3387c1a8741 = 0;$v865c0c0b4ab0e063e5caa3387c1a8741 < $vc9e9a848920877e76685b2e4e76de38d;$v865c0c0b4ab0e063e5caa3387c1a8741 += 1) {ob_end_clean();}ob_start();}public function send() {$this->sendHeaders();echo $this->buffer;parent::clear();}}