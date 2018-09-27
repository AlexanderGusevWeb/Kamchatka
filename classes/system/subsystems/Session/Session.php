<?php
namespace UmiCms\System\Session;use UmiCms\System\Cookies\iCookieJar;class Session implements iSession {private $config;private $cookieJar;public function __construct(\iConfiguration $v2245023265ae4cf87d02c8b6ba991139, iCookieJar $v3952212ff477ba2f5b443a38a081fecb) {$this->config = $v2245023265ae4cf87d02c8b6ba991139;$this->cookieJar = $v3952212ff477ba2f5b443a38a081fecb;$this->initSettings();}public function get($v3c6e0b8a9c15224a8228b9a98ca1531d) {if (!$this->isValidKey($v3c6e0b8a9c15224a8228b9a98ca1531d)) {return null;}$this->start();$v2063c1608d6e0baf80249c42e2be5804 = getArrayKey($_SESSION, $v3c6e0b8a9c15224a8228b9a98ca1531d);$this->commit();return $v2063c1608d6e0baf80249c42e2be5804;}public function isExist($v3c6e0b8a9c15224a8228b9a98ca1531d) {if (!$this->isValidKey($v3c6e0b8a9c15224a8228b9a98ca1531d)) {return false;}$this->start();$v5070b17e082dfffd6140455da3cf1219 = array_key_exists($v3c6e0b8a9c15224a8228b9a98ca1531d, $_SESSION);$this->commit();return $v5070b17e082dfffd6140455da3cf1219;}public function set($v3c6e0b8a9c15224a8228b9a98ca1531d, $v2063c1608d6e0baf80249c42e2be5804) {if (!$this->isValidKey($v3c6e0b8a9c15224a8228b9a98ca1531d)) {return $this;}$this->start();$_SESSION[$v3c6e0b8a9c15224a8228b9a98ca1531d] = $v2063c1608d6e0baf80249c42e2be5804;$this->commit();return $this;}public function del($vd36a87418dcd06d8fbb68d2a1776284e) {$vd36a87418dcd06d8fbb68d2a1776284e = is_array($vd36a87418dcd06d8fbb68d2a1776284e) ? $vd36a87418dcd06d8fbb68d2a1776284e : [$vd36a87418dcd06d8fbb68d2a1776284e];$this->start();foreach ($vd36a87418dcd06d8fbb68d2a1776284e as $v3c6e0b8a9c15224a8228b9a98ca1531d) {if (!$this->isValidKey($v3c6e0b8a9c15224a8228b9a98ca1531d)) {continue;}unset($_SESSION[$v3c6e0b8a9c15224a8228b9a98ca1531d]);}$this->commit();return $this;}public function getArrayCopy() {$this->start();$v21d6f40cfb511982e4424e0e250a9557 = $_SESSION;$this->commit();return $v21d6f40cfb511982e4424e0e250a9557;}public function clear() {$this->start();$_SESSION = [];$this->commit();return $this;}public function __get($v3c6e0b8a9c15224a8228b9a98ca1531d) {return $this->get($v3c6e0b8a9c15224a8228b9a98ca1531d);}public function __isset($v3c6e0b8a9c15224a8228b9a98ca1531d) {return $this->isExist($v3c6e0b8a9c15224a8228b9a98ca1531d);}public function __set($v3c6e0b8a9c15224a8228b9a98ca1531d, $v2063c1608d6e0baf80249c42e2be5804) {return $this->set($v3c6e0b8a9c15224a8228b9a98ca1531d, $v2063c1608d6e0baf80249c42e2be5804);}public function __unset($vd36a87418dcd06d8fbb68d2a1776284e) {return $this->del($vd36a87418dcd06d8fbb68d2a1776284e);}public function changeId($vb80bb7740288fda1f201890375a60c8f = null) {$this->start();if ($vb80bb7740288fda1f201890375a60c8f !== null && is_string($vb80bb7740288fda1f201890375a60c8f) && !empty($vb80bb7740288fda1f201890375a60c8f)) {session_id($vb80bb7740288fda1f201890375a60c8f);}else {session_regenerate_id();}return $this->commit()   ->bufferCookieHeaders()   ->deleteCookieHeaders();}public function getId() {$this->start();$vb80bb7740288fda1f201890375a60c8f = session_id();$this->commit();return $vb80bb7740288fda1f201890375a60c8f;}public function getName() {$this->start();$vb068931cc450442b63f5b3d276ea4297 = session_name();$this->commit();return $vb068931cc450442b63f5b3d276ea4297;}public function startActiveTime() {$this->set('start_time', time());return $this;}public function endActiveTime() {$v908d776230f35e017ee02392bc9a4d35 = time() - ($this->getMaxActiveTime() + 1) * self::SECONDS_IN_ONE_MINUTE;$this->set('start_time', $v908d776230f35e017ee02392bc9a4d35);return $this;}public function isActiveTimeExpired() {$v449f7acc06c24b890c69b290d7b036a9 = (int) $this->get('start_time');if ($v449f7acc06c24b890c69b290d7b036a9 === 0) {return false;}$v89cce9b6a30f9c15ca6e7b2162a6d55d = $this->getMaxActiveTime() * self::SECONDS_IN_ONE_MINUTE;return $v449f7acc06c24b890c69b290d7b036a9 + $v89cce9b6a30f9c15ca6e7b2162a6d55d < time();}public function getActiveTime() {$v449f7acc06c24b890c69b290d7b036a9 = (int) $this->get('start_time');$v89cce9b6a30f9c15ca6e7b2162a6d55d = $this->getMaxActiveTime() * self::SECONDS_IN_ONE_MINUTE;if ($v449f7acc06c24b890c69b290d7b036a9 === 0) {return $v89cce9b6a30f9c15ca6e7b2162a6d55d;}return $v449f7acc06c24b890c69b290d7b036a9 + $v89cce9b6a30f9c15ca6e7b2162a6d55d - time();}public function getMaxActiveTime() {$v4cea0278aa9e6c71ca4a3105ba9c1613 = $this->getConfig()   ->get('session', 'active-lifetime');return is_numeric($v4cea0278aa9e6c71ca4a3105ba9c1613) ? (int) $v4cea0278aa9e6c71ca4a3105ba9c1613 : self::TWO_WEEKS_IN_SECONDS;}private function start() {if (!$this->isStarted()) {@session_start();$this->bufferCookieHeaders()    ->deleteCookieHeaders();}return $this;}private function commit() {if ($this->isStarted()) {session_commit();}return $this;}private function isStarted() {return session_status() === PHP_SESSION_ACTIVE;}private function getCookieJar() {return $this->cookieJar;}private function getConfig() {return $this->config;}private function initSettings() {$v2245023265ae4cf87d02c8b6ba991139 = $this->getConfig();$v6159e57fd3d04c0a77cf7c61ee8f0a9e = $v2245023265ae4cf87d02c8b6ba991139->get('session', 'cookie-lifetime');$v6159e57fd3d04c0a77cf7c61ee8f0a9e = is_numeric($v6159e57fd3d04c0a77cf7c61ee8f0a9e) ? (int) $v6159e57fd3d04c0a77cf7c61ee8f0a9e : self::TWO_WEEKS_IN_SECONDS;$vd6fe1d0be6347b8ef2427fa629c04485 = $v2245023265ae4cf87d02c8b6ba991139->get('session', 'cookie-path');$vd6fe1d0be6347b8ef2427fa629c04485 = (is_string($vd6fe1d0be6347b8ef2427fa629c04485) && !empty($vd6fe1d0be6347b8ef2427fa629c04485)) ? $vd6fe1d0be6347b8ef2427fa629c04485 : self::DEFAULT_COOKIE_PATH;$vad5f82e879a9c5d6b5b442eb37e50551 = $v2245023265ae4cf87d02c8b6ba991139->get('session', 'cookie-domain');$vad5f82e879a9c5d6b5b442eb37e50551 = (is_string($vad5f82e879a9c5d6b5b442eb37e50551) && !empty($vad5f82e879a9c5d6b5b442eb37e50551)) ? $vad5f82e879a9c5d6b5b442eb37e50551 : self::DEFAULT_COOKIE_DOMAIN;$v53fac525efd9feacd6bb93e2a6770cfd = $v2245023265ae4cf87d02c8b6ba991139->get('session', 'cookie-secure-flag');$v53fac525efd9feacd6bb93e2a6770cfd = is_numeric($v53fac525efd9feacd6bb93e2a6770cfd) ? (bool) $v53fac525efd9feacd6bb93e2a6770cfd : self::DEFAULT_COOKIE_SECURE_FLAG;$v7a56464fb30d4aca22654f40d3d2e8eb = $v2245023265ae4cf87d02c8b6ba991139->get('session', 'cookie-http-flag');$v7a56464fb30d4aca22654f40d3d2e8eb = is_numeric($v7a56464fb30d4aca22654f40d3d2e8eb) ? (bool) $v7a56464fb30d4aca22654f40d3d2e8eb : self::DEFAULT_COOKIE_HTTP_ONLY_FLAG;session_set_cookie_params($v6159e57fd3d04c0a77cf7c61ee8f0a9e, $vd6fe1d0be6347b8ef2427fa629c04485, $vad5f82e879a9c5d6b5b442eb37e50551, $v53fac525efd9feacd6bb93e2a6770cfd, $v7a56464fb30d4aca22654f40d3d2e8eb);$vb068931cc450442b63f5b3d276ea4297 = $v2245023265ae4cf87d02c8b6ba991139->get('session', 'name');$vb068931cc450442b63f5b3d276ea4297 = (is_string($vb068931cc450442b63f5b3d276ea4297) && !empty($vb068931cc450442b63f5b3d276ea4297)) ? $vb068931cc450442b63f5b3d276ea4297 : self::DEFAULT_NAME;session_name($vb068931cc450442b63f5b3d276ea4297);return $this;}private function bufferCookieHeaders() {$v3952212ff477ba2f5b443a38a081fecb = $this->getCookieJar();foreach (headers_list() as $v099fb995346f31c749f6e40db0f395e3) {$v9091da5a67b801050d20f0aae1dcbd2f = is_int(mb_strpos($v099fb995346f31c749f6e40db0f395e3, 'Set-Cookie'));if (!$v9091da5a67b801050d20f0aae1dcbd2f) {continue;}try {$v3952212ff477ba2f5b443a38a081fecb->setFromHeader($v099fb995346f31c749f6e40db0f395e3);}catch (\wrongParamException $ve1671797c52e15f763380b45e841ec32) {continue;}}return $this;}private function deleteCookieHeaders() {@header_remove('Set-Cookie');return $this;}private function isValidKey($v3c6e0b8a9c15224a8228b9a98ca1531d) {return (is_string($v3c6e0b8a9c15224a8228b9a98ca1531d) || is_int($v3c6e0b8a9c15224a8228b9a98ca1531d));}}