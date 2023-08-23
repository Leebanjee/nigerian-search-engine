<aside id="sidebar-left" class="sidebar-left">
				
                <div class="sidebar-header">
                    <div class="sidebar-title">
                        
                    </div>
                    <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
                        <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                    </div>
                </div>
            
                <div class="nano">
                    <div class="nano-content">
                        <nav id="menu" class="nav-main" role="navigation">
                        
                            <ul class="nav nav-main">
                                <li class="nav-active">
                                    <a href="?url=Dashboard">
                                        <i class="fa fa-home" aria-hidden="true"></i>
                                        <span>Dashboard</span>
                                    </a>                        
                                </li>
                                <li class="nav-parent">
                                    <a href="#">
                                        <i class="fa fa-users" aria-hidden="true"></i>
                                        <span>Users</span>
                                    </a>
                                    <ul class="nav nav-children">
                                                               
                                                                
                                        <li>
                                            <a href="?url=Users">
                                                All Users
                                            </a>
                                        </li>
                                                                <li>
                                            <a href="?url=createUser">
                                                Create User
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                                        <li class="nav-parent">
                                    <a href="#">
                                        <i class="fa fa-gear" aria-hidden="true"></i>
                                        <span>Posts</span>
                                    </a>
                                    <ul class="nav nav-children">
                                        <li>
                                            <a href="?url=Posts">
                                                All Posts
                                            </a>
                                        </li>
                                        
                                    </ul>
                                </li>
                                <li class="nav-parent">
                                    <a href="">
                                        <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                        <span>Sites</span>
                                    </a>
                                    <ul class="nav nav-children">
                                                                <li>
                                            <a href="?url=Sites">
                                               All Sites
                                            </a>
                                        </li>
                                       
                                    </ul>
                                </li>
                                <li class="nav-parent">
                                    <a href="#">
                                        <i class="fa fa-image" aria-hidden="true"></i>
                                        <span>Images</span>
                                    </a>
                                    <ul class="nav nav-children">
                                        <li>
                                            <a href="?url=Images">
                                                All Images
                                            </a>
                                        </li>
                                        
                                    </ul>
                                </li>
                                
                                </li>
                                <li class="nav-parent">
                                    <a href="#">
                                        <i class="fa fa-gear" aria-hidden="true"></i>
                                        <span>Crawler</span>
                                    </a>
                                    <ul class="nav nav-children">
                                        <li>
                                            <a href="?url=Crawler">
                                                Web Crawler
                                            </a>
                                        </li>
                                        
                                    </ul>
                                </li>
                                
                                </li>
                                <li class="nav-parent">
                                    <a href="#">
                                        <i class="fa fa-gears" aria-hidden="true"></i>
                                        <span>Settings</span>
                                    </a>
                                    <ul class="nav nav-children">
                                        <li>
                                            <a href="#">
                                                Settings
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                Settings
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
            
                        <hr class="separator" />
            
                        <div class="sidebar-widget widget-tasks">
                            <div class="widget-header">
                                <h6>More</h6>
                                <div class="widget-toggle">+</div>
                            </div>
                            <div class="widget-content">
                                <ul class="list-unstyled m-none">
                                    <li><a href="crawler/webcrawler.php">Crawling</a></li>
                                </ul>
                            </div>
                            <div class="widget-content">
                                <ul class="list-unstyled m-none">
                                    <li><a href="../includes/logout/Logout.php">Logout</a></li>
                                </ul>
                            </div>
                        </div>
            
                        <hr class="separator" />
                    </div>
            
                    <script>
                        // Maintain Scroll Position
                        if (typeof localStorage !== 'undefined') {
                            if (localStorage.getItem('sidebar-left-position') !== null) {
                                var initialPosition = localStorage.getItem('sidebar-left-position'),
                                    sidebarLeft = document.querySelector('#sidebar-left .nano-content');
                                
                                sidebarLeft.scrollTop = initialPosition;
                            }
                        }
                    </script>
                    
            
                </div>
            
            </aside>