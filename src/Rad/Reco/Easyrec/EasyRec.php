<?php

namespace Rad\Reco\Easyrec;

use ErrorException;
use Rad\Config\Config;
use Rad\Reco\Easyrec\Api\Action;
use Rad\Reco\Easyrec\Api\AModule;
use Rad\Reco\Easyrec\Api\Recommendation;
use Rad\Reco\Easyrec\Error\EasyrecError;
use Rad\Reco\Easyrec\Log\Log;
use Rad\Reco\Easyrec\Request\ApiRequest;

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

final class EasyRec {

    private $userid;
    private $sessionid;
    private $apikey;
    private $tenantid;
    private $host;
    private $request_url;
    private $login;
    private $password;
    private static $instance = null;
    private $authorized_type = array("json", "xml");
    private $accepted_type = "xml";
    private $modules = array(
        "action" => "Rad\Reco\Easyrec\Api\Action",
        "recommendation" => "Rad\Reco\Easyrec\Api\Recommendation",
        "import" => "Rad\Reco\Easyrec\Api\Import",
        "ranking" => "Rad\Reco\Easyrec\Api\Ranking",
        "profile" => "Rad\Reco\Easyrec\Api\Profile",
        "cluster" => "Rad\Reco\Easyrec\Api\Cluster",
    );

    private function __construct() {
        $config = Config::getServiceConfig("reco", "easyrec")->config;
        $this->setHost($config->host);
        $this->setUrl($config->url);
        $this->setKey($config->key);
        $this->setTenantId($config->tenant_id);
        $this->setOperatorLogin($config->operator_login);
        $this->setOperatorPassword($config->operator_password);
        $this->setAcceptType($config->accept_type);
    }

    /**
     * 
     * @return EasyRec
     */
    public static function getHandle() {
        if (self::$instance === null) {
            self::$instance = new EasyRec();
        }
        return self::$instance;
    }

    /**
     * 
     * @param type $sessionId
     * @return $this
     */
    public function setSessionId($sessionId): self {
        $this->sessionid = $sessionId;
        return $this;
    }

    /**
     * 
     * @param type $userId
     * @return $this
     */
    public function setUserId($userId): self {
        $this->userid = $userId;
        return $this;
    }

    /**
     * 
     * @param type $apiKey
     * @return $this
     */
    public function setKey($apiKey): self {
        $this->apikey = $apiKey;
        return $this;
    }

    /**
     * 
     * @param type $tenantId
     * @return $this
     */
    public function setTenantId($tenantId): self {
        $this->tenantid = $tenantId;
        return $this;
    }

    /**
     * 
     * @param type $url
     * @return $this
     */
    public function setUrl($url): self {
        $this->request_url = $url;
        return $this;
    }

    /**
     * 
     * @param type $host
     * @return $this
     */
    public function setHost($host): self {
        $this->host = $host;
        return $this;
    }

    /**
     * 
     * @param type $login
     * @return $this
     */
    public function setOperatorLogin($login): self {
        $this->login = $login;
        return $this;
    }

    /**
     * 
     * @param type $password
     * @return $this
     */
    public function setOperatorPassword($password): self {
        $this->password = $password;
        return $this;
    }

    public function setAcceptType($type): self {
        if (in_array($type, $this->authorized_type)) {
            $this->accepted_type = $type;
        } else {
            throw new ErrorException("Not an accepted type");
        }
        return $this;
    }

    /**
     * 
     * @return AModule
     */
    public function getModule($module): AModule {
        Log::getLogHandler()->debug("Loading $module");
        $apirequest = new ApiRequest($this->host, $this->request_url, $this->tenantid, $this->apikey, $this->sessionid, $this->userid, $this->login, $this->password, $this->accepted_type);
        return new $this->modules[$module]($apirequest);
    }

    /**
     * 
     * @return Recommendation
     */
    public function getRecommendations(): Recommendation {
        Log::getLogHandler()->debug("Loading Recommendation");
        $apirequest = new ApiRequest($this->host, $this->request_url, $this->tenantid, $this->apikey, $this->sessionid, $this->userid, $this->login, $this->password, $this->accepted_type);
        return new Recommendation($apirequest);
    }

    /**
     * 
     * @return \Rad\Reco\Easyrec\Action
     */
    public function getActions(): Action {
        Log::getLogHandler()->debug("Loading Action");
        $apirequest = new ApiRequest($this->host, $this->request_url, $this->tenantid, $this->apikey, $this->sessionid, $this->userid, $this->login, $this->password, $this->accepted_type);
        return new Action($apirequest);
    }

    /**
     * 
     * @param type $url
     * @return type
     */
    public function backtrackUrl($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HEADER, TRUE);
        $curlData = curl_exec($curl);
        curl_close($curl);
        $a = explode("\r\n", $curlData);
        $ret = "";
        foreach ($a as $l) {
            if (strpos($l, "Location") !== false) {
                $ret = trim(str_replace("Location:", "", $l));
            }
        }
        return $ret;
    }

    public function __clone() {
        throw new EasyrecError("Can't clone singleton");
    }

}
