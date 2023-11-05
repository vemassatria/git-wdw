<?php
$Station = $_POST["Station"];
$len = strlen($Station);
$inFile = "tugas.dat";
$in = fopen ($inFile, "r") or die("Can't open file");
$line = fgets($in);

echo '<style>
table {
  border: 2px solid #ddd;
  border-collapse: collapse;
  margin-top: 120px;
  width: 70%;
  margin: 0 auto;
  font-family: Arial, Helvetica, sans-serif;
  color: #444;
}

th {
  background-color: #f2f2f2;
  border: 1px solid #ddd;
  padding: 10px;
  text-align: center;
}

td {
  border: 1px solid #ddd;
  padding: 10px;
  text-align: center;
}
</style>';

$found = 0;

while ((!feof($in)) && ($found == 0)) {
    list(
        $Station_dat,
        $MeanS,
        $AtileS,
        $BtileS,
        $MeanM,
        $AtileM,
        $BtileM,
        $MeanD,
        $AtileD,
        $BtileD,
        $R
    ) = fscanf(
        $in,
        "%s %f %f %f %f %f %f %f %f %f %f"
    );

    if (strncasecmp($Station_dat, $Station, $len) == 0)
        $found = 1;
}

fclose($in);

if ($found == 0) {
    echo "<p>Couldn't find this station.</p>";
} else {
    echo '<table>';
    echo '
<tr>
  <th rowspan="2">Station</th>
  <th colspan="3">Distance</th>
  <th colspan="3">Measured</th>
  <th colspan="3">Difference</th>
  <th rowspan="2">R<sup>2</sup></th>
</tr>
<tr>
  <th>Mean</th>
  <th>5%tile</th>
  <th>95%tile</th>
  <th>Mean</th>
  <th>5%tile</th>
  <th>95%tile</th>
  <th>Mean</th>
  <th>5%tile</th>
  <th>95%tile</th>
</tr>
<tr>
  <td>' . $Station . '</td>
  <td>' . $MeanS . '</td>
  <td>' . $AtileS . '</td>
  <td>' . $BtileS . '</td>
  <td>' . $MeanM . '</td>
  <td>' . $AtileM . '</td>
  <td>' . $BtileM . '</td>
  <td>' . $MeanD . '</td>
  <td>' . $AtileD . '</td>
  <td>' . $BtileD . '</td>
  <td>' . $R . '</td>
</tr>';
    echo "</table>";
}
?>