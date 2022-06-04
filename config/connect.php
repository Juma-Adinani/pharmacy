<?php

$con = mysqli_connect('localhost', 'root', '', 'pharmacydb');

if (mysqli_error($con)) {
    echo 'database connection error => ' . mysqli_error($con);
}
