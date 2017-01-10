<?php
class WPW_REST_Controller {

    // Here initialize our namespace and resource name.
    public function __construct() {
        $this->namespace     = '/wpw/1';
        $this->resource_name = 'rsvp';
    }

    // Register our routes.
    public function register_routes() {
        register_rest_route( $this->namespace, '/' . $this->resource_name, array(
            array(
                'methods'   => 'POST',
                'callback'  => array( $this, 'post_rsvp' ),
            ),
        ) );
    }

    public function post_rsvp($request) {
        $message = "New RSVP\n";

        $guests = $_REQUEST['guest'];
        $diets = $_REQUEST['diet'];
        $events = $_REQUEST['event'];

        $count = 0;
        foreach ($guests as $guest) {
            $guest = $count+1;
            $message .= "
Guest {$guest}: {$guests[$count]}
Diet: {$diets[$count]}
Event: {$events[$count]}\n";
            $count++;
        }

        $message .= "
Email: {$_REQUEST['email']}
Phone: {$_REQUEST['phone']}
Message: {$_REQUEST['message']}";

        $headers = '';
        $attachments = array();

        wp_mail(get_option('admin_email'), 'RSVP', $message, $headers, $attachments);

        //$request->data = $message;
        $response = new WP_REST_Response($request);
        $response->set_status(201);
        return $response;
    }

}

// Function to register our new routes from the controller.
function wpw_register_rest_routes() {
    $controller = new WPW_REST_Controller();
    $controller->register_routes();
}

add_action( 'rest_api_init', 'wpw_register_rest_routes' );
