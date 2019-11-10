
<?php
    require("includes/header.php");
   
?>
<main>
        <section class="timeline_section">
            <div class="container">
                <div class="row">
                    <div class="timeline_feeds" style="width:100% !important; text-align:center">
                    <h4 class="right">Explore</h4>

                    <?php
                            try{
                                $limit = 5;
                                $sql = "SELECT * FROM `image`";
                                $s = $conn->prepare($sql);
                                $s->execute();
                                $total_results = $s->rowCount();
                                $total_pages = ceil($total_results/$limit);

                                if (!isset($_GET['page'])) {
                                    $page = 1;
                                } else{
                                    $page = $_GET['page'];
                                }

                                $starting_limit = ($page-1)*$limit;

                                $stmt = $conn->prepare("SELECT i.image_id, i.user_id, i.image_caption, i.image_name, i.image_time FROM `image` i  ORDER BY i.image_time DESC LIMIT $starting_limit, $limit"); 
                                $stmt->execute();
                                if ($stmt === false){                                            
                                    $error = "Error: Something went";
                                }else{ 
                                    foreach ($stmt as $row) {
                                        echo "<a class='link' href='post.php?action=post&id=$row[image_id]'><div class='image-container'>";
                                        echo "<img src='".$row['image_name']."' width='250px' height='250px' alt='Posts' class='image'>";
                                        echo    "<div class='overlay'>";
                                        echo        "<div class='text'>".$row['image_caption']."</div>";
                                        echo    "</div>";
                                        echo "</div></a>";
                                        
                                    }
                                }
                                   
                            }catch(PDOException $e){
                                    $error = "Error: ".$e->getMessage();
                            }
                       ?> 
                       <?php
                       echo '<br/><br/><br/>';
                        for ($page=1; $page <= $total_pages ; $page++):?>
                            <ul class="pagination">
                                 <li><a href='<?php echo "?page=$page"; ?>' class="links"><?php  echo $page; ?> </a></li>
                            </ul>
                        <?php endfor; echo '<br/><br/><br/>';?>
                    </div>
                </div>
            </div>
        </section>
</main>
<?php
    require("includes/footer.php");
?>
</body>

</html>