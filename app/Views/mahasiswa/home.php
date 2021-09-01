<?php $this->extend( "templates/default-layout" ) ?>
<?php $this->section( "content" ) ?>
<?php echo $this->include( "mahasiswa/templates/sidebar" ) ?>
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Dashboard</h1>
    </div>

    <div class="section-body">
      <div class="card">
        <div class="card-header">
          <h4>Data tagihan kamu</h4>
        </div>
        <div class="card-body">
          <h4>Tagihan Lunas</h4>
          <table class="table" border="1" id="table-lunas">
            <thead>
              <tr>
                <th>Semester</th>
                <th>Jenis Tagihan</th>
                <th>Jumlah Tagihan</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>

          <br>
          <br>

          <h4>Tagihan Belum Lunas</h4>
          <table class="table" border="1" id="table-unlunas">
            <thead>
              <tr>
                <th>Semester</th>
                <th>Jenis Tagihan</th>
                <th>Jumlah Tagihan</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>

        </div>
      </div>
    </div>
  </section>
</div>

<?php $this->endSection() ?>

<?php $this->section( "custom-js" ) ?>

<script type="text/javascript">
  
  // mengambil list data tagihan mahasiswa
  function getTagihan()
  {
    fetch( `${BASE_URL}/api/mahasiswa/tagihan?use-email=true` )
    .then( response => response.json() )
    .then( response => {
      for( let data of response.data ) {
        const isLunas = Boolean( Number( data.is_lunas ) );
        if( isLunas ) {
          $( `#table-lunas > tbody` ).append(`
            <tr>
              <td>${data.mahasiswa_semester}</td>
              <td>${data.jenis_tagihan}</td>
              <td>${data.jumlah_tagihan}</td>
            </tr>
          `);
        }
        else {
          $( `#table-unlunas > tbody` ).append(`
            <tr>
              <td>${data.mahasiswa_semester}</td>
              <td>${data.jenis_tagihan}</td>
              <td>${data.jumlah_tagihan}</td>
              <td><a href=>hapus</a></td>
            </tr>
          `);
        }
      }
    } )
  }

  $(document).ready( function(e) {
    getTagihan();
  } )
</script>

<?php $this->endSection() ?>