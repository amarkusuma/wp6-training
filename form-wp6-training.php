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
        echo '<input type="text" id="search" name="wp-input">' . '</input>';
        echo '</p>';

        echo '<p><input type="submit" name="submit" value="Send"></p>';
        echo '</form>';
    }

    function fomPage()
    {
        ob_start();
        $this->html_form_code();
        return ob_get_clean();
    }
}
