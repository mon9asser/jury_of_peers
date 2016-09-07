<?php
   $file = dirname(__FILE__)."/../modular/autoload_apps.php";
   if(is_file($file)) require_once $file;
   
if(!isset($_POST['GroupType']))
        return false ;
    
?> 


<?php
                                $getApiMainArgs = new main_get_app();
                                $videosAccGroup = $getApiMainArgs->get_apps_sum_desc_reviews(2,$_POST['GroupType']/*video type*/);
                                  
                            ?>
<?php
    if(count($videosAccGroup) != 0 ){
?>
                            <?php for ($i=0;$i<count($videosAccGroup);$i++){ 
                                
                                 $vide_post_apis = new video_posts_applications() ;
                                     $videoInfo = $vide_post_apis->video_posts_check_exist(['id'=>$videosAccGroup[$i]->post_id]);
                                ?>
                                <div onclick="window.location.href='video_judge?id=<?php echo $videoInfo->id; ?>'" title="<?php echo $videosAccGroup[$i]->review_counter.' Review(s)'?>" data-toggle="tooltip" data-placement="left"  class="containerFilms">
                                <div class="divationsScore">
                                    Score : 
                                    <span  style="font-weight: bold;line-height: 1;color: teal;">
                                        <?php
                                        
                                              $counts = $videosAccGroup[$i]->review_counter;
                                            $sumRows =$videosAccGroup[$i]->sum_reviews  ;
                                            $fixed = 0.05 ;
                                               if($sumRows != 0 ){
                                               $rowPercent = $counts * $fixed ;
                                               $perccentStar = $sumRows / $rowPercent ;
                                               $starss =     $perccentStar * $fixed     ;
                                               echo substr($starss, 0, 3); 
                                            }else echo 0 ;       
                                        ?>
                                    </span>
                                    <img  src="images/video_on.png" />
                                    
                                </div>
                                <div class="divationsFile">
                                     <?php
                                    
                                            echo substr($videoInfo->video_name, 0, 30).'...';
                                        ?>
                                </div>
                            </div>
                           <?php } 
    }else 
        echo "<center><b style='color:tomato;'> There are No Movies </b></center>";
                           ?> 



  <script src="js/jquery-1.12.4_1.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.raty.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
             $('[data-toggle="tooltip"]').tooltip();
        });
    </script>