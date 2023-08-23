<?php 
include("../../Database/databaseconfig.php");
include("../../Database/connection.php");
class SitesSearch {
    

    public function getResults($page,$pageSize,$searchTerms){

        global $connect;
        
        $startingRecord = ($page-1)*$pageSize;
        $condition = ''; 
        $query = explode(" ", $searchTerms);
        foreach($query as $text)  
        {  
                                $condition .= "description LIKE '%".mysqli_real_escape_string($connect, $text)."%' OR ";
                                $condition .= "url LIKE '%".mysqli_real_escape_string($connect, $text)."%' OR ";
                                $condition .= "title LIKE '%".mysqli_real_escape_string($connect, $text)."%' OR ";
                                $condition .= "keywords LIKE '%".mysqli_real_escape_string($connect, $text)."%' OR ";
                                
                                
                              
                          } 
                          $stm = "ORDER BY timesvisited DESC LIMIT $startingRecord, $pageSize";
         $condition = substr($condition, 0, -4);
         $sql_query = "SELECT * FROM sites WHERE " . $condition . $stm;  
         $count_query = "SELECT COUNT(1) AS TotalCount  FROM sites WHERE " . $condition;  
        $result = mysqli_query($connect, $sql_query);
        $countResult = mysqli_query($connect, $count_query);
        
     

        

        $data = $row = mysqli_fetch_array($countResult);

        $count = $data["TotalCount"];
$text = $count == 1 ? 'result': 'results';
        if ($count == 1) {
          $text = 'result';
        }

        $results = "<p class='searchCount'>Your search for <i>$searchTerms</i> produce About $count $text</p>";
        if(mysqli_num_rows($result) > 0)  
        {  
             $records ="<div class='site-results'>";
             while($row = mysqli_fetch_array($result))  
             {  
                  $url = $row["url"];
                  $id = $row["id"];
                  $title = $row["title"];
                  $description = $row["description"];
                  $descriptionT = $this->trimField($description, 100);
                  
                  $titleT = $this->trimField($title, 55);
               $records .= " <div class='site-result-container'>
               
               <span class='url'>$url</span>
               <h3 class='title'>
               <a class = 'title-url' href='$url' data-id='$id'>
               $titleT
               </a>
               </h3>
               <span class='description'>$descriptionT</span>
               
               
                        
               </div>
               "
               ;
          }
           $records .= "</div>";
           
           $results .=  $records;
           
          }  
          
          else  
          {  
             echo '<label>Results not Found</label>';  
          }  
    
   

        return array( $count,$results);
    }
    private function trimField($string, $characterLimit) 
	{
		$dots = strlen($string) > $characterLimit ? "..." : "";
		return substr($string, 0, $characterLimit) . $dots;
	}
}
?>