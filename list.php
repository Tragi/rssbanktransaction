<table class="table table-sm ">
    <thead>
        <tr>
            <th scope="col">Datum</th>
            <th scope="col">Grain</th>
            <th scope="col">Wood</th>
            <th scope="col">Stone</th>
            <th scope="col">Iron</th>
            <th scope="col">Gold</th>
        </tr>
    </thead>
    <tbody>
        <?php $sum = echoTransactions(); ?>
    </tbody>
</table>
<table class="table table-sm "><thead>
<?php echo $sum; ?>
</thead></table>
