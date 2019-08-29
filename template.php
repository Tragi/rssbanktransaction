<!doctype html>
<html lang="en">
    <?php include("header.html"); ?>
    <body>
        <div class="container">
            <div class="row">
                <div class="p2 col-4">
                    <h1>Banka</h1>
                    <div class="">
                        <?php include("form.html"); ?>
                    </div>
                </div>
                <div class="p2 col-4">
                    <h1>Historie pohybu</h1>
                    <div class="" id="transactionList">
                        <?php include("list.php"); ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
