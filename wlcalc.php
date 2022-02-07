<?php
error_reporting(E_ALL);
// "The older you get the less young you look" - Eleesha
if(isset($_POST['submit'])){
                $xname=filter_input(INPUT_POST, 'xname', FILTER_SANITIZE_SPECIAL_CHARS);
                $xgender=filter_input(INPUT_POST, 'xgender', FILTER_SANITIZE_SPECIAL_CHARS);
                $xweight=filter_input(INPUT_POST, 'xweight', FILTER_SANITIZE_SPECIAL_CHARS);
                $xheight=filter_input(INPUT_POST, 'xheight', FILTER_SANITIZE_SPECIAL_CHARS);
                $xage=filter_input(INPUT_POST, 'xage', FILTER_SANITIZE_SPECIAL_CHARS);
                $xactlvl=filter_input(INPUT_POST, 'xactivity', FILTER_SANITIZE_SPECIAL_CHARS);
                $xmpd=filter_input(INPUT_POST, 'xmpd', FILTER_SANITIZE_SPECIAL_CHARS);
                $xgoal=filter_input(INPUT_POST, 'xgoal', FILTER_SANITIZE_SPECIAL_CHARS);

                    $content=$content."<table cellspacing=\"0\" border=\"0\" width=\"60%\">";
                    $content=$content."<tr><td>Name</td><td>$xname</td></tr>";
                    $content=$content."<tr><td>Gender</td><td>";
                    if($xgender == 'm'){$content=$content." Male</td></tr>"; } else { $content=$content." Female</td></tr>"; }
                    $content=$content."<tr><td>Weight:</td><td>$xweight kgs</td></tr>";
                    $content=$content."<tr><td>Height:</td><td>$xheight cm</td></tr>";
                    $content=$content."<tr><td>Age:</td><td>$xage</td></tr>";


                    $content=$content."</table><br /><br />";

                    if($xgender == 'm'){
                        $BMR=round(66+(13.7*$xweight)+(5*$xheight)-(6.8*$xage),0); // Male BMR
                    } else { 
                        $BMR=round(655+(9.6*$xweight)+(1.8*$xheight)-(4.7*$xage),0); // Female BMR
                    }
                    switch($xactlvl){
                            case 1: // Sedentary
                                $DCN=1.2;
                                break;
                            case 2: // Lightly Active
                                $DCN=1.3;
                                break;
                            case 3: // Moderately Active
                                $DCN=1.4;
                                break;
                            case 4: // Very Active
                                $DCN=1.5;
                                break;
                            case 5: // Extra Active
                                $DCN=1.6;
                                break;

                    }


                $calneed=round($BMR*$DCN);
                $meals=round($calneed/$xmpd,0);

                $content=$content."Your BMR is $BMR<br />";
                $content=$content."Including your activity factor, your daily Calorie needs are:".round($BMR*$DCN);

                $content=$content."<br /><br />";

                switch($xgoal){
                        case 1: // Weight Loss
                        $proteinperday=round((($calneed*0.5)/4)/0.33,0);
                        $proteinpermeal=round($proteinperday/$xmpd,0);
                        $carbperday=round((($calneed*0.2)/4)/0.33,0);
                        $carbpermeal=round($carbperday/$xmpd,0);
                        $fatperday=round((($calneed*0.1)/9)/0.33,0);
                        $fatpermeal=round($fatperday/$xmpd,0);
                        $content=$content."<br />To lose weight you must consume:<br />";
                        $content=$content."<table width=\"60%\" border=\"1\" cellspacing=\"0\">";
                        $content=$content."<tr><td>$xmpd";if($xmpd>1){$content.=" meals";}else{ $content.=" meal";} $content.="</td><td><b>Per Day</b></td><td><b>Per meal</b></td></tr>";
                        $content=$content."<tr><td><b>Protein (meat)</b></td><td>$proteinperday g</td><td>$proteinpermeal g</td></tr>";
                        $content=$content."<tr><td><b>Carbs (meal)</b></td><td>$carbperday g</td><td>$carbpermeal g</td></tr>";
                        $content=$content."<tr><td><b>Fat (meal)</b></td><td>$fatperday g</td><td>$fatpermeal g</td></tr>";
                        $content=$content."</table>";
                            break;
                        case 2: // Maintenance
                        $proteinperday=round((($calneed*0.4)/4)/0.33,0);
                        $proteinpermeal=round($proteinperday/$xmpd,0);
                        $carbperday=round((($calneed*0.4)/4)/0.33,0);
                        $carbpermeal=round($carbperday/$xmpd,0);
                        $fatperday=round((($calneed*0.2)/9)/0.33,0);
                        $fatpermeal=round($fatperday/$xmpd,0);
                        $content=$content."To maintain your current weight you must consume:<br />";
                        $content=$content."<table width=\"60%\" border=\"1\" cellspacing=\"0\">";
                        $content=$content."<tr><td>$xmpd";if($xmpd>1){$content.=" meals";}else{ $content.=" meal";} $content.="</td><td><b>Per Day</b></td><td><b>Per meal</b></td></tr>";
                        $content=$content."<tr><td><b>Protein </b></td><td>$proteinperday g</td><td>$proteinpermeal g</td></tr>";
                        $content=$content."<tr><td><b>Carbs </b></td><td>$carbperday g</td><td>$carbpermeal g</td></tr>";
                        $content=$content."<tr><td><b>Fat (meal)</b></td><td>$fatperday g</td><td>$fatpermeal g</td></tr>";
                        $content=$content."</table>";

                            break;
                }
                echo $content;
                echo "<a href=\"\">Click here for meal plans</a>";
}
?>
<br /><br />
<table>
<form action="" method="POST">
<tr><td>Name:</td><td><input type="text" name="xname" id="xname" value="" /></td></tr>
<tr><td>Gender:</td><td><select name="xgender">
                            <option value="f">Female</option>
                            <option value="m">Male</option>
            </select></tr></tr>
<tr><td>Weight:</td><td><input type="text" name="xweight" value="" />Kgs</td></tr>
<tr><td>Height:</td><td><input type="text" name="xheight" value="" /> cms</td></tr>
<tr><td>Age:</td><td><input type="text" name="xage" value="" /> </td></tr>
<tr><td>Activity Level:</td><td><select name="xactivity">
                        <option value="1">Sendentary</option>
                        <option value="2">Lightly Active</option>
                        <option value="3">Moderately Active</option>
                        <option value="4">Very Active</option>
                        <option value="5">Extra Active</option>
                </select></td></tr>
                <tr><td>Meals Per day:</td><td><input type="text" name="xmpd" value="" /> </td></tr>
                <tr><td>Goal:</td><td><select name="xgoal">
                        <option value="1">Weight Loss</option>
                        <option value="2">Maintenance</option>
                </select></td></tr>
<tr><td> </td><td><input type="submit" name="submit" /></td></tr>
</form>
</table>
