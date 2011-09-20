<?php
  /*
   * geocode.class.php
   *
   * Copyright 2011 Wouter Snels <info@ofloo.net>
   *
   * This program is free software; you can redistribute it and/or modify
   * it under the terms of the GNU General Public License as published by
   * the Free Software Foundation; either version 2 of the License, or
   * (at your option) any later version.
   *
   * This program is distributed in the hope that it will be useful,
   * but WITHOUT ANY WARRANTY; without even the implied warranty of
   * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   * GNU General Public License for more details.
   *
   * You should have received a copy of the GNU General Public License
   * along with this program; if not, write to the Free Software
   * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
   * MA 02110-1301, USA.
   *
   * SVN: https://narf.ofloo.net/svn/geocode.php/
   *
   */

  class geocode {

    private $_URL = "http://maps.googleapis.com/maps/api/geocode/xml?sensor=false&address=";
    private $_LAT;
    private $_LNG;
    private $_ACCURACY;
    private $_PARTIAL = false;
    private $_STATUS = -4;
    private $_FORMAT;
    private $_STREET;
    private $_NUMBER;
    private $_POSTAL;
    private $_PRECISSION;

    /* bool returns true or false, true on result false on no result
     */
    public function __construct ($address, $city, $country) {
      $url = $this->_URL . $this->url_encode ($address) . "," . $this->url_encode ($city) . "," . $this->url_encode ($country);
      if ($xml = @simplexml_load_file($url)) {
        switch ($xml->status) {
          case "OK":
            $this->_LAT = $xml->result->geometry->location->lat;
            $this->_LNG = $xml->result->geometry->location->lng;
            $this->_ACCURACY = $xml->result->geometry->location_type;
            if ($xml->result->partial_match) {
              $this->_PARTIAL = true;
            }
            if (!is_array ($xml->result->type)) {
              switch ($xml->result->type) {
                case "post_box":
                case "floor":
                case "room":
                  $this->_PRECISSION = 3;
                break;
                case "street_number":
                  $this->_PRECISSION = 2;
                break;
                case "street_address":
                  $this->_PRECISSION = 1;
                break;
                default :
                  $this->_PRECISSION = 0;
                break;
              }
            } else {
              $this->_PRECISSION = -1;
            }
            $this->_FORMAT = $xml->result->formatted_address;
            foreach ($xml->result->address_component as $_list) {
              switch ($_list->type) {
                case "street_number":
                  $this->_NUMBER = $_list->long_name;
                break;
                case "postal_code":
                  $this->_POSTAL = $_list->long_name;
                break;
                case "route":
                  $this->_STREET = $_list->long_name;
                break;
                default:
                break;
              }
            }
            $this->_STATUS = 1;
          break;
          case "ZERO_RESULTS":
            $this->_STATUS = 0;
          break;
          case "OVER_QUERY_LIMIT":
            $this->_STATUS = -1;
          break;
          case "REQUEST_DENIED":
            $this->_STATUS = -2;
          break;
          case "INVALID_REQUEST":
            $this->_STATUS = -3;
          break;
          default:
            $this->_STATUS = -4;
          break;
        }
        return true;
      }
      return false;
    }

    /* double returns latitude
     */
    public function lat () {
      return $this->_LAT;
    }

    /* double returns longtitude
     */
    public function lng () {
      return $this->_LNG;
    }

    /* string returns streetname
     */
    public function street () {
      return $this->_STREET;
    }

    /* string returns street number
     */
    public function number () {
      return $this->_NUMBER;
    }

    public function postal () {
      return $this->_POSTAL;
    }

    /* string returns postal code
     */
    public function format () {
      return $this->_FORMAT;
    }

    /* int returns precission -1 to 3
     * -1: multiple results
     *  0: from route level to up (default)
     *  1: street address
     *  2: street number
     *  3: room, floor, post box
     */
    public function precission () {
      return $this->_PRECISSION;
    }

    /* bool return true on partialmatch otherwise false
     */
    public function partial () {
      return $this->_PARTIAL;
    }

    /* int returns range from 2 to -2, ..
     *  2: indicates that the returned result is a precise geocode for which we have location information accurate down to street address precision.
     *  1: indicates that the returned result reflects an approximation (usually on a road) interpolated between two precise points (such as intersections). Interpolated results are generally returned when rooftop geocodes are unavailable for a street address.
     *  0: default
     * -1: indicates that the returned result is the geometric center of a result such as a polyline (for example, a street) or polygon (region).
     * -2: indicates that the returned result is approximate.
     */
    public function accuracy () {
      switch ($this->_ACCURACY) {
        case "ROOFTOP":
          return 2;
        break;
        case "RANGE_INTERPOLATED":
          return 1;
        break;
        case "GEOMETRIC_CENTER":
          return -1;
        break;
        case "APPROXIMATE":
          return -2;
        break;
        default:
          return 0;
        break;
      }
    }

    /* int returns range from 1 to -4
     *  1: indicates that no errors occurred; the address was successfully parsed and at least one geocode was returned.
     *  0: indicates that the geocode was successful but returned no results. This may occur if the geocode was passed a non-existent address or a latlng in a remote location.
     * -1: indicates that you are over your quota.
     * -2: indicates that your request was denied, generally because of lack of a sensor parameter.
     * -3: generally indicates that the query (address or latlng) is missing.
     * -4: default, either no request was made, or it was unsuccessfully made
     */
    public function status () {
      return $this->_STATUS;
    }

    private function url_encode ($str) {
      $out = null;
      foreach (str_split ($str) as $k => $v) {
        if ($v == " ") {
          $out .= "+";
        } else {
          $out .= utf8_encode ($v);
        }
      }
      return $out;
    }

    public function __destruct () {
      unset ($this->_URL);
      unset ($this->_LAT);
      unset ($this->_LNG);
      unset ($this->_PARTIAL);
      unset ($this->_ACCURACY);
      unset ($this->_STATUS);
      unset ($this->_FORMAT);
      unset ($this->_STREET);
      unset ($this->_NUMBER);
      unset ($this->_POSTAL);
      unset ($this->_PRECISSION);
      foreach(get_object_vars($this) as $k => $v) {
        unset($this->$k);
      }
    }
  }

?>
