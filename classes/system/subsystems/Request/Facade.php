<?php
 namespace UmiCms\System\Request;use UmiCms\System\Request\Http\iRequest;use UmiCms\Utils\Browser\iDetector as BrowserDetector;use UmiCms\System\Request\Mode\iDetector as ModeDetector;use UmiCms\System\Request\Path\iResolver as PathResolver;class Facade implements iFacade {private $request;private $browserDetector;private $modeDetector;private $pathResolver;private $queryHash;public function __construct(   iRequest $v10573b873d2fa5a365d558a45e328e47, BrowserDetector $v70fef00db84e5862fcedc2c32d20f98a, ModeDetector $v4076631aa75ae111b33f593b0558da6a, PathResolver $v4cb6e1fae20c2f513df8e826f6ba45df  ) {$this->request = $v10573b873d2fa5a365d558a45e328e47;$this->browserDetector = $v70fef00db84e5862fcedc2c32d20f98a;$this->modeDetector = $v4076631aa75ae111b33f593b0558da6a;$this->pathResolver = $v4cb6e1fae20c2f513df8e826f6ba45df;}public function Cookies() {return $this->getRequest()    ->Cookies();}public function Server() {return $this->getRequest()    ->Server();}public function Post() {return $this->getRequest()    ->Post();}public function Get() {return $this->getRequest()    ->Get();}public function Files() {return $this->getRequest()    ->Files();}public function getPath() {return $this->getPathResolver()    ->get();}public function getPathParts() {return $this->getPathResolver()    ->getParts();}public function isStream() {return $this->Get()->isExist('scheme');}public function getStreamScheme() {return $this->Get()->get('scheme');}public function isJson() {if ($this->isStream()) {return mb_strpos($this->getPath(), '.json') !== false;}return $this->Get()->get('jsonMode') === 'force';}public function isXml() {if ($this->isStream()) {return !$this->isJson();}return $this->Get()->get('xmlMode') === 'force';}public function isHtml() {return (!$this->isJson() && !$this->isXml());}public function isMobile() {$v55e7dd3016ce4ac57b9a0f56af12f7c2 = $this->Cookies();if ($v55e7dd3016ce4ac57b9a0f56af12f7c2->isExist('is_mobile')) {return (bool) $v55e7dd3016ce4ac57b9a0f56af12f7c2->get('is_mobile');}$v21aed3df2077b5d91ce46bf123446731 = $this->getBrowserDetector();try {return ($v21aed3df2077b5d91ce46bf123446731->isMobile() || $v21aed3df2077b5d91ce46bf123446731->isTablet());}catch(\Exception $ve1671797c52e15f763380b45e841ec32) {return false;}}public function isLocalHost() {return contains($this->host(), 'localhost') || contains($this->serverAddress(), '127.0.0.');}public function getBrowser() {return $this->getBrowserDetector()    ->getBrowser();}public function getPlatform() {return $this->getBrowserDetector()    ->getPlatform();}public function isRobot() {return $this->getBrowserDetector()    ->isRobot();}public function isStreamCallStack() {return (bool) $this->Get()->get('showStreamsCalls');}public function method() {return $this->getRequest()    ->method();}public function isPost() {return $this->getRequest()    ->isPost();}public function isGet() {return $this->getRequest()    ->isGet();}public function isAdmin() {return $this->getModeDetector()    ->isAdmin();}public function isNotAdmin() {return !$this->isAdmin();}public function isSite() {return $this->getModeDetector()    ->isSite();}public function isCli() {return $this->getModeDetector()    ->isCli();}public function mode() {return $this->getModeDetector()    ->detect();}public function host() {return $this->getRequest()    ->host();}public function userAgent() {return $this->getRequest()    ->userAgent();}public function remoteAddress() {return $this->getRequest()    ->remoteAddress();}public function serverAddress() {return $this->getRequest()    ->serverAddress();}public function uri() {return $this->getRequest()    ->uri();}public function query() {return $this->getRequest()    ->query();}public function queryHash() {if ($this->queryHash !== null) {return $this->queryHash;}$v1b1cc7f086b3f074da452bc3129981eb = '';$v9c28d32df234037773be184dbdafc274 = [];$v260ca9dd8a4577fc00b7bd5810298076 = preg_match('/([\?|\&][^\/#]*)/', $this->query(), $v9c28d32df234037773be184dbdafc274);if ($v260ca9dd8a4577fc00b7bd5810298076 && isset($v9c28d32df234037773be184dbdafc274[0])) {$v1b1cc7f086b3f074da452bc3129981eb = $v9c28d32df234037773be184dbdafc274[0];}return $this->queryHash = md5($v1b1cc7f086b3f074da452bc3129981eb);}public function getRawBody() {return $this->getRequest()    ->getRawBody();}private function getRequest() {return $this->request;}private function getBrowserDetector() {if (!$this->browserDetector->getUserAgent()) {$this->browserDetector->setUserAgent($this->userAgent());}return $this->browserDetector;}private function getModeDetector() {return $this->modeDetector;}private function getPathResolver() {return $this->pathResolver;}}