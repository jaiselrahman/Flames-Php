<?php
ini_set('default_socket_timeout', 600);
ini_set('mysql.connect_timeout', 600);

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/flames.php';

$app = new Slim\App();

$app->get('/', function ($req, $res, $args) use ($app) {
	$n1 = $_GET['name1'];
	$n2 = $_GET['name2'];
	if(isset($n1) and isset($n2) and $n1 == $n2) {
		$result = "Seems to be same person";
	} else {
		$result = flames($n1,$n2);
	}
    printResponse($n1,$n2,$result);
});

$app->get('/{name1}[/{name2}]', function ($req, $res, $args){
    if($args['name1'] == $args['name2']) {
		$result = "Seems to be same person";
	} else if (!isset($args['name2'])) {
		$result = "Enter Another Name";
	} else {
		$result = flames($args['name1'], $args['name2']);
	}
    printResponse($args['name1'],$args['name2'],$result);
});

$app->run();

function printResponse($name1, $name2, $result) {
    echo  <<< END
    <!DOCTYPE html>
    <html>
      <head>
        <meta content="text/html" http-equiv="content-type">
        <title>Flames</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="/flames/bs/css/bootstrap.min.css" rel="stylesheet">
        <script src="/flames/utils.js"></script>
      </head>
      <body class="container">
        <h1 class="bg-primary" style="text-align: center">Flames</h1>
        <div class="well" style="margin-top: 100px;">
          <form class="form-horizontal" style="margin-top: 36px;" role="form" action="./index.php"
            method="GET">
            <div class="form-group row">
              <div class="col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6"> <input
                  class="form-control" name="name1" id="name1" value="{$name1}" placeholder="Enter Your Name" 
                  autofocus="true" type="text" required="true"> </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6"> <input
                  class="form-control" name="name2" id="name2" value="{$name2}" placeholder="Enter Another Name" 
                  type="text" required="true"> </div>
            </div>
            <div class="form-group row">
				<div class="col-sm-offset-2 col-sm-2 col-md-offset-3 col-md-1"> 
					<button type="button" class="btn btn-info" onClick="clearText();">Clear</button>
				</div>
		
				<div class="col-sm-6 col-md-5" style="text-align: right">
					<button type="submit" class="btn  bg-primary">Do Flames...!</button> 
				</div>
			</div>
			
            <div class="form-group row">
            <strong>
              <div class="alert-success text-center text-danger" id="result">{$result}
              </div>
              </strong>
            </div>
          </form>
        </div>
      </body>
    </html>
END;
}

