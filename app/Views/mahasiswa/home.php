<?php $this->extend( "templates/default-layout" ) ?>
<?php $this->section( "content" ) ?>
<?php echo $this->include( "mahasiswa/templates/sidebar" ) ?>
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Dashboard</h1>
    </div>

    <div class="section-body">
      
      <!-- tambahkan data disini -->


    </div>
  </section>
</div>

<?php $this->endSection() ?>

<?php $this->section( "custom-js" ) ?>

<script type="text/javascript">

</script>

<?php $this->endSection() ?>