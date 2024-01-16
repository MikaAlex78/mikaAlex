<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gazetteer</title>
  <link rel="icon" href="./favicon.ico" type="image/x-icon">

  <link rel="stylesheet" href="assets/vendors/bootstrap-5.3.2-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/vendors/Leaflet.EasyButton-master/src/easy-button.css">
  <link rel="stylesheet" href="assets/vendors/leaflet/leaflet.css">
  <link rel="stylesheet" href="assets/vendors/Leaflet.markercluster-1.4.1/dist/MarkerCluster.css">
  <link rel="stylesheet" href="assets/vendors/Leaflet.markercluster-1.4.1/dist/MarkerCluster.Default.css">
  <link rel="stylesheet" href="assets/vendors/fontawesome-free-5.15.2-web/css/all.min.css">
  <link rel="stylesheet" href='https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.css' />
  <!-- <link rel="stylesheet" href="https://cdn.maptiler.com/mapbox-gl-js/v1.5.1/mapbox-gl.css" /> -->
  <link rel="stylesheet" href="assets/css/leafletMainStyle.css">

  <link rel="stylesheet" href="assets/vendors/" />
  <script src="https://unpkg.com/leaflet-extra-markers@1.0.0/dist/js/leaflet.extra-markers.min.js"></script>
  <!-- Leaflet.awesome-markers CSS -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.awesome-markers/2.0.2/leaflet.awesome-markers.css" /> -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script> -->
</head>

