<?php
/*Jorge Muñoz García*/

    session_start();
    session_destroy();
    
    header("Location: ../index.php");
    exit();
?>