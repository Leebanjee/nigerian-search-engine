<div class="wrapper">
        <div class="headerSection">
            <div class="headercontent">
                <div class="image_container">
                    <a href="../../index.php">
                        <img src="assests/logo.png" />
                    </a>
                </div>
                <div class="">
                    <form action="results.php" class='search'>
                        <div class="searchInput">

                            
                            
                            <input value="<?php echo $type; ?>" type="hidden" name="searchType" />
                            <input value="<?php echo $term; ?>" type="text" class="search__inputbox" name="searchTerm" />
                            

                            <button>

                                <i  class="fa fa-search searchInputIcon" ></i>
                            </button>
                        </div>
                        <br>
                        
                    </form>
                </div>
            </div>
            
            <div class='searchPage'>
                <div class='SearchPage__header'>
                    
                    
                    <div class='SearchPage__headerBody'>
                       
        
                        <div class='searchPage__Options'>
                            <div class='searchPage__OptionsLeft'>
        
                                <div class='searchPage__Options'>
                                <div class="<?php echo $type == 'sites' ? 'active' : ''?>">
                                <div class="flexbox">

                                    <i class="fa fa-search"></i>
    
                                        
                                        <a href="<?php echo "results.php?searchTerm=$term&searchType=sites"?>">Sites</a>
                                </div>    
                                    
                                </div>
                                </div> 
                                <div class='searchPage__Options'>
                                <div class="<?php echo $type == 'images' ? 'active' : ''?>">   
                                <div class="flexbox">

                                    <i class="fa fa-image"></i>
                                    <a href="<?php echo "results.php?searchTerm=$term&searchType=images"?>">Images</a>
                                    </div>
                                </div>
                                </div>
                                <div class='searchPage__Options'>
                                <i class="fa fa-news"></i>
                                <a href="<?php echo "results.php?searchTerm=$term&searchType=sites"?>">News</a>
                                </div>
                                <div class='searchPage__Options'>
                                <i class="fa fa-description"></i>
                                <LocalOfferIcon />
                                <a href="<?php echo "results.php?searchTerm=$term&searchType=sites"?>">Shopping</a>
                                
                                </div>
                                
                                <div class='searchPage__Options'>
                                <i class="fa fa-description"></i>
                                <MoreVertIcon />
                                <a href="<?php echo "results.php?searchTerm=$term&searchType=sites"?>">More</a>
                                </div>
                            </div>
                            <div class='searchPage__OptionsRight'>
                                <div class='searchPage__Options'>
                    
                                <Link to={'/settings'}>Settings</Link>
                                 </div>
                                 <div class='searchPage__Options'>
                                
                                <Link to={'/tools'}>Tools</Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">   
        </div>
            <div class="headerlist">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container shadow">
                            
                    
                            <div class="resultsSection">
                                    <div id="google_translate_element"></div>

                                <script type="text/javascript">
                                function googleTranslateElementInit() {
                                new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.inlineLayout.SIMPLE}, 'google_translate_element');
                                }
                                </script>

                                <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                                <?php 
                                $resultInstance = $type == 'images' ? new ImagesSearch() : new SitesSearch();
                                $resultInstance1 = $type == 'news' ? new News() : new ImagesSearch();
                                $resultRequired = $type == 'images' ? 20 : 10;
                                $results = $resultInstance->getResults($page,$resultRequired,$term);

                                echo $results[1];
                                
                                ?>
                            </div>
                                    <div class="">
                                                <div class="">
                                                    <div class="flexbox">
                                                        
                                                    
                                                                <?php                 
                                                                $maxPages = 10;
                                                                $pagesRequired = ceil($results[0]/$resultRequired);
                                                                $pagesToShow = min($pagesRequired,$maxPages);
                                                                $currentPage = $page - ($maxPages/2);
                                                                if($currentPage <=0){
                                                                    $currentPage = 1;
                                                                }
                                                                if($currentPage + $pagesToShow >= $pagesRequired){
                                                                    $currentPage =  $pagesRequired - $pagesToShow + 1;
                                                                }
                                                                while($pagesToShow !=0){
                                                                    
                                                                    if($currentPage == $page){
                                                                        echo "<nav aria-label='Page navigation example'>
                                                                            <ul class='pagination justify-content-center pagination-sm'>
                                                                            <li class='page-item disabled'><a class='page-link'>$currentPage</a></li>
                                                                            </ul>
                                                                            
                                                                            </nav>";
                                                                    }
                                                                    else{
                                                                    echo "<nav aria-label='Page navigation example'>
                                                                    <ul class='pagination justify-content-center'>
                                                                            <li class='page-item'><a class='page-link' href='results.php?searchType=$type&searchTerm=$term&page=$currentPage'>
                                                                                
                                                                            $currentPage
                                                                        </a></li>
                                                                            </ul>
                                                                            
                                                                        </nav>";
                                                                    }

                                                                    $pagesToShow--;
                                                                    $currentPage++;
                                                                }
                                                                ?>
                                                    </div>
                                                </div>
                                     </div>
                        </div>
                    </div>
                    
                    </div>
                </div>
            </div>
        </div>
</div>


            </div>
                </div>
        </div>
</div>
