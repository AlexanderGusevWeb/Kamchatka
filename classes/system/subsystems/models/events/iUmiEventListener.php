<?php
interface iUmiEventListener {public function __construct($v53cc4db543d7a569e51c1d76ac6f278e, $v95c6b29be20eb79b67569234625cad19, $v9d39b057bcc1e761e1d8b96b2e062561);public function setPriority($vb988295c268025b49dfb3df26171ddc3 = 5);public function getPriority();public function setIsCritical($v12adfdc02f1648be7a61845ae7ff4691 = false);public function getIsCritical();public function getEventId();public function getCallbackModule();public function getCallbackMethod();}