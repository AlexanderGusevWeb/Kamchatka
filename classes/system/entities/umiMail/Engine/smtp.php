<?php
 namespace UmiCms\Mail\Engine;use UmiCms\Mail;use PHPMailer\PHPMailer;class smtp extends Mail\Engine {private $config;private $mailer;private $logger;const SECTION = 'mail';const TIMEOUT = 'smtp.timeout';const USE_VERP = 'smtp.use-verp';const HOST = 'smtp.host';const PORT = 'smtp.port';const ENCRYPTION = 'smtp.encryption';const AUTH = 'smtp.auth';const USER = 'smtp.user-name';const PASSWORD = 'smtp.password';const DEBUG = 'smtp.debug';public function __construct($v2245023265ae4cf87d02c8b6ba991139 = null) {if ($v2245023265ae4cf87d02c8b6ba991139 instanceof \iConfiguration) {$this->config = $v2245023265ae4cf87d02c8b6ba991139;}else {$this->config = \mainConfiguration::getInstance();}$this->initLogger()    ->initMailer();}public function send($v884d9804999fc47a3c2694e49ad2536a) {$v7b334b7260361141659fa9862e803476 = $this->getTransport();if (!$v7b334b7260361141659fa9862e803476 instanceof PHPMailer\SMTP) {return $this->handleError('Подключение не было инициализировано');}if (!$v7b334b7260361141659fa9862e803476->connected()) {return $this->handleError('Подключение по smtp неактивно');}if (!$this->validateSender($v7b334b7260361141659fa9862e803476)) {return $this->handleError('Передан некорректный адрес отправителя');}if (!$this->validateRecipient($v7b334b7260361141659fa9862e803476, $v884d9804999fc47a3c2694e49ad2536a)) {return $this->handleError('Не задано ни одного корректного получателя письма');}$v78e731027d8fd50ed642340b7c9a63b3 = $this->buildMessage($v884d9804999fc47a3c2694e49ad2536a);if (!$v7b334b7260361141659fa9862e803476->data($v78e731027d8fd50ed642340b7c9a63b3)) {return $this->handleError('Не удалось отправить сообщение');}$v7b334b7260361141659fa9862e803476->reset();return true;}public function log($v78e731027d8fd50ed642340b7c9a63b3, $vc9e9a848920877e76685b2e4e76de38d = null) {if (!is_string($v78e731027d8fd50ed642340b7c9a63b3) || empty($v78e731027d8fd50ed642340b7c9a63b3)) {return $this;}$v6db435f352d7ea4a67807a3feb447bf7 = $this->getLogger();$v6db435f352d7ea4a67807a3feb447bf7->log($v78e731027d8fd50ed642340b7c9a63b3);$v6db435f352d7ea4a67807a3feb447bf7->save();return $this;}public function __destruct() {$v7b334b7260361141659fa9862e803476 = $this->getTransport();if ($v7b334b7260361141659fa9862e803476 instanceof PHPMailer\SMTP) {$this->closeConnection($v7b334b7260361141659fa9862e803476);}}protected function validateSender(PHPMailer\SMTP $v7b334b7260361141659fa9862e803476) {$ved75f24799bbec4542c837761a06fa6a = $this->getAddressFromHeader($this->getHeaders());return (bool) $v7b334b7260361141659fa9862e803476->mail($ved75f24799bbec4542c837761a06fa6a);}protected function validateRecipient(PHPMailer\SMTP $v7b334b7260361141659fa9862e803476, $v884d9804999fc47a3c2694e49ad2536a) {$v418b588eceec11addf965cf80bc393f1 = $this->getRecipientList($v884d9804999fc47a3c2694e49ad2536a);foreach ($v418b588eceec11addf965cf80bc393f1 as $v3c6e0b8a9c15224a8228b9a98ca1531d => $vd6e41fc5d1bcfead1db3b6dc05774971) {if (!is_string($vd6e41fc5d1bcfead1db3b6dc05774971) || !$v7b334b7260361141659fa9862e803476->recipient($vd6e41fc5d1bcfead1db3b6dc05774971)) {unset($v418b588eceec11addf965cf80bc393f1[$v3c6e0b8a9c15224a8228b9a98ca1531d]);}}if (empty($v418b588eceec11addf965cf80bc393f1)) {return false;}return true;}protected function closeConnection(PHPMailer\SMTP $v7b334b7260361141659fa9862e803476) {$v7b334b7260361141659fa9862e803476->quit();$v7b334b7260361141659fa9862e803476->close();}protected function getRecipientList($v884d9804999fc47a3c2694e49ad2536a) {$v418b588eceec11addf965cf80bc393f1 = array_merge(    (array) $this->getAddressFromHeader($v884d9804999fc47a3c2694e49ad2536a),    $this->getAddressListFromHeaderString('/Cc: .+\s/'), $this->getAddressListFromHeaderString('/Bcc: .+\s/') );return array_unique($v418b588eceec11addf965cf80bc393f1);}protected function getAddressListFromHeaderString($v240bf022e685b0ee30ad9fe9e1fb5d5b) {$v735e9b7af110bccc360f8868b58bafb4 = [];preg_match($v240bf022e685b0ee30ad9fe9e1fb5d5b, $this->getHeaders(), $v9c28d32df234037773be184dbdafc274);if (!isset($v9c28d32df234037773be184dbdafc274[0])) {return $v735e9b7af110bccc360f8868b58bafb4;}$vd59ad6a1d472470730d908b6c7d1e984 = explode(',', $v9c28d32df234037773be184dbdafc274[0]);foreach ($vd59ad6a1d472470730d908b6c7d1e984 as $v20da62d10b1da3a315b8bd2aa6fb7ac8) {$v884d9804999fc47a3c2694e49ad2536a = $this->getAddressFromHeader($v20da62d10b1da3a315b8bd2aa6fb7ac8);if ($v884d9804999fc47a3c2694e49ad2536a === null) {continue;}$v735e9b7af110bccc360f8868b58bafb4[] = $v884d9804999fc47a3c2694e49ad2536a;}return $v735e9b7af110bccc360f8868b58bafb4;}protected function getAddressFromHeader($v099fb995346f31c749f6e40db0f395e3) {if (contains($v099fb995346f31c749f6e40db0f395e3, '<')) {preg_match('/<(.*)>/', $v099fb995346f31c749f6e40db0f395e3, $v9c28d32df234037773be184dbdafc274);return isset($v9c28d32df234037773be184dbdafc274[1]) ? $v9c28d32df234037773be184dbdafc274[1] : null;}return $v099fb995346f31c749f6e40db0f395e3;}protected function buildMessage($v884d9804999fc47a3c2694e49ad2536a) {$v4340fd73e75df7a9d9e45902a59ba3a4 = $this->getHeaders() .    $this->buildHeader('To', $v884d9804999fc47a3c2694e49ad2536a) .    $this->buildHeader('Subject', $this->getSubject());return $v4340fd73e75df7a9d9e45902a59ba3a4 . "\r\n" . $this->getMessage();}protected function buildHeader($vb068931cc450442b63f5b3d276ea4297, $v2063c1608d6e0baf80249c42e2be5804) {return "$vb068931cc450442b63f5b3d276ea4297: $v2063c1608d6e0baf80249c42e2be5804" . "\r\n";}protected function initMailer() {$v13c32afe6424995205a83c8fe16f61b2 = $this->isDebugEnabled();$v99bb411b44b7a1084ac25aaf1169fb8e = new PHPMailer\PHPMailer($v13c32afe6424995205a83c8fe16f61b2);$v99bb411b44b7a1084ac25aaf1169fb8e->SMTPDebug = $this->getDebugLevel();$v99bb411b44b7a1084ac25aaf1169fb8e->Debugoutput = [$this, 'log'];$v99bb411b44b7a1084ac25aaf1169fb8e->Host = $this->getHost();$v99bb411b44b7a1084ac25aaf1169fb8e->Port = $this->getPort();$v99bb411b44b7a1084ac25aaf1169fb8e->Timeout = $this->getTimeout();$v99bb411b44b7a1084ac25aaf1169fb8e->do_verp = $this->needToUseDoVerp();if ($this->isAuthRequired()) {$v99bb411b44b7a1084ac25aaf1169fb8e->SMTPAuth = true;$v99bb411b44b7a1084ac25aaf1169fb8e->Username = $this->getUserName();$v99bb411b44b7a1084ac25aaf1169fb8e->Password = $this->getPassword();}if ($this->isAutoEncryption()) {$v99bb411b44b7a1084ac25aaf1169fb8e->SMTPAutoTLS = true;}else {$v99bb411b44b7a1084ac25aaf1169fb8e->SMTPSecure = $this->getEncryption();}if (!$v99bb411b44b7a1084ac25aaf1169fb8e->smtpConnect()) {return $this->handleError('Не удалось произвести подключение по smtp');}$this->mailer = $v99bb411b44b7a1084ac25aaf1169fb8e;return $this;}protected function handleError($v78e731027d8fd50ed642340b7c9a63b3) {if ($this->isDebugEnabled()) {throw new \Exception($v78e731027d8fd50ed642340b7c9a63b3);}try {$this->log($v78e731027d8fd50ed642340b7c9a63b3);}catch (\Exception $v42552b1f133f9f8eb406d4f306ea9fd1) {}return false;}protected function initLogger() {$v5f8f22b8cdbaeee8cf857673a9b6ba20 = new \umiDirectory($this->getLogDirectoryPath());if ($v5f8f22b8cdbaeee8cf857673a9b6ba20->getIsBroken()) {$v5f8f22b8cdbaeee8cf857673a9b6ba20::requireFolder($v5f8f22b8cdbaeee8cf857673a9b6ba20->getPath());}$this->logger = new \umiLogger($v5f8f22b8cdbaeee8cf857673a9b6ba20->getPath());return $this;}protected function getLogger() {return $this->logger;}protected function getTransport() {return ($this->mailer instanceof PHPMailer\PHPMailer) ?  $this->mailer->getSMTPInstance() : null;}protected function getHost() {return (string) $this->config->get(self::SECTION, self::HOST);}protected function getPort() {return (int) $this->config->get(self::SECTION, self::PORT);}protected function getTimeout() {return (int) $this->config->get(self::SECTION, self::TIMEOUT);}protected function isAuthRequired() {return (bool) $this->config->get(self::SECTION, self::AUTH);}protected function getUserName() {return (string) $this->config->get(self::SECTION, self::USER);}protected function getPassword() {return (string) $this->config->get(self::SECTION, self::PASSWORD);}protected function isDebugEnabled() {return (bool) $this->config->get(self::SECTION, self::DEBUG);}protected function isAutoEncryption() {return $this->getEncryption() == 'auto';}protected function getEncryption() {return (string) $this->config->get(self::SECTION, self::ENCRYPTION);}protected function needToUseDoVerp() {return (bool) $this->config->get(self::SECTION, self::USE_VERP);}protected function getDebugLevel() {return $this->isDebugEnabled() ? PHPMailer\SMTP::DEBUG_LOWLEVEL : PHPMailer\SMTP::DEBUG_OFF;}protected function getLogDirectoryPath() {return $this->config->includeParam('sys-log-path') . '/smtp/';}}