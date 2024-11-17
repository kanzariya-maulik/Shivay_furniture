<style>
        html {
            background-color: #000000; /* black background */
            color: white; /* white text */
        }

        h1, h2 {
            color: green; /* green headings */
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px auto; /* center the table */
        }

        th, td {
            border-bottom: 1px solid red; /* red bottom border for table cells */
            padding: 10px;
            text-align: center;
        }

        th {
            border-bottom: 2px solid red; /* thicker bottom border for table headers */
        }

        img {
            max-width: 100%;
            height: auto;
        }

        .edit_btn {
            background-color: #333; /* dark gray button background */
            color: white; /* white text */
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .edit_btn:hover {
            background-color: #555; /* slightly lighter gray on hover */
        }
    </style>
<?php

include_once("../dbconnection/connection.php");

$q="select * from guest where role='mainimg'";

if($result=mysqli_query($conn,$q)){
    while($row = mysqli_fetch_assoc($result)){
        $imgname=$row['imgname'];
        $name=$row['name'];
        $desc=$row['description'];
    }   
}

?>

<h1>Guest Panel</h1>
<center>
<a href="index.php?username=<?php echo $_GET['username']; ?>" class="btn btn-primary my-3" style="background-color:white;height:5%;width:5%;text-decoration:none;font-size:20px;">ADMIN PAGE</a>
</center>
<h2>main image</h2>
<table>
    <tr>
    <th>Imgname</th>
    <th>Name</th>
    <th>Description</th>
    <th>Edit</th>
    </tr>
    <tr>
        <td><image height="40%" width="40%" src='../img/<?php echo $imgname ?>' /></td>
        <td><?php echo $name; ?></td>
        <td><?php echo $desc; ?></td>
        <td><a href='mainimg_crud.php'><button class='edit_btn'>Edit</button></a></td>
    </tr>
</table>

<?php

$q="select * from guest where role='product'";

$product=array();

if ($result = mysqli_query($conn, $q)) {
    while ($row = mysqli_fetch_array($result)) {
        $imgname = $row['imgname'];
        $name = $row['name'];
        $description = $row['description'];
        $price = $row['price'];
        
        $item = array(
            'imgname' => $imgname,
            'name' => $name,
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

<h2>Product</h2>
<table>
    <tr>
    <th>card number</th>
    <th>Imgname</th>
    <th>Name</th>
    <th>Description</th>
    <th>Price</th>
    <th>Edit</th>
    </tr>
    <?php 
    $count = 1;
                foreach ($product as $item) {
                    echo "<tr>";
                    echo "<th scope='row'>" . $count . "</th>";
                    echo "<td>" . "<image height='40%' width='40%' src='../img/products/".$item['imgname']."' />" . "</td>";
                    echo "<td>" . $item['name'] . "</td>";
                    echo "<td>" . $item['description'] . "</td>";
                    echo "<td>" . $item['price'] . "</td>";
                    echo "<td><a href='guest_product_crud.php?name={$item['name']}'><button class='edit_btn'>Edit</button></a></td>";
                    echo "</tr>";
                    $count++;
                }
    ?>
</table>

<?php

$q="select * from guest where role='rating'";

$rating=array();

if ($result = mysqli_query($conn, $q)) {
    while ($row = mysqli_fetch_array($result)) {
        $imgname = $row['imgname'];
        $name = $row['name'];
        $description = $row['description'];
        $rate = $row['rating'];
        
        $item = array(
            'imgname' => $imgname,
            'name' => $name,
            'description' => $description,
            'rate' => $rate
        );
        
        $rating[] = $item;
    }
    $count = 1;
  
  foreach ($rating as $item) {
      foreach ($item as $key => $value) {
          ${$key . '_' . $count} = $value;
      }
      $count++; 
  }
  
  }
?>

<h2>Rating</h2>
<table>
    <tr>
    <th>card number</th>
    <th>Imgname</th>
    <th>Name</th>
    <th>Description</th>
    <th>Rate</th>
    <th>Edit</th>
    </tr>
    <?php
    $count = 1;
                foreach ($rating as $item) {
                    echo "<tr>";
                    echo "<th scope='row'>" . $count . "</th>";
                    echo "<td>" . "<image height='40%' width='40%' src='../img/".$item['imgname']."' />" . "</td>";
                    echo "<td>" . $item['name'] . "</td>";
                    echo "<td>" . $item['description'] . "</td>";
                    echo "<td>" . $item['rate'] . "</td>";
                    echo "<td><a href='guest_rating_crud.php?name={$item['name']}'><button class='edit_btn'>Edit</button></a></td>";
                    echo "</tr>";
                    $count++;
                }
    ?>
</table>

<?php

$q="select * from guest where role='team'";

$team=array();

if ($result = mysqli_query($conn, $q)) {
    while ($row = mysqli_fetch_array($result)) {
        $imgname = $row['imgname'];
        $name = $row['name'];
        $description = $row['description'];
        
        $item = array(
            'imgname' => $imgname,
            'name' => $name,
            'description' => $description
        );
        
        $team[] = $item;
    }
    $count = 1;
  
  foreach ($team as $item) {
      foreach ($item as $key => $value) {
          ${$key . '_' . $count} = $value;
      }
      $count++; 
  }
  
  }
?>

<h2>Team</h2>
<table>
    <tr>
    <th>card number</th>
    <th>Imgname</th>
    <th>Name</th>
    <th>Description</th>
    <th>Edit</th>
    </tr>
    <?php 
    $count = 1;
                foreach ($team as $item) {
                    echo "<tr>";
                    echo "<th scope='row'>" . $count . "</th>";
                    echo "<td>" . "<image height='40%' width='40%' src='../img/ceo/".$item['imgname']."' />" . "</td>";
                    echo "<td>" . $item['name'] . "</td>";
                    echo "<td>" . $item['description'] . "</td>";
                    echo "<td><a href='guest_team_crud.php?name={$item['name']}'><button class='edit_btn'>Edit</button></a></td>";
                    echo "</tr>";
                    $count++;
                }
    ?>
</table>