<?php

namespace App\Helpers;

class Common {
    public static function alertAndRedirect(string $message, $url) {
        echo "<script>
                alert('" . addslashes($message) . "');
                window.location.href = '" . addslashes($url) . "';
              </script>";
        exit;
    }
}
