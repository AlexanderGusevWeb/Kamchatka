<?php
namespace UmiCms\Libs;class AutoloadMapLoader {private $map = [];public function getMap() {return $this->map;}public function fromFile($v47826cacc65c665212b821e6ff80b9b0) {if ( !file_exists($v47826cacc65c665212b821e6ff80b9b0) ) {return $this;}$ve0bda8197e58839fe38b56adbfec55ff = [];require $v47826cacc65c665212b821e6ff80b9b0;$this->map = array_merge($this->map, $ve0bda8197e58839fe38b56adbfec55ff);return $this;}public function fromConfig(\iConfiguration $v2245023265ae4cf87d02c8b6ba991139, $v73d5342eba070f636ac3246f319bf77f = 'autoload') {$vff53f50391920baa48eb3b1006be93be = $v2245023265ae4cf87d02c8b6ba991139->getList($v73d5342eba070f636ac3246f319bf77f);if ( !is_array($vff53f50391920baa48eb3b1006be93be) || count($vff53f50391920baa48eb3b1006be93be) === 0 ) {return $this;}$result = [];foreach ($vff53f50391920baa48eb3b1006be93be as $va2f2ed4f8ebc2cbb4c21a29dc40ab61d) {$vf595d4c971339549e44e99ace240cf42 = $v2245023265ae4cf87d02c8b6ba991139->get($v73d5342eba070f636ac3246f319bf77f, $va2f2ed4f8ebc2cbb4c21a29dc40ab61d);if ( is_array($vf595d4c971339549e44e99ace240cf42) && count($vf595d4c971339549e44e99ace240cf42) > 0) {$vf595d4c971339549e44e99ace240cf42 = array_map([$this, 'getAbsolutePath'], $vf595d4c971339549e44e99ace240cf42);$result[$va2f2ed4f8ebc2cbb4c21a29dc40ab61d] = $vf595d4c971339549e44e99ace240cf42;}}$this->map = array_merge($this->map, $result);return $this;}private function getAbsolutePath($v47826cacc65c665212b821e6ff80b9b0) {return preg_replace('/^~/', CURRENT_WORKING_DIR, $v47826cacc65c665212b821e6ff80b9b0);}}