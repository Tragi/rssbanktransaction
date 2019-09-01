<!doctype html>
<html lang="en">
    <?php include("header.html"); ?>
    <body>
        <div class="body">
            <div class="row">
                <div class="p2 col-12">
                    <h2 class="align-middle col-2">Výpis</h2>
                    <div class="">
                        <table class="table table-sm fixed_header">
                            <thead>
                                <tr>
                                    <th scope="col" style="width:100px">Uživatel</th>
                                    <th scope="col" style="width:120px">T3</th>
                                    <th scope="col" style="width:120px">T4</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sum = echoSummaryArmy(); ?>
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

