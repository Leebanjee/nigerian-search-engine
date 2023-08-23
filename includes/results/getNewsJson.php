<?php

$json_data = file_get_contents("searchres.json"); 
$data= json_decode($json_data,true);
$data = $data["webPages"]["value"];
foreach($data as $keys => $value){
    echo '<div class="site-result-container">
    <span class="url">'. $value["url"] .' </span>
    <h3 class="title">
    <a class = "title-url" href="'. $value["url"] .'">
    '. $value["url"] .'
    </a></h3>
    <span class="description">'.$value["snippet"] .'</span>
    <hr>
    ';
   
}
// <div class='site-result-container'>
               
// <span class='url'>$url</span>
// <h3 class='title'>
// <a class = 'title-url' href=$url data-id=$id>
// $titleT
// </a>
// </h3>
// <span class='description'>$descriptionT</span>


         
// </div>