<?php
include '../db.php';
$addrTable = array();
$nameTable = array();
$num = 0;
while (isset($_GET['loc' . $num])) {
    $loc = $_GET['loc' . $num];
    if ($loc == "") {
        break;
    }
    $addrTable[] = $loc;
    $num++;
}

for ($numName = 0; $numName < $num; $numName++) {
    $nameTable[$numName] = '';
    if (isset($_GET['name' . $numName])) {
        $nameTable[$numName] = $_GET['name' . $numName];
    }
}

$lat;
$lng;
if (isset($_GET['center'])) {
    $loc = $_GET['center'];
    if (eregi("\(\s*\-?([0-9]+|[0-9]*\.[0-9]+),\s*\-?([0-9]+|[0-9]*\.[0-9]+)\)", $loc)) {
        $latLngArr = split("[\s,\)\(]+", $loc);
        $lat = $latLngArr[1];
        $lng = $latLngArr[2];
    }
}

$zoom = 8;
if (isset($_GET['zoom'])) {
    $zoom = $_GET['zoom'];
}

$mode = 0;
if (isset($_GET['mode'])) {
    $mode = $_GET['mode'];
}

$walk = 0;
if (isset($_GET['walk'])) {
    $walk = $_GET['walk'];
}

$bike = 0;
if (isset($_GET['bike'])) {
    $bike = $_GET['bike'];
}

$avoid = 0;
if (isset($_GET['avoid'])) {
    $avoid = $_GET['avoid'];
}

$avoidTolls = 0;
if (isset($_GET['avoidTolls'])) {
    $avoidTolls = $_GET['avoidTolls'];
}

$hidePoll1 = true;
if (isset($_COOKIE['poll1Hidden'])) {
    $hidePoll1 = true;
}

$hidePoll2 = false;
if (isset($_COOKIE['poll2Hidden'])) {
    $hidePoll2 = true;
}

