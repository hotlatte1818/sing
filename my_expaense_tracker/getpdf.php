<?php  
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['detsuid']==0)) {
  header('location:logout.php');
  } else{

//code deletion
if(isset($_GET['delid']))
{
$rowid=intval($_GET['delid']);
$query=mysqli_query($con,"delete from tblexpense where ID='$rowid'");
if($query){
echo "<script>alert('Record successfully deleted');</script>";
echo "<script>window.location.href='manage-expense.php'</script>";
} else {
echo "<script>alert('Something went wrong. Please try again');</script>";

}

}
  }



  $uid=$_SESSION['detsuid'];
$ret=mysqli_query($con,"select FullName,Email from tbluser where ID='$uid'");
$row=mysqli_fetch_assoc($ret);
$Name=$row['FullName'];
$Email=$row['Email'];

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>manage_expense</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <style>
    body{
    background:#eee;
}

.invoice {
    background: #fff;
    padding: 20px
}

.invoice-company {
    font-size: 20px
}

.invoice-header {
    margin: 0 -20px;
    background: #B4E197;
    padding: 20px
}

.invoice-date,
.invoice-from,
.invoice-to {
    display: table-cell;
    width: 1%
}

.invoice-from,
.invoice-to {
    padding-right: 20px
}

.invoice-date .date,
.invoice-from strong,
.invoice-to strong {
    font-size: 16px;
    font-weight: 600
}

.invoice-date {
    text-align: right;
    padding-left: 20px
}

.invoice-price {
    background: #ECB390;
    display: table;
    width: 100%
}

.invoice-price .invoice-price-left,
.invoice-price .invoice-price-right {
    display: table-cell;
    padding: 20px;
    font-size: 20px;
    font-weight: 600;
    width: 75%;
    position: relative;
    vertical-align: middle
}

.invoice-price .invoice-price-left .sub-price {
    display: table-cell;
    vertical-align: middle;
    padding: 0 20px
}

.invoice-price small {
    font-size: 12px;
    font-weight: 400;
    display: block
}

.invoice-price .invoice-price-row {
    display: table;
    float: left
}

.invoice-price .invoice-price-right {
    width: 25%;
    background: #2d353c;
    color: #fff;
    font-size: 28px;
    text-align: right;
    vertical-align: bottom;
    font-weight: 300
}

.invoice-price .invoice-price-right small {
    display: block;
    opacity: .6;
    position: absolute;
    top: 10px;
    left: 10px;
    font-size: 12px
}

.invoice-footer {
    border-top: 1px solid #ddd;
    padding-top: 10px;
    font-size: 10px
}

.invoice-note {
    color: #999;
    margin-top: 80px;
    font-size: 85%
}

.invoice>div:not(.invoice-footer) {
    margin-bottom: 20px
}

.btn.btn-white, .btn.btn-white.disabled, .btn.btn-white.disabled:focus, .btn.btn-white.disabled:hover, .btn.btn-white[disabled], .btn.btn-white[disabled]:focus, .btn.btn-white[disabled]:hover {
    color: #2d353c;
    background: #fff;
    border-color: #d9dfe3;
}
    
   @media print{
    th{
        color:black;
    }
    td{
        color:black;
    }
    #print-btn{
        display: none
    }
    #p{
      color:black;
    }
  </style>
</head>
  <body style=" background-color: #06283D ">
  <?php include_once('includes/navbar.php');?>


  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container-fluid">
   <div class="col-md-12">
      <div class="invoice">
         <!-- begin invoice-company -->
         <div class="invoice-company text-inverse f-w-600">
            <span class="pull-right hidden-print">
            <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-white m-b-10 p-l-5" id="print-btn"><i class="fa fa-print t-plus-1 fa-fw fa-lg"></i> Print</a>
            </span>
            <b  style="font-size:2rem";>Expense Tracker</b>
         </div>
         <div class="invoice-header">
            <div class="invoice-from">
               <small>From</small>
               <address class="m-t-5 m-b-5">
                  <strong class="text-inverse">Expense Tracker,Managing Team.</strong><br>
                  Kharar<br>
                  Mohali ,140301<br>
                  Phone: (+91) 9586-568589<br>
                  Fax: (123) 456-7890
               </address>
            </div>
            <div class="invoice-to">
               <small>To</small>
               <address class="m-t-5 m-b-5">
                  <strong class="text-inverse"><?php echo $Name; ?></strong><br>
                  Street Address<br>
                  City, Zip Code<br>
                  Phone: (123) 456-7890<br>
                  Fax: (123) 456-7890
               </address>
            </div>
            <div class="invoice-date">
               <small>Invoice / July period</small>
               <div class="date text-inverse m-t-5">
               <div id="current_date"></p>
