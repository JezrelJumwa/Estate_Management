<!-- Blog Archive -->
<section id="aa-blog-archive">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="aa-blog-archive-area aa-blog-archive-2">
                    <div class="row">
                        <div class="col-md-3">
                            <aside class="aa-blog-sidebar">
                                <?php
                                    
                                    if(isset($uid) && $uid !=="" && $change_pass == 0){
                                        require_once("pages/side_bar.php");
                                    }
                                    
                                ?>
                            </aside>
                        </div>
                        <div class="col-md-9">
                            <aside class="aa-blog-sidebar">
                            
                            <?php
                                
                                if(isset($uid) && $uid !=="" && $change_pass == 0){
                                    require_once $module->loadPage();
                                
                                }else{
                                    if($change_pass == 0){ 
                                        // Login
                                        require_once("forms/login.php");
                                        
                                    }else{
                                        // Change pass
                                        
                                    }
                                    
                                }
                                
                            ?>
                            
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

                            