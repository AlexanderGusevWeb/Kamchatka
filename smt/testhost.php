<?php
 class testHost {public $listErrors;private $cliMode;private $domain;private $host;private $user;private $password;private $database;private $link;public function __construct($v0e05d74bbc655cc42c026f2353d1eb63 = array(), $vad5f82e879a9c5d6b5b442eb37e50551 = '') {$this->listErrors = array();$this->cliMode = defined('UMICMS_CLI_MODE') && UMICMS_CLI_MODE;$this->domain = $vad5f82e879a9c5d6b5b442eb37e50551;}public function setConnect($v67b3dba8bc6778101892eb77249db32e, $vee11cbb19052e40b07aac0ca060c23ee, $v5f4dcc3b5aa765d61d8327deb882cf99, $v11e0eed8d3696c0a632f822df385ab3c) {$this->user = $vee11cbb19052e40b07aac0ca060c23ee;$this->host = $v67b3dba8bc6778101892eb77249db32e;$this->password = $v5f4dcc3b5aa765d61d8327deb882cf99;$this->database = $v11e0eed8d3696c0a632f822df385ab3c;}public function getResults() {$this->runAllTests();return $this->listErrors;}private function runAllTests() {foreach (get_class_methods($this) as $vddaa6e8c8c412299272e183087b8f7b6) {if (preg_match('/^test/', $vddaa6e8c8c412299272e183087b8f7b6)) {$this->$vddaa6e8c8c412299272e183087b8f7b6();}}}private function testIIS() {$vac134c52386a1913d9d31ecb3cbc9c94 = isset($_SERVER['SERVER_SOFTWARE']) ? mb_strtolower($_SERVER['SERVER_SOFTWARE']) : '';$this->assert(mb_strpos($vac134c52386a1913d9d31ecb3cbc9c94, 'microsoft-iis') === false, 13090, false);}private function assert($ve8933b3c62648b9468f3e637ced377d0, $v0279985cdca9ad2836b5dc949af215c8, $v7e85bcb66fb9a809d5ab4f62a8b8bea8 = true, $v6efc3a4b88162d72cd844eaabb9a0153 = '') {if (!$ve8933b3c62648b9468f3e637ced377d0) {$this->listErrors[] = array($v0279985cdca9ad2836b5dc949af215c8, $v7e85bcb66fb9a809d5ab4f62a8b8bea8, $v6efc3a4b88162d72cd844eaabb9a0153);}}private function testPhpVersion() {$v0ba4439ee9a46d9d9f14c60f88f45f87 = version_compare(phpversion(), '5.6.0', '>') && version_compare(phpversion(), '7.2.7', '<');$this->assert($v0ba4439ee9a46d9d9f14c60f88f45f87, 13000);}private function testSuhosin() {$this->assert(!extension_loaded('suhosin'), 13001, false);}private function testMemoryLimit() {$vf58f093c66feb87b0fcc803d50e095ac = ini_get('memory_limit');if (!$vf58f093c66feb87b0fcc803d50e095ac) {$this->assert(false, 13002, false);return;}if ($vf58f093c66feb87b0fcc803d50e095ac < 0) {return;}$vddcd8e2f1f81aac7c9cbbcc4553a71bc = $vf58f093c66feb87b0fcc803d50e095ac[mb_strlen($vf58f093c66feb87b0fcc803d50e095ac) - 1];$v87e9a4d836b4452ccde0621b77720eca = mb_strtolower($vddcd8e2f1f81aac7c9cbbcc4553a71bc);if (in_array($v87e9a4d836b4452ccde0621b77720eca, array('g', 'm', 'k'))) {$vcc74156c927817ab1c5bbcdf1018b083 = (int) str_replace($vddcd8e2f1f81aac7c9cbbcc4553a71bc, '', $vf58f093c66feb87b0fcc803d50e095ac);switch ($v87e9a4d836b4452ccde0621b77720eca) {case 'g':      $vcc74156c927817ab1c5bbcdf1018b083 *= 1024 * 1024 * 1024;break;case 'm':      $vcc74156c927817ab1c5bbcdf1018b083 *= 1024 * 1024;break;case 'k':      $vcc74156c927817ab1c5bbcdf1018b083 *= 1024;break;}}else {$vcc74156c927817ab1c5bbcdf1018b083 = (int) $vf58f093c66feb87b0fcc803d50e095ac;}$this->assert($vcc74156c927817ab1c5bbcdf1018b083 >= 32 * 1024 * 1024, 13003);}private function testModRewrite() {if (!$this->cliMode && $this->isApacheServer()) {$this->assert(in_array('mod_rewrite', apache_get_modules()), 13007);}}private function isApacheServer() {return extension_loaded('apache2handler');}private function testModAuth() {if (!$this->cliMode && $this->isApacheServer()) {$this->assert(in_array('mod_auth_basic', apache_get_modules()), 13009);}}private function testExtensions() {$v74ee3e70ef075411a5de16630163205b = array(    'zlib',    'gd',    'libxml',    'iconv',    'xsl',    'simplexml',    'xmlreader',    'mbstring',    'json',    'mysqli',    'curl',    'phar'   );$v68e77c9c4d583159feeb1bf44c9a631a = 0;foreach ($v74ee3e70ef075411a5de16630163205b as $v566bbee0f961ad71b54c3c2fd36db053) {$this->assert(extension_loaded($v566bbee0f961ad71b54c3c2fd36db053), 13030 + $v68e77c9c4d583159feeb1bf44c9a631a);$v68e77c9c4d583159feeb1bf44c9a631a += 1;}if (defined('LIBXML_DOTTED_VERSION')) {$this->assert(version_compare(LIBXML_DOTTED_VERSION, '2.9.4', '<='), 13091);}}private function testPermissions() {$this->assert(is_writable(__DIR__), 13010);}private function testSession() {if (!$this->domain) {return;}if (defined('INSTALLER_CURRENT_WORKING_DIR')) {$v4bf89b84cd55006e8ee03f47801ec7af = INSTALLER_CURRENT_WORKING_DIR;}else {$v4bf89b84cd55006e8ee03f47801ec7af = CURRENT_WORKING_DIR;}file_put_contents($v4bf89b84cd55006e8ee03f47801ec7af . '/umi_smt.php', '<?php
				@session_start();
				$_SESSION["test"] = "test";
				$sessionId = session_id();
				@session_write_close();
				unset($_SESSION["test"]);
				@session_id($sessionId);
				@session_start();
				echo($_SESSION["test"]);');if (defined('PHP_FILES_ACCESS_MODE')) {chmod($v4bf89b84cd55006e8ee03f47801ec7af . '/umi_smt.php', PHP_FILES_ACCESS_MODE);}else {$v15d61712450a686a7f365adf4fef581f = mb_substr(decoct(fileperms(__FILE__)), -4, 4);chmod($v4bf89b84cd55006e8ee03f47801ec7af . '/umi_smt.php', octdec($v15d61712450a686a7f365adf4fef581f));}$v19e03fd9d22ec02340b6c0a1e3ffacc7 = $this->getProtocol() . '://' . $this->domain . '/umi_smt.php';$vd88fc6edf21ea464d35ff76288b84103 = curl_init();curl_setopt($vd88fc6edf21ea464d35ff76288b84103, CURLOPT_URL, $v19e03fd9d22ec02340b6c0a1e3ffacc7);curl_setopt($vd88fc6edf21ea464d35ff76288b84103, CURLOPT_HEADER, 0);curl_setopt($vd88fc6edf21ea464d35ff76288b84103, CURLOPT_RETURNTRANSFER, 1);$result = curl_exec($vd88fc6edf21ea464d35ff76288b84103);if ($result !== false) {$this->assert($result == 'test', 13083);}unlink($v4bf89b84cd55006e8ee03f47801ec7af . '/umi_smt.php');}private function getProtocol() {if (function_exists('getServerProtocol')) {return getServerProtocol();}if ($this->isHttps()) {return 'https';}return 'http';}private function isHttps() {if (isset($_SERVER['HTTPS']) && in_array($_SERVER['HTTPS'], array('on', 1))) {return true;}if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {return true;}if (isset($_SERVER['SERVER_PROTOCOL']) && mb_strtolower(mb_substr($_SERVER['SERVER_PROTOCOL'], 0, 5)) == 'https') {return true;}return false;}private function testConnect() {if (!extension_loaded('mysqli')) {return;}$this->link = mysqli_init();mysqli_real_connect($this->link, $this->host, $this->user, $this->password, $this->database);$this->assert((bool) $this->link, 13011);if (!$this->link) {return;}$this->checkMysqlVersion();$this->checkBasicDatabaseQueries();$this->checkInnoDbSupport();}private function checkMysqlVersion() {$v17569e8ba32971d8bf01ca2706bdeaf2 = mysqli_get_server_version($this->link);if ($v17569e8ba32971d8bf01ca2706bdeaf2) {$this->assert(version_compare($v17569e8ba32971d8bf01ca2706bdeaf2, '40100', '>='), 13071);}else {$this->assert(false, 13070);}}private function checkBasicDatabaseQueries() {$v07cc694b9b3fc636710fa08b6922c42b = time();$this->assertQuery("create table `test{$v07cc694b9b3fc636710fa08b6922c42b}` (a int not null auto_increment, primary key (a))", 13013);$this->assertQuery("create temporary table `temporary_table{$v07cc694b9b3fc636710fa08b6922c42b}` like `test{$v07cc694b9b3fc636710fa08b6922c42b}`", 13048);$this->query("drop temporary table `temporary_table{$v07cc694b9b3fc636710fa08b6922c42b}`");$this->assertQuery("alter table `test{$v07cc694b9b3fc636710fa08b6922c42b}` ADD b int(7) NULL", 13014);$this->assertQuery("insert into `test{$v07cc694b9b3fc636710fa08b6922c42b}` (b) values (11)", 13043);$this->assertQuery("select * from `test{$v07cc694b9b3fc636710fa08b6922c42b}`", 13044);$this->assertQuery("update `test{$v07cc694b9b3fc636710fa08b6922c42b}` set b=12 where b=11", 13045);$this->assertQuery("delete from `test{$v07cc694b9b3fc636710fa08b6922c42b}`", 13046);$this->assertQuery('SET foreign_key_checks = 1', 13047);$this->assertQuery("drop table `test{$v07cc694b9b3fc636710fa08b6922c42b}`", 13015);}private function assertQuery($vac5c74b64b4b8352ef2f181affb5ac2a, $v0279985cdca9ad2836b5dc949af215c8) {return $this->assert($this->query($vac5c74b64b4b8352ef2f181affb5ac2a), $v0279985cdca9ad2836b5dc949af215c8);}private function query($vac5c74b64b4b8352ef2f181affb5ac2a) {return mysqli_query($this->link, $vac5c74b64b4b8352ef2f181affb5ac2a);}private function checkInnoDbSupport() {$v6208c126754346fefd9c9778602b1cc9 = false;$result = $this->query("SHOW VARIABLES LIKE 'have_innodb'");if (mysqli_num_rows($result) > 0) {$vf1965a857bc285d26fe22023aa5ab50d = mysqli_fetch_array($result);if (mb_strtolower($vf1965a857bc285d26fe22023aa5ab50d['Value']) == 'yes') {$v6208c126754346fefd9c9778602b1cc9 = true;}}else {$result = $this->query('SHOW ENGINES');if (mysqli_num_rows($result) > 0) {while ($vf1965a857bc285d26fe22023aa5ab50d = mysqli_fetch_assoc($result)) {if (mb_strtolower($vf1965a857bc285d26fe22023aa5ab50d['Engine']) == 'innodb' &&       in_array(mb_strtolower($vf1965a857bc285d26fe22023aa5ab50d['Support']), array('yes', 'default'))      ) {$v6208c126754346fefd9c9778602b1cc9 = true;break;}}}}$this->assert($v6208c126754346fefd9c9778602b1cc9, 13016);}}