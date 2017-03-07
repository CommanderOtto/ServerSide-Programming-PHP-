<?php

require_once "dbconnect.php";


// Fill up array with names
$q=$_REQUEST["q"]; 
$sql = "select JobTitle from Jobs WHERE JobTitle LIKE '%".$q."%'";

//$a = $con->Execute($sql);
$result = mysqli_query($con, $sql) or die(mysqli_error($con));
$field = mysqli_fetch_object($result); //the query results are objects, in this case, one object
$a = $field->JobTitle;
//$a = $field['JobTitle'];

// get the q parameter from URL


$hint="";

// lookup all hints from array if $q is different from "" 
if ($q !== "")
{ 	
	$q=strtolower($q); 
	$len=strlen($q);
	
	if (stristr($q, substr($a,0,$len))) //test if $q matches with the first few characters of the same length in the lastname
	{ 
		if ($hint === "")
		{ 
			$hint = "<option>". $a."</option>";
		}
		else
		{ 	
			$hint .= "<option>". $a."</option>";
		}
	}
}

print $hint;
?>