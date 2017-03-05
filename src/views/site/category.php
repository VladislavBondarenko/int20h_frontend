<?php include ROOT.'/src/views/layouts/header.php'; ?>

<div class="container">


    <div class="row row-content" style="background:white;">

        <?php foreach($news as $new) { ?>

        <!--<div class="col-xs-12 col-sm-3 col-sm-push-9">
            <p style="padding:20px;"></p>
            <h3 align="center">Our Lipsmacking Culinary Creations</h3>
        </div>
        <div class="col-xs-12 col-sm-9 col-sm-pull-3">-->
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

                            <span class="label <?=$colors[$i]?> btn-group-sm"><?= $tag->name?></span>

                        <?php $i++;} ?>
                    </ul>
                    <h2 style="font-size:20px"><?= $new->intro?></h2>
                    <p><a href='/site/new/?id=<?=$new->id?>' class="btn btn-primary btn-xs">More &raquo;</a></p>
                </div>
        </div>

        <?php } ?>

    </div>
</div>


</body>
</html>
