<?php
use UmiCms\Service;class umiEventsController implements iUmiEventsController {protected static $eventListeners = [];private   static $oInstance;protected function __construct() {$this->loadEventListeners();}public static function getInstance() {if(self::$oInstance == null) {self::$oInstance = new umiEventsController();}return self::$oInstance;}protected function loadEventListeners() {$v6c63406410aa57b3c97b88d3feb09990 = Service::Registry()->getList('//modules');foreach($v6c63406410aa57b3c97b88d3feb09990 as $v47c80780ab608cc046f2a6e6f071feb6) {$v22884db148f0ffb0d830ba431102b0b5 = $v47c80780ab608cc046f2a6e6f071feb6[0];$this->loadModuleEventListeners($v22884db148f0ffb0d830ba431102b0b5);}}protected function loadModuleEventListeners($v22884db148f0ffb0d830ba431102b0b5) {$vd6fe1d0be6347b8ef2427fa629c04485 = SYS_MODULES_PATH . "{$v22884db148f0ffb0d830ba431102b0b5}/events.php";$v8c889aaa2bdffb33c678609ca3bddac8 = SYS_MODULES_PATH . "{$v22884db148f0ffb0d830ba431102b0b5}/custom_events.php";$v6829cdfdefd69b947abedd8fa2c4bcc7 = cmsController::getInstance()->getResourcesDirectory();if ($v6829cdfdefd69b947abedd8fa2c4bcc7) {$this->tryLoadEvents($v6829cdfdefd69b947abedd8fa2c4bcc7 . "/classes/modules/{$v22884db148f0ffb0d830ba431102b0b5}/events.php");}$vc91e6e80deac06534fba478f9a7daf4d = SYS_MODULES_PATH . "{$v22884db148f0ffb0d830ba431102b0b5}/ext/events_*.php";$vef36273b1a6b54195bf260c283a4ef6f = glob($vc91e6e80deac06534fba478f9a7daf4d);if(is_array($vef36273b1a6b54195bf260c283a4ef6f)) {foreach (glob($vc91e6e80deac06534fba478f9a7daf4d) as $v435ed7e9f07f740abf511a62c00eef6e) {if (file_exists($v435ed7e9f07f740abf511a62c00eef6e)) {$this->tryLoadEvents($v435ed7e9f07f740abf511a62c00eef6e);}}}$this->tryLoadEvents($v8c889aaa2bdffb33c678609ca3bddac8);$this->tryLoadEvents($vd6fe1d0be6347b8ef2427fa629c04485);}protected function tryLoadEvents($vd6fe1d0be6347b8ef2427fa629c04485) {if(file_exists($vd6fe1d0be6347b8ef2427fa629c04485)) {require $vd6fe1d0be6347b8ef2427fa629c04485;return true;}return false;}protected function searchEventListeners($v53cc4db543d7a569e51c1d76ac6f278e) {static $v0fea6a13c52b4d4725368f24b045ca84 = [];if (isset($v0fea6a13c52b4d4725368f24b045ca84[$v53cc4db543d7a569e51c1d76ac6f278e])) {return $v0fea6a13c52b4d4725368f24b045ca84[$v53cc4db543d7a569e51c1d76ac6f278e];}$result = [];foreach(self::$eventListeners as $v09d7ec30552b0eded7e4bfad71fac83d) {if($v09d7ec30552b0eded7e4bfad71fac83d->getEventId() == $v53cc4db543d7a569e51c1d76ac6f278e) {$result[] = $v09d7ec30552b0eded7e4bfad71fac83d;}}$v3d801aa532c1cec3ee82d87a99fdf63f = [];foreach($result as $v924a8ceeac17f54d3be3f8cdf1c04eb2) {$v3d801aa532c1cec3ee82d87a99fdf63f[$v924a8ceeac17f54d3be3f8cdf1c04eb2->getPriority()][] = $v924a8ceeac17f54d3be3f8cdf1c04eb2;}$result = [];ksort($v3d801aa532c1cec3ee82d87a99fdf63f);foreach($v3d801aa532c1cec3ee82d87a99fdf63f as $v6a3d252c501d3bde07ddc1f57a683937) {foreach ($v6a3d252c501d3bde07ddc1f57a683937 as $v924a8ceeac17f54d3be3f8cdf1c04eb2) {$result[] = $v924a8ceeac17f54d3be3f8cdf1c04eb2;}}$v0fea6a13c52b4d4725368f24b045ca84[$v53cc4db543d7a569e51c1d76ac6f278e] = $result;return $v0fea6a13c52b4d4725368f24b045ca84[$v53cc4db543d7a569e51c1d76ac6f278e];}protected function executeCallback($v924a8ceeac17f54d3be3f8cdf1c04eb2, $v70e8822b2e035fa3777d666207aeafa8) {$v22884db148f0ffb0d830ba431102b0b5 = $v924a8ceeac17f54d3be3f8cdf1c04eb2->getCallbackModule();$vea9f6aca279138c58f705c8d4cb4b8ce = $v924a8ceeac17f54d3be3f8cdf1c04eb2->getCallbackMethod();$v47a12618c9a47b69a3050e6b9313a351 = cmsController::getInstance()->getModule($v22884db148f0ffb0d830ba431102b0b5);if($v47a12618c9a47b69a3050e6b9313a351) {$v47a12618c9a47b69a3050e6b9313a351->$vea9f6aca279138c58f705c8d4cb4b8ce($v70e8822b2e035fa3777d666207aeafa8);}else {throw new coreException("Cannot find module \"{$v22884db148f0ffb0d830ba431102b0b5}\"");}}public function callEvent(iUmiEventPoint $v70e8822b2e035fa3777d666207aeafa8, $vd1540c8092fdc7e9a4b4b1160ba22465 = []) {$v53cc4db543d7a569e51c1d76ac6f278e = $v70e8822b2e035fa3777d666207aeafa8->getEventId();$v89885eff552e13893a0dade8efb1b731 = $this->searchEventListeners($v53cc4db543d7a569e51c1d76ac6f278e);$v2165e4fa5bddb65a31f6a0c495c2fa37 = ['executed' => [], 'failed' => [], 'breaked' => []];foreach($v89885eff552e13893a0dade8efb1b731 as $v924a8ceeac17f54d3be3f8cdf1c04eb2) {if(!empty($vd1540c8092fdc7e9a4b4b1160ba22465) && !in_array($v924a8ceeac17f54d3be3f8cdf1c04eb2->getCallbackModule(), $vd1540c8092fdc7e9a4b4b1160ba22465))     {continue;}try {$this->executeCallback($v924a8ceeac17f54d3be3f8cdf1c04eb2, $v70e8822b2e035fa3777d666207aeafa8);$v2165e4fa5bddb65a31f6a0c495c2fa37['executed'][] = $v924a8ceeac17f54d3be3f8cdf1c04eb2;}catch (baseException $ve1671797c52e15f763380b45e841ec32) {$v2165e4fa5bddb65a31f6a0c495c2fa37['failed'][] = $v924a8ceeac17f54d3be3f8cdf1c04eb2;if($v924a8ceeac17f54d3be3f8cdf1c04eb2->getIsCritical()) {throw $ve1671797c52e15f763380b45e841ec32;}continue;}catch (breakException $ve1671797c52e15f763380b45e841ec32) {$v2165e4fa5bddb65a31f6a0c495c2fa37['breaked'][] = $v924a8ceeac17f54d3be3f8cdf1c04eb2;break;}}return $v2165e4fa5bddb65a31f6a0c495c2fa37;}public static function registerEventListener(iUmiEventListener $v09d7ec30552b0eded7e4bfad71fac83d) {self::$eventListeners[] = $v09d7ec30552b0eded7e4bfad71fac83d;}}