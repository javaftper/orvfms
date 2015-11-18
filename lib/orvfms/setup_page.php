<?php
function displaySetupPage($mac,&$s20Table,$myUrl){
    global $daysOfWeek;    

    $devData = $s20Table[$mac];
    $timerName = $devData['name'];
?>

<div style="text-align:center">
<h2> 
<form action="<?php echo $myUrl ?>" method="post">
<?php
    if(array_key_exists('off',$s20Table[$mac])){
        echo $timerName;  
        $mayEdit = 0;
    }
    else{
        $mayEdit = 1;
?>

        <input type = "text" name="newName" value="<?php echo $timerName; ?>" id="inputName">
<?php
    }

    if(isset($devData['st']) && ($devData['st'] >= 0) && !array_key_exists('off',$s20Table[$mac])){
        $stDisplay = ($devData['st'] ? "greenCircle100px.png" : "redCircle100px.png");
        echo '<img src="'.IMG_PATH.
                         $stDisplay
                         .'" style="width:0.8em;position:relative;top:0.1em;left:0.3em;">';    

    }
    $nnext = $devData['next'];

    if($mayEdit){
        echo '<br><div id="mayEdit">Socket name above is editable</div>';
    }
?> 
</h2>
<p>
<hr>





    <input type="submit" name="toMainPage" value="back<?php echo $mac ?>"  
    id="backButton"> 

<?php
    if(!array_key_exists('off',$s20Table[$mac])){
?>

<div>
        Number of next events displayed in main page for this timer: 
<select name="numberOfNextEvents">        
<?php
        
        for($i = 0 ; $i < 8; $i++){
            echo '<option value="'.$i.'"'.($nnext==$i ? ' selected="selected"' : ' ').'>'.$i.'</option>'."\n";
        }
?>
</select>

<p>




<p>

<button type="submit" name="toMainPage" value="procSetup<?php echo $mac ?>" id="doneButton">Done</button>



<div style="margin-top:10vh;">
<hr>
Delete device from the system<p>
<button type="submit" name="toMainPage" value="procSetupDel<?php echo $mac ?>" id="deleteButton">Delete device</button>
<hr>
</div>
<?php
        }
        else{

            $inactiveTimeStamp = $s20Table[$mac]['off'];
            $inactiveString = gmdate("D M j G:i:s T Y",$inactiveTimeStamp);

            $now = time();
            $delta = $now - $inactiveTimeStamp;
            $deltaString = secToHourString($delta);
            $msg = "This device is inactive since ".$inactiveString;
            $msg = $msg." (".$deltaString."s ago)<p>";
            echo $msg;
?>
<hr>
<button type="submit" name="toMainPage" value="procSetupDel<?php echo $mac ?>" id="deleteButton">Delete device</button>
<p>
<button type="submit" name="toMainPage" value="procSetupCancel<?php echo $mac ?>" id="cancelButton">Cancel</button>


<?php
        }
?>
</form>

</div>

<?php
}
?>

