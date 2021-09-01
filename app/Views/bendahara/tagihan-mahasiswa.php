<?php $this->extend( "templates/default-layout" ) ?>

<?php $this->section( "content" ) ?>
<?php echo $this->include( "bendahara/templates/sidebar" ) ?>
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Tagihan Mahasiswa</h1>
    </div>

    <div class="section-body">
      <div class="card">
        <div class="card-header">
          <table width="50%" border="1" cellpadding="10" id="table-mahasiswa">
            <thead>
              <tr>
                <th>NIM</th>
                <th>NAMA</th>
                <th>SEMESTER SAAT INI</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
        <div class="card-body">

          <?php if( session()->getFlashdata("alert-msg") ): ?>
            <?php if( session()->getFlashdata( "alert-code" ) == 200 ): ?>
              <div class="alert alert-success"><?php echo session()->getFlashdata("alert-msg") ?></div>
            <?php else : ?>
              <div class="alert alert-danger"><?php echo session()->getFlashdata("alert-msg") ?></div>
            <?php endif; ?>
          <?php endif; ?>

          <a href="" class="btn btn-danger">Tambah Tagihan</a>
          <br>
          <br>
          <table class="table table-bordered" id="table-tagihan">
            <thead>
              <tr>
                <th>Jenis Tagihan</th>
                <th>Jumlah</th>
                <th>Batas waktu pembayaran</th>
              </tr>
            </thead>
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
    function getMahasiswa()
    {

      const query = new URLSearchParams(window.location.search);
      const nim = query.get('nim');

      fetch(`${BASE_URL}/api/mahasiswa?token=${nim}`)
      .then( response => response.json() )
      .then( response => {
        for( var data of response ) {
          $( `#table-mahasiswa > tbody` ).append(`
              <tr>
                <td>${data.nim}</td>
                <td>${data.nama}</td>
                <td>${data.semester}</td>
              </tr>
          `);
        }
      } )
    }
    $(document).ready( function(e) {
      getMahasiswa();
    } )
  </script>
<?php $this->endSection() ?>