<?php
$conn = mysqli_connect("localhost", "root", "123456", "rush00");
if ($_GET['page'] == all)
{
    $query = mysqli_query($conn, "SELECT * FROM `items`");
}

echo "<div class='center'>";
echo "<div class='table'>";
echo "<table>";
foreach ($query as $value)
{
    echo "<tr>";
    echo "<td class='name'>".$value['name']."</td>";
    echo "<td class='price'>".$value['price']."</td>";
    echo "<td class='description'>".$value['description']."</td>";
    echo "</tr>";
}
echo "<table>";
echo "</div>";
echo "</div>";
?>