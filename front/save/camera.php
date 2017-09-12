<?php
  $data = $_POST['imgData'];
  echo "<script>alert('$data, your picture was saved!')</script>";

?>
<!-- session_start();
function chargerClasse($classe)
{
    require 'classes/'.$classe.'.class.php';
}
spl_autoload_register('chargerClasse');
if (empty($_SESSION['tof']))
    echo "1";
else{
    $dir = dirname(__DIR__, 1);
    $id = md5(microtime(TRUE) * 100000);
    $decoded = base64_decode(substr($_SESSION['tof'],22));
    file_put_contents($dir . '/css/img/camera/'.$id.'.png', $decoded);
    $login = new Login([
        'pseudo' => addslashes($_SESSION['login']),
        'avatar' => addslashes(".png")]);
    $comm = array();
    $like = array();
    $tab1 = serialize($comm);
    $tab2 = serialize($like);
    $error = $login->add_camera($id.".png", $tab1, $tab2);
    unset($_SESSION['tof']);
    echo $id.".png";
} -->
<!-- <?php
// session_start();
// $json = json_decode(file_get_contents('php://input'));
// $base64 = substr($json->data[0]->img, 22);
// $webcam = imagecreatefromstring(base64_decode($base64));
// $filtre = imagecreatefrompng($json->data[0]->filtre);
// imagecreatenew($webcam, $filtre, 0,0,0,0,imagesx($filtre), imagesy($filtre), 100);
// function imagecreatenew($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct)
// {
//     $cut = imagecreatetruecolor($src_w, $src_h);
//     imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
//     imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);
//     imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);
// }
// ob_start();
// imagepng($webcam);
// $imgData = ob_get_contents();
// ob_end_clean();
// $base64 = "data:image/png;base64," . base64_encode($imgData);
// imagedestroy($webcam);
// $_SESSION['tof'] = $base64;
// echo $base64;
?> -->
