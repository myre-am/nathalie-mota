<!-- Modale de contact -->

<div id="myModal" class="modal">
  <div class="modal-content">
    <img class="header-contact" src="<?php echo get_template_directory_uri() . '/assets/images/header_contact.png'; ?>" alt="Header du formulaire de contact">
    
    <span id="close"></span>
    
    <?php
  
    echo do_shortcode('[contact-form-7 id="2ea860b" title="Contact"]');
    ?>
    </div>
  </div>

</div>