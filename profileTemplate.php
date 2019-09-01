<!doctype html>
<html lang="en">
    <?php include("header.html"); ?>
    <body>
        <div class="body">
            <div class="row">
                <div class="p2 col-4">
                    <h2>Profil</h2>
                    <div class="">
                        <form id="armyForm" method="post" action="">
                            <label for="customRange2">T3</label>
                            <div class="form-group row">
                                <div class="d-flex flex-fill">
                                    <div class="col-8">
<input type="range" class="custom-range align-middle" min="0" max="10000000" step="10000" value=<?php echo "\"".army("t3")."\"";  ?>  id="t3Slider" />
                                    </div>
                                    <div class="col-4">
                                        <input class="form-control" type="number" min="0" max="10000000" step="10000" value=<?php echo "\"".army("t3")."\"";  ?> id="t3Input" name="t3" />
                                    </div>
                                </div>
                            </div>
                            <label for="customRange2">T4</label>
                            <div class="form-group row">
                                <div class="d-flex flex-fill">
                                    <div class="col-8">
                                        <input type="range" class="custom-range align-middle" min="0" max="10000000" step="10000" value=<?php echo "\"".army("t4")."\"";  ?>  id="t4Slider" />
                                    </div>
                                    <div class="col-4">
                                        <input class="form-control" type="number" min="0" max="10000000" step="10000" value=<?php echo "\"".army("t4")."\"";  ?> id="t4Input" name="t4" />
                                    </div>
                                </div>
                            </div>

                            <br />
                            <div class="form-group row">
                                <div class="d-flex justify-content-end col-12">
                                    <input type="hidden" value="user" name="update" />
                                    <button id="submitProfile" class="btn btn-primary col-4">Aktualizovat</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

