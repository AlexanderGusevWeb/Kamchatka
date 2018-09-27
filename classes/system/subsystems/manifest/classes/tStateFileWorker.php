<?php
 trait tStateFileWorker {protected $v9ed39e2ea931586b6a985a6942ef573e = [];protected $vdcd393d584f197f5b88cc97cd3968206;public function setStatePath($v47826cacc65c665212b821e6ff80b9b0) {if (!is_string($v47826cacc65c665212b821e6ff80b9b0) || empty($v47826cacc65c665212b821e6ff80b9b0)) {throw new Exception('Wrong state path given');}$this->statePath = $v47826cacc65c665212b821e6ff80b9b0;return $this;}public function loadState() {$v17686b6dc6aae6ad46d83d04aa895405 = $this->getStatePath();if (is_file($v17686b6dc6aae6ad46d83d04aa895405)) {$vb1f2466d7392d7649c0d5dc4fd3e29ae = file_get_contents($v17686b6dc6aae6ad46d83d04aa895405);$v9ed39e2ea931586b6a985a6942ef573e = $this->unpackState($vb1f2466d7392d7649c0d5dc4fd3e29ae);if (is_array($v9ed39e2ea931586b6a985a6942ef573e)) {return $this->setState($v9ed39e2ea931586b6a985a6942ef573e);}}return $this->resetState();}protected function getStatePart($v6a992d5529f459a44fee58c733255e86) {$v9ed39e2ea931586b6a985a6942ef573e = $this->getState();return isset($v9ed39e2ea931586b6a985a6942ef573e[$v6a992d5529f459a44fee58c733255e86]) ? $v9ed39e2ea931586b6a985a6942ef573e[$v6a992d5529f459a44fee58c733255e86] : null;}protected function setStatePart($v6a992d5529f459a44fee58c733255e86, $v86662855faac1061255df3e47b9e0cdc) {$this->state[$v6a992d5529f459a44fee58c733255e86] = $v86662855faac1061255df3e47b9e0cdc;return $this;}protected function getStartState() {return [];}protected function getState() {return $this->state;}protected function setState(array $v9ed39e2ea931586b6a985a6942ef573e) {$this->state = $v9ed39e2ea931586b6a985a6942ef573e;return $this;}protected function saveState() {$v9ed39e2ea931586b6a985a6942ef573e = $this->getState();$vb1f2466d7392d7649c0d5dc4fd3e29ae = $this->packState($v9ed39e2ea931586b6a985a6942ef573e);$v17686b6dc6aae6ad46d83d04aa895405 = $this->getStatePath();$result = file_put_contents($v17686b6dc6aae6ad46d83d04aa895405, $vb1f2466d7392d7649c0d5dc4fd3e29ae);if (!$result) {throw new Exception("Can'\t save state: {$v17686b6dc6aae6ad46d83d04aa895405}");}return $this;}protected function resetState() {$v40ca204588c683d5b198009b5eb23778 = $this->getStartState();return $this->setState($v40ca204588c683d5b198009b5eb23778);}protected function getStatePath() {if ($this->statePath === null) {throw new Exception('You must set state path');}return $this->statePath;}protected function packState(array $v9ed39e2ea931586b6a985a6942ef573e) {return serialize($v9ed39e2ea931586b6a985a6942ef573e);}protected function unpackState($v9ed39e2ea931586b6a985a6942ef573e) {return unserialize($v9ed39e2ea931586b6a985a6942ef573e);}}