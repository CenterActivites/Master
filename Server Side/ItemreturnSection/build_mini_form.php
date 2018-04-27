<?php
    /*=====
        function: build_mini_form: string string -> void
        purpose: expects a desired textfield name and
                 submit-button label, and outputs to the resulting
                 document a mini-form with a textfield with that
                 name and a submit button with that label;
                 however, if the textfield name is "", it OMITS the
                 textfield

        by: Sharon Tuttle
        last modified: 2018-03-21
    =====*/

    function build_mini_form($textfield_name, $submit_label)
    {
        // start the form
        ?>
        <form method="post"
              action="<?= htmlentities($_SERVER['PHP_SELF'], 
                                       ENT_QUOTES) ?>">      
        <?php

        // IF a non-blank textfield name has been given,
        //    add a textfield with that name

        if ($textfield_name != "")
        {
            ?>
            <input type="text" name="<?= $textfield_name ?>" /> 
            <?php
        }

        // always end with a submit button with the specified label

        ?>
            <input type="submit" value="<?= $submit_label ?>" />
        </form>           
        <?php
    }
?>