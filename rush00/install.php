<?php 
$conn = mysqli_connect("localhost", "root", "123456");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

$db = mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS rush00");
echo "Successfully db created \n";

$conn = mysqli_connect("localhost", "root", "123456", "rush00");

$tableItems = mysqli_query($conn, "CREATE TABLE IF NOT EXISTS items(
    `item_id` int(100) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `type` varchar (100) NOT NULL,
    `model` varchar (100) NOT NULL, 
    `description` varchar (300) NOT NULL,
    `price`int (100) NOT NULL, 
    `img` varchar(500) NOT NULL,
    PRIMARY KEY (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8");

$tableUsers = mysqli_query($conn, "CREATE TABLE IF NOT EXISTS users(
  `user_id` int (10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar (50) NOT NULL,
  `login` varchar (50) not null,
  `email` varchar (50) not null,
  `password` varchar (100) default null,
  PRIMARY KEY (`user_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8");

$tableAdmin = mysqli_query($conn, "CREATE TABLE admin (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8");

$tableOrders = mysqli_query($conn, "CREATE TABLE IF NOT EXISTS orders(
  `order_id` int (10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int (10) unsigned NOT NULL,
  `item_id` int(100) unsigned NOT NULL,
  `quantity` int(100) NOT NULL,
  `amount` int(100) NOT NULL,
  PRIMARY KEY (`order_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8");

$adpasswd = hash('sha256', 'root');
mysqli_query($conn, "INSERT INTO admin (`username`, `password`) VALUES ('root', '$adpasswd')");

?>