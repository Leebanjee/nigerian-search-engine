<?php 
include("../../Database/databaseconfig.php");
include("../../Database/connection.php");
class ImagesSearch {

    public function getResults($page,$pageSize,$searchTerms){

       
        global $connect;

        

        
        $startingRecord = ($page-1)*$pageSize;
        
        $condition = ''; 
        $query = explode(" ", $searchTerms);
        foreach($query as $text)  
        {  
            
            $condition .= "imageurl LIKE '%".mysqli_real_escape_string($connect, $text)."%' OR ";
            $condition .= "title LIKE '%".mysqli_real_escape_string($connect, $text)."%' OR ";
            $condition .= "alt LIKE '%".mysqli_real_escape_string($connect, $text)."%' OR ";
            
            
            
        } 
        $stm = "ORDER BY timesvisited DESC LIMIT $startingRecord, $pageSize";
        $condition = substr($condition, 0, -4);
        $sql_query = "SELECT * FROM images WHERE " . $condition . $stm; 
        $count_query = "SELECT COUNT(1) AS TotalCount  FROM images WHERE " . $condition;   
        $result = mysqli_query($connect, $sql_query);
        $countResult = mysqli_query($connect, $count_query);
        $data = $row = mysqli_fetch_array($countResult);
        
        $count = $data["TotalCount"];
        $results = "<p class='searchCount'>About $count results</p>";
        if(mysqli_num_rows($result) > 0)  
        {  
            $records ="<div class='images-results'>";
             while($row = mysqli_fetch_array($result))  
             {  
                $imageurl = $row["imageurl"];
                $title = $row["title"];
                $id = $row["id"];
                if(!$title){
                    $title = $row["alt"];
                }
                $records .= "<div class='image-result-container'>
                <a href='$imageurl' data-fancybox='image' data-caption='$title' data-id='$id'>
                <img src='$imageurl'>
                </a>          
                </div>";
           }
           $records .= "</div>";
   
           $results .=  $records;
    
             }  
         
        else  
        {  
             echo '<label>Images not Found😁😁</label>';  
         }  
   
        return array( $count,$results);
    }
}
?>