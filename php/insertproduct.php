<?php require '../config.php'; 

// need to get store owner's uuid, check it with stores database, retrieve storeid
    $storeuuid = $_POST['Owner'];
    $prodname = $_POST['Product'];
    
    $result = mysqli_query($connect, "SELECT storeid FROM products WHERE storeuuid='$storeuuid' AND productname='$prodname'");
    if ($result){
        while ($obj=mysqli_fetch_object($result)){
            $storeid = $obj->storeid;
            $productid = $obj->productid;
        }
    }


/*  what i'm going off of that i've seen in sl
    llHTTPRequest(urlinsert,[HTTP_METHOD,"POST",HTTP_MIMETYPE,"application/x-www-form-urlencoded"],
            "storeuuid="+(string)storeowneruuid+
            "&prodname="+(string)productname+
            "&price="+(int)price+
            .... etc
*/

// initialized vendor, add the product into product table with the configuration user made during vendor set-up
$query  = "INSERT INTO products ( `productid`, `storeid`, `productname`, `price`, 
                                    `active`, `saleregion`, `salestart`, `saleend`, 
                                    `dateadded`, `discount`, `discountgroup`,
                                    `reward`, `rewardgroup` ) 
            VALUES ( 
                'NULL',
                '$storeid',                
                '".$_POST['Product']."', 
                '".$_POST['Price']."', 
                '".$_POST['Active']."',
                '".$_POST['Region']."',
                '".$_POST['Sale_Start']."', 
                '".$_POST['Sale_End']."', 
                '".$_POST['Date']."',
                '".$_POST['Discount_All']."', 
                '".$_POST['Discount_Group']."',
                '".$_POST['Reward_All']."', 
                '".$_POST['Reward_Group']."'
                )";
$result = mysqli_query($connect, $query);
?>
