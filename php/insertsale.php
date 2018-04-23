<?php require '../config.php'; 


    $storeuuid = $_POST['Owner'];
    $prodname = $_POST['Product'];
    $regname = $_POST['Region'];

    // get the storeid and productid from database
    $result = mysqli_query($connect, "SELECT storeid FROM products WHERE storeuuid='$storeuuid' AND productname='$prodname'");
    if ($result){
        while ($obj=mysqli_fetch_object($result)){
            $storeid = $obj->storeid;
            $productid = $obj->productid;
        }
    }

    // gets the region id of the corresponding region name and storeid from database
    $result = mysqli_query($connect, "SELECT regionid FROM region WHERE storeid='$storeid' AND regionname='$regname'");
    if ($result){
        while ($obj=mysqli_fetch_object($result)){
            $regionid = $obj->regionid;
        }
    }

/*  what i'm going off of that i've seen in sl
    llHTTPRequest(urlinsert,[HTTP_METHOD,"POST",HTTP_MIMETYPE,"application/x-www-form-urlencoded"],
            "storeuuid="+(string)storeowneruuid+
            "&prodname="+(string)productname+
            "&price="+(int)price+
            .... etc
*/

// if customer purchases product, insert it into the datatable
$query  = "INSERT INTO sales ( `saleid`, `productid`, `storeid`, 
                                `custuuid`, `custname`, `productname`,
                                `payment`, `price`, `reward`, `recipuuid`, 
                                `recipname`, `date`, `regionid`, `regionname`) 
            VALUES ( 
                'NULL',
                '$productid', 
                '$storeid',        
                '".$_POST['Customer_Key']."', 
                '".$_POST['Customer_Name']."',         
                '$prodname', 
                '".$_POST['Payment_Method']."', 
                '".$_POST['Paid_Amount']."',
                '".$_POST['Reward_Earned']."',                 
                '".$_POST['Gift_Key']."', 
                '".$_POST['Gift_Name']."',
                '".$_POST['Date']."', 
                '$regionid',
                '$regname'
                )";

$result = mysqli_query($connect, $query);


//HTTP Response
echo "Values Insert Successfull!";

?>
