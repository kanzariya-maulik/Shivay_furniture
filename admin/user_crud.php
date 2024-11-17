<style>
    html{
        background-color: #000000;
        color:white;
    }
    h1{
        color:green;
    }
    h2{
        color:green;
    }
    table{
        border-top: 1px solid red;
        width: 100%;
        justify-content: center;
    }
    td{
        border-bottom: 1px solid white;
        width: 25%;
        justify-content: center;
    }
    th{
        border-bottom: 1px solid red;
        width: 25%;
        justify-content: center;
    }
    </style>
<?php

include_once("../dbconnection/connection.php");

$q="select * from user_dynamic where role='mainimg'";

if($result=mysqli_query($conn,$q)){
    while($row = mysqli_fetch_assoc($result)){
        $imgname=$row['imgname'];
        $name=$row['name'];
        $desc=$row['description'];
    }   
}

?>

<h1>user Panel</h1>
<a href="index.php?username=<?php echo $_GET['username']; ?>" class="btn btn-primary my-3" style="background-color:white;height:5%;width:5%;text-decoration:none;font-size:20px;">ADMIN PAGE</a>
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
        <td><a href='user_mainimg_crud.php'><button class='edit_btn'>Edit</button></a></td>
    </tr>
</table>

<?php

$q="select * from user_dynamic where role='team'";

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
  
  }else{
    echo mysqli_error($conn);
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
                    echo "<td><a href='user_team_crud.php?name={$item['name']}'><button class='edit_btn'>Edit</button></a></td>";
                    echo "</tr>";
                    $count++;
                }
    ?>
</table>