<script>
date = new Date();
year = date.getFullYear();
day = date.getDate();
var  months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
var d = new Date();
monthName=months[d.getMonth()]; // "July" (or current month)
document.getElementById("current_date").innerHTML = monthName + "-" + day + "-" + year;

</script>
</div>
</div>
               <div class="invoice-detail">
                  #0000123DSS<br>
                  Services Product
               </div>
            </div>
         </div>
         <div class="invoice-content">
            <div class="table-responsive">
               <table class="table table-invoice">
                  <thead>
                     <tr>
                        <th scope="col">S.NO</th>
                        <th>EXPENSES DESCRIPTION</th>
                        <th class="text-center" width="10%">DATE</th>
                        <th class="text-center" width="20%">COST</th>
                     </tr>
                  </thead>
                  <?php
     $userid=$_SESSION['detsuid'];
     $query5=mysqli_query($con,"select sum(ExpenseCost)  as totalexpense from tblexpense where UserId='$userid';");
$result5=mysqli_fetch_array($query5);
$sum_total_expense=$result5['totalexpense'];
$ret=mysqli_query($con,"select * from tblexpense where UserId='$userid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>


                  <tbody>
                     <tr>
                        <td><?php echo $cnt;?></td>

                        <td class="text-right"><?php  echo $row['ExpenseItem'];?></td>
                        <td class="text-center"><?php  echo $row['ExpenseDate'];?></td>
                        <td class="text-center"><?php  echo $row['ExpenseCost'];?></td>
                     </tr>

                     <?php 
$cnt=$cnt+1;
}?>

                  </tbody>
               </table>
            </div>
            <div class="invoice-price">
               <div class="invoice-price-left">
                  <div class="invoice-price-row">
                     <div class="sub-price">
                        <small>SUBTOTAL</small>
                        <span class="text-inverse">₹<?php if($sum_total_expense==""){
echo "0";
} else {
echo $sum_total_expense;
}	?></span>
                     </div>
                     <div class="sub-price">
                        <i class="fa fa-plus text-muted"></i>
                     </div>
                     <div class="sub-price">
                        <small>EXPENSE TRACKER FEE (0%)</small>
                        <span class="text-inverse">₹0</span>
                     </div>
                  </div>
               </div>
               <div class="invoice-price-right">
                  <small id="p">TOTAL</small> <span class="f-w-600" id="p">₹<?php if($sum_total_expense==""){
echo "0";
} else {
echo $sum_total_expense;
}

	?></span>
               </div>
            </div>
         </div>
         <div class="invoice-note">
            * Make all cheques payable to Expense Tracker<br>
            * If you have any questions concerning this invoice, contact  Arnab Singha ,ph :7908502755, Email :uic.21mca2445@gmail.com
         </div>
         <div class="invoice-footer">
            <p class="text-center m-b-5 f-w-600">
               THANK YOU FOR YOUR BUSINESS
            </p>
            <p class="text-center">
               <span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i> ExpenseTracker.com</span>
               <span class="m-r-10"><i class="fa fa-fw fa-lg fa-phone-volume"></i> T:016-18192302</span>
               <span class="m-r-10"><i class="fa fa-fw fa-lg fa-envelope"></i>uic.21mca2445@gmail.com</span>
            </p>
         </div>
      </div>
   </div>
</div>


  </body>
</html>














