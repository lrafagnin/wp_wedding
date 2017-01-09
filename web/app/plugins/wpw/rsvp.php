<?php

function wpw_register_strings() {
   $form = array(
	   "Your details",
	   "Full name",
	   "Special dietary",
	   "Select events",
	   "Reception & Brunch",
	   "Reception",
	   "Apologies, I will not be able to attend",
       "Add guest",
	   "Guest details",
	   "Guest name",
	   "Your email",
	   "Your phone",
	   "Your message",
	   "Send confirmation",
       "Thank you for confirmation. We are super excited to see you there!",
       "An error occured. Please try again.",
   );
   foreach ($form as $item) {
	   pll_register_string('wpw', $item, 'form', false);
   }
}
add_action('admin_init', 'wpw_register_strings');
