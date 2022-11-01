<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('dashboard') ?>

<div class="container">
    <div class="row pt-3">
            <h4> <?= $title?> </h4>
            <hr>
        </div>
    </div>
</div>
<?php 
    while($item = mysqli_fetch_array($retorno)){
        $data[] = $item;
    }

    print_r($data);
?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        let rows=[
          ['Date', 'input', 'output'],
          <?php
            $rows="";
            foreach($data AS $item){
                $rows.="['{$item['date']}',{$item['input']} ,{$item['output']}],";
            }
            ?>
         
        ];
        
        var data = google.visualization.arrayToDataTable([
          ['Date', 'input', 'output'],
          <?php  echo substr($rows, 0, -1); ?>
          
        ]);

        var options = {
          title: 'Moviments',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
    <div id="curve_chart" style="width:90vwpx; height:60vh"></div>

<?= $this->endSection() ?>