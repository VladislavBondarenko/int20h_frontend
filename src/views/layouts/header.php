<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Главная</title>
    <link href="/src/template/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/src/template/css/bootstrap-social.css" />
    <link href="/src/template/css/font-awesome.min.css" rel="stylesheet">
    <!--<link href="/src/template/css/prettyPhoto.css" rel="stylesheet">
    <link href="/src/template/css/price-range.css" rel="stylesheet">-->
    <link href="/src/template/css/animate.css" rel="stylesheet">
    <link href="/src/template/css/main.css" rel="stylesheet">
    <link href="/src/template/css/responsive.css" rel="stylesheet">
    <link href="/src/template/css/mystyles.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="/src/template/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="/src/template/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/src/template/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/src/template/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/src/template/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/src/template/images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>


<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><img src="/src/template/img/logo.png" height="auto" width=60px></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/site/index"><span class="glyphicon glyphicon-home"
                                                              aria-hidden="true"></span> Home</a></li>
                <!--<li><a href="aboutus.html">
                        <span class="glyphicon glyphicon-info-sign"
                              aria-hidden="true"></span> About</a></li>-->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                       role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                        Categories <span class="caret"></span></a>
                    <ul class="dropdown-menu">

                    <?php foreach($categories as $category) { ?>

                        <li><a href="/site/category/?category=<?=$category->name?>"><?= $category->name ?></a></li>

                     <?php } ?>

                    </ul>
                </li>
                <!--<li><a href="contactus.html"><i class="fa fa-envelope-o"></i> Contact</a></li>-->
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <!--data-toggle="modal" data-target="#loginModal";-->


                <li>
                <?php if(empty($authorize_url->authUri)) {
//                    print_r($authorize_url);
                    echo '<span class="list-group-item" style="margin-top:8px">'
                        . $userProfile->first_name . ' ' . $userProfile->last_name . '</span>'; ?>
                    <a href="/site/logout" class="btn btn-block btn-social btn-vk">
                        <span class="fa fa-vk"></span> Logout VK
                    </a>
                <?php } else {?>
                    <a href="<?= $authorize_url->authUri ?>" class="btn btn-block btn-social btn-vk">
                        <span class="fa fa-vk"></span> Sing in with VK
                    </a>
                <?php } ?>
                </li>

            </ul>
        </div>
    </div>
</nav>


<div id="reserveModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Reserve a table </h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <span class="col-sm-2 control-label">Number of Guests</span>
                        <div class="col-sm-10">
                            <label class="radio-inline">
                                <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> 1
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> 2
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3"> 3
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> 4
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> 5
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3"> 6
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <span class="col-sm-2 control-label">Section</span>
                        <div class="btn-group col-sm-10" data-toggle="buttons">
                            <label class="btn btn-success active">
                                <input type="radio" name="options" id="option1" autocomplete="off" checked> Non Smoking
                            </label>
                            <label class="btn btn-danger">
                                <input type="radio" name="options" id="option2" autocomplete="off"> Smoking
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <span class="col-sm-2 control-label">Date and Time</span>
                        <div class="col-sm-10">
	                    		<span class="has-feedback">
	                    			<input type="date" class="form-control" placeholder="Date">
	                    			<span class="glyphicon glyphicon-calendar form-control-feedback" aria-hidden="true"></span>
	                    		</span>
                            <span class="has-feedback">
		                    		<input type="time" class="form-control" placeholder="Time">
		                    		<span class="glyphicon glyphicon-time form-control-feedback" aria-hidden="true"></span>
	                    		</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">Reserve</button>
                        </div>
                    </div>
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Warning:</strong>: Please, <strong>call</strong> us to reserve for more than six guests.
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>