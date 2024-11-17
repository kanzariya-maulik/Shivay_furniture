<?php

$host="localhost";
$username="root";
$password="";
$databasename="shivay";

$conn = mysqli_connect($host,$username,$password,$databasename);

// $q="create database shivay";

// $q="create table  user_info
// (
//     fname char(50),
//     lname char(50),
//     username varchar(30) primary key,
//     mobilenumber varchar(15),
//     password varchar(18),
//     imgname varchar(255) default '1.jpg'
// );";

// $q="create table products(
//     imagname varchar(255),
//     name varchar(255),
//     searchkey varchar(255) NOT NULL,
//     description varchar(255),
//     price int(10)
// );";

// if(mysqli_query($conn,$q)){
//     echo "sucessfull";
// }
// else{
//     echo mysqli_error($conn);
// }
