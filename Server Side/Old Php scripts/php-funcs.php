<?php
/*
This is the php functions helper file for our website.  

Contains Functions:
    select_fill($index, $contents, $size) - fills select boxes given an index column name, the contents from a fetch_all in an oci call, and a size variable for a column.

    table_fill($contents, $tableArr, $size, $tableArrSize)
    complain_and_exit($missing_info_type)
    create_login($text = '')
*/

//////////////////
// HTML HELPERS //
//////////////////
    function select_fill($index, $contents, $size)
    {
        for($i = 0; $i < $size; $i++)
        {
            if (is_null($contents[$index][$i])) echo '<option value=\'--\'>--</option>';
            else {
                echo '<option value=\''.$contents[$index][$i].'\'>'.$contents[$index][$i].'</option>';
            }
        }
    }

    function table_fill($contents, $tableArr, $size, $tableArrSize)
    {
        for ($i = 0; $i < $size; $i++)// N^2 sup. :S xD
        {
            echo '<tr>';
            for ($j = 0; $j < $tableArrSize; $j++)
            {
                echo '<td>';
                if (is_null($contents[$tableArr[$j]][$i])) echo '-- ';
                else { echo $contents[$tableArr[$j]][$i]; }
                echo '</td>';
            }
            echo '</tr>';
        }
    }


//////////////////////
//   / HTML HELPERS //
//////////////////////

    function complain_and_exit($missing_info_type)
    {
        ?>
        <h2> Something failed.  Error: <?= $missing_info_type ?></h2>

        <form method="post"
              action="<?= htmlentities($_SERVER['PHP_SELF'],
                                       ENT_QUOTES) ?>">
            <input type="submit" value="Try again!" />
        </form>

        <?php
        session_destroy();
        require_once('footer.html');
        ?>
        </body>
        </html>
        <?php
        exit;
    }


    function create_login($text = '')
    {
        echo '<center><img style="position:relative; display: block;  border: 10; margin-top:-5%;
        margin-left:auto; margin-right:auto; height:25%; " src="images/hsu-logo-long.png"><center>';
        if(!empty($text)) echo $text.'<br>';
        ?>

        <form method="post" action="<?php domain ?>">
            <fieldset style="margin-left:auto; margin-right:auto; width:65%;">
                <legend> Enter Username/Password: </legend>

        <div style="float:left; width:45%;">
                <img src="images/hsu-icon.png" height="15px" width="15px">
                <label for="name_entry"> Username: </label>
                <input type="text" name="username" id="name_entry"
                       required="required" />
        </div>

        <div style="float:left; width:45%;">
          <img src="images/hsu-icon.png" height="15px" width="15px">
                <label for="pwd_entry"> Password: </label>
                <input type="password" name="password" id="pwd_entry"
                       required="required" />
        </div>

        <input type="hidden" name="connect" value="connect">
        <div style="float:right; width:5%;">
                <input style="float:right;" type="submit" id="login" value="log in" />
        </div>
            </fieldset>
        </form>

<?php  }
?>