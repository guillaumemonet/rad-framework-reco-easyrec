<?php

namespace Rad\Reco;

use Rad\Service\Service;

/**
 * Description of Database.
 * @author Guillaume MonetI
 */
final class Reco extends Service {

    public static function addHandler(string $handlerType, $handler) {
        static::getInstance()->addServiceHandler($handlerType, $handler);
    }

    public static function getHandler(string $handlerType = null): RecoInterface {
        return static::getInstance()->getServiceHandler($handlerType);
    }

    protected function getServiceType(): string {
        return 'reco';
    }

}
