<?php
 interface iUmiObject extends iUmiEntinty {public function getName($vf2e8a978f868dbada56963ee2baf4d4b = false);public function setName($vb068931cc450442b63f5b3d276ea4297);public function setTypeId($v5f694956811487225d15e973ca38fbab);public function getTypeId();public function getIsLocked();public function setIsLocked($v73b8754d45983f35756b157ea439de8c);public function getOwnerId();public function setOwnerId($vb0ab4f7791b60b1e8ea01057b77873b0);public function getGUID();public function setGUID($v1e0ca5b1252f1f6b1e0ac91be7e7219e);public function getXlink();public function getUpdateTime();public function setUpdateTime($v5fa40b2485d1096a170d2d7ecd0f7030);public function getOrder();public function setOrder($v70a17ffa722a3985b86d30b034ad06d7);public function setIsUpdated($v8de61324edc43f3acb1b73da3c63e89e = true);public function getTypeGUID();public function getType();public function isFilled();public function getPropByName($vb068931cc450442b63f5b3d276ea4297);public function getPropById($vb80bb7740288fda1f201890375a60c8f);public function isPropertyExists($vb80bb7740288fda1f201890375a60c8f);public function isPropertyNameExist($vb068931cc450442b63f5b3d276ea4297);public function isPropGroupExists($vb80bb7740288fda1f201890375a60c8f);public function getPropGroupId($vb068931cc450442b63f5b3d276ea4297);public function getPropGroupByName($vb068931cc450442b63f5b3d276ea4297);public function getPropGroupById($vb80bb7740288fda1f201890375a60c8f);public function getValue($vb068931cc450442b63f5b3d276ea4297, $v21ffce5b8a6cc8cc6a41448dd69623c9 = null);public function getValueById($v945100186b119048837b9859c2c46410, $v21ffce5b8a6cc8cc6a41448dd69623c9 = null);public function setValue($vb068931cc450442b63f5b3d276ea4297, $v2063c1608d6e0baf80249c42e2be5804);public function delete();public function getModule();public function getMethod();public function loadFields();}