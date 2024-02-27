<?php

try {
    $connection = mysqli_connect("localhost", "root", "", "fakebook");
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
}

?>
