<?php
 namespace UmiCms\System\Cache\Browser;use UmiCms\System\Response\iFacade as iResponse;use UmiCms\System\Request\iFacade as iRequest;interface iEngine {public function __construct(iRequest $v10573b873d2fa5a365d558a45e328e47, iResponse $vd1fc8eaf36937be0c3ba8cfe0a2c1bfe, \iConfiguration $vccd1066343c95877b75b79d47c36bebe);public function process();}