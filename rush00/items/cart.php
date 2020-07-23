<?php
session_start();

function search_quantity($cart, $id)
{
	foreach($cart as $item)
	{
		if ($item['item_id'] == $id)
			return $item['amount'];
	}
	return 0;
}
$conn = mysqli_connect("localhost", "root", "123456", "rush00");
if (!$conn)
{
	echo "Failed to connect with database! This is from cart.php";
}

if (isset($_SESSION['cart']))
{
	foreach ($_SESSION['cart'] as $item)
	{
		if ($item)
			$product_ids = $product_ids != NULL ? $product_ids.",".$item['item_id'] : "(".$item['item_id'];
	}
	$product_ids .= ")";
    $query = mysqli_query($conn, "SELECT * FROM items WHERE `item_id` in $product_ids");
}

echo "<table border='1 solid red'>
<tr>
<th>Name</th>
<th>Type</th>
<th>Model</th>
<th>Price</th>
<th>Description</th>
<th>Image</th>
<th>Quantity</th>
<th>Amount</th>
<th>Remove</th>
</tr>";

$total_amount = 0;
$total_quantity = 0;
while($row = mysqli_fetch_array($query))
{
	$quantity = search_quantity($_SESSION['cart'], $row['item_id']);
	$amount = $quantity * $row['price'];
	$total_amount += $amount;
	$total_quantity += $quantity;
    echo "<tr>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['type'] . "</td>";
    echo "<td>" . $row['model'] . "</td>";
    echo "<td>" . $row['price'] . "</td>";
    echo "<td>" . $row['description'] . "</td>";
    echo "<td><img src='".$row['img']."' alt='".$row['img']."' width='60' height='60' /></td>";
	echo "<td>" . $quantity . "</td>";
	echo "<td>" . $amount . "</td>";
	echo "<td><form method='post'><button type='submit' name='remove' value='".$row['item_id']."'>Remove item</button></form></td>";
    echo "</tr>";
}
echo "<tr>";
echo "<td>Totals</td>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td>" . $total_quantity . "</td>";
echo "<td>" . $total_amount . "</td>";
echo "<td></td>";
echo "</tr>";

echo "</table><br />";

echo "<form method='post'><input type='submit' name='buy_now' value='Buy Now'></form><br /><br />";
echo "<form method='post'><input type='submit' name='clear' value='Clear Cart'></form>";

if (isset($_POST['remove']))
{
	if (isset($_SESSION['cart']))
    {
        foreach($_SESSION['cart'] as $key => $val)
        {
            if ($val['item_id'] == $_POST['remove'])
            {
                unset($_SESSION['cart'][$key]);
                header("location: index.php?page=cart");
            }
        }
    }
	header("location: index.php?page=cart");
}

if (isset($_POST['clear']) AND $_POST['clear'] == "Clear Cart")
{
	if (isset($_SESSION['cart']))
    {
        foreach($_SESSION['cart'] as $key => $val)
			unset($_SESSION['cart'][$key]);
    }
	header("location: index.php?page=cart");
}

if (isset($_POST['buy_now']) AND $_POST['buy_now'] == "Buy Now")
{
	if (!isset($_SESSION['user'])  OR $_SESSION['user']['name'] == NULL OR $_SESSION['user']['name'] == "")
    {
		echo "<div><p>You must login to be able to make orders.</p></div>";
	}         
	elseif (isset($_SESSION['cart']))
	{
		$err = FALSE;
		foreach ($_SESSION['cart'] as $item)
		{
			if ($item)
			{
				$product_id = $item['item_id'];
				$uid = $_SESSION['user']['user_id'];
				$query = mysqli_query($conn, "SELECT * FROM items WHERE `item_id`='$product_id'");
				$row = mysqli_fetch_array($query);
				$quantity = search_quantity($_SESSION['cart'], $row['item_id']);
				$amount = $quantity * $row['price'];
				$order_row = $row['name'] . " " . $row['model'] . " (quantity: " . $quantity . ", amount: " . $amount .")";

				$query = mysqli_query($conn, "INSERT INTO orders (`user_id`, `item_id`, `quantity`, `amount`) VALUES ('$uid', '$product_id','$quantity', '$amount')");
				if (mysqli_affected_rows($conn) > 0)
					echo "<div><p>$order_row added to order.</p></div>";
				else
				{
					echo "<b style='color: red'>Error adding $order_row to order. Contact staff.</b>";
					$err = TRUE;
					break ;
				}
			}
		}
		if ($err == FALSE)
			echo "<div><p>Order sent.</p></div>";
	}
	else
		echo "<b style='color: red'>Error with order. Try again or contact staff.</b>";
}

?>