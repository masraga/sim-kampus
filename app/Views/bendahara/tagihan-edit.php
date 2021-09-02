<?php $this->extend( "templates/default-layout" ) ?>

<?php $this->section( "content" ) ?>
<?php echo $this->include( "bendahara/templates/sidebar" ) ?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Edit Tagihan</h1>
          </div>

          <div class="section-body">

            <?php if( session()->getFlashdata("alert-msg") ): ?>
              <?php if( session()->getFlashdata( "alert-code" ) == 200 ): ?>
                <div class="alert alert-success"><?php echo session()->getFlashdata("alert-msg") ?></div>
              <?php else : ?>
                <div class="alert alert-danger"><?php echo session()->getFlashdata("alert-msg") ?></div>
              <?php endif; ?>
            <?php endif; ?>

            <form method="post" action="<?php echo base_url("/api/mahasiswa/tagihan/update") ?>" id="form-edit-tagihan">
              <input type="hidden" name="id_tagihan">

              <div class="form-group">
                <label for="nim-list">Nim - Nama</label>
                <input type="text" name="nim" class="form-control" readonly="">
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
                <input type="date" name="tanggal_batas" class="form-control" id="tanggal_batas">
              </div>

              <div class="form-group">
                <label for="tanggal_batas">Status</label>
                <select name="is_lunas" class="form-control" required="">
                  <option value="0">Belum Lunas</option>
                  <option value="1">Lunas</option>
                </select>
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
  const query = new URLSearchParams(window.location.search);
  const token = query.get('token');
  const bill = query.get('bill');

  /**
   * mengambil data tagihan dari database
   */
  async function dataTagihan()
  {
    const f = await fetch( `${BASE_URL}/api/mahasiswa/tagihan?token=${token}&bill=${bill}` )

    return await f.json();
  }

  /**
   * mengisi default inputan pada form
   */
  async function fillForm()
  {
    const tagihan = await dataTagihan();
    
    const form = $( "#form-edit-tagihan" );

    form.find( `[name="id_tagihan"]` ).val( tagihan["data"][0]["id_tagihan"] );
    form.find( `[name="nim"]` ).val( tagihan["data"][0]["nim_mahasiswa"] );
    form.find( `[name="jenis"]` ).val( tagihan["data"][0]["jenis_tagihan"] );
    form.find( `[name="jumlah"]` ).val( tagihan["data"][0]["jumlah_tagihan"] );
  }

  $( document ).ready( function() {
    fillForm();
  } )

</script>
  
<?php $this->endSection() ?>