<?php

$autocomplite = new Autocomplite();
add_shortcode('wp6_training', [$autocomplite, 'fomPage']);


class Autocomplite
{

    function html_form_code()
    {

        echo '<form action="' . esc_url($_SERVER['REQUEST_URI']) . '" method="post">';
        echo '<p>';
        echo 'Input Data <br/>';
        echo '<input type="text" id="search" name="wp-input" value="' . (isset($_POST["wp-input"]) ? esc_attr($_POST["wp-input"]) : '') . '" />';
        echo '</p>';

        echo '<p><input type="submit" name="submit" value="Send"></p>';
        echo '</form>';
    }

    function send()
    {

        if (isset($_POST['submit'])) {
            global $wpdb;

            $input = isset($_POST['wp-input']) ? sanitize_text_field($_POST['wp-input']) : '';
            $search = $wpdb->esc_like($input);
            $loop = new WP_Query(array(
                's' => $search,
                'posts_per_page' => '5',
            ));
            while ($loop->have_posts()) {
                $loop->the_post();
                $items = get_the_title();
                $data = json_encode($items);
                echo "<p>$data</p>";
            }
        }
    }

    function fomPage()
    {
        ob_start();
        $this->send();
        $this->html_form_code();
        return ob_get_clean();
    }
}
