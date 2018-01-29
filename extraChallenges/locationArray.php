<?php
$people_location_array = [
                                'Oli' => 'Bedminster',
                                'Kye' => 'St. Phillips',
                                'Paul' => 'Worcester',
                                'Nicola' => 'Clifton',
                                'Ellie' => 'Clifton',
                                'Arthur' => 'Southville',
                                'Daniel' => 'Gloucester Road',
                                'David' => 'Stokes Croft',
                                'Liz' => 'Montpelier',
                                'Jonny' => 'Trowbridge',
                            ];




foreach($people_location_array AS $person => $location){
    echo $person.' lives in '.$location.'<br>';
    
}

?>