//print_r($addrTable);
//print_r($nameTable);
//  print_r($latLngArr);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" itemscope itemtype="http://schema.org/Product">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>

        <meta itemprop="name" content="OptiMap">
            <meta itemprop="description" content="Fastest roundtrip solver and route planner with multiple destinations. Up to 100 stops. Send computed route to TomTom or Garmin GPS.">
                <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
                <title>Multiple Destination Route Planner for Google Maps</title>
                <link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
                    <link rel="stylesheet" href="css/print.css" type="text/css" media="print">
                        <link type="text/css" href="css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
                        <script>
                            //var addr;
                        </script>
                        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
                        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>

                        <script type="text/javascript" src="js/jquery.cookie.js"></script>
                        <script type="text/javascript" src="http://www.google.com/jsapi"></script>
                        <?php
                        echo "<script type=\"text/javascript\" src=\"js/acoAlgorithm.js?" . filemtime("js/acoAlgorithm.js") . "\"></script>\n";
                        echo "<script type=\"text/javascript\" src=\"js/directions-export.js?" . filemtime("js/directions-export.js") . "\"></script>\n";
                        echo "<script type=\"text/javascript\" src=\"js/tsp.js?" . filemtime("js/tsp.js") . "\"></script>\n";
                        ?>
                        <script type="text/javascript">
                            jQuery.noConflict();
                            function onBodyLoad() {
                                google.load("maps", "3", {callback: init, other_params:"sensor=false"});
                            }

                            function init() {
<?php
if (isset($lat) && isset($lng)) {
    echo "\tloadAtStart(" . $lat . ", " . $lng . ", " . $zoom . ");\n";
} else {
    echo "\tif (google.loader.ClientLocation != null) {\n";
    echo "\t\tlatLng = new google.maps.LatLng(google.loader.ClientLocation.latitude, google.loader.ClientLocation.longitude);\n";
    echo "\t\tloadAtStart(google.loader.ClientLocation.latitude, google.loader.ClientLocation.longitude, " . $zoom . ");\n";
    echo "\t} else {\n";
    //$lat = "37.4419";
    //$lng = "-122.1419";
    echo "\t\tloadAtStart(37.4419, -122.1419, " . $zoom . ");\n";
    echo "\t}\n";
}
for ($i = 0; $i < count($addrTable); $i++) {
    echo "\taddAddressAndLabel('"
    . $addrTable[$i] . "', '" . $nameTable[$i] . "');\n";
}
if (count($addrTable) > 0) {
    $walkStr = ($walk == 0) ? "false" : "true";
    $bikeStr = ($bike == 0) ? "false" : "true";
    $avoidStr = ($avoid == 0) ? "false" : "true";
    $avoidTollsStr = ($avoidTolls == 0) ? "false" : "true";
    echo "\tdirections(" . $mode . ", " . $walkStr . ", " . $bikeStr . ", " . $avoidStr . ", " . $avoidTollsStr . ");\n";
}
?>
    }

    function toggle(divId) {
        var divObj = document.getElementById(divId);
        if (divObj.innerHTML == "") {
            divObj.innerHTML = document.getElementById(divId + "_hidden").innerHTML;
            document.getElementById(divId + "_hidden").innerHTML = "";
        } else {
            document.getElementById(divId + "_hidden").innerHTML = divObj.innerHTML;
            divObj.innerHTML = "";
        }
    }

    function setPollHidden() {
        jQuery('.poll').hide();
        jQuery.cookie('poll2Hidden', 'true', { path: '/', expires: 365 });
    }

    jQuery(function() {
        jQuery( "#accordion" ).accordion({
            collapsible: true,
            autoHeight: false,
            clearStyle: true
        });
        jQuery("input:button").button();
        jQuery("#dialogProgress" ).dialog({
            height: 140,
            modal: true,
            autoOpen: false
        });
        jQuery("#progressBar").progressbar({ value: 0 });
        jQuery("#dialogTomTom" ).dialog({
            height: 480,
            width: 640,
            modal: true,
            autoOpen: false
        });
        jQuery("#dialogGarmin" ).dialog({
            height: 480,
            width: 640,
            modal: true,
            autoOpen: false
        });
        jQuery('.myMap').height(jQuery(window).height() - 100);
    });

    (function() {
        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
        po.src = 'https://apis.google.com/js/plusone.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
    })();

                        </script>
                        <script type="text/javascript">
                            /* <![CDATA[ */
                            (function() {
                                var s = document.createElement('script'), t = document.getElementsByTagName('script')[0];
                                s.type = 'text/javascript';
                                s.async = true;
                                s.src = 'http://api.flattr.com/js/0.6/load.js?mode=auto';
                                t.parentNode.insertBefore(s, t);
                            })();
                            /* ]]> */</script>

                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                        <style>
                            body,html{
                                width: 99%;
                                background-color: #eee;
                                margin: auto;
                                font-size: 16px;
                                font-family: heventica, sams;
                                margin-top: 1%;

                            }
                            .container{
                                width: 90%;
                                margin: auto;
                                background: #fff;
                            }
                            table{
                                width: 90% !important;
                                margin-left: 5% !important;

                            }
                            tr,td{
                                /*width: 100%;*/
                            }
                            text{
                                font-size: 16px;  
                            }
                            #bulkLoader_hidden{
                                height: 10px;
                            }
                        </style>
                        </head>

                        <body onLoad="onBodyLoad()">
                            <div class="container">
                                <h2 style="text-align: center"><b>Route Optimize</b><br/>
                                    <text>(Using Ant Colony Optimization Algorithm)</text>
                                </h2>


                                <div style="width: 100%" class='mainTable' > 
                                    <div style="width: 100%"> 
                                        <div style='width: 49%;'>

                                            <div id="accordion" style='width: 100%;'>
                                                <h3><a href="#" class='accHeader'>Destinations</a></h3>
                                                <div style="width: 100%">
                                                    <form name="address" onSubmit="clickedAddAddress(); return false;">
                                                        Address starting with source location to Destinations: 
                                                        <div style="width: 100%"><div style="width: 100%">
                                                                <div style="width: 100%"><input name="addressStr" type="text"></div>
                                                                <div style="width: 100%"><input type="button" value="Add!" onClick="clickedAddAddress()"></div>
                                                            </div>
                                                    </form>
                                                    <!--or <a href="#" onClick="toggle('bulkLoader'); document.listOfLocations.inputList.focus(); document.listOfLocations.inputList.select(); return false;"> Multiple Address or (lat, lng)</a>.-->
                                                    <div id="bulkLoader"></div>
                                                </div>

                                                <h3><a href="#" class='accHeader'>Route Options</a></h3>
                                                <div>
                                                    <form name="travelOpts">
                                                        <input id="walking" type="checkbox"/> Walking<br />
                                                        <input id="bicycling" type="checkbox"/> Bicycling<br />
                                                        <input id="avoidHighways" type="checkbox"/> Avoid highways<br />
                                                        <input id="avoidTolls" type="checkbox"/> Avoid toll roads
                                                    </form>
                                                </div>

                                                <h3><a href="#" class='accHeader'>Export</a></h3>
                                                <div>
                                                    <div id="exportGoogle"></div>
                                                    <div id="exportDataButton"></div>
                                                    <div id="exportData"></div>
                                                    <div id="exportLabelButton"></div>
                                                    <div id="exportLabelData"></div>
                                                    <div id="exportAddrButton"></div>
                                                    <div id="exportAddrData"></div>
                                                    <div id="exportOrderButton"></div>
                                                    <div id="exportOrderData"></div>
                                                    <!--                                                    <div id="garmin"></div>
                                                                                                        <div id="tomtom"></div>-->
                                                    <div id="durations" class="pathdata"></div>
                                                    <div id="durationsData"></div>
                                                </div>

                                                <h3><a href="#" class='accHeader'>Edit Route</a></h3>
                                                <div>
                                                    <div id="routeDrag"></div>
                                                    <div id="reverseRoute"></div>
                                                </div>

                                                <!--  <h3><a href="#" class='accHeader'>Help</a></h3>
                                                  <div>
                                                  <p>To add locations, simply left-click the map or enter an address
                                                  either in the single address field, or in the bulk loader. </p>
                                                  <p>The first location you add is considered to be the start 
                                                  of your journey. If you click 'Calculate Fastest Roundtrip', it will
                                                  also be the end of your trip. If you click 'Calculate Fastest A-Z Trip',
                                                  the last location (the one with the highest number), will be the final
                                                  destination.</p>
                                                  <p>To remove or edit a location, click its marker.</p>
                                                  <p>If more than 15 locations are specified, you are not guaranteed
                                                  to get the optimal solution, but the solution is likely to be close
                                                  to the best possible.</p>
                                                  <p>You can re-arrange
                                                  stops after the route is computed. To do this, open the 'Edit Route'
                                                  section and drag or delete locations.</p>
                                                  </div>-->

                                                <!--  <h3><a href="#" class='accHeader'>About</a></h3>
                                                  <div>
                                                  <p><span class="red">Version 4</span>&nbsp;<a href="http://gebweb.net/blogpost/2012/01/25/optimap-version-4-is-here/">Read about the new
                                                  version, and post comments, bugs and suggestions</a>.
                                                  <p>How it works: <a href="http://gebweb.net/blogpost/2007/07/05/behind-the-scenes-of-optimap/">Behind the Scenes of OptiMap</a></p>
                                                  <p>Use on your website: <a href="http://gebweb.net/blogpost/2007/08/26/optimize-your-trips/">Optimize Your Trips</a></p>
                                                  <p>
                                                   The solver <a href="http://code.google.com/p/google-maps-tsp-solver/">
                                                   source code</a> is available under the MIT license. If you are
                                                   interested in
                                                   knowing about updates to this code, please subscribe to
                                                   <a href="http://groups.google.com/group/google-maps-tsp-solver">
                                                   this mailing list</a>.</p>
                                                  <p>
                                                   You can specify a default starting position and zoom level,
                                                   by adding http GET parameters center and zoom. E.g
                                                   <a href="http://gebweb.net/optimap/index.php?center=(60,10)&amp;zoom=6">http://gebweb.net/optimap/index.php?center=(60,10)&amp;zoom=6</a>.</p>
                                                  <p>Up to 100 locations are accepted.</p>
                                                  </div>-->

                                            </div>
                                        </div>
                                         <div style="width: 100%; float: left;">
                                            <div id="road_info">

                                            </div>
                                        </div>
                                            
                                    </div>

                                    <div  style='width: 100%;padding: 5px;'>
                                        <div id="map" class="myMap" ></div>
                                        <div style="width:100%">
                                            <h1>Action Panel</h1>
                                            <input id="button1" class="calcButton" type="button" value="Calculate Fastest Roundtrip" onClick="directions(0, document.forms['travelOpts'].walking.checked, document.forms['travelOpts'].bicycling.checked, document.forms['travelOpts'].avoidHighways.checked, document.forms['travelOpts'].avoidTolls.checked)">
                                                <br/> <input id="button2" class="calcButton" type="button" value="Calculate Fastest A-Z Trip" onClick="directions(1, document.forms['travelOpts'].walking.checked, document.forms['travelOpts'].bicycling.checked, document.forms['travelOpts'].avoidHighways.checked, document.forms['travelOpts'].avoidTolls.checked)">
                                                    <br/> <input id='button3' class="calcButton" type='button' value='Start Over Again' onClick='startOver()'>

                                                        </div>
                                                        <div id="path" class="pathdata"></div>
                                                        <div id="my_textual_div"></div>
                                                        </div>

                                                        </div>

                                                        <!-- Hidden stuff -->
                                                        <!--<div id="bulkLoader_hidden" style="visibility: hidden;">
                                                          <form name="listOfLocations" onSubmit="clickedAddList(); return false;">
                                                          <textarea name="inputList" id="inputList"  rows="10" cols="70">One destination per line</textarea><br>
                                                          <input type="button" value="Add list of locations" onClick="clickedAddList()">
                                                        </form></div>-->
                                                        <div id="exportData_hidden" style="visibility: hidden;"></div>
                                                        <div id="exportLabelData_hidden" style="visibility: hidden;"></div>
                                                        <div id="exportAddrData_hidden" style="visibility: hidden;"></div>
                                                        <div id="exportOrderData_hidden" style="visibility: hidden;display: "></div>
                                                        <div id="durationsData_hidden" style="visibility: hidden;"></div>

                                                        <div id="dialogProgress" title="Calculating route...">
                                                            <div id="progressBar"></div>
                                                        </div>

                                                        <div style="display: none">
                                                            <div id="dialogTomTom" title="Export to TomTom">
                                                                <iframe name='tomTomIFrame' style='width: 100%;'></iframe> 
                                                            </div>

                                                            <div id="dialogGarmin" title="Export to Garmin">
                                                                <iframe name='garminIFrame' style='width: 100%;'></iframe>
                                                            </div>
                                                        </div>

                                                        <script type="text/javascript">
                                                            var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
                                                            document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
                                                        </script>
                                                        <script type="text/javascript">
                                                            var pageTracker = _gat._getTracker("UA-3472506-1");
                                                            pageTracker._initData();
                                                            pageTracker._trackPageview();
                                                        </script>
                                                        </div>
                                                        </body>
                                                        </html>
