<?php
    /*======
        function: complain_and_exit : string -> void

        purpose: expects a string saying what should have been
            entered that wasn't, and responds with a complaint
            screen making that complaint, and destroying 
            the current session and giving a form so the
            user can try again

        requires: 328footer.html, build_mini_form.php

        last modified: 2018-03-21
    =====*/

    function complain_and_exit($missing_info_type)
    {
        ?>
        <h2> Need to enter a <?= $missing_info_type ?>...
             RUN AWAY!!! </h2>
        <?php
        build_mini_form("", "Try again!");
     
        session_destroy();
        //require_once('328footer.html');
        ?>
</body>
</html>
        <?php
        exit;
    }
?>