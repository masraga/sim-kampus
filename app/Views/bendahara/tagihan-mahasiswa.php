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

          <a href="<?php echo base_url("/bendahara/tagihan/new") ?>" class="btn btn-danger">Tambah Tagihan</a>
          <br>
          <br>
          <table class="table" border="1" id="table-tagihan">
            <thead>
              <tr>
                <th>Jenis Tagihan</th>
                <th>Jumlah</th>
                <th>Batas waktu pembayaran</th>
                <th>Lunas</th>
                <th>Action</th>
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
    const query = new URLSearchParams(window.location.search);
    const nim = query.get('nim');

    // get data mahasiswa
    function getMahasiswa()
    {
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

    // mengambil list data tagihan mahasiswa
    function getTagihan()
    {
      fetch( `${BASE_URL}/api/mahasiswa/tagihan?token=${nim}` )
      .then( response => response.json() )
      .then( response => {
        for( let dataset of response.data ){

          let lunasEl = "";

          if( response.data.is_lunas ) {
            lunasEl = `<div class="text-success font-weight-bold">Lunas</div>`
          }
          else {
            lunasEl = `<div class="text-danger font-weight-bold">Belum</div>`
          }

          $("#table-tagihan > tbody").append(`
            <tr>
              <td>${dataset.jenis_tagihan}</td>
              <td>${dataset.jumlah_tagihan}</td>
              <td>${dataset.tanggal_batas}</td>
              <td>${lunasEl}</td>
              <td>
                <a 
                  href="javascript:void(0)" 
                  id="btn-hapus-tagihan" 
                  id-tagihan="${dataset.id_tagihan}"
                  nim-mahasiswa="${dataset.nim_mahasiswa}"
                  class="btn btn-danger">Hapus</a>

                <a 
                  href="${BASE_URL}/bendahara/mahasiswa/tagihan/edit?token=${dataset.nim_mahasiswa}&bill=${dataset.id_tagihan}" 
                  class="btn btn-warning">Edit</a>
              </td>
            </tr>
          `);
        }

        $( document ).on( "click", "#btn-hapus-tagihan", function(e){
          e.preventDefault();

          const token     = $(this).attr(`nim-mahasiswa`);
          const tagihan   = $(this).attr(`id-tagihan`);
          const redirect  = `${BASE_URL}/api/bendahara/tagihan/${tagihan}/mahasiswa/${token}/delete`;

          if( confirm( "Hapus tagihan ini ?" ) ) {
            window.location = redirect;
          }
        } )
      } )
    }
    $(document).ready( function(e) {
      getMahasiswa();
      getTagihan();
    } )
  </script>
<?php $this->endSection() ?>