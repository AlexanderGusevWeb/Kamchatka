<?php
 namespace UmiCms\Classes\System\Utils\Captcha\Settings;use UmiCms\System\Hierarchy\Domain\iDetector as DomainDetector;use UmiCms\System\Hierarchy\Language\iDetector as LanguageDetector;interface iFactory {public function __construct(   \iConfiguration $vccd1066343c95877b75b79d47c36bebe, \iRegedit $va9205dcfd4a6f7c2cbe8be01566ff84a, DomainDetector $v45651ec82e45766b3d707ee33df1a61a,   LanguageDetector $vf24870e9df244bb77374445d936a6741  );public function getCommonSettings();public function getSiteSettings($v72ee76c5c29383b7c9f9225c1fa4d10b = null, $vf585b7f018bb4ced15a03683a733e50b = null);public function getCurrentSettings($v72ee76c5c29383b7c9f9225c1fa4d10b = null, $vf585b7f018bb4ced15a03683a733e50b = null);}