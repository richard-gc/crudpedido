<?php
echo(json_encode("hola"));
if(isset($_POST['descargar'])){
header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=file.csv");

function outputCSV($data) {
  $output = fopen("php://output", "w");
  foreach ($data as $row)
    fputcsv($output, $row); // here you can change delimiter/enclosure
  fclose($output);
}

outputCSV(array(
  array("name 1", "age 1", "city 1"),
  array("name 2", "age 2", "city 2"),
  array("name 3", "age 3", "city 3")
));
 }
 ?>