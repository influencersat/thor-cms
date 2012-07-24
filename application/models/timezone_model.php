<?php
/**
 * Manages time zones and locals that php needs in order to function properly.
 *
 * @author David Thor
 * @version 1.0
 */
class Timezone_Model extends CI_Model {

    private static final $zones = array(
        'Pacific/Midway'        => "(GMT-11:00) Midway Island",
        'US/Samoa'              => "(GMT-11:00) Samoa",
        'US/Hawaii'             => "(GMT-10:00) Hawaii",
        'US/Alaska'             => "(GMT-09:00) Alaska",
        'US/Pacific'            => "(GMT-08:00) Pacific Time (US & Canada)",
        'America/Tijuana'       => "(GMT-08:00) Tijuana",
        'US/Arizona'            => "(GMT-07:00) Arizona",
        'US/Mountain'           => "(GMT-07:00) Mountain Time (US & Canada)",
        'America/Chihuahua'     => "(GMT-07:00) Chihuahua",
        'America/Mazatlan'      => "(GMT-07:00) Mazatlan",
        'America/Mexico_City'   => "(GMT-06:00) Mexico City",
        'America/Monterrey'     => "(GMT-06:00) Monterrey",
        'Canada/Saskatchewan'   => "(GMT-06:00) Saskatchewan",
        'US/Central'            => "(GMT-06:00) Central Time (US & Canada)",
        'US/Eastern'            => "(GMT-05:00) Eastern Time (US & Canada)",
        'US/East-Indiana'       => "(GMT-05:00) Indiana (East)",
        'America/Bogota'        => "(GMT-05:00) Bogota",
        'America/Lima'          => "(GMT-05:00) Lima",
        'America/Caracas'       => "(GMT-04:30) Caracas",
        'Canada/Atlantic'       => "(GMT-04:00) Atlantic Time (Canada)",
        'America/La_Paz'        => "(GMT-04:00) La Paz",
        'America/Santiago'      => "(GMT-04:00) Santiago",
        'Canada/Newfoundland'   => "(GMT-03:30) Newfoundland",
        'America/Buenos_Aires'  => "(GMT-03:00) Buenos Aires",
        'Greenland'             => "(GMT-03:00) Greenland",
        'Atlantic/Stanley'      => "(GMT-02:00) Stanley",
        'Atlantic/Azores'       => "(GMT-01:00) Azores",
        'Atlantic/Cape_Verde'   => "(GMT-01:00) Cape Verde Is.",
        'Africa/Casablanca'     => "(GMT) Casablanca",
        'Europe/Dublin'         => "(GMT) Dublin",
        'Europe/Lisbon'         => "(GMT) Lisbon",
        'Europe/London'         => "(GMT) London",
        'Africa/Monrovia'       => "(GMT) Monrovia",
        'Europe/Amsterdam'      => "(GMT+01:00) Amsterdam",
        'Europe/Belgrade'       => "(GMT+01:00) Belgrade",
        'Europe/Berlin'         => "(GMT+01:00) Berlin",
        'Europe/Bratislava'     => "(GMT+01:00) Bratislava",
        'Europe/Brussels'       => "(GMT+01:00) Brussels",
        'Europe/Budapest'       => "(GMT+01:00) Budapest",
        'Europe/Copenhagen'     => "(GMT+01:00) Copenhagen",
        'Europe/Ljubljana'      => "(GMT+01:00) Ljubljana",
        'Europe/Madrid'         => "(GMT+01:00) Madrid",
        'Europe/Paris'          => "(GMT+01:00) Paris",
        'Europe/Prague'         => "(GMT+01:00) Prague",
        'Europe/Rome'           => "(GMT+01:00) Rome",
        'Europe/Sarajevo'       => "(GMT+01:00) Sarajevo",
        'Europe/Skopje'         => "(GMT+01:00) Skopje",
        'Europe/Stockholm'      => "(GMT+01:00) Stockholm",
        'Europe/Vienna'         => "(GMT+01:00) Vienna",
        'Europe/Warsaw'         => "(GMT+01:00) Warsaw",
        'Europe/Zagreb'         => "(GMT+01:00) Zagreb",
        'Europe/Athens'         => "(GMT+02:00) Athens",
        'Europe/Bucharest'      => "(GMT+02:00) Bucharest",
        'Africa/Cairo'          => "(GMT+02:00) Cairo",
        'Africa/Harare'         => "(GMT+02:00) Harare",
        'Europe/Helsinki'       => "(GMT+02:00) Helsinki",
        'Europe/Istanbul'       => "(GMT+02:00) Istanbul",
        'Asia/Jerusalem'        => "(GMT+02:00) Jerusalem",
        'Europe/Kiev'           =>  "(GMT+02:00) Kyiv",
        'Europe/Minsk'          => "(GMT+02:00) Minsk",
        'Europe/Riga'           => "(GMT+02:00) Riga",
        'Europe/Sofia'          => "(GMT+02:00) Sofia",
        'Europe/Tallinn'        => "(GMT+02:00) Tallinn",
        'Europe/Vilnius'        => "(GMT+02:00) Vilnius",
        
    );

    /**
     *
     */
    public function getUTCList() {
        $abbreviations = DateTimeZone::listAbbreviations();

        $cities = array();
        foreach ($abbreviations as $key => $zones) {
            foreach ($zones as $id => $zone) {
                if (preg_match('/^(America|Antartica|Arctic|Asia|Atlantic|Europe|Indian|Pacific)\//', $zone['timezone_id']) &&
                    $zone['timezone_id']) 
                {
                    $cities[$zone['timezone_id']][] = $key;
                }
            }
        }

        foreach ($cities as $key => $value) {
            $cities[$key] = join(', ', $value);
        }

        $cities = array_unique($cities);
        ksort($cities);

        return $cities;
    }
}
