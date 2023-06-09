<?php include('../classes/brand.php'); ?>
<?php include('../classes/category.php');?>
<?php include('../classes/product.php');?>
<?php
    /* update Product */
    /* show category update */
    $productClass = new product();
    if (!isset($_GET['productId']) || $_GET['productId'] == NULL) {
        echo "<script>window.location = 'listProduct.php'</script>";
    } else {
        $id = $_GET['productId'];
    }
    /* Update category */
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $updateProduct = $productClass->updateProduct($_POST, $_FILES, $id);
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/grid.css">
    <link rel="stylesheet" href="./assets/css/frame.css">
    <link rel="stylesheet" href="./assets/css/category.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- <meta http-equiv="refresh" content="5"> -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- boostrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
</head>
<body>
    <div class="main">
        <?php include('./inc/header.php'); ?>
        
        <div class="main__content">
            <?php include('./inc/sliderbar.php'); ?>
            <div class="page_content">
                <div class="header__title">
                    Chỉnh sửa thông tin sản phẩm
                </div>
                <?php 
                    if(isset($updateProduct)) {
                        echo $updateProduct;
                    }
                ?>
                <?php
                    $getProductById = $productClass->getProductById($id);
                    if($getProductById){
                        while($result_product = $getProductById->fetch_assoc()){

                ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                    
                        <tr>
                            <td>
                                <label>Tên sản phẩm</label>
                            </td>
                            <td>
                                <input type="text" name="productName" placeholder="Nhập tên sản phẩm..." value="<?php echo $result_product['TenSanPham']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Danh mục sản phẩm</label>
                            </td>
                            <td>
                                <select id="select" name="category">
                                    <option>Chọn danh mục</option>
                                    <?php
                                    $cat = new category();
                                    $catlist = $cat->showCategory();

                                    if($catlist){
                                        while($result = $catlist->fetch_assoc()){
                                    ?>
                                    
                                        <option 
                                            <?php if($result['ID'] == $result_product['IDDanhMucLon']){
                                                echo 'selected';
                                            } ?>
                                            value="<?php echo $result['ID'] ?>"><?php echo $result['TenDanhMuc'] ?></option>

                                    <?php
                                        }
                                    }
                                ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Thương hiệu sản phẩm</label>
                            </td>
                            <td>
                                <select id="select" name="brand">
                                    <option>Chọn thương hiệu</option>

                                    <?php
                                    $brand = new brand();
                                    $brandlist = $brand->showBrand();

                                    if($brandlist){
                                        while($result = $brandlist->fetch_assoc()){
                                    ?>

                                    <option
                                        <?php if($result['ID'] == $result_product['IDDanhMucCon']){
                                                echo 'selected';
                                        } ?>
                                        value="<?php echo $result['ID'] ?>"><?php echo $result['TenThuongHieu'] ?></option>

                                    <?php
                                        }
                                    }
                                ?>
                                
                                </select>
                            </td>
                        </tr>
                        
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Mô tả</label>
                            </td>
                            <td>
                                <textarea name="product_desc" class="tinymce" id="summernote"><?php echo $result_product['MoTa']; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Giá gốc</label>
                            </td>
                            <td>
                                <input type="text" name="priceOrigin" value="<?php echo $result_product['GiaGoc']; ?>" placeholder="Nhập giá gốc..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Giá Khuyến Mãi</label>
                            </td>
                            <td>
                                <input type="text" name="priceSale" value="<?php echo $result_product['GiaKM']; ?>" placeholder="Nhập giá khuyến mãi..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Cấu hình Ram</label>
                            </td>
                            <td>
                                <input type="text" name="ram" placeholder="Ram..." value="<?php echo $result_product['RAM']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Cấu hình Bộ nhớ</label>
                            </td>
                            <td>
                                <input type="text" name="memo" placeholder="Bộ nhớ..." value="<?php echo $result_product['BoNho']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Cấu hình CPU</label>
                            </td>
                            <td>
                                <input type="text" name="cpu" placeholder="CPU..." value="<?php echo $result_product['CPU']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Màn hình</label>
                            </td>
                            <td>
                                <input type="text" name="screen" placeholder="Màn hình..." value="<?php echo $result_product['ManHinh']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Số lượng</label>
                            </td>
                            <td>
                                <input type="text" name="quatity" placeholder="Nhập số lượng" value="<?php echo $result_product['SoLuong']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Đăng tải hình ảnh</label>
                            </td>
                            <td>
                                <img src="<?php echo $result_product['HinhAnh'] ?>" alt="" style="width:100px;">
                                <input type="file" name="image" />
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" value="Cập nhật" />
                            </td>
                        </tr>
                    </table>
                </form>
                <?php 
                    }
                }
                ?>
            </div>
        </div>

    </div>
</body>
</html>

<!-- summernot editor -->
<script type="text/javascript">
    $('textarea#summernote').summernote({
        placeholder: 'Nhập mô tả',
        tabsize: 2,
        height: 100,
  toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'italic', 'underline', 'clear']],
        // ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
        //['fontname', ['fontname']],
       // ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        ['table', ['table']],
        ['update', ['link', 'picture', 'hr']],
        //['view', ['fullscreen', 'codeview']],
        ['help', ['help']]
      ],
      });
</script>