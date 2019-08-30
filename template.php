<!doctype html>
<html lang="en">
    <?php include("header.html"); ?>
    <body>
        <div class="body">
            <div class="row">
                <div class="p2 col-4">
                    <h2>Banka</h2>
                    <div class="">
                        <?php include("form.php"); ?>
                    </div>
                </div>
                <div class="p2 col-8">
                    <h2>Historie pohybů</h2>
                    <div class="" id="transactionList">
                        <?php include("list.php"); ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
