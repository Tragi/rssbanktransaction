<!doctype html>
<html lang="en">
    <?php include("header.html"); ?>
    <body>
        <div class="body">
            <div class="row">
                <div class="p2 col-12">
                <form id="switchBank" method="get" action="/.">
                    <div class="form-group d-flex flex-fill">
                        <h2 class="align-middle col-2">Výpis</h2>
                        <label class="align-middle col-1 p-2" for="sel1">Banka:</label>
                        <select id="bankSelect" class="form-control col-3" name="bank">
                            <?php echo bankOptions(); ?>
                        </select>
                    </div>
                </form>
                <div class="">
                        <table class="table table-sm fixed_header">
                            <thead>
                                <tr>
                                    <th scope="col" style="width:100px">Uživatel</th>
                                    <th scope="col" style="width:120px">Grain</th>
                                    <th scope="col" style="width:120px">Wood</th>
                                    <th scope="col" style="width:120px">Stone</th>
                                    <th scope="col" style="width:120px">Iron</th>
                                    <th scope="col" style="width:120px">Gold</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sum = echoSummaryTransactions(); ?>
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
