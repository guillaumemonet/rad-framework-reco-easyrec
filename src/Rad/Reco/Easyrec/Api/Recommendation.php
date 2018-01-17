<?php

namespace Rad\Reco\Easyrec\Api;

/**
 * Description of GetRecommendation
 *
 * @author guillaume
 */
class Recommendation extends AModule {

    /**
     * 
     * @param string $itemid
     * @param int $n
     * @return int
     */
    public function alsoViewed($itemid, $n = 10) {
        if (!empty($itemid)) {
            $get_params = array(
                "itemid" => $itemid,
                "numberOfResults" => $n
            );
            return $this->getRequest("otherusersalsoviewed", $get_params);
        } else {
            return null;
        }
    }

    /**
     * 
     * @param type $itemid
     * @param type $n
     * @return int
     */
    public function alsoBought($itemid, $n = 10) {
        if (!empty($itemid)) {
            $get_params = array(
                "itemid" => $itemid,
                "numberOfResults" => $n
            );
            return $this->getRequest("otherusersalsobought", $get_params);
        } else {
            return null;
        }
    }

    /**
     * 
     * @param type $itemid
     * @param type $n
     * @return int
     */
    public function ratedGood($itemid, $n = 10) {
        if (!empty($itemid)) {
            $get_params = array(
                "itemid" => $itemid,
                "numberOfResults" => $n
            );
            return $this->getRequest("itemsratedgoodbyotherusers", $get_params);
        } else {
            return null;
        }
    }

    /**
     * 
     * @param type $user_id
     * @param type $n
     * @return type
     */
    public function recForUser($n = 10) {
        $get_params = array(
            "numberOfResults" => $n
        );
        return $this->getRequest("recommendationsforuser", $get_params);
    }

    /**
     * 
     * @param type $itemid
     * @param type $n
     * @return type
     */
    public function relatedItems($itemid, $n = 10) {
        if (!empty($itemid)) {
            $get_params = array(
                "itemid" => $itemid,
                "numberOfResults" => $n
            );
            return $this->getRequest("relateditems", $get_params);
        } else {
            return null;
        }
    }

    /**
     * 
     * @param type $type
     * @param type $n
     * @return type
     */
    public function actionHistory($type = "VIEW", $n = 10) {
        if (!empty($type)) {
            $get_params = array(
                "actiontype" => $type,
                "numberOfResults" => $n
            );
            return $this->getRequest("actionhistoryforuser", $get_params);
        } else {
            return null;
        }
    }

}
