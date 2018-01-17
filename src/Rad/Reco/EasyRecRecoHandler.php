<?php

namespace Rad\Reco;

use Rad\Reco\Easyrec\EasyRec;

class EasyRecRecoHandler implements RecoInterface {

    public function getRecoEngine() {
        return EasyRec::getHandle();
    }

}
