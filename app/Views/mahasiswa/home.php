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

<div class="modal" tabindex="-1" id="modal-tagihan" role="dialog">
  <div class="modal-dialog" role="document">
    <form id="form-bayar-tagihan">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Form Tagihan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <input type="hidden" name="id">
          <input type="hidden" name="token">

          <div class="form-group">
            <label for="">Tagihan semeseter</label>
            <input type="text" name="semester" class="form-control" disabled="">
          </div>
          <div class="form-group">
            <label for="">Jenis Tagihan</label>
            <input type="text" name="jenis" class="form-control" disabled="">
          </div>
          <div class="form-group">
            <label for="">Jumlah tagihan</label>
            <input type="text" name="jumlah" class="form-control" disabled="">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Bayar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
    </div>
  </div>
</div>

<?php $this->endSection() ?>

<?php $this->section( "custom-js" ) ?>

<script type="text/javascript">
  
  // mengambil list data tagihan mahasiswa
  async function getTagihan()
  {
    const f = await fetch( `${BASE_URL}/api/mahasiswa/tagihan?use-email=true` )
    
    return await f.json();
  }

  /**
   * menampilkan data table tagihan baik yang sudah lunas
   * ataupun belum lunas
   */
  function setTableTagihan()
  {
    getTagihan()
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
              <td>
                <a 
                  href="javascript:void(0)" 
                  class="btn btn-success btn-bayar-tagihan"
                  id="${data.id_tagihan}"
                  token="${data.nim_mahasiswa}">Bayar</a>
              </td>
            </tr>
          `);
        }
      }
    } )
  }

  /**
   * menampilkan form detail tagihan yang akan dibayar
   *
   * @param string id         id tagihan
   * @param string token      nim mahasiswa
   */
  function setFormTagihan( id, token )
  {
    getTagihan()
    .then( response => {
      let usedData = {};

      for( let dataset of response.data ) {
        if( dataset.id_tagihan == id && dataset.nim_mahasiswa == token ) {
          usedData = dataset;
          break;
        }
      }

      const modal = $("#modal-tagihan");

      $( `[name="id"]` ).val( usedData.id_tagihan );
      $( `[name="token"]` ).val( usedData.nim_mahasiswa );
      $( `[name="semester"]` ).val( usedData.mahasiswa_semester );
      $( `[name="jenis"]` ).val( usedData.jenis_tagihan );
      $( `[name="jumlah"]` ).val( usedData.jumlah_tagihan );

      modal.modal( "show" );

      submitPayment();

    } )
  }

  function submitPayment()
  {
    $(`form#form-bayar-tagihan`).submit( function( e ) {
      e.preventDefault();
        
      $(this).find( `[type="submit"]` ).text("Loading...");

      fetch( `${BASE_URL}/api/mahasiswa/tagihan/bayar`, {
        method : "POST",
        body   : $(this).serialize(),
        mode : "cors",
        headers : {
          "Content-Type" : "application/x-www-form-urlencoded",
          "X-Requested-With": "XMLHttpRequest"
        } 
      } )
      .then( response => response.json() )
      .then( response => {
        alert( response.msg )
        window.location.reload()
      } )
    } )
  }

  /**
   * menampilkan form pembayaran tagihan jika
   * tombol bayar di klik
   */
  function showPayBillForm()
  {
    $( document ).on( "click", ".btn-bayar-tagihan", function(){
      const id = $(this).attr( "id" );
      const token = $(this).attr( "token" );

      setFormTagihan( id, token );
    } )
  }

  $(document).ready( function(e) {
    setTableTagihan();
    showPayBillForm();
  } )
</script>

<?php $this->endSection() ?>