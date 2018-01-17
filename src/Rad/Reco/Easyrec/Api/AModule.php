<?php

/*
 * The MIT License
 *
 * Copyright 2017 guillaume.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace Rad\Reco\Easyrec\Api;

use Rad\Reco\Easyrec\Request\ApiRequest;

/**
 * Description of AModule
 *
 * @author guillaume
 */
abstract class AModule {

    /**
     *
     * @var ApiRequest
     */
    private $request;

    public function __construct(ApiRequest $request) {
        $this->request = $request;
    }

    protected function getRequest($action, $datas) {
        return $this->request->getRequest($action, $datas);
    }

    protected function postRequest($action, $datas) {
        return $this->request->postRequest($action, $datas);
    }

    protected function getToken() {
        return $this->request->getToken();
    }

    protected function getAcceptedType() {
        return $this->request->getAcceptedType();
    }

}
