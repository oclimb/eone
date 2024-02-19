<!DOCTYPE html>
<html lang="en">

<?php require_once 'head.php';
?>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/networkgraph.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php require_once 'header.php'; ?>
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          <div class="col-md-12 grid-margin">
            <div class="row">
              <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <?php
                if (isset($_SESSION['MSG'])) {
                  echo $_SESSION['MSG'] . "<br>";
                  unset($_SESSION['MSG']);
                }
                ?>

                <h3 class="font-weight-bold">Welcome <?php echo $accountName; ?></h3>
              </div>
              <div class="col-12 col-xl-4">
                <div class="justify-content-end d-flex">
                  <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                    <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                      <!--<i class="mdi mdi-calendar"></i> Today (10 Jan 2021)-->
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <!-- <p class="card-title">Students</p> -->
                <div class="row">
                  <div class="col-12">


                    <figure class="highcharts-figure">
                      <div id="container"></div>

                    </figure>


                  </div>
                </div>
              </div>
            </div>


          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
      <!-- partial:partials/_footer.html -->
      <?php require_once 'footer.php'; ?>
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <script>
    // Add the nodes option through an event call. We want to start with the parent
    // item and apply separate colors to each child element, then the same color to
    // grandchildren.
    Highcharts.addEvent(
      Highcharts.Series,
      'afterSetOptions',
      function(e) {

        const colors = Highcharts.getOptions().colors,
          nodes = {};

        let i = 0;

        if (
          this instanceof Highcharts.Series.types.networkgraph &&
          e.options.id === 'lang-tree'
        ) {
          e.options.data.forEach(function(link) {

            if (link[0] === 'ADMIN') {
              nodes['ADMIN'] = {
                id: 'ADMIN',
                marker: {
                  radius: 20
                }
              };
              nodes[link[1]] = {
                id: link[1],
                marker: {
                  radius: 10
                },
                color: colors[i++]
              };
            } else if (nodes[link[0]] && nodes[link[0]].color) {
              nodes[link[1]] = {
                id: link[1],
                color: nodes[link[0]].color
              };
            }
          });

          e.options.nodes = Object.keys(nodes).map(function(id) {
            return nodes[id];
          });
        }
      }
    );

    Highcharts.chart('container', {
      chart: {
        type: 'networkgraph',
        height: '80%'
      },
      title: {
        text: '',
        align: 'left'
      },
      credits: {
        enabled: false
      },
      plotOptions: {
        networkgraph: {
          keys: ['from', 'to'],
          layoutAlgorithm: {
            enableSimulation: true,
            friction: -0.9
          }
        }
      },
      series: [{
        accessibility: {
          enabled: false
        },
        dataLabels: {
          enabled: true,
          linkFormat: '',
          style: {
            fontSize: '0.8em',
            fontWeight: 'normal'
          }
        },
        id: 'lang-tree',
        data: <?php echo $user_function->getAdminNetwork(); ?>
      }]
    });
  </script>

</body>

</html>