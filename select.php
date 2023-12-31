<h1>Wohin als Nächstes, <?php echo $_SESSION['vorname']; ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class=" auswahlcenter">
            <div class="row auswahl">

                <div class="d-flex col-lg-3 col-sm-12">
                    <select name="zimmerart" type="text" class="form-control" class="form-select form-select-sm"
                        aria-label="Small select example">
                        <option selected>Welches Zimmer?</option>
                        <option value="1">Luxuszimmer</option>
                        <option value="2">Doppelzimmer</option>
                        <option value="3">Einzelzimmer</option>
                        <option value="4">Dreierzimmer</option>
                        <option value="5">Viererzimmer</option>
                        <option value="6">Präsidentensuite</option>


                    </select>
                </div>
                <div class=" d-flex col-lg-3 col-sm-12">
                    <input class="form-control dropdown-toggle" type="text" id="dropdownMenuClickable"
                        placeholder="Mit wem reisen Sie?" data-bs-toggle="dropdown" data-bs-auto-close="false"
                        onclick="removeDropdown2()">
                    </input>

                    <div class="dropdown">

                        <div id="dropdown" class="dropdown-menu p-4">
                            <div class="mb-2">
                                <label for="exampleDropdownFormEmail2" class="form-label">Erwachsene</label>
                                <button type="button" onclick="decreaseValue('adult')" name='decqty'>-</button>
                                <input id="adult" type='text' size='1' name='adult' value='0' readonly />
                                <button type="button" onclick="increaseValue('adult')" name='incqty'>+</button>

                            </div>
                            <div class="mb-2">
                                <label for="exampleDropdownFormPassword2" class="form-label">Kinder</label>
                                <button type="button" onclick="decreaseValue('child')" name='decqty'>-</button>
                                <input id="child" type='text' size='1' name='child' value='0' readonly />
                                <button type="button" onclick="increaseValue('child')" name='incqty'>+</button>

                            </div>
                            <div class="mb-3">
                                <label for="exampleDropdownFormPassword2" class="form-label">Haustiere</label>
                                <button type="button" onclick="decreaseValue('pets')" name='decqty'>-</button>
                                <input id="pets" type='text' size='1' name='pets' value='0' readonly />
                                <button type="button" onclick="increaseValue('pets')" name='incqty'>+</button>

                            </div>

                            <button type="button" data-toggle="dropdown" onclick="removeDropdown()"
                                class="btn btn-primary">Fertig</button>
                        </div>
                    </div>
                </div>
                <div class="d-flex col-lg-3 col-sm-12">
                    <!-- 
                            <input style="font-size: 15px;" id="datepicker" class="form-control dropdown-toggle"
                                type="text" id="dropdownMenuClickable" name="datepicker" placeholder="Wann reisen Sie?"
                                data-bs-toggle="dropdown" data-bs-auto-close="false" />
                            <input type="hidden" id="startDate">
                            <input type="hidden" id="endDate">
                            --->

                    <input class="form-control dropdown-toggle" type="text" id="dropdownMenuClickable"
                        placeholder="Extras auswählen" data-bs-toggle="dropdown" data-bs-auto-close="false"
                        onclick="removeDropdown()">
                    </input>

                    <div class="dropdown">

                        <div id="dropdown2" class="dropdown-menu p-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="breakfast" value="breakfast"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Mit Frühstück?
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="park" value="park"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Mit Parkplatz?
                                </label>
                            </div>

                            <button type="button" data-toggle="dropdown" onclick="removeDropdown2()"
                                class="btn btn-primary">Fertig</button>
                        </div>
                    </div>

                </div>
                <div class="d-flex col-lg-3 col-sm-12">
                    <button style="width: 100%;" class="btn btn-primary btn-lg" type="getZimmer" id="getZimmer"
                        name="getZimmer">Suchen</button>
                </div>
            </div>
        </div>
    </form>

    <?php if(isset($_POST['getZimmer'])) : ?>
    <?php foreach ($allezimmer as $zimmer) : ?>
    <div class="zimmer">
        <img alt="zimmer" height="183px" width="275px" src="<?php echo $zimmer['bildpfad'] ?>">
        <h2>Luxuszimmer</h2>
        <h3><?php echo $zimmer['preisProTag'] .'€' ?></h3>
        <p><?php echo $zimmer['beschreibung'] ?>
        </p>
        <a href="<?php echo "zimmerdetails.php?id=" . $zimmer['zimmerid'] ?>"> Mehr Informationen</a>
        <br>
        <br>
        <a href="<?php echo "buchen.php?id=" . $zimmer['zimmerid'] ?>"><button type="button"
                class="btn btn-primary">Buchen</button></a>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>