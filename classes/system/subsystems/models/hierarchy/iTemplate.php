<?php
 interface iTemplate extends iUmiEntinty {public function getName();public function getFilename();public function getResourcesDirectory($v64feae0988f5b61c96c305e3c3f04551 = false);public function getTemplatesDirectory();public function getFilePath();public function getType();public function getTitle();public function getDomainId();public function getLangId();public function getIsDefault();public function setName($vb068931cc450442b63f5b3d276ea4297);public function setFilename($v435ed7e9f07f740abf511a62c00eef6e);public function setTitle($vd5d3db1765287eef77d7927cc956f50a);public function setType($v599dcce2998a6b40b1e38e8c6006cb0a);public function setDomainId($v72ee76c5c29383b7c9f9225c1fa4d10b);public function setLangId($vf585b7f018bb4ced15a03683a733e50b);public function setIsDefault($ve558e63f3083922542d8745224a66eea);public function getFileExtension();public function getConfigPath();public function getUsedPages($vaa9f73eea60a006820d0f8768bc8a3fc = 0, $v7a86c157ee9713c34fbd7a1ee40f0c5a = 0);public function getTotalUsedPages();public function getRelatedPages($vaa9f73eea60a006820d0f8768bc8a3fc = 0, $v7a86c157ee9713c34fbd7a1ee40f0c5a = 0);public function setUsedPages($vb3b32a2d422265cd25c3323ed0157f81);}