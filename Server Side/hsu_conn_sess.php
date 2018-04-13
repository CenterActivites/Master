<?php

    function hsu_conn_sess($usr, $pwd)
    {
      
        $db_conn_str =
            "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)
                                       (HOST = cedar.humboldt.edu)
                                       (PORT = 1521))
                            (CONNECT_DATA = (SID = STUDENT)))";

        
        $connctn = oci_connect($usr, $pwd, $db_conn_str);

        if (! $connctn)
        {
        ?>
            <p> Could not log into Oracle, sorry. </p>

</body>
</html>
            <?php
            session_destroy();
            exit;
        }

        return $connctn;
    }
?>