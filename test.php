<?php


$randomWords = "Cool,Strange,Funny,Laughing,Nice,Awesome,Great,Horrible,Beautiful,PHP,Vegeta,Italy,Joost";



$words=str_word_count($randomWords, 1);



echo $words[0];


// var_dump(strtolower($randomWords));

//  $randomWords = ['Cool','Strange','Funny','Laughing','Nice','Awesome','Great','Horrible','Beautiful','PHP','Vegeta','Italy','Joost'];

// //  $randomWords = ['Cool','Strange','Funny'];

// function combine($array) {
//     // initialize by adding the empty set
//     $results = [[]];

//     foreach ($array as $element){
//         foreach ($results as $combination){
//             array_push($results, array_merge([$element], $combination));

//         }
//     }

//     return $results;
// }

// print_r(combine($randomWords));

