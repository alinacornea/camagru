<?php
    session_start();
    include('../../shared/header.php');
    define('UPLOAD_DIR', 'uploads/');
    $file = UPLOAD_DIR . uniqid() . '.png';
    $img = $_POST['hidden'];
    $img_style = $_POST['img_style'];

    $data = str_replace('data:image/png;base64,', '', $img);
    $data = str_replace(' ', '+', $data);
    $decode = base64_decode($data);
    
    if ($img_style == "grayscale(100%)")
    {
        $imgname = "uploads/result1_".$file;
        $img = imagecreatefrompng ($img_name);
        imagefilter($img, IMG_FILTER_GRAYSCALE);
        imagepng($img, $imgname);
    }
    $success = file_put_contents($file, $decode);
?>

<div align="center">
  <img src="<?php echo $file;?>" width="50%" height="60%">
</div>

<?php
    include('../../shared/footer.php');
?>
