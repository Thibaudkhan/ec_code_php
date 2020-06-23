<?php ob_start(); ?>

<div class="landscape">
  <div class="bg-black">
    <div class="row no-gutters">
      <div class="col-md-6 full-height bg-white">
        <div class="auth-container">
          <h1>Hello</h1>
        </div>
      </div>
      <div class="col-md-6 full-height">
        <div class="auth-container">
          <h1>Heureux de vous revoir !</h1>
        </div>
      </div>
    </div>
  </div>
</div>


<?php $content = ob_get_clean(); ?>

<?php require( __DIR__ . '/../base.php'); ?>
