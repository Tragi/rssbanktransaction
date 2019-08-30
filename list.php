<table class="table table-sm ">
    <thead>
        <tr>
            <th scope="col" style="width:30%">Datum</th>
            <th scope="col" style="width:14%">Grain</th>
            <th scope="col" style="width:14%">Wood</th>
            <th scope="col" style="width:14%">Stone</th>
            <th scope="col" style="width:14%">Iron</th>
            <th scope="col" style="width:14%">Gold</th>
        </tr>
    </thead>
    <tbody>
        <?php $sum = echoTransactions(); ?>
    </tbody>
</table>
<table class="table table-sm "><thead>
<?php echo $sum; ?>
</thead></table>
