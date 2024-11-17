<?php
include_once("../dbconnection/connection.php"); 

$q="select * from products";

$product=array();

if ($result = mysqli_query($conn, $q)) {
    while ($row = mysqli_fetch_array($result)) {
      $productid=$row['product_id'];
        $imgname = $row['imagname'];
        $name = $row['name'];
        $searchkey=$row['searchkey'];
        $description = $row['description'];
        $price = $row['price'];
        
        $item = array(
            'productid' => $productid,
            'imgname' => $imgname,
            'name' => $name,
            'search'=>$searchkey,
            'description' => $description,
            'price' => $price
        );
     
        $product[] = $item;
    }
    $count = 1;
  
  foreach ($product as $item) {
      foreach ($item as $key => $value) {
          ${$key . '_' . $count} = $value;
      }
      $count++; 
  }
  
  }
?>
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f5f5f5; /* light gray background */
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333; /* dark gray */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* subtle shadow effect */
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd; /* light gray border between rows */
        }

        th {
            background-color: #333; /* dark gray background for header */
            color: white;
        }

        td img {
            width: 100px;
            height: auto;
            display: block;
            margin: 0 auto; /* center image horizontally */
        }

        a button {
            height: 30px;
            background-color: black;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin:2px 2px;
            transition: background-color 0.3s ease;
            text-decoration: none; /* remove underline from links */
        }

        a button:hover {
            background-color: #555;
        }

        .edit_btn, .delete_btn {
            padding: 5px 10px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none; /* remove underline from links */
        }

        .edit_btn:hover, .delete_btn:hover {
            background-color: #555;
        }
    </style>
<h2>Product</h2>
<a href="new_product.php"><button>Add new Product</button></a><a href="index.php?username=<?php echo $_GET['username']; ?>"><button>ADMIN PAGE</button></a>

<table border="1">
    <tr>
    <th>Product id</th>
    <th>Imgname</th>
    <th>Name</th>
    <th>search key</th>
    <th>Description</th>
    <th>Price</th>
    <th>Edit</th>
    <th>Delete</th>
    </tr>
    <?php 
    $count = 1;
                foreach ($product as $item) {
                    echo "<tr>";
                    echo "<th scope='row'>" . $item['productid'] . "</th>";
                    echo "<td>" . "<image height='40%' width='40%' src='../img/products/".$item['imgname']."' />" . "</td>";
                    echo "<td>" . $item['name'] . "</td>";
                    echo "<td>" . $item['search'] . "</td>";
                    echo "<td>" . $item['description'] . "</td>";
                    echo "<td>" . $item['price'] . "</td>";
                    echo "<td><a href='product_edit.php?productid={$item['productid']}'><button class='edit_btn'>Edit</button></a></td>";
                    echo "<td><a href='product_delete.php?productid={$item['productid']}'><button class='edit_btn'>Delete</button></a></td>";
                    echo "</tr>";
                    $count++;
                }
    ?>
</table>