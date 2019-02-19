<?php

/** Класс пользовательских макросов */
class ContentCustomMacros
{
    /** @var content $module */
    public $module;

    /**
     * Рекурсивыный поиск фалй по директории
     */
    public function parseDir_file($directory, $needle_file = '', $includePath = false, $recurce = false)
    {
        $result = array();

        if (substr($directory, -1) == "/") {
            $directory = substr($directory, 0, -1);
        }

        if (!is_dir($directory)) {
            return array('error' => 'Not found this DIR');
        }

        if ($dh = opendir($directory)) {

            while (($file = readdir($dh)) !== false) {

                if (($file == '.') || ($file == '..')) continue;

                if (trim($needle_file) != '') {

                    if (is_dir($directory . "/" . $file)) {
                        if ($recurce) {
                            $result = array_values(array_merge($result, self::parseDir_file($directory . "/" . $file, $needle_file, $includePath, $recurce)));
                        }
                    } else {
                        if (trim($file) == trim($needle_file)) {
                            array_push($result, ($includePath) ? $directory . "/" . $file : $file);
                        }
                    }
                } else {

                    if (is_dir($directory . "/" . $file)) {
                        if ($recurce) {
                            $result = array_values(array_merge($result, self::parseDir_file($directory . "/" . $file, $needle_file, $includePath, $recurce)));
                        }
                    } else
                        array_push($result, ($includePath) ? $directory . "/" . $file : $file);
                }
            }
        }
        closedir($dh);
        return $result;
    }
}
