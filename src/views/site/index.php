<?php include ROOT.'/src/views/layouts/header.php'; ?>
<div style="background:royalblue;clear:both;overflow:hidden;">
<div class="row row-content col-xs-12 col-sm-8 col-lg-8">
    <div class="col-xs-12">
        <div id="mycarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#mycarousel" data-slide-to="0" class="active"></li>
                <li data-target="#mycarousel" data-slide-to="1"></li>
                <li data-target="#mycarousel" data-slide-to="2"></li>
                <li data-target="#mycarousel" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner" role="listbox">

               <?php for ($i=0; $i<4; $i++) { ?>

                <div class="item <?php if ($i==0) { echo 'active'; } ?>">
                    <img src="/src/template/img/news/<?= $news[$i]->id?>.jpg" alt="<?= $news[$i]->header?>" class="img-responsive">
                    <div class="carousel-caption"  style="color:white">
                        <h2><?= $news[$i]->header?></h2>
                        <p><?= $news[$i]->intro?></p>
                        <p><a class="btn btn-primary btn-s" href='/site/new/?id=<?=$new->id?>'>More &raquo;</a></p>
                    </div>
                </div>

                <?php } ?>

            </div>
            <a class="left carousel-control" href="#mycarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#mycarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            <div class="btn-group" id="carouselButtons">
                <button class="btn btn-danger btn-xs" id="carousel-pause">
                    <span class="glyphicon glyphicon-pause" aria-hidden="true"></span>
                </button>
                <button class="btn btn-danger btn-xs" id="carousel-play">
                    <span class="glyphicon glyphicon-play" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="row row-content col-xs-12 col-sm-4 col-lg-4">

        <?php foreach($news as $new) { ?>

            <div class="media media-object img-thumbnail" style="margin-right:15px">
                <div class="media-left media-middle col-sm-4">
                    <a href="#">
                        <img class="media-object img-thumbnail"
                             src="/src/template/img/news/<?= $new->id?>.jpg" alt="<?= $new->header?>">
                    </a>
                </div>
                <div class="media-body">
                    <h1 class="media-heading" style="font-size:24px"><?=$new->header?></h1>
                    <ul class="list-group">

                        <?php $colors = ['label-primary','label-success','label-info','label-warning','label-danger'];
                        $i = 0;
                        ?>

                        <?php foreach ($new->tags as $tag) { ?>

                            <span class="label <?=$colors[$i]?> btn-group-sm"><?= $tag->name?></span>

                            <?php $i++;} ?>
                    </ul>
                    <h2 style="font-size:16px"><?= $new->intro?></h2>
                    <p><a href='/site/new/?id=<?=$new->id?>' class="btn btn-primary btn-xs">More &raquo;</a></p>
                </div>
            </div>

        <?php } ?>

</div>
</div>


<script>
    $(document).ready(function(){
        $("#mycarousel").carousel( { interval: 3000 } );
        $("#carousel-pause").click(function(){
            $("#mycarousel").carousel('pause');
        });
        $("#carousel-play").click(function(){
            $("#mycarousel").carousel('cycle');
        });
    });
</script>

</body>
</html>