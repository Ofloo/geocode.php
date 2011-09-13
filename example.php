<?php
/*
 *      example.php
 *
 *      Copyright 2011 Wouter Snels <info@ofloo.net>
 *
 *      This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 2 of the License, or
 *      (at your option) any later version.
 *
 *      This program is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU General Public License for more details.
 *
 *      You should have received a copy of the GNU General Public License
 *      along with this program; if not, write to the Free Software
 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *      MA 02110-1301, USA.
 */

  if ($test = new geocode("vlagstraat 5a","antwerpen","be")) {
    echo ("latitude: " . $test->lat () . "\n");
    echo ("longitude: " . $test->lng () . "\n");
    echo ("accuracy: " . $test->accuracy () . "\n");
    echo ("status: " . $test->status () . "\n");
    if ($test->partial ()) {
      echo ("partial\n");
    }
  } else {
    echo "false\n";
  }
  $test = null;

  /* returns:
     latitude: 51.2242191
     longitude: 4.4370204
     accuracy: 1
     status: 1
   */


  if ($test = new geocode("vlagstraat 5a","antwerpen","be")) {
    echo ("latitude: " . $test->lat () . "\n");
    echo ("longitude: " . $test->lng () . "\n");
    echo ("accuracy: " . $test->accuracy () . "\n");
    echo ("status: " . $test->status () . "\n");
    if ($test->partial ()) {
      echo ("partial\n");
    }
  } else {
    echo "false\n";
  }
  $test = null;

  /* returns:
     latitude: 51.2242191
     longitude: 4.4370204
     accuracy: 1
     status: 1
     partial
   */

  if ($test = new geocode("blah 5a","blah","be")) {
    echo ("latitude: " . $test->lat () . "\n");
    echo ("longitude: " . $test->lng () . "\n");
    echo ("accuracy: " . $test->accuracy () . "\n");
    echo ("status: " . $test->status () . "\n");
    if ($test->partial ()) {
      echo ("partial\n");
    }
  } else {
    echo "false\n";
  }
  $test = null;

  /*
    latitude:
    longitude:
    accuracy: 0
    status: 0
  */

?>
