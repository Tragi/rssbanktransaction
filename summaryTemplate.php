<!doctype html>
<html lang="en">
    <?php include("header.html"); ?>
    <body>
        <div class="body">
            <div class="row">
                <div class="p2 col-12">
                    <h2>Výpis</h2>
                    <div class="">
                        <table class="table table-sm fixed_header">
                            <thead>
                                <tr>
                                    <th scope="col" style="width:220px">Uživatel</th>
                                    <th scope="col" style="width:120px">Grain</th>
                                    <th scope="col" style="width:120px">Wood</th>
                                    <th scope="col" style="width:120px">Stone</th>
                                    <th scope="col" style="width:120px">Iron</th>
                                    <th scope="col" style="width:120px">Gold</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sum = echoTransactions(); ?>
                            </tbody>
                            <tfoot>
                                <?php echo $sum; ?>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
