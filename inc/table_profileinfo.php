<div class="container profilesection">
    <div class="row profileelem">
        <div class="col-4"><span>Name</span></div>
        <div class="col-4">
            <p class="tablep"><?php echo $vorname . " " . $nachname; ?></p>
        </div>
        <div class="col-4" onclick="edit(0);"><span class="bearbeiten">Modify</span></div>
        <hr>
    </div>

    <div class="row editdata block">
        <br>
        <form action="" method="post" class="row">
            <div class="col-sm-6 col-md-auto">
                <label for="vornamefield" class="form-label">Name</label>
            </div>
            <div class="col-sm-6 col-md-3">
                <input type="text" name="vornamefield" class=" form-control" value="<?php echo $vorname;?>"
                    id="vornamefield">
            </div>
            <div class="col-sm-6 col-md-auto">
                <label for="nachnamefield" class="form-label">Surname</label>
            </div>
            <div class="col-sm-6 col-md-3 ">
                <input type="text" name="nachnamefield" class="form-control" value="<?php echo $nachname;?>"
                    id="nachnamefield">
            </div>
            <div class="col-md-auto">
                <button type="submit" name="update_name" class="btn btn-primary">Submit</button>
            </div>
        </form>
        <br>

    </div>

    <div class="row profileelem">
        <div class="col-4"><span>E-Mail</span></div>
        <div class="col-4">
            <p class="tablep"><?php echo $mail;?></p>
        </div>
        <div class="col-4" onclick="edit(1);"><span class="bearbeiten">Modify</span></div>
        <hr>
    </div>

    <div class="row editdata block">
        <br>
        <form action="" method="post" class="row">
            <div class="col-auto">
                <label for="emailfield" class="form-label">E-Mail</label>
            </div>
            <div class="col-3">
                <input type="text" name="emailfield" value="<?php echo $mail;?>" class="form-control" id="emailfield">
            </div>
            <div class="col-auto">
                <button type="submit" name="update_mail" class="btn btn-primary">Submit</button>
            </div>
        </form>
        <br>
    </div>

    <div class="row profileelem">
        <div class="col-4"><span>Password</span></div>
        <div class="col-4">
            <p class="tablep">*********</p>
        </div>
        <div class="col-4" onclick="edit(2);"><span class="bearbeiten">Modify</span></div>
        <hr>
    </div>

    <div class="row editdata block">
        <br>
        <form action="" method="post" class="row">
            <div class="col-lg-auto col-md-6">
                <label for="passwordfield" class="form-label">Password</label>
            </div>
            <div class="col-lg-3 col-md-6">
                <input name="pwfield" type="password" class="form-control" id="passwordfield">
            </div>
            <div class="col-lg-auto col-md-6">
                <label for="passwordfield2" class="form-label">Password again</label>
            </div>
            <div class="col-lg-3 col-md-6">
                <input name="pwfield2" type="password" class="form-control" id="passwordfield2">
            </div>
            <div class="col-lg-auto col-md-6">
                <button type="submit" name="update_pw" class="btn btn-primary">Submit</button>
            </div>
        </form>
        <br>
    </div>

    <div class="row profileelem">
        <div class="col-4"><span>Address</span></div>
        <div class="col-4">
            <p class="tablep"><?php echo $adresse;?></p>
        </div>
        <div class="col-4" onclick="edit(3);"><span class="bearbeiten">Modify</span></div>
        <hr>
    </div>

    <div class="row editdata block">
        <br>
        <form action="" method="post" class="row">
            <div class="col-auto">
                <label for="adressefield" class="form-label">Address</label>
            </div>
            <div class="col-3">
                <input type="text" name="adressfield" value="<?php echo $adresse;?>" class="form-control"
                    id="adressefield">
            </div>
            <div class="col-auto">
                <button type="submit" name="update_adress" class="btn btn-primary">Submit</button>
            </div>
        </form>
        <br>
    </div>

    <div class="row profileelem">
        <div class="col-4"><span>City</span></div>
        <div class="col-4">
            <p class="tablep"><?php echo $stadt;?></p>
        </div>
        <div class="col-4" onclick="edit(4);"><span class="bearbeiten">Modify</span></div>
        <hr>
    </div>

    <div class="row editdata block">
        <br>
        <form action="" method="post" class="row">
            <div class="col-auto">
                <label for="cityfield" class="form-label">City</label>
            </div>
            <div class="col-3">
                <input type="text" name="cityfield" class="form-control" value="<?php echo $stadt;?>" id="cityfield">
            </div>
            <div class="col-auto">
                <button type="submit" name="update_city" class="btn btn-primary">Submit</button>
            </div>
        </form>
        <br>
    </div>

    <div class="row profileelem">
        <div class="col-4"><span>PLZ</span></div>
        <div class="col-4">
            <p class="tablep"><?php echo $plz;?></p>
        </div>
        <div class="col-4" onclick="edit(5);"><span class="bearbeiten">Modify</span></div>
        <hr>
    </div>

    <div class="row editdata block">
        <br>
        <form action="" method="post" class="row">
            <div class="col-auto">
                <label for="plzfield" class="form-label">PLZ</label>
            </div>
            <div class="col-3">
                <input type="text" name="plzfield" class="form-control" value="<?php echo $plz;?>" id="plzfield">
            </div>
            <div class="col-auto">
                <button type="submit" name="update_plz" class="btn btn-primary">Submit</button>
            </div>
        </form>
        <br>
    </div>

    <?php if($_SESSION['isAdmin'] == 1) :?>
    <div class="row profileelem">
        <div class="col-4"><span>isAdmin</span></div>
        <div class="col-4">
            <p class="tablep"><?php echo $isAdmin;?></p>
        </div>
        <div class="col-4" onclick="edit(6);"><span class="bearbeiten">Modify</span></div>
        <hr>
    </div>

    <div class="row editdata block">
        <br>
        <form action="" method="post" class="row">
            <div class="col-auto">
                <label for="isAdminField" class="form-label">IsAdmin</label>
            </div>
            <div class="col-3">
                <input type="text" name="isAdminField" class="form-control" value="<?php echo $isAdmin;?>"
                    id="isAdminField">
            </div>
            <div class="col-auto">
                <button type="submit" name="update_isAdmin" class="btn btn-primary">Submit</button>
            </div>
        </form>
        <br>
    </div>


    <div class="row profileelem">
        <div class="col-4"><span>isActive</span></div>
        <div class="col-4">
            <p class="tablep"><?php echo $isActive;?></p>
        </div>
        <div class="col-4" onclick="edit(7);"><span class="bearbeiten">Modify</span></div>
        <hr>
    </div>

    <div class="row editdata block">
        <br>
        <form action="" method="post" class="row">
            <div class="col-auto">
                <label for="isActiveField" class="form-label">isActive</label>
            </div>
            <div class="col-3">
                <input type="text" name="isActiveField" class="form-control" value="<?php echo $isActive;?>"
                    id="isActiveField">
            </div>
            <div class="col-auto">
                <button type="submit" name="update_isActive" class="btn btn-primary">Submit</button>
            </div>
        </form>
        <br>
    </div>
    <?php endif;?>
</div>