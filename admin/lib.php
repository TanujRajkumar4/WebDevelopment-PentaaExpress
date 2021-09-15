<?php 
function assign_rand_value($num)
{
// accepts 1 - 36
  switch($num)
  {
    case "1":
     $rand_value = "011";
    break;
    case "2":
     $rand_value = "012";
    break;
    case "3":
     $rand_value = "013";
    break;
    case "4":
     $rand_value = "014";
    break;
    case "5":
     $rand_value = "015";
    break;
    case "6":
     $rand_value = "016";
    break;
    case "7":
     $rand_value = "017";
    break;
    case "8":
     $rand_value = "018";
    break;
    case "9":
     $rand_value = "019";
    break;
    case "10":
     $rand_value = "020";
    break;
    case "11":
     $rand_value = "021";
    break;
    case "12":
     $rand_value = "022";
    break;
    case "13":
     $rand_value = "023";
    break;
    case "14":
     $rand_value = "024";
    break;
    case "15":
     $rand_value = "025";
    break;
    case "16":
     $rand_value = "026";
    break;
    case "17":
     $rand_value = "027";
    break;
    case "18":
     $rand_value = "028";
    break;
    case "19":
     $rand_value = "029";
    break;
    case "20":
     $rand_value = "030";
    break;
    case "21":
     $rand_value = "031";
    break;
    case "22":
     $rand_value = "032";
    break;
    case "23":
     $rand_value = "033";
    break;
    case "24":
     $rand_value = "034";
    break;
    case "25":
     $rand_value = "035";
    break;
    case "26":
     $rand_value = "036";
    break;
    case "27":
     $rand_value = "037";
    break;
    case "28":
     $rand_value = "001";
    break;
    case "29":
     $rand_value = "002";
    break;
    case "30":
     $rand_value = "003";
    break;
    case "31":
     $rand_value = "004";
    break;
    case "32":
     $rand_value = "005";
    break;
    case "33":
     $rand_value = "006";
    break;
    case "34":
     $rand_value = "007";
    break;
    case "35":
     $rand_value = "008";
    break;
    case "36":
     $rand_value = "009";
    break;
  }
return $rand_value;
}

function get_rand_id($length)
{
  if($length>0) 
  { 
  $rand_id="";
   for($i=1; $i<=$length; $i++)
   {
   mt_srand((double)microtime() * 1000000);
   $num = mt_rand(1,36);
   $rand_id .= assign_rand_value($num);
   }
  }
return $rand_id;
} 
?>