<?php
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['update']))
{
$itemname=$_POST['itemname'];
$category=$_POST['category'];
$author=$_POST['author'];
$isbn=$_POST['isbn'];
$price=$_POST['price'];
$itemid=intval($_GET['itemid']);
$sql="update  tblitems set BookName=:itemname,CatId=:category,AuthorId=:author,BookPrice=:price where id=:itemid";
$query = $pdo->prepare($sql);
$query->bindParam(':itemname',$itemname,PDO::PARAM_STR);
$query->bindParam(':category',$category,PDO::PARAM_STR);
$query->bindParam(':author',$author,PDO::PARAM_STR);
$query->bindParam(':price',$price,PDO::PARAM_STR);
$query->bindParam(':itemid',$itemid,PDO::PARAM_STR);
$query->execute();
echo "<script>alert('Book info updated successfully');</script>";
echo "<script>window.location.href='index.php?action=manage-items'</script>";


}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>NurseryPro | Edit Book</title>
    <?php include('view/includes/header.php'); ?>
</head>
<body>
      
<?php include('includes/admin-menu.php');?>

    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Add Book</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md12 col-sm-12 col-xs-12">
<div class="panel panel-info">
<div class="panel-heading">
Book Info
</div>
<div class="panel-body">
<form role="form" method="post">
<?php 
$itemid=intval($_GET['itemid']);
$sql = "SELECT tblitems.BookName,tblcategory.CategoryName,tblcategory.id as cid,tblauthors.AuthorName,tblauthors.id as athrid,tblitems.ISBNNumber,tblitems.BookPrice,tblitems.id as itemid,tblitems.itemImage from  tblitems join tblcategory on tblcategory.id=tblitems.CatId join tblauthors on tblauthors.id=tblitems.AuthorId where tblitems.id=:itemid";
$query = $pdo -> prepare($sql);
$query->bindParam(':itemid',$itemid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  

<div class="col-md-6">
<div class="form-group">
<label>Book Image</label>
<img src="img/<?php echo htmlentities($result->itemImage);?>" width="100">
<a href="change-img.php?itemid=<?php echo htmlentities($result->itemid);?>">Change Book Image</a>
</div></div>

<div class="col-md-6">
<div class="form-group">
<label>Book Name<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="itemname" value="<?php echo htmlentities($result->BookName);?>" required />
</div></div>

<div class="col-md-6">
<div class="form-group">
<label> Category<span style="color:red;">*</span></label>
<select class="form-control" name="category" required="required">
<option value="<?php echo htmlentities($result->cid);?>"> <?php echo htmlentities($catname=$result->CategoryName);?></option>
<?php 
$status=1;
$sql1 = "SELECT * from  tblcategory where Status=:status";
$query1 = $pdo -> prepare($sql1);
$query1-> bindParam(':status',$status, PDO::PARAM_STR);
$query1->execute();
$resultss=$query1->fetchAll(PDO::FETCH_OBJ);
if($query1->rowCount() > 0)
{
foreach($resultss as $row)
{           
if($catname==$row->CategoryName)
{
continue;
}
else
{
    ?>  
<option value="<?php echo htmlentities($row->id);?>"><?php echo htmlentities($row->CategoryName);?></option>
 <?php }}} ?> 
</select>
</div></div>

<div class="col-md-6">
<div class="form-group">
<label> Author<span style="color:red;">*</span></label>
<select class="form-control" name="author" required="required">
<option value="<?php echo htmlentities($result->athrid);?>"> <?php echo htmlentities($athrname=$result->AuthorName);?></option>
<?php 

$sql2 = "SELECT * from  tblauthors ";
$query2 = $pdo -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);
if($query2->rowCount() > 0)
{
foreach($result2 as $ret)
{           
if($athrname==$ret->AuthorName)
{
continue;
} else{

    ?>  
<option value="<?php echo htmlentities($ret->id);?>"><?php echo htmlentities($ret->AuthorName);?></option>
 <?php }}} ?> 
</select>
</div></div>


<div class="col-md-6">
<div class="form-group">
<label>ISBN Number<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="isbn" value="<?php echo htmlentities($result->ISBNNumber);?>"  readonly />
<p class="help-block">An ISBN is an International Standard Book Number.ISBN Must be unique</p>
</div></div>


<div class="col-md-6">
 <div class="form-group">
 <label>Price in USD<span style="color:red;">*</span></label>
 <input class="form-control" type="text" name="price" value="<?php echo htmlentities($result->BookPrice);?>"   required="required" />
 </div></div>
 <?php }} ?><div class="col-md-12">
<button type="submit" name="update" class="btn btn-info">Update </button></div>

                                    </form>
                            </div>
                        </div>
                            </div>

        </div>
   
    </div>
    </div>
     
     <?php include 'includes/footer.php'; ?>
</body>
</html>
<?php } ?>
