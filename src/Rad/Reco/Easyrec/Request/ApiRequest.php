<?php

namespace Rad\Reco\Easyrec\Request;

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

/**
 * Description of ApiRequest
 *
 * @author guillaume
 */
class ApiRequest {

    private $userid;
    private $sessionid;
    private $apikey;
    private $tenantid;
    private $host;
    private $request_url;
    private $login;
    private $password;
    private $accepted_type = "";

    public function __construct($host, $request_url, $tenantid, $apikey, $sessionid = null, $userid = null, $login = null, $password = null, $accepted_type = "xml") {
        $this->host = $host;
        $this->request_url = $request_url;
        $this->tenantid = $tenantid;
        $this->apikey = $apikey;
        $this->sessionid = $sessionid;
        $this->userid = $userid;
        $this->login = $login;
        $this->password = $password;
        if ($accepted_type != "xml") {
            $this->accepted_type = $accepted_type;
        }
    }

    public function getRequest($action, array $datas) {
        $get_params["apikey"] = "" . $this->apikey;
        $get_params["tenantid"] = "" . $this->tenantid;
        $get_params["userid"] = $this->userid;
        $get_params["sessionid"] = $this->sessionid;
        $get_params = array_merge($get_params, $datas);
        $get_params = array_filter($get_params, function($value) {
            return $value !== null && $value !== "";
        });
        $url = $this->host . $this->request_url . "/" . ($this->accepted_type ? $this->accepted_type . "/" : "") . $action . "?" . http_build_query($get_params);
        $ret = file_get_contents($url);
        return $ret;
    }

    public function postRequest($action, array $datas) {
        $postdata["apikey"] = "" . $this->apikey;
        $postdata["tenantid"] = "" . $this->tenantid;
        $postdata["userid"] = $this->userid;
        $postdata["sessionid"] = $this->sessionid;
        $postdata = array_merge($postdata, $datas);
        $postdata = array_filter($postdata, function($value) {
            return $value !== null && $value !== "";
        });
        $opts = array('http' =>
            array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => http_build_query($postdata)
            )
        );

        $context = stream_context_create($opts);
        $url = $this->host . $this->request_url . "/" . ($this->accepted_type ? $this->accepted_type . "/" : "") . $action;
        return file_get_contents($url, false, $context);
    }

    /**
     * 
     * @return string
     */
    public function getToken() {
        $get_params["operatorId"] = $this->login;
        $get_params["password"] = $this->password;
        $rec = new SimpleXMLElement(file_get_contents($this->host . "/operator/signin?" . http_build_query($get_params)));
        return "" . $rec->token;
    }

    public function getAcceptedType() {
        return $this->accepted_type;
    }

}
