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
        <div class="card-header">
          <h4>Data mahasiswa</h4>
        </div>
        <div class="card-body">
          <table width="100%" class="table" border="1" id="table-mahasiswa">
            <thead>
              <tr>
                <th>NIM</th>
                <th>NAMA</th>
                <th>SEMESTER</th>
                <th>ACTION</th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>

<?php $this->endSection() ?>

<?php $this->section( "custom-js" ) ?>

<script type="text/javascript">
  // get data mahasiswa
  $(document).ready( function(e) {
    fetch(`${BASE_URL}/api/mahasiswa`)
    .then( response => response.json() )
    .then( response => {
      for( var data of response ) {
        $( `#table-mahasiswa > tbody` ).append(`
            <tr>
              <td>${data.nim}</td>
              <td>${data.nama}</td>
              <td>${data.semester}</td>
              <td>
                <a href="${BASE_URL}/bendahara/tagihan/mahasiswa?nim=${data.nim}" class="btn btn-primary">Lihat tagihan</a>
              </td>
            </tr>
        `);
      }
    } )
  } )
</script>
<?php $this->endSection() ?>