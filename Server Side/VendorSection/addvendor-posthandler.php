<?php

function db_insert($table, $cols, $values)
  {
      $conn   = db_conn();
      if (!$conn) return -1;

      $table  = htmlspecialchars($table);
      $cols   = htmlspecialchars($cols);
      $values = htmlspecialchars($values);

      $insert = "INSERT INTO $table ($cols) VALUES ($values)";
      echo "<br>INSERT: " . $insert . "<br>";
      $stid = oci_parse($conn, $insert);
      oci_execute($stid);

      oci_free_statement($stid);
      oci_close($conn);
  }


  function get_nextval($select, $from)
  {
      $res = db_query($select, $from);
      $time = time();
      foreach ($res as $key => $arr)
      {
          $nextval = sizeof($res[$key]) + $time;
          break;
      }
      return $nextval;
  }


  function db_query($select, $from, $where = '1=1')
{
    $conn   = db_conn();
    if (!$conn) return -1;

    $select = htmlspecialchars($select);
    $from   = htmlspecialchars($from);
    $where  = htmlspecialchars($where);

    $sql = "SELECT $select FROM $from WHERE $where";

    $stid = oci_parse($conn, $sql);
    oci_execute($stid);

    oci_fetch_all($stid, $res);

    oci_free_statement($stid);
    oci_close($conn);

    return $res;
}


  if
  ((isset($_POST['venName'])) &&
	((isset($_POST['venLoc'])) &&
	((isset($_POST['venPhone']))))) {
    $venname = $_POST['venName'];
    $venloc = $_POST['venLoc'];
    $venphone = $_POST['venPhone'];
    $id = 'ven_id';
    $ven_name = 'ven_name';
    $ven_pone = 'ven_phone';
    $ven_address = 'ven_address';
    $table = 'Vendor';
    




    header("Location: http://nrs-projects.humboldt.edu/~Alt-F4/index.php");
  }


?>
