        <form id="transactionForm" method="post" action="/." onsubmit="return false;">
            <div class="form-group d-flex flex-fill">
                <span class="align-middle p-2">uživatel:</span>
                <strong class="align-middle col-2 p-2"><?php echo $userName; ?></strong>
                <span class="align-middle col-2"></span>
                <label class="align-middle col-2 p-2" for="sel1">Účet:</label>
                <select class="form-control col-3" id="sel1" name="bank">
                     <?php echo bankOptions(); ?>
                </select>
            </div>
            <label for="customRange2">Grain</label>
            <div class="form-group row">
                <div class="d-flex flex-fill">
                    <div class="col-8">
                        <input type="range" class="custom-range align-middle" min="0" max="10000000" step="100000" value="0"  id="grainSlider" />
                    </div>
                    <div class="col-4">
                        <input class="form-control" type="number" min="0" max="10000000" step="100000" value="0" id="grainInput" name="grain" />
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
                        <input class="form-control" type="number" min="0" max="10000000" step="100000" value="0" id="woodInput" name="wood" />
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
                        <input class="form-control" type="number" min="0" max="10000000" step="100000" value="0" id="stoneInput" name="stone" />
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
                        <input class="form-control" type="number" min="0" max="10000000" step="100000" value="0" id="ironInput" name="iron" />
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
                        <input class="form-control" type="number" min="0" max="10000000" step="100000" value="0" id="goldInput" name="gold" />
                    </div>
                </div>
            </div>
            <br />
            <div class="form-group row">
                <div class="d-flex justify-content-end col-12">
                    <div class="col-5">
                        <input checked="checked" type="checkbox" data-toggle="toggle" data-on="Vklad" data-off="Výběr" id="transactionToggle" name="transaction" data-onstyle="success" data-offstyle="danger"/>
                        <script>
                            $(function() {
                              $('#transactionToggle').bootstrapToggle();
                            })
                        </script>
                    </div>
                    <button id="submit" class="btn btn-primary col-3" data-dismiss="modal">Potvrdit</button>
                </div>
            </div>
        </form>
