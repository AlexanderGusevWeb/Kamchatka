<?php
 namespace UmiCms\Classes\System\Translators;class TranslatorFactory {const JSON = 'jsonTranslator';const XML = 'xmlTranslator';const PHP = 'UmiCms\Classes\System\Translators\PhpTranslator';public static function create($va2f2ed4f8ebc2cbb4c21a29dc40ab61d) {if ( !class_exists($va2f2ed4f8ebc2cbb4c21a29dc40ab61d) ) {throw new \ErrorException( sprintf('Translator class %s does not exist', $va2f2ed4f8ebc2cbb4c21a29dc40ab61d) );}return self::createInstance($va2f2ed4f8ebc2cbb4c21a29dc40ab61d);}private static function createInstance($va2f2ed4f8ebc2cbb4c21a29dc40ab61d) {return new $va2f2ed4f8ebc2cbb4c21a29dc40ab61d();}}