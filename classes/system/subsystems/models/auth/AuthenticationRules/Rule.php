<?php
 namespace UmiCms\System\Auth\AuthenticationRules;use UmiCms\System\Selector\iFactory as SelectorFactory;use UmiCms\System\Auth\PasswordHash\iAlgorithm;abstract class Rule implements iRule {protected $hashAlgorithm;protected $selectorFactory;abstract public function validate();protected function getSelectorFactory() {return $this->selectorFactory;}protected function getQueryBuilder() {$v7e5aadfde0b0d3a8a9e841ac0d976572 = $this->getSelectorFactory()    ->createObjectTypeName('users', 'user');$v7e5aadfde0b0d3a8a9e841ac0d976572->option('return')->value('id');$v7e5aadfde0b0d3a8a9e841ac0d976572->option('no-length')->value(true);return $v7e5aadfde0b0d3a8a9e841ac0d976572;}}