<?php
for($hour = 0; $hour < 24; $hour++){
    echo $hour.':00 is ';

    switch($hour){
        case 8:
        case 9:
        case 10:
        case 11:
        case 12:
        case 13:
        case 14:
        case 15:
        case 16:
        case 17:
            echo 'light';
            break;
        default:
            echo 'dark';
    }

    echo '<br>';
}