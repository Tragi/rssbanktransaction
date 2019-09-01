<!doctype html>
<html lang="en">
    <?php include("header.html"); ?>
    <body>
        <div class="body">
            <div class="row">
                <div class="p2 col-4">
                    <h2>Profil</h2>
                    <div class="">
                        <form id="transactionForm" method="post" action="/." onsubmit="return false;">
                            <label for="customRange2">Gold</label>
                            <div class="form-group row">
                                <div class="d-flex flex-fill">
                                    <div class="col-8">
                                        <input type="range" class="custom-range align-middle" min="0" max="10000000" step="100000" value="0"  id="goldSlider" />
                                    </div>
                                    <div class="col-4">
                                        <input class="form-control" type="number" min="0" max="10000000" step="100000" value="0" id="goldInput" name="gold" />
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="form-group row">
                                <div class="d-flex justify-content-end col-12">
                                    <button id="submit" class="btn btn-primary col-3" data-dismiss="modal">Aktualizovat</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

