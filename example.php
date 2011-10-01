<?php
  /*
   * example.php
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

  /* There is a few things to keep in mind, ..
   * partial will return true even if the address is valid
   * precission refers to the returned geocode, if route or street_address, are returned
   * this doesn't mean precission of the address is not valid all it means is the precission
   * that geocode returns is accurate up untill that point.
   */
  echo ("+" . str_repeat ("-",50) . "+\n");
  if ($test = new geocode("vlagstraat 5a","antwerpen","be")) {
    echo ("latitude: " . $test->lat () . "\n");
    echo ("longitude: " . $test->lng () . "\n");
    echo ("accuracy: " . $test->accuracy () . "\n");
    echo ("status: " . $test->status () . "\n");
    echo ("format: " . $test->format () . "\n");
    echo ("street: " . $test->street () . "\n");
    echo ("number: " . $test->number () . "\n");
    echo ("postal: " . $test->postal () . "\n");
    echo ("precission: " . $test->precission () . "\n");
    if ($test->partial ()) {
      echo ("partial\n");
    }
  } else {
    echo "false\n";
  }
  $test = null;
  echo ("+" . str_repeat ("-",50) . "+\n");

  /*
    latitude: 51.2242191
    longitude: 4.4370204
    accuracy: 1
    status: 1
    format: Vlagstraat 5, 2060 Antwerp, Belgium
    street: Vlagstraat
    number: 5
    postal: 2060
    precission: 1
    partial
   */


  if ($test = new geocode("vlagstraat 5a","antwerpen","be")) {
    echo ("latitude: " . $test->lat () . "\n");
    echo ("longitude: " . $test->lng () . "\n");
    echo ("accuracy: " . $test->accuracy () . "\n");
    echo ("status: " . $test->status () . "\n");
    echo ("format: " . $test->format () . "\n");
    echo ("street: " . $test->street () . "\n");
    echo ("number: " . $test->number () . "\n");
    echo ("postal: " . $test->postal () . "\n");
    echo ("precission: " . $test->precission () . "\n");
    if ($test->partial ()) {
      echo ("partial\n");
    }
  } else {
    echo "false\n";
  }
  $test = null;
  echo ("+" . str_repeat ("-",50) . "+\n");

  /*
    latitude: 51.2242191
    longitude: 4.4370204
    accuracy: 1
    status: 1
    format: Vlagstraat 5, 2060 Antwerp, Belgium
    street: Vlagstraat
    number: 5
    postal: 2060
    precission: 1
    partial
   */

  if ($test = new geocode("blah 5a","blah","be")) {
    echo ("latitude: " . $test->lat () . "\n");
    echo ("longitude: " . $test->lng () . "\n");
    echo ("accuracy: " . $test->accuracy () . "\n");
    echo ("status: " . $test->status () . "\n");
    echo ("format: " . $test->format () . "\n");
    echo ("street: " . $test->street () . "\n");
    echo ("number: " . $test->number () . "\n");
    echo ("postal: " . $test->postal () . "\n");
    echo ("precission: " . $test->precission () . "\n");
    if ($test->partial ()) {
      echo ("partial\n");
    }
  } else {
    echo "false\n";
  }
  $test = null;
  echo ("+" . str_repeat ("-",50) . "+\n");

  /*
    latitude:
    longitude:
    accuracy: 0
    status: 0
    format:
    street:
    number:
    postal:
    precission: 0
  */

?>
