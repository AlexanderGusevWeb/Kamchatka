<?php
 class ymlSplitter extends umiImportSplitter {private $doc;protected function prepareData() {$v4b43b0aee35624cd95b910189b3dc231 = $this->reader;$v9a09b4dfda82e3e665e31092d1c3ec8d = new DomDocument;$v5118e2d6cb8d101c16049b9cf18de377 = $v9a09b4dfda82e3e665e31092d1c3ec8d->createElement('yml_catalog');$v9a09b4dfda82e3e665e31092d1c3ec8d->appendChild($v5118e2d6cb8d101c16049b9cf18de377);$v63a9f0ea7bb98050796b649e85481845 = $v9a09b4dfda82e3e665e31092d1c3ec8d->createElement('shop');$v5118e2d6cb8d101c16049b9cf18de377->appendChild($v63a9f0ea7bb98050796b649e85481845);$v7a86c157ee9713c34fbd7a1ee40f0c5a = $this->offset;while ($v4b43b0aee35624cd95b910189b3dc231->read() && $v4b43b0aee35624cd95b910189b3dc231->name != 'categories') {if ($v4b43b0aee35624cd95b910189b3dc231->nodeType != XMLReader::ELEMENT) {continue;}if ($v4b43b0aee35624cd95b910189b3dc231->name == 'yml_catalog' || $v4b43b0aee35624cd95b910189b3dc231->name == 'shop') {continue;}$v8e2dcfd7e7e24b1ca76c1193f645902b = $v4b43b0aee35624cd95b910189b3dc231->expand();$v63a9f0ea7bb98050796b649e85481845->appendChild($v8e2dcfd7e7e24b1ca76c1193f645902b);}$v4757fe07fd492a8be0ea6a760d683d6e = 0;while ($v4b43b0aee35624cd95b910189b3dc231->read() && $v4757fe07fd492a8be0ea6a760d683d6e < $v7a86c157ee9713c34fbd7a1ee40f0c5a) {if ($v4b43b0aee35624cd95b910189b3dc231->nodeType != XMLReader::ELEMENT) {continue;}if ($v4b43b0aee35624cd95b910189b3dc231->name == 'category' || $v4b43b0aee35624cd95b910189b3dc231->name == 'offer') {$v4757fe07fd492a8be0ea6a760d683d6e++;}}$this->offset += $v4757fe07fd492a8be0ea6a760d683d6e;$this->doc = $v9a09b4dfda82e3e665e31092d1c3ec8d;}protected function readDataBlock() {$v4b43b0aee35624cd95b910189b3dc231 = $this->reader;$v9a09b4dfda82e3e665e31092d1c3ec8d = clone $this->doc;$vb005ad12944422688084f19bf5e19729 = $this->block_size;$v441e86bd8d1175501e5d30a0f40e6c89 = $v9a09b4dfda82e3e665e31092d1c3ec8d->getElementsByTagName('shop');if (!$v441e86bd8d1175501e5d30a0f40e6c89->length) {throw new coreException('Data container not found in default document.');}$vdb6687dec5c316c304d51734f40867fd = $v441e86bd8d1175501e5d30a0f40e6c89->item(0);$vb0b5ccb4a195a07fd3eed14affb8695f = $v9a09b4dfda82e3e665e31092d1c3ec8d->createElement('categories');$vb2bf18e206cf9b5eb2d632030acb16cc = $v9a09b4dfda82e3e665e31092d1c3ec8d->createElement('offers');$v4757fe07fd492a8be0ea6a760d683d6e = 0;while ($v4b43b0aee35624cd95b910189b3dc231->read() && $v4757fe07fd492a8be0ea6a760d683d6e < $vb005ad12944422688084f19bf5e19729) {if ($v4b43b0aee35624cd95b910189b3dc231->nodeType != XMLReader::ELEMENT) {continue;}if ($v4b43b0aee35624cd95b910189b3dc231->name == 'category' || $v4b43b0aee35624cd95b910189b3dc231->name == 'offer') {$v4757fe07fd492a8be0ea6a760d683d6e++;}if ($v4b43b0aee35624cd95b910189b3dc231->name == 'category') {$vb0b5ccb4a195a07fd3eed14affb8695f->appendChild($v4b43b0aee35624cd95b910189b3dc231->expand());}if ($v4b43b0aee35624cd95b910189b3dc231->name == 'offer') {$vb2bf18e206cf9b5eb2d632030acb16cc->appendChild($v4b43b0aee35624cd95b910189b3dc231->expand());}}$this->offset += $v4757fe07fd492a8be0ea6a760d683d6e;if (!$vb0b5ccb4a195a07fd3eed14affb8695f->hasChildNodes() && !$vb2bf18e206cf9b5eb2d632030acb16cc->hasChildNodes()) {return false;}$vdb6687dec5c316c304d51734f40867fd->appendChild($vb0b5ccb4a195a07fd3eed14affb8695f);$vdb6687dec5c316c304d51734f40867fd->appendChild($vb2bf18e206cf9b5eb2d632030acb16cc);return $v9a09b4dfda82e3e665e31092d1c3ec8d;}}