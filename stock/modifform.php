<body id="main_body">
    <div id="form_container">
        <input class="button_close" type="button" onclick="closeForm('modif-popup')" value="   [X]   "
            style="float: right;" />
        <form id="formAorM" class="appnitro" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
            method="post">

            <div class="form_description">
                <h2><?php echo $modifierORadd; ?> DU MATERIEL AU STOCK</h2>
            </div>

            <table id="aze" class="blueTable tablenoFixHead">
                <thead>
                    <tr>
                        <th colspan="2" style="width: 33%;">BUREAU</th>
                        <th colspan="2" style="width: 33%;">WL</th>
                        <th colspan="2" style="width: 33%;">JPM</th>
                    </tr>
                </thead>
                <tbody>
                    <th colspan="2">
                        <input style="display:none;" type="checkbox" name="FAV" value="0" checked>
                        <input type="checkbox" name="FAV" value="1" <?php if ($namemodifierORadd == "modifitem") {
    $_SESSION['keepfiltre'] = true;
    $_SESSION['nofav'] = true;
    // echo 'onchange="$(\'#formAorM\').submit();"\'';
}; ?> <?php if ($row["FAV"] >= 1) {
    echo 'checked';
}; ?>>
                        <?php
                        if ($row["FAV"] >= 1) {
                            echo '<input type="checkbox" name="FAV" value="2"';
                            if ($namemodifierORadd == "modifitem") {
                                $_SESSION['keepfiltre'] = true;
                                $_SESSION['nofav'] = true;
                            };
                            if ($row["FAV"] == 2) {
                                echo 'checked';
                            };
                            echo '>';
                        }
