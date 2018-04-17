<?php
$filedir = __DIR__.'/files';
$dir = new RecursiveDirectoryIterator($filedir);
var_dump($dir);

foreach    ($dir as $d) {
    echo $d->getBasename();
}
$iterator = new RecursiveIteratorIterator($dir);

              foreach    ($iterator as $i) {
                  echo $i->getBasename();
              }
var_dump($iterator);
$regex = new RegexIterator($iterator, '#^(?:[A-Z]:)?(?:/(?!\.Trash)[^/]+)+/[^/]+\.(?:txt|html)$#Di');
    foreach($regex as $filematch) {
        echo '<a href="?f=' .$filematch .'">';
        echo $filematch->getBasename();
        echo '</a>';
        }
if(isset($_GET['f'])) {
$path = $_GET['f'];
$fileContent = file_get_contents($path);
    }

    if (isset($_POST['content'])) {
        $path = $_POST['file'];
        $file =  fopen($path,"w");
        fwrite($file, $_POST['content']);
        fclose($file);
    }

?>

<?php include('inc/head.php'); ?>
<section>
    <form action="index.php" method="post" role="form">
        <legend>Form Title</legend>
        <div class="form-group">
            <input type="hidden" name="file" value="<?=$_GET['f']?>">
            <textarea name="content" class="form-control" rows="10"><?=$fileContent ?></textarea>
            <input type="submit" value="Send">
        </div>
    </form>



</section>

<?php include('inc/foot.php'); ?>