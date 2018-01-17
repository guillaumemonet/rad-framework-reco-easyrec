<?php

namespace Rad\Reco\Easyrec\Api;

/**
 * Description of CommunityRanking
 *
 * @author guillaume
 */
class Ranking extends AModule {

    /**
     * 
      return   id,type,description,url,[imageurl],[value]
      $timeRange => DAY,WEEK,MONTH,ALL
     */
    public function mostViewed($timeRange = "ALL", $n = 10, $clusterid = null) {
        $get_params["timeRange"] = $timeRange;
        $get_params["numberOfResults"] = $n;
        $get_params["clusterid"] = $clusterid;
        return $this->getRequest("mostvieweditems", $get_params);
    }

    /**
      return   id,type,description,url,[imageurl],[value]
      $timeRange => DAY,WEEK,MONTH,ALL
     */
    public function mostBought($timeRange = "ALL", $n = 10, $clusterid = null) {
        $get_params["timeRange"] = $timeRange;
        $get_params["numberOfResults"] = $n;
        $get_params["clusterid"] = $clusterid;
        return $this->getRequest("mostboughtitems", $get_params);
        
    }

    /**
      return   id,type,description,url,[imageurl],[value]
      $timeRange => DAY,WEEK,MONTH,ALL
     */
    public function mostRated($timeRange = "ALL", $n = 10, $clusterid = null) {
        $get_params["timeRange"] = $timeRange;
        $get_params["numberOfResults"] = $n;
        $get_params["clusterid"] = $clusterid;
        return $this->getRequest("mostrateditems", $get_params);
    }

    /**
      return   id,type,description,url,[imageurl],[value]
      $timeRange => DAY,WEEK,MONTH,ALL
     */
    public function bestRated($timeRange = "ALL", $n = 10, $clusterid = null) {
        $get_params["timeRange"] = $timeRange;
        $get_params["numberOfResults"] = $n;
        $get_params["clusterid"] = $clusterid;
        return $this->getRequest("bestrateditems", $get_params);
    }

    /**
      return   id,type,description,url,[imageurl],[value]
      $timeRange => DAY,WEEK,MONTH,ALL
     */
    public function worstRated($timeRange = "ALL", $n = 10, $clusterid = null) {
        $get_params["timeRange"] = $timeRange;
        $get_params["numberOfResults"] = $n;
        $get_params["clusterid"] = $clusterid;
        return $this->getRequest("worstrateditems", $get_params);
    }

}
