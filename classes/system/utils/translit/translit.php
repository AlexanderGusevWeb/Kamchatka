<?php
 class translit implements iTranslit {public static $fromUpper = ['Э', 'Ч', 'Ш', 'Ё', 'Ё', 'Ж', 'Ю', 'Ю', 'Я', 'Я', 'А', 'Б', 'В', 'Г', 'Д', 'Е', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Щ', 'Ъ', 'Ы', 'Ь'];public static $fromLower = ['э', 'ч', 'ш', 'ё', 'ё', 'ж', 'ю', 'ю', 'я', 'я', 'а', 'б', 'в', 'г', 'д', 'е', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'щ', 'ъ', 'ы', 'ь'];public static $toLower = ['e', 'ch', 'sh', 'yo', 'jo', 'zh', 'yu', 'ju', 'ya', 'ja', 'a', 'b', 'v', 'g', 'd', 'e', 'z', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'w', '~', 'y', "\'"];public static function convert($v341be97d9aff90c9978347f66f945b77, $va0f0bc95016c862498bbad29d1f4d9d4 = '_') {$va0f0bc95016c862498bbad29d1f4d9d4 = $va0f0bc95016c862498bbad29d1f4d9d4 ? addcslashes($va0f0bc95016c862498bbad29d1f4d9d4, ']/\$') : '_';$v341be97d9aff90c9978347f66f945b77 = umiObjectProperty::filterInputString($v341be97d9aff90c9978347f66f945b77);$v341be97d9aff90c9978347f66f945b77 = str_replace(self::$fromLower, self::$toLower, $v341be97d9aff90c9978347f66f945b77);$v341be97d9aff90c9978347f66f945b77 = str_replace(self::$fromUpper, self::$toLower, $v341be97d9aff90c9978347f66f945b77);$v341be97d9aff90c9978347f66f945b77 = mb_strtolower($v341be97d9aff90c9978347f66f945b77);$v341be97d9aff90c9978347f66f945b77 = preg_replace("/([^A-z0-9_\-]+)/", $va0f0bc95016c862498bbad29d1f4d9d4, $v341be97d9aff90c9978347f66f945b77);$v341be97d9aff90c9978347f66f945b77 = preg_replace("/[\/\\\',\t`\^\[\]]*/", '', $v341be97d9aff90c9978347f66f945b77);$v341be97d9aff90c9978347f66f945b77 = str_replace(chr(8470), '', $v341be97d9aff90c9978347f66f945b77);$v341be97d9aff90c9978347f66f945b77 = preg_replace("/[ \.]+/", $va0f0bc95016c862498bbad29d1f4d9d4, $v341be97d9aff90c9978347f66f945b77);$v341be97d9aff90c9978347f66f945b77 = preg_replace('/([' . $va0f0bc95016c862498bbad29d1f4d9d4 . ']+)/', $va0f0bc95016c862498bbad29d1f4d9d4, $v341be97d9aff90c9978347f66f945b77);$v341be97d9aff90c9978347f66f945b77 = trim(trim($v341be97d9aff90c9978347f66f945b77), $va0f0bc95016c862498bbad29d1f4d9d4);return $v341be97d9aff90c9978347f66f945b77;}}