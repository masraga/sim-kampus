<?php $this->extend( "templates/default-layout" ) ?>
<?php $this->section( "content" ) ?>
<?php echo $this->include( "bendahara/templates/sidebar" ) ?>
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Dashboard</h1>
    </div>

    <div class="section-body">
      <div class="card">
        <div class="card-header"> <h4>Data tagihan mahasiswa</h4> </div>
        <div class="card-body">
          <canvas id="myChart" width="400" height="400"></canvas>
        </div>
      </div>
    </div>
  </section>
</div>

<?php $this->endSection() ?>

<?php $this->section( "custom-js" ) ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
<script type="text/javascript">

  function setChartTagihan()
  {
    fetch( `${BASE_URL}/api/mahasiswa/tagihan` )
    .then( response => response.json() )
    .then( response => {
      const lunas = response.data.filter( v =>  { return v.is_lunas == "1" } ).length;
      const unlunas = response.data.filter( v =>  { return v.is_lunas == "0" } ).length;
      
      var ctx = document.getElementById('myChart').getContext('2d');
      var myChart = new Chart(ctx, {
          type: 'doughnut',
          data: {
              labels: ['Belum Lunas', 'Lunas'],
              datasets: [{
                  label: '# of Votes',
                  data: [unlunas, lunas],
                  backgroundColor: [
                      'rgba(255, 99, 132, 0.8)',
                      'rgba(75, 192, 192, 0.8)',
                  ],
                  borderColor: [
                      'rgba(255, 99, 132, 1)',
                      'rgba(75, 192, 192, 1)',
                  ],
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  y: {
                      beginAtZero: true
                  }
              }
          }
      });
    } )
  }

  $( document ).ready( function(){
    setChartTagihan();
  } )
</script>
<?php $this->endSection() ?>