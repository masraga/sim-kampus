<?php $this->extend( "templates/default-layout" ) ?>

<?php $this->section( "content" ) ?>
<?php echo $this->include( "bendahara/templates/sidebar" ) ?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Tambah Tagihan</h1>
          </div>

          <div class="section-body">
            <form method="post" id="form-tambah-tagihan">
              <div class="form-group">
                <label for="nim-list">Nim - Nama</label>
                <select class="form-control" id="nim-list">
                </select>
              </div>

              <div class="form-group">
                <label for="jenis">Jenis Tagihan</label>
                <input type="text" name="jenis" class="form-control" id="jenis" required="">
              </div>

              <div class="form-group">
                <label for="jumlah">Jumlah Tagihan</label>
                <input type="text" name="jumlah" class="form-control" id="jumlah" required="">
              </div>

              <div class="form-group">
                <label for="tanggal_batas">Batas Waktu Pembayaran</label>
                <input type="date" name="tanggal_batas" class="form-control" id="tanggal_batas" required="">
              </div>


              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                  Tambah Tagihan
                </button>
              </div>
            </form>
          </div>
        </section>
      </div>
      
    </div>
  </div>
<?php $this->endSection() ?>

<?php $this->section( "custom-js" ) ?>
  <script type="text/javascript">
    
    function getMahasiswa()
    {
      fetch(`${BASE_URL}/api/mahasiswa`)
      .then( response => response.json() )
      .then( response => {
        for( var data of response ) {
          $( `#nim-list` ).append( `<option value="${data.nim}">${data.nim} - ${data.nama}</option>` )
        }
      } )
    }

    function tambahTagihan()
    {
      $(`#form-tambah-tagihan`).submit( function(e) {
        e.preventDefault();
      } )
    }

    $( document ).ready( function(){
      getMahasiswa();
    } )
  </script>
<?php $this->endSection() ?>