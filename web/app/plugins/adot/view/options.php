<div>
  <?php screen_icon(); ?>
  <h1>aDot Seal Settings</h1>
  <form method="post" action="options.php">
      <?php
      settings_fields("adot-settings-section");
      do_settings_sections("adot-settings-options");
      submit_button();
      ?>
  </form>
</div>
