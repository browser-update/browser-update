<?php

require 'vendor/autoload.php';

use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;

function get_country_from_ip($hostname) {
    $reader = new Reader(__DIR__ . '/../../geoip/GeoLite2-Country.mmdb');
    try {
        $record = $reader->country($hostname);
    } catch (AddressNotFoundException $e) {
        return false;
    }

    return strtolower($record->country->isoCode);
}

//echo get_country_from_ip($_SERVER['REMOTE_ADDR']);
//echo geoip_db_get_all_info();
/*
if (!function_exists('geoip_record_by_name')) {
    function geoip_record_by_name($hostname) {
        $reader = new Reader(__DIR__ . '/geoip/GeoLite2-City.mmdb');
        try {
            $record = $reader->city($hostname);
        } catch (AddressNotFoundException $e) {
            return false;
        }

        return array(
            //'continent_code' => $record->mostSpecificSubdivision->isoCode,
            'country_code' => $record->country->isoCode,
            //'country_code3' => 'USA',
            'country_name' => $record->country->name,
            //'region' => 'CA',
            'city' => $record->city->name,
            'postal_code' => $record->postal->code,
            'latitude' => $record->location->latitude,
            'longitude' => $record->location->longitude,
            //'dma_code' => 803,
            //'area_code' => 310,
        );
    }
}
*/