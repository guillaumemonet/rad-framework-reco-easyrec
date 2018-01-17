<?php

namespace Rad\Reco\Easyrec\Api;

/**
 * Description of SendAction
 *
 * @author guillaume
 */
class Action extends AModule {

    /**
     * 
     * @param mixed $itemid
     * @param mixed $itemdesc
     * @param mixed $itemurl
     * @param mixed $itemimageurl
     * @param mixed $itemtype
     * @param mixed $actiontime
     * @param mixed $actioninfo
     * @return mixed
     */
    public function view($itemid, $itemdesc, $itemurl, $itemimageurl = null, $itemtype = "ITEM", $actiontime = null, $actioninfo = null) {
        if (!empty($itemid) && !empty($itemdesc) && !empty($itemurl)) {
            $itemdesc = urlencode(utf8_encode(html_entity_decode($itemdesc)));
            $itemurl = str_replace("&", "%26", $itemurl);
            $itemimageurl = str_replace("&", "%26", $itemimageurl);
            $get_params = array(
                "itemid" => $itemid,
                "itemdescription" => $itemdesc,
                "itemurl" => $itemurl,
                "itemimageurl" => $itemimageurl,
                "itemptype" => $itemtype,
                "actiontime" => $actiontime,
                "actioninfo" => $actioninfo
            );
            return $this->getRequest("view", $get_params);
        } else {
            return null;
        }
    }

    /**
     * 
     * @param type $itemid
     * @param type $itemdesc
     * @param type $itemurl
     * @return int
     */
    public function buy($itemid, $itemdesc, $itemurl, $itemimageurl = null, $itemtype = "ITEM", $actiontime = null, $actioninfo = null) {
        if (!empty($itemid) && !empty($itemdesc) && !empty($itemurl)) {
            $itemdesc = urlencode(utf8_encode(html_entity_decode($itemdesc)));
            $itemurl = str_replace("&", "%26", $itemurl);
            $itemimageurl = str_replace("&", "%26", $itemimageurl);
            $get_params = array(
                "itemid" => $itemid,
                "itemdescription" => $itemdesc,
                "itemurl" => $itemurl,
                "itemimageurl" => $itemimageurl,
                "itemptype" => $itemtype,
                "actiontime" => $actiontime,
                "actioninfo" => $actioninfo
            );
            return $this->getRequest("buy", $get_params);
        } else {
            return null;
        }
    }

    /**
     * 
     * @param type $itemid
     * @param type $itemdesc
     * @param type $itemurl
     * @param type $rvalue
     * @param type $itemimageurl
     * @param type $itemtype
     * @param type $actiontime
     * @param type $actioninfo
     * @return type
     */
    public function rate($itemid, $itemdesc, $itemurl, $rvalue, $itemimageurl = null, $itemtype = "ITEM", $actiontime = null, $actioninfo = null) {
        if (!empty($itemid) && !empty($itemdesc) and ! empty($itemurl) && !empty($rvalue)) {
            $itemdesc = urlencode(utf8_encode(html_entity_decode($itemdesc)));
            $itemurl = str_replace("&", "%26", $itemurl);
            $itemimageurl = str_replace("&", "%26", $itemimageurl);
            $get_params = array(
                "itemid" => $itemid,
                "itemdescription" => $itemdesc,
                "itemurl" => $itemurl,
                "itemimageurl" => $itemimageurl,
                "itemptype" => $itemtype,
                "ratingvalue" => $rvalue,
                "actiontime" => $actiontime,
                "actioninfo" => $actioninfo
            );
            return $this->getRequest("rate", $get_params);
        } else {
            return null;
        }
    }

    /**
     * 
     * @param type $actiontype
     * @param type $itemid
     * @param type $itemdesc
     * @param type $itemurl
     * @param type $itemimageurl
     * @param type $itemtype
     * @param type $actiontime
     * @param type $actioninfo
     * @return type
     */
    public function sendAction($actiontype, $itemid, $itemdesc, $itemurl, $itemimageurl = null, $itemtype = "ITEM", $actiontime = null, $actioninfo = null) {
        if (!empty($itemid) && !empty($itemdesc) && !empty($itemurl)) {
            $itemdesc = urlencode(utf8_encode(html_entity_decode($itemdesc)));
            $itemurl = str_replace("&", "%26", $itemurl);
            $itemimageurl = str_replace("&", "%26", $itemimageurl);
            $get_params = array(
                "actiontype" => $actiontype,
                "itemid" => $itemid,
                "itemdescription" => $itemdesc,
                "itemurl" => $itemurl,
                "itemimageurl" => $itemimageurl,
                "itemptype" => $itemtype,
                "actiontime" => $actiontime,
                "actioninfo" => $actioninfo
            );
            return $this->getRequest("sendaction", $get_params);
        } else {
            return null;
        }
    }

    /**
     * 
     * @param type $itemfromid
     * @param type $itemfromtype
     * @param type $itemtoid
     * @param type $itemtotype
     * @param type $rectype
     * @return type
     */
    public function track($itemfromid, $itemfromtype, $itemtoid, $itemtotype, $rectype) {
        $get_params = array(
            "itemfromid" => $itemfromid,
            "itemfromtype" => $itemfromtype,
            "itemtoid" => $itemtoid,
            "itemtotype" => $itemtotype,
            "rectype" => $rectype);
        return $this->getRequest("track", $get_params);
    }

}
