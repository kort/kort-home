<?php

namespace Osm;

use Helper\HttpHelper;

class OsmChecker {

    public static function notChangedInOsm(array $fix)
    {
        $http = new HttpHelper();
        $osmWsUrl = "http://play.kort.ch/server/webservices/osm/" . $fix['osm_type']. "/" . $fix['osm_id'];
        $result = $http->get($osmWsUrl);

        $doc = new \DOMDocument();
        $doc->loadXML($result);
        $xPath = new \DOMXpath($doc);

        $queryResult = $xPath->query("//node()[@id=" . $fix['osm_id'] . "]/tag[@k='".$fix['osm_tag']."']");

        $value = null;
        $element = $queryResult->item(0);
        if (!empty($element)) {
            $value = $element->getAttribute('v');
        }
        return empty($value);
    }
}
