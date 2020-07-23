<?php
session_start();
$conn = mysqli_connect("localhost", "root", "123456", "rush00");
if ($_GET['page'] == 'all')
{
    $query = mysqli_query($conn, "SELECT * FROM items");
}
if ($_GET['page'] == 'nokia')
{
    $query = mysqli_query($conn, "SELECT * FROM items WHERE `name` = 'Nokia'");
}

if ($_GET['page'] == 'samsung')
{
    $query = mysqli_query($conn, "SELECT * FROM items WHERE `name` = 'Samsung'");
}

if ($_GET['page'] == 'apple')
{
    $query = mysqli_query($conn, "SELECT * FROM items WHERE `name` = 'Apple'");
}


echo "<table border='1 solid red'>
<tr>
<th>Name</th>
<th>Type</th>
<th>Model</th>
<th>Price</th>
<th>Description</th>
<th>Image</th>
<th colspan='2'>Action</th>
</tr>";
while($row = mysqli_fetch_array($query))
{
    echo "<tr>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['type'] . "</td>";
    echo "<td>" . $row['model'] . "</td>";
    echo "<td>" . $row['price'] . "</td>";
    echo "<td>" . $row['description'] . "</td>";
    echo "<td><img src='".$row['img']."' alt='".$row['img']."' width='60' height='60' /></td>";
    echo "<td><form method='post'><button type='submit' name='buy' value='".$row['item_id']."'>Buy</button></form></td>";
    echo "<td><form method='post'><button type='submit' name='add_to_cart' value='".$row['item_id']."'>Add to Cart</button></form></td>";
    echo "</tr>";
}
echo "</table>";

if (isset($_POST['buy']))
{
    $added = FALSE;
    if (isset($_SESSION['cart']))
    {
        foreach($_SESSION['cart'] as &$item)
        {
            if ($item['item_id'] == $_POST['buy'])
            {
                $item['amount'] += 1;
                $added = TRUE;
                header("location: index.php?page=cart");
            }
        }
    }
    else
        $_SESSION['cart'] = array();
    if ($added == FALSE)
    {
        $new_item = array('item_id' => $_POST['buy'], 'amount' => 1);
        array_push($_SESSION['cart'], $new_item);
    }
    header("location: index.php?page=cart");
}

if (isset($_POST['add_to_cart']))
{
    $added = FALSE;
    if (isset($_SESSION['cart']))
    {
        foreach($_SESSION['cart'] as &$item)
        {
            if ($item['item_id'] == $_POST['add_to_cart'])
            {
                $item['amount'] += 1;
                $added = TRUE;
            }
        }
    }
    else
        $_SESSION['cart'] = array();
    if ($added == FALSE)
    {
        $new_item = array('item_id' => $_POST['add_to_cart'], 'amount' => 1);
        array_push($_SESSION['cart'], $new_item);
    }
}