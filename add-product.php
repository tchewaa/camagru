<?php
require "includes/header.php";
?>
<section class="register-class">
            <div class="container">
                <div class="row">
                    <h1 class="register-header">-Add Product-</h1>
                    <div class="row">
                        <div class="reg-form">
                            <?php
                                if (isset($_POST["add_product"]))
                                {
                                    $filename = $_FILES['file']['name'];
                                    $target_dir = "upload/";
                                    $target_file = $target_dir . basename($_FILES["file"]["name"]);
                                    // Select file type
                                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                                    // Valid file extensions
                                    $extensions_arr = array("jpg","jpeg","png","gif");
                                    
                                    if(empty($product_name) || empty($product_description) || empty($product_quantity) || empty($product_price) || empty($product_image) || empty($filename))                                  {
                                        echo '<p class="error">Fields must not be empty.</p>';
                                    }

                                    // Check extension
                                    if( in_array($imageFileType,$extensions_arr) ){
                                        


                                        // Convert to base64 
                                        $image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']) );
                                        $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;

                                        // Insert record
                                        //$query = "insert into images(name,image) values('".$name."','".$image."')";
                                    
                                        //mysqli_query($con,$query) or die(mysqli_error($con));
                                        
                                        // Upload file
                                        move_uploaded_file($_FILES['file']['tmp_name'],'upload/'.$filename);

                                    }
                                }
                            ?>
                            <form enctype="multipart/form-data" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                <input type="text" value = "<?php if(isset($_POST['product_name'])){echo $_POST['product_name'];}?>" name="product_name" placeholder="Product Name"><br/><br/>
                                <input type="text" value = "<?php if(isset($_POST['product_description'])){echo $_POST['product_description'];}?>" name="product_description" placeholder="Product Description"><br/><br/>
                                <input type="text" value = "<?php if(isset($_POST['product_quantity'])){echo $_POST['product_quantity'];}?>" name="product_quantity" placeholder="Product Quantity"><br/><br/>
                                <input type="text" value = "<?php if(isset($_POST['product_price'])){echo $_POST['product_price'];}?>" name="product_price" placeholder="Price"><br/><br/>
                                <select name="category_name">
                                    <option value="">Select Category</option>
                                    <?php
                                        $sql = "SELECT * FROM `categories`";
                                        $res = $conn->query($sql);
                                        while ($rows = mysqli_fetch_assoc($res)){ 
                                        ?>
                                        <option value="<?php echo $rows['category_id'];?>"><?php echo $rows['category_name'];?></option>

                                        <?php
                                        } 
                                        ?>
                                    </select> <br/><br/>
                                <input type='file' name='file' /><br/><br/>
                                <button class ="primary-button" type="submit" name="add_product">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>