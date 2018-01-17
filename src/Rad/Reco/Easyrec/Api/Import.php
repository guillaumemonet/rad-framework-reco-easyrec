<?php

namespace Rad\Reco\Easyrec\Api;

/**
 * Description of Import
 *
 * @author guillaume
 */
class Import extends AModule {

    /**
     * 
     * @param type $itemId
     * @param type $active
     * @return type
     */
    public function activateItem($itemId, $active = true) {
        if (!empty($itemId)) {
            $get_params = array("itemid" => $itemId,
                "active" => ($active ? "true" : "false"),
                "token" => $this->getToken());
            return $this->getRequest("setitemactive", $get_params);
        } else {
            return null;
        }
    }

    /**
     * 
     * @param type $itemid
     * @param type $itemdesc
     * @param type $itemurl
     * @param type $itemimageurl
     * @return type
     */
    public function updateItem($itemid, $itemdesc, $itemurl, $itemimageurl = null) {
        if (!empty($itemid) && !empty($itemdesc) && !empty($itemurl)) {
            $itemdesc = urlencode(utf8_encode(html_entity_decode($itemdesc)));
            $itemurl = str_replace("&", "%26", $itemurl);
            $itemimageurl = str_replace("&", "%26", $itemimageurl);
            $get_params = array(
                "itemid" => $itemid,
                "itemdescription" => $itemdesc,
                "itemurl" => $itemurl,
                "itemimageurl" => $itemimageurl,
                "token" => $this->getToken()
            );

            return $this->getRequest("importitem", $get_params);
        } else {
            return null;
        }
    }

    /**
     * 
     * @param type $itemId
     * @param type $json
     * @return type
     */
    public function updateProfile($itemId, $json) {
        $get_params["itemid"] = $itemId;
        $get_params["profile"] = $json;
        $rec = $this->postRequest("json/profile/store", $get_params);
        return $rec;
    }

}
