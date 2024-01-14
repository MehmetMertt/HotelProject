<?php if(isset($_GET['booking']) && isset($message) == FALSE) : ?>
<div class="container" id="summary">
    <h2>Booking Summary</h2>
    <hr>
    <div class="row justify-content-center text-center">
        <div class="col-lg-3 col-12 col-sm-10">
            <div style="display: inline-grid;">
                <img src="<?php echo $bildpfad ?>" width="250px" alt="Hotelzimmer" />
                <a id="seedet" class="btn btn-primary" href="zimmerinformation.php?id=<?php echo $id; ?>"
                    target="_blank">See
                    Details</a>
            </div>

        </div>


        <div class="col-lg-2 col-sm-6 col-12">
            <div>
                <p>Room Type: <b><?php include 'inc/kategorieparser.php'; ?></b></p>
                <p>Room Number:<b> Room <?php echo $id; ?></b></p>
                <input type="hidden" name="zimmerID" value="<?php echo $id; ?>" />
                <p>Frühstück:
                    <?php echo $break == 1 ? '✔️' : '❌'; ?> </p>
                <input type="hidden" name="fruestueck" value="<?php echo $break; ?>" />

                <p>Parkplatz: <?php echo $park == 1 ? '✔️' : '❌'; ?> </p>
                <input type="hidden" name="parkplatz" value="<?php echo $park; ?>" />
            </div>
        </div>

        <div class="col-lg-3 details col-sm-6 col-12">
            <div>
                <p>Erwachsene: <b><?php echo $adults; ?></b></p>
                <input type="hidden" name="adults" value="<?php echo $adults; ?>" />
                <p>Kinder: <b><?php echo $children; ?></b></p>
                <input type="hidden" name="children" value="<?php echo $children; ?>" />
                <p>Haustiere: <b><?php echo $pets; ?></b></p>
                <input type="hidden" name="pets" value="<?php echo $pets; ?>" />
            </div>

        </div>

        <div class="offset-lg-2 col-lg-3 col-12 gebucht">
            <table>
                <tr>
                    <th class="small text-muted pr-2" scope="row">Von</th>
                    <td id="startDate" style="float: right"><?php echo $von;?></td>
                    <input type="hidden" id="startDateID" name="startDateID" value="" />

                </tr>
                <tr>
                    <th class="small text-muted pr-2" scope="row">Bis</th>
                    <td id="endDate" style="float: right"><?php echo $bis;?></td>
                    <input type="hidden" id="endDateID" name="endDateID" value="" />

                </tr>
                <tr>
                    <th class="small text-muted pr-2" scope="row"><b>Total</b></th>
                    <input type="hidden" id="preisProTag" name="preisProTag" value="<?php echo $preisProTag; ?>" />
                    <td id="totalprice" style="float: right"><b><?php echo $totalprice . " EUR";?></b>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<br>
<?php endif; ?>