<body>

  <!-- <header>
   
  </header> -->

  <div id="loading">
    <div id="loading-img">
      <img src="assets\img\loading.gif" />
      <p>Loading...</p>
    </div>
  </div>

  <div id="map" class=" position-relative text-center">
    <div class="container-fluid position-absolute d-flex align-items-center justify-content-center" style="top: 0;
      z-index: 99999;
      background-color:transparent; /* Add background color if needed */
      padding: 10px;">
      <form class="d-flex align-items-end">
        <select name="sel-country" id="selCountry" class="form-select" aria-label="Select Country" style="width:auto;"></select>
      </form>
    </div>
    <script>
      $(document).ready(function() {
        var map = L.map('map').setView([51.505, -0.09], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var greenIcon = L.AwesomeMarkers.icon({
          icon: 'coffee', // Font Awesome icon name (without the 'fa-' prefix)
          markerColor: 'red', // Marker color
          prefix: 'fa' // Use Font Awesome icons
        });

        L.marker([51.508, -0.11], {
          icon: greenIcon
        }).addTo(map);
      });
    </script>

  </div>

  <!--Wikipedia Modal -->
  <div class="modal fade" id="wikiModal" tabindex="-1" aria-labelledby="wikiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title" id="wikiModalLabel"></h5>
        </div>
        <div class="modal-body">
          <table id="countryInfoTable" class="table">
            <div id="txtWikiImg"></div>
            <tbody>
              <tr>
                <th scope="row">Population:</th>
                <td id="txtPopulation"></td>
              </tr>
              <tr>
                <th scope="row">Capital:</th>
                <td id="txtCapital"></td>
              </tr>
              <tr>
                <th scope="row">Language(s):</th>
                <td id="txtLanguages"></td>
              </tr>
              <tr>
                <th scope="row">Demonym:</th>
                <td id="txtDemonym"></td>
              </tr>
              <tr>
                <th scope="row">Area:</th>
                <td id="txtArea"></td>
              </tr>
              <tr>
                <th scope="row">ISO2 Country Code:</th>
                <td id="txtIso2"></td>
              </tr>
              <tr>
                <th scope="row">ISO3 Country Code:</th>
                <td id="txtIso3"></td>
              </tr>
              <tr>
                <th scope="row">Calling Code:</th>
                <td id="txtCallingCode"></td>
              </tr>
              <tr>
                <th scope="row">Country Domain:</th>
                <td id="txtDomain"></td>
              </tr>
            </tbody>
          </table>
          <div id="txtWiki"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary closeBtn" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!--Covid Modal -->
  <div class="modal fade" id="covidModal" tabindex="-1" aria-labelledby="covidModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-info text-center">
          <h5 class="modal-title" id="covidModalLabel">Covid Info</h5>

        </div>
        <div class="modal-body short-modal">
          <table id="covidTable" class="table">
            <tbody>
              <tr>
                <th scope="row">Cases:</th>
                <td id="txtCovidCases"></td>
              </tr>
              <tr>
                <th scope="row">Recovered:</th>
                <td id="txtCovidRecovered"></td>
              </tr>
              <tr>
                <th scope="row">Deaths:</th>
                <td id="txtCovidDeaths"></td>
              </tr>
              <tr>
                <th scope="row">Population:</th>
                <td id="txtCovidPerMillion"></td>
              </tr>
              <tr>
                <th scope="row">Cases Per Million:</th>
                <td id="txtCovidDeathRate"></td>
              </tr>
              <tr>
                <th scope="row">Recovered Per Million:</th>
                <td id="txtCovidRecoveryRate"></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary closeBtn" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


  <!--Weather Modal -->
  <div id="weatherModal" class="modal fade" tabindex="-1" data-bs-backdrop="false" data-bs-keyboard="false" aria-labelledby="weatherModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content shadow">
        <div class="modal-header bg-primary bg-gradient text-white">

          <h5 class="modal-title" id="weatherModalLabel"></h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>

        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col border m-2">
              <p class="fw-bold fs-5 mt-1">TODAY</p>

              <div class="row">

                <div class="col text-center m-3">

                  <p id="todayConditions" class="fw-bold fs-6"></p>

                </div>

                <div class="col text-center">

                  <img id="todayIcon" class="img-fluid mt-0" src="" alt="" title="">

                </div>

                <div class="col text-center">

                  <p class="fw-bold fs-4 mb-0"><span id="todayMaxTemp"></span><sup>o</sup><span class="tempMetric">c</span></p>
                  <p class="fs-5 mt-0 text-secondary"><span id="todayMinTemp">0</span><sup>o</sup><span class="tempMetric">c</span></p>

                </div>

              </div>

            </div>

          </div>

          <div class="row">
            <div class="col border m-2">
            <p id="NextDate" class="fw-bold fs-5 mt-1"> Next Day</p>

              <div class="row">

                <div class="col text-center m-3">

                  <p id="nextdayConditions" class="fw-bold fs-6"></p>

                </div>

                <div class="col text-center">
                  <img id="nextIcon" class="img-fluid mt-0" src="" alt="" title="">

                </div>

                <div class="col text-center">

                  <p class="fw-bold fs-4 mb-0"><span id="nextMaxTemp"></span><sup>o</sup><span class="tempMetric">c</span></p>
                  <p class="fs-5 mt-0 text-secondary"><span id="nextMinTemp">0</span><sup>o</sup><span class="tempMetric">c</span></p>

                </div>

              </div>

            </div>

          </div>

          <div class="row">
            <div class="col border m-2">
              <div class="row">
                <div class="col text-center">
                  <p id="day1Date" class="fw-bold fs-6 mt-3"></p>
                </div>
              </div>
              <div class="row">
                <div class="col text-center">
                  <p class="fw-bold fs-4 mb-0"><span id="day1MaxTemp"></span><sup>o</sup>c</p>
                  <p class="fs-5 mt-0 text-secondary"><span id="day1MinTemp"></span><sup>o</sup>c</p>
                </div>
                <div class="col text-center">
                  <img id="day1Icon" src="" alt="" title="">
                </div>
              </div>
            </div>

            <div class="col border m-2">
              <div class="row">
                <div class="col text-center">
                  <p id="day2Date" class="fw-bold fs-6 mt-3"></p>
                </div>
              </div>
              <div class="row">
                <div class="col text-center">
                  <p class="fw-bold fs-4 mb-0"><span id="day2MaxTemp"></span><sup>o</sup>c</p>
                  <p class="fs-5 mt-0 text-secondary"><span id="day2MinTemp"></span><sup>o</sup>c</p>
                </div>

                <div class="col text-center">

                  <img id="day2Icon" src="" alt="" title="">

                </div>

              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <p class="fs-6 fw-light">Last updated <span id="lastUpdated"></span></p>
        </div>
      </div>
    </div>
  </div>
<!-- ============================================================================================= -->
<div id="BBcNews" class="modal fade" tabindex="-1" data-bs-backdrop="false" data-bs-keyboard="false" aria-labelledby="BBcNewsLabel" aria-hidden="true">
  
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content shadow"> 
      <div class="modal-header bg-danger bg-gradient text-white">
        <h5 class="modal-title">BREAKING NEWS</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <!-- first item -->          
        <table class="table table-borderless">
          <tr>
            <td rowspan="2" width="50%">
              <img class="img-fluid rounded" src="https://ichef.bbci.co.uk/news/240/cpsprodpb/14498/production/_130069038_gettyimages-519726116.jpg" alt="" title="">
            </td>
            <td>
              <a href="https://www.bbc.co.uk/news/entertainment-arts-65881813" class="fw-bold fs-6 text-black" target="_blank">Sir Paul McCartney says AI has enabled a 'final' Beatles song</a>
            </td>
          </tr>
          <tr>
            <td class="align-bottom pb-0">
              <p class="fw-light fs-6 mb-1">BBC News</p>
            </td>            
          </tr>
        </table>
        <hr>
        <!-- second item -->
        <table class="table table-borderless mb-0">       
          <tr>
            <td rowspan="2" width="50%">
              <img class="img-fluid rounded" src="https://ichef.bbci.co.uk/news/240/cpsprodpb/669D/production/_130096262_img_5432.jpg" alt="" title="">
            </td>
            <td>
              <a href="https://www.bbc.co.uk/news/uk-scotland-glasgow-west-65894201" class="fw-bold fs-6 text-black" target="_blank">Parents 'devastated' as blunder leaves village 1,000 school places short</a>
            </td>
          </tr>
          <tr>
            <td class="align-bottom pb-0">
              <p class="fw-light fs-6 mb-1">BBC News</p>
            </td>
          </tr>
        </table> 
        <hr>
        <!-- third item -->
        <table class="table table-borderless mb-0">       
          <tr>
            <td rowspan="2" width="50%">
              <img class="img-fluid rounded" src="https://ichef.bbci.co.uk/news/240/cpsprodpb/1084B/production/_130095676_p0fv8hdd.jpg" alt="" title="">
            </td>
            <td>
              <a href="https://www.bbc.co.uk/news/av/world-australia-65912350" class="fw-bold fs-6 text-black" target="_blank">Watch: Tourist fights off feisty kangaroo in Australia</a>
            </td>
          </tr>
          <tr>
            <td class="align-bottom pb-0">
              <p class="fw-light fs-6 mb-1">BBC News</p>
            </td>            
          </tr>          
        </table>         
        <hr>
        <!-- fourth item -->
        <table class="table table-borderless mb-0">       
          <tr>
            <td rowspan="2" width="50%">
              <img class="img-fluid rounded" src="https://ichef.bbci.co.uk/news/240/cpsprodpb/419D/production/_130079761_whatsubject.jpg" alt="" title="">
            </td>
            <td>
              <a href="https://www.bbc.co.uk/news/business-65861096" class="fw-bold fs-6 text-black" target="_blank">Is the US trying to kill crypto?</a>
            </td>
          </tr>
          <tr>
            <td class="align-bottom pb-0">
              <p class="fw-light fs-6 mb-1">BBC News</p>
            </td>            
          </tr>          
        </table>    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- ============================================================================================= -->

<div class="container">
<div id="currencyModal" class="modal fade" tabindex="-1" data-bs-backdrop="false" data-bs-keyboard="false" aria-labelledby="currencyModalLabel" aria-hidden="true">


  <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content shadow">
      <div class="modal-header bg-secondary bg-gradient text-white">
        <h5 class="modal-title">Currency calculator</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body h-100">
        <form>
          <div class="form-floating mb-2">
            <input id="fromAmount" type="number" class="form-control" value="1" min="1" step="1">
            <label>From USD</label>
          </div>
          <div class="form-floating mb-2">
            <select id="exchangeRate" class="form-select">
              <option value='300.44825'>Argentine Peso</option>
              <option value='1.913594'>Australian Dollar</option>
              <option value='0.470535'>Bahraini Dinar</option>
              <option value='17.225451'>Botswana Pula</option>
              <option value='6.307207'>Brazilian Real</option>
              <option value='1.688601'>Bruneian Dollar</option>
              <option value='2.282091'>Bulgarian Lev</option>
              <option value='1.692578'>Canadian Dollar</option>
              <option value='1009.438823'>Chilean Peso</option>
              <option value='8.888399'>Chinese Yuan Renminbi</option>
              <option value='5528.940329'>Colombian Peso</option>
              <option value='27.636701'>Czech Koruna</option>
              <option value='8.689852'>Danish Krone</option>
              <option value='4.595847'>Emirati Dirham</option>
              <option value='1.166815'>Euro</option>
              <option value='9.801109'>Hong Kong Dollar</option>
              <option value='432.709138'>Hungarian Forint</option>
              <option value='174.678675'>Icelandic Krona</option>
              <option value='103.081588'>Indian Rupee</option>
              <option value='18669.170443'>Indonesian Rupiah</option>
              <option value='52925.669587'>Iranian Rial</option>
              <option value='4.688887'>Israeli Shekel</option>
              <option value='173.774594'>Japanese Yen</option>
              <option value='561.809857'>Kazakhstani Tenge</option>
              <option value='0.384916'>Kuwaiti Dinar</option>
              <option value='6.039288'>Libyan Dinar</option>
              <option value='5.773178'>Malaysian Ringgit</option>
              <option value='57.582621'>Mauritian Rupee</option>
              <option value='21.994095'>Mexican Peso</option>
              <option value='165.007852'>Nepalese Rupee</option>
              <option value='2.072121'>New Zealand Dollar</option>
              <option value='13.935341'>Norwegian Krone</option>
              <option value='0.481775'>Omani Rial</option>
              <option value='356.775593'>Pakistani Rupee</option>
              <option value='70.206283'>Philippine Peso</option>
              <option value='5.291117'>Polish Zloty</option>
              <option value='4.555176'>Qatari Riyal</option>
              <option value='5.793038'>Romanian New Leu</option>
              <option value='101.307599'>Russian Ruble</option>
              <option value='4.692832'>Saudi Arabian Riyal</option>
              <option value='1.688601'>Singapore Dollar</option>
              <option value='24.619532'>South African Rand</option>
              <option value='1649.696284'>South Korean Won</option>
              <option value='369.011498'>Sri Lankan Rupee</option>
              <option value='13.603793'>Swedish Krona</option>
              <option value='1.13769'>Swiss Franc</option>
              <option value='38.436967'>Taiwan New Dollar</option>
              <option value='43.351356'>Thai Baht</option>
              <option value='8.476306'>Trinidadian Dollar</option>
              <option value='26.057917'>Turkish Lira</option>
              <option value='1.251422'>US Dollar</option>
            </select>
            <label for="exchangeRate">Convert to</label>
          </div>
          <div class="form-floating">
            <input id="toAmount" type="text" class="form-control" disabled>
            <label for="toAmount">Result</label>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary btn-sm myBtn" data-bs-dismiss="modal">CLOSE</button>
      </div>
    </div>
  </div>
</div>

  <div id="overlay"></div>


  <script src="assets/vendors/jquery-3.5.1.min.js"></script>
  <script src="assets/vendors/bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
  <script src="assets/vendors/leaflet/leaflet.js"></script>
  <script src="assets/vendors/Leaflet.EasyButton-master/src/easy-button.js"></script>
  <script src="assets/vendors/Leaflet.markercluster-1.4.1/dist/leaflet.markercluster.js"></script>
  <script src="assets/mapbox-gl-leaflet/leaflet-mapbox-gl.js"></script>
  <script src="https:/api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.js"></script>
  <!-- <script src="https://cdn.maptiler.com/mapbox-gl-leaflet/latest/leaflet-mapbox-gl.js"></script> -->
  <script src="assets/js/leafletApp.js"></script>
 


</body>

</html>