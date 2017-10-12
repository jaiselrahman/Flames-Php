<?php
/**
* Copyright [2017] [jaiselrahman]
*
* Licensed under the Apache License, Version 2.0 (the "License");
* you may not use this file except in compliance with the License.
* You may obtain a copy of the License at
*
*     http://www.apache.org/licenses/LICENSE-2.0
*
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an "AS IS" BASIS,
* WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
* See the License for the specific language governing permissions and
* limitations under the License.
*/

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
          <form class="form-horizontal" style="margin-top: 36px;" role="form" action="/flames/index.php"
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
            <div class="col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6">
				<table width="100%" border=0>
					<tr><td >
						<button type="button" class="btn btn-info" onClick="clearText();">Clear</button>
					</td>
					<td align="right">
						<button type="submit" class="btn bg-primary" >Do Flames...!</button> 
					</td></tr>
				</table>				
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
		<div class="well text-center">
			<text class="text-danger"> Download Flames app for Android </text>
			<a href="http://jaisel.000webhostapp.com/apps/com.jaisel.flames-1.3.0.apk" target=_self>
				<button class="btn btn-danger" style="margin-left: 20px">Download</button>
			</a>
		</div>
      </body>
    </html>
END;
}

