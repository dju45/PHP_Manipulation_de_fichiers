<?php
require 'function.php';

$filedir = 'files';
$result   = new RecursiveDirectoryIterator($filedir, RecursiveDirectoryIterator::SKIP_DOTS);
$objects = new RecursiveTreeIterator($result);
$extensions = array('html', 'txt');
$extension = new SplFileInfo($_GET['f']);

    if(isset($_GET['f'])) {
        if (in_array($extension->getExtension(), $extensions)) {
        $path = $_GET['f'];
        $fileContent = file_get_contents($path);
        } else {
            $fileContent= 'You can\'t edit this file';
        }
    }

    if (isset($_POST['content'])) {
        $path = $_POST['file'];
        $file =  fopen($path,"w");
        fwrite($file, $_POST['content']);
        fclose($file);
    }

    if (isset($_GET['d'])) {
        delete_files($_GET['d']);
    }

?>

<?php include('inc/head.php'); ?>
<section>
    <h2>file editor</h2>
    <form action="index.php" method="post" role="form">
        <legend><?= basename($_GET['f']) ?></legend>
        <div class="form-group">
            <input type="hidden" name="file" value="<?=$_GET['f']?>">
            <textarea name="content" class="form-control" rows="10"><?=$fileContent ?></textarea>
            <input type="submit" value="Send">
        </div>
    </form>
    <h2>X-files-manager</h2>
        <?php foreach ($objects as $name => $object) :?>
            <a href=?f=<?=  $name ?>><?=$object?></a>
            <a class="alert-warning" href=?d=<?= $name ?>>Delete</a><br>
        <?php endforeach; ?>
</section>

<?php include('inc/foot.php'); ?>