?>
                    </th>
                    <th colspan="2"><input style="display:none;" type="checkbox" name="WL" value="0" checked>
                        <input type="checkbox" name="WL" value="1" <?php if ($namemodifierORadd == "modifitem") {
    $_SESSION['keepfiltre'] = true;
    $_SESSION['nofav'] = true;
    // echo 'onchange="$(\'#formAorM\').submit();"\'';
}; ?> <?php if ($row["WL"] == 1) {
    echo 'checked';
}; ?>>
                    <th colspan="2">
                        <input style="display:none;" type="checkbox" name="JPM" value="0" checked>
                        <input type="checkbox" name="JPM" value="1" <?php if ($namemodifierORadd == "modifitem") {
    $_SESSION['keepfiltre'] = true;
    $_SESSION['nofav'] = true;
    // echo 'onchange="$(\'#formAorM\').submit();"\'';
}; ?> <?php if ($row["JPM"] == 1) {
    echo 'checked';
}; ?>>
                    </th>
                    </th>
                </tbody>
            </table>
            <br>
            <table class="blueTable tableFixHead">
                <thead>
                    <tr>
                        <th style="width: 33%;" colspan="1">BUREAU</th>
                        <th style="width: 33%;" colspan="1">WILLIAM</th>
                        <th style="width: 33%;" colspan="1">JEAN PHILIPPE</th>
                        <!-- <th>LIMITE</th> -->
                    </tr>
                </thead>
                <tbody>
                    <!-- <tr> -->
                    <!-- <td>REEL</td> -->
                    <!-- <td>LIMITE</td> -->
                    <!-- <td>REEL</td> -->
                    <!-- <td>LIMITE</td> -->
                    <!-- <td>REEL</td> -->
                    <!-- <td>LIMITE</td> -->
                    <!-- <td>EN %</td> -->
                    <!-- </tr> -->
                    <tr>
                        <td>
                            <input style="display:none" name="QRB" type="text" maxlength="255"
                                value=" <?php echo $row['QRB']; ?> " />
                            <select id="numerifqtmodif" name="QRBM">
                                <?php
                                    for ($i = 250; $i >= -intval($row['QRB']); $i--) {
                                        echo '<option value="' . $i .'"';
                                        if (0 == $i) {
                                            echo ' selected="selected"';
                                        }
                                        // echo '>' . $i .' = ' . intval($row['QRB']) + $i . '</option>';
                                        echo '>' . intval($row['QRB']) + $i . ' = ';
                                        if ($i>0) {
                                            echo '+';
                                        }
                                        echo $i .  '</option>';
                                    }
                                ?>
                            </select>
                        </td>

                        <td>
                            <input style="display:none" name="QRW" type="text" maxlength="255"
                                value=" <?php echo $row['QRW']; ?> " />
                            <select id="numerifqtmodif" name="QRWM">
                                <?php
                                    for ($i = intval($row['QRB']); $i >= -intval($row['QRW']); $i--) {
                                        echo '<option value="' . $i .'"';
                                        if (0 == $i) {
                                            echo ' selected="selected"';
                                        }
                                        echo '>'  . intval($row['QRW']) + $i . ' = ';
                                        if ($i>0) {
                                            echo '+';
                                        }
                                        echo $i . '</option>';
                                    }
                                ?>
                            </select>
                        </td>

                        <td>
                            <input style="display:none" name="QRJ" type="text" maxlength="255"
                                value=" <?php echo $row['QRJ']; ?> " />
                            <select id="numerifqtmodif" name="QRJM">
                                <?php
                                    for ($i = intval($row['QRB']); $i >= -intval($row['QRJ']); $i--) {
                                        echo '<option value="' . $i .'"';
                                        if (0 == $i) {
                                            echo ' selected="selected"';
                                        }
                                        echo '>' . intval($row['QRJ']) + $i . ' = ' ;
                                        if ($i>0) {
                                            echo '+';
                                        }
                                        echo $i . '</option>';
                                    }
                                ?>
                            </select>
                        </td>
                        <!-- <td>                            
                            <select id="numerifqtmodif" name="QRB">
                                <?php
                                    for ($i = 0; $i <= 500; $i++) {
                                        echo '<option value="' . $i .'"';
                                        if ($row['QRB'] == $i) {
                                            echo ' selected="selected"';
                                        }
                                        echo '>' . $i .'</option>';
                                    }
                                ?>
                            </select>
                        </td>
                        <td>
                            <select id="numerifqtmodif" name="QRW">
                                <?php
                                    for ($i = 0; $i <= 500; $i++) {
                                        echo '<option value="' . $i .'"';
                                        if ($row['QRW'] == $i) {
                                            echo ' selected="selected"';
                                        }
                                        echo '>' . $i .'</option>';
                                    }
                                ?>
                            </select>
                        </td>
                        <td>
                            <select id="numerifqtmodif" name="QRJ">
                                <?php
                                    for ($i = 0; $i <= 500; $i++) {
                                        echo '<option value="' . $i .'"';
                                        if ($row['QRJ'] == $i) {
                                            echo ' selected="selected"';
                                        }
                                        echo '>' . $i .'</option>';
                                    }
                                ?>
                            </select>
                        </td> -->
                    </tr>
                </tbody>
            </table>
            <br>
            <input style="display:none" id="element_6" name="ID" class="element text medium" type="text" maxlength="255"
                value=" <?php echo $row["ID"]; ?> " />
            <input id="saveForm" class="btn btn-outline-primary" type="submit" name="<?php echo $namemodifierORadd; ?>"
                value="<?php echo $modifierORadd; ?>" style="width:100%" ; />
            <br>
            <ul>
                <label class="description" for="element_1">REF INTERNE</label>
                <div>
                    <input id="element_1" name="REFINT" class="element text medium" type="text" maxlength="255"
                        value="<?php echo $row['REFINT']; ?>" />
                </div>
                <label class="description" for="element_1">DESIGNATION</label>
                <div>
                    <input id="element_1" name="DESIGNATION" class="element text medium" type="text" maxlength="255"
                        value="<?php echo $row['DESIGNATION']; ?>" />
                </div>
                <label class="description" for="element_5">REFERENCE</label>
                <div>
                    <input id="element_5" name="REFERENCE" class="element text medium" type="text" maxlength="255"
                        value="<?php echo $row['REFERENCE']; ?>" />
                </div>
                <label class="description" for="element_7">FOURNISSEUR</label>
                <div>
                    <input class="element text medium" id="element_7" name="FOURNISSEUR"
                        value="<?php echo $row['FOURNISSEUR']; ?>" list="FOURNISSEURlist">
                    <datalist id="FOURNISSEURlist">
                        <option value="STOCK" selected="selected">STOCK</option>
                        <option value="TBS">TBS</option>
                        <option value="PPC">PPC</option>
                        <option value="OEG">OEG</option>
                        <option value="VIESSMANN">VIESSMANN</option>
                        <option value="WEISHAUPT">WEISHAUPT</option>
                    </datalist>
                </div>
                <label class="description" for="element_8">PRIX PUBLIC</label>

                <span>
                    <input id="element_8_1" name="PRIXPUBLIC1" class="element text medium" size="10"
                        value="<?php echo $row['PRIXPUBLIC']; ?>" type="text" />
                    </br>
                    <label for="element_8_1">Euros</label>
                </span>
                <label class="description" for="element_9">PRIX NET</label>
                <span>
                    <input id="element_9_1" name="PRIXNET1" class="element text medium" size="10"
                        value="<?php echo $row['PRIXNET']; ?>" type="text" />
                    </br>
                    <label for="element_9_1">Euros</label>
                </span>
                <label class="description" for="element_6">REF CLIENT</label>
                <div>
                    <input id="element_6" name="REFCLIENT" class="element text medium" type="text" maxlength="255"
                        value="<?php echo $row['REFCLIENT']; ?>" />
                </div>
            </ul>



        </form>
    </div>
</body>
<script>
function inc() {
    let number = document.querySelector('[name="QRB"]');
    number.value = parseInt(number.value) + 1;
}

function dec() {
    let number = document.querySelector('[name="QRB"]');
    if (parseInt(number.value) > 0) {
        number.value = parseInt(number.value) - 1;
    }
}
</script>