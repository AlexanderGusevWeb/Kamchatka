<?php
namespace UmiCms\System\Permissions;class SystemUsersPermissions implements iSystemUsersPermissions {private $umiObjects;public function __construct(\iUmiObjectsCollection $v22df6b77ddb3d4a444fba472a24b327d) {$this->umiObjects = $v22df6b77ddb3d4a444fba472a24b327d;}public function getSvUserId() {return (int) $this->getUmiObjects()   ->getObjectIdByGUID(self::SV_USER_GUID);}public function getSvGroupId() {return (int) $this->getUmiObjects()   ->getObjectIdByGUID(self::SV_GROUP_GUID);}public function getGuestUserId() {return (int) $this->getUmiObjects()   ->getObjectIdByGUID(self::GUEST_USER_GUID);}public function getRegisteredGroupId() {return (int) $this->getUmiObjects()   ->getObjectIdByGUID(self::REGISTERED_GROUP_GUID);}public function getIdList() {return [   $this->getSvUserId(),   $this->getSvGroupId(),   $this->getGuestUserId(),   $this->getRegisteredGroupId(),  ];}private function getUmiObjects() {return $this->umiObjects;}}