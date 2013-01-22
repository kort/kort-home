<?php
/**
 * kort - Osm\OsmChecker class
 */

namespace Osm;

use Helper\HttpHelper;

/**
 * The OsmChecker class is used to check information from OpenStreetMap.
 */
class OsmChecker
{
    /**
     * Return true if the supplied $fix is not yet in OpenStreetMap.
     *
     * @param array $fix The information of fix from Kort.
     *
     * @return boolean True if the fix is not yet in OpenStreetMap, false otherwise
     */
    public static function notChangedInOsm(array $fix)
    {
        $http = new HttpHelper();
        $osmWsUrl = "http://play.kort.ch/server/webservices/osm/" . $fix['osm_type']. "/" . $fix['osm_id'];
        $result = $http->get($osmWsUrl);

        $value = null;
        if (!empty($result)) {
            $doc = new \DOMDocument();
            $doc->loadXML($result);
            $xPath = new \DOMXpath($doc);

            $queryResult = $xPath->query("//node()[@id=" . $fix['osm_id'] . "]/tag[@k='".$fix['osm_tag']."']");

            $element = $queryResult->item(0);
            if (!empty($element)) {
                $value = $element->getAttribute('v');
            }
        } else {
            $value = "OSM Object not found!";
        }
        return empty($value);
    }
}
