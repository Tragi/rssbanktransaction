<table class="table table-sm fixed_header">
    <thead>
        <tr>
            <th scope="col" style="width:220px">Datum</th>
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
</tfoot></table>
