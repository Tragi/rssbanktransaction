<?php

error_reporting(E_ALL);

$db = parse_url(getenv("DATABASE_URL"));
$host='ec2-54-217-235-87.eu-west-1.compute.amazonaws.com';
$dbname = 'd4es7alaadvmih';
$username = 'zhtzkjcvxxjmfk';
$password = '0d089aae8342db654d90cb7cb2e652bdf303918af61f9d997f380a80aba204f0';
$dsn = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";
    
try {
    $pdo = new PDO($dsn);

	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling
//    $sql ="CREATE TABLE banks (ID serial PRIMARY KEY, Name VARCHAR(50) NOT NULL, Created timestamp);" ;
//    $pdo->exec($sql);
    
//    $sql ="CREATE TABLE users(ID serial PRIMARY KEY, Name VARCHAR(50) NOT NULL, Role integer NOT NULL, Created timestamp);" ;
//    $pdo->exec($sql);
    
//    $sql ="CREATE TABLE transactions (ID serial PRIMARY KEY, UID integer NOT NULL, BID integer NOT NULL, Grain integer NOT NULL, Wood integer NOT NULL, Stone integer NOT NULL, Iron integer NOT NULL, Gold integer NOT NULL, Created timestamp);";
//    $pdo->exec($sql);
    
    
} catch(PDOException $e) {
    echo $e->getMessage();//Remove or change message in production code
}

?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>    </head>

<script>
$(document).ready(function() {
                  var resources = ["grain","wood","stone","iron","gold"]
                  for (i = 0; i < resources.length; i++) {
                  (function (i) {
                   var slider = $("#" + resources[i] + "Slider");
                   var input = $("#" + resources[i] + "Input");
                   slider.val("0");
                   input.val("0");
                   slider.on("input change", function(e) {
                             input.val($(this).val())
                             });
                   input.on("input change", function(e) {
                            slider.val($(this).val())
                            });
                   })(i)
                  }
                  $("button#submit").click(function(){
                                           alert($("#transactionForm").serialize())
                                           $.ajax({
                                                  type: "POST",
                                                  url: "postTransaction",
                                                  data: $("#transactionForm").serialize(),
                                                  success: function(msg){},
                                                  error: function(){}
                                                  })
                                           });
                  });
</script>
<body>
    <div class="p2 col-4">
        <h1>Banka</h1>
        <div class="">
            <form id="transactionForm" method="post" action="postTransaction" onsubmit="return false;">
                <label for="customRange2">Grain</label>
                <div class="form-group row">
                    <div class="d-flex flex-fill">
                        <div class="col-8">
                            <input type="range" class="custom-range align-middle" min="0" max="10000000" step="100000" value="0"  id="grainSlider" />
                        </div>
                        <div class="col-4">
                            <input class="form-control" type="number" min="0" max="10000000" step="100000" value="0" id="grainInput" />
                        </div>
                    </div>
                </div>
                <label for="customRange2">Wood</label>
                <div class="form-group row">
                    <div class="d-flex flex-fill">
                        <div class="col-8">
                            <input type="range" class="custom-range align-middle" min="0" max="10000000" step="100000" value="0"  id="woodSlider" />
                        </div>
                        <div class="col-4">
                            <input class="form-control" type="number" min="0" max="10000000" step="100000" value="0" id="woodInput" />
                        </div>
                    </div>
                </div>
                <label for="customRange2">Stone</label>
                <div class="form-group row">
                    <div class="d-flex flex-fill">
                        <div class="col-8">
                            <input type="range" class="custom-range align-middle" min="0" max="10000000" step="100000" value="0"  id="stoneSlider" />
                        </div>
                        <div class="col-4">
                            <input class="form-control" type="number" min="0" max="10000000" step="100000" value="0" id="stoneInput" />
                        </div>
                    </div>
                </div>
                <label for="customRange2">Iron</label>
                <div class="form-group row">
                    <div class="d-flex flex-fill">
                        <div class="col-8">
                            <input type="range" class="custom-range align-middle" min="0" max="10000000" step="100000" value="0"  id="ironSlider" />
                        </div>
                        <div class="col-4">
                            <input class="form-control" type="number" min="0" max="10000000" step="100000" value="0" id="ironInput" />
                        </div>
                    </div>
                </div>
                <label for="customRange2">Gold</label>
                <div class="form-group row">
                    <div class="d-flex flex-fill">
                        <div class="col-8">
                            <input type="range" class="custom-range align-middle" min="0" max="10000000" step="100000" value="0"  id="goldSlider" />
                        </div>
                        <div class="col-4">
                            <input class="form-control" type="number" min="0" max="10000000" step="100000" value="0" id="goldInput" />
                        </div>
                    </div>
                </div>
                <br />
                <div class="form-group row">
                    <div class="d-flex justify-content-end col-12">
                        <button id="submit" class="btn btn-primary col-3" data-dismiss="modal">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
