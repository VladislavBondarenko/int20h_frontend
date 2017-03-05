<?php include ROOT.'/src/views/layouts/header.php'; ?>

<div class="container">

    <div class="row row-content" style="background:white;">

        <div class="media media-object img-thumbnail">
            <div class="media-left media-middle col-sm-4">
                <a href="#">
                    <img class="media-object img-thumbnail"
                         src="/src/template/img/news/<?= $new->id?>.jpg" alt="<?= $new->header?>">
                </a>
            </div>
            <div class="media-body">
                <h1 class="media-heading" style="font-size:36px"><?=$new->header?></h1>
                <ul class="list-group">

                    <?php $colors = ['label-primary','label-success','label-info','label-warning','label-danger'];
                    $i = 0;
                    ?>

                    <?php foreach ($new->tags as $tag) { ?>

                        <span class="label <?=$colors[$i]?> btn-group-lg" style="padding: 10px; font-size: 15px"><?= $tag->name?></span>

                        <?php $i++;} ?>
                </ul>
                <h2 style="font-size:20px"><?= $new->text?></h2>
            </div>
        </div>

    </div>
</div>


</body>
</html>
