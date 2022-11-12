<body id="main_body">
    <div id="form_container">
        <input class="button_close" type="button" onclick="closeForm('modif-popup')" value="   [X]   "
            style="float: right;" />
        <form id="form_7328" class="appnitro" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
            method="post">

            <div class="form_description">
                <h2><?php echo $modifierORadd; ?> DU MATERIEL AU STOCK</h2>
            </div>

            <ul>
                <li id="li_1">
                    <label class="description" for="element_1">DESIGNATION</label>
                    <div>
                        <input id="element_1" name="DESIGNATION" class="element text medium" type="text" maxlength="255"
                            value="<?php echo $row['DESIGNATION']; ?>" />
                    </div>
                </li>
                <li id="li_2">
                    <label class="description" for="element_2">TYPE</label>
                    <div>
                        <input id="element_2" name="TYPE" class="element text medium" type="text" maxlength="255"
                            value="<?php echo $row['TYPE']; ?>" />
                    </div>
                </li>
                <li id="li_5">
                    <label class="description" for="element_5">REFERENCE</label>
                    <div>
                        <input id="element_5" name="REFERENCE" class="element text medium" type="text" maxlength="255"
                            value="<?php echo $row['REFERENCE']; ?>" />
                    </div>
                </li>
                <li id="li_7">
                    <label class="description" for="element_7">FOURNISEUR</label>
                    <div>
                        <input class="element text medium" id="element_7" name="FOURNISEUR"
                            value="<?php echo $row['FOURNISEUR']; ?>" list="FOURNISEURlist">
                        <datalist id="FOURNISEURlist">
                            <option value="STOCK" selected="selected">STOCK</option>
                            <option value="TBS">TBS</option>
                            <option value="PPC">PPC</option>
                            <option value="OEG">OEG</option>
                            <option value="VIESSMANN">VIESSMANN</option>
                            <option value="WEISHAUPT">WEISHAUPT</option>
                        </datalist>
                    </div>
                </li>
                <li id="li_8">
                    <label class="description" for="element_8">PRIX PUBLIC</label>

                    <span>
                        <?php
						$PRIXPUBLIC10 = explode(".", $row['PRIXPUBLIC']);
					?>
                        <input id="element_8_1" name="PRIXPUBLIC1" class="element text currency" size="10"
                            value="<?php echo $PRIXPUBLIC10[0]; ?>" type="text" /> €
                        <label for="element_8_1">Euros</label>
                    </span>
                    <span>
                        <input id="element_8_2" name="PRIXPUBLIC0" class="element text" size="2" maxlength="2"
                            value="<?php echo $PRIXPUBLIC10[1]; ?>" type="text" />
                        <label for="element_8_2">Cents</label>
                    </span>

                </li>
                <li id="li_9">
                    <label class="description" for="element_9">PRIX NET</label>
                    <span>
                        <?php
					$PRIXNET10 = explode(".", $row['PRIXNET']);
				?>
                        <input id="element_9_1" name="PRIXNET1" class="element text currency" size="10"
                            value="<?php echo $PRIXNET10[0]; ?>" type="text" /> €
                        <label for="element_9_1">Euros</label>
                    </span>
                    <span>
                        <input id="element_9_2" name="PRIXNET0" class="element text" size="2" maxlength="2"
                            value="<?php echo $PRIXNET10[1]; ?>" type="text" />
                        <label for="element_9_2">Cents</label>
                    </span>

                </li>
                <li id="li_6">
                    <label class="description" for="element_6">REF CLIENT</label>
                    <div>
                        <input id="element_6" name="REFCLIENT" class="element text medium" type="text" maxlength="255"
                            value="<?php echo $row['REFCLIENT']; ?>" />
                    </div>
                </li>
                <li id="li_12">
                    <table class="blueTable tableFixHead">
                        <thead>
                            <tr>
                                <th colspan="2">BUREAU</th>
                                <th colspan="2">WILLIAM</th>
                                <th colspan="2">JEAN PHILIPPE</th>
                                <th>LIMITE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>REEL</td>
                                <td>LIMITE</td>
                                <td>REEL</td>
                                <td>LIMITE</td>
                                <td>REEL</td>
                                <td>LIMITE</td>
                                <td>EN %</td>
                            </tr>
                            <tr>
                                <td><input class="element text medium" type="number" name="QRB" min="0"
                                        value="<?php echo $row['QRB']; ?>" <?php //enableQuant();  ?>></td>
                                <td><input class="element text medium" type="number" name="QLB" min="0"
                                        value="<?php echo $row['QLB']; ?>" <?php //enableQuant();  ?>></td>
                                <td><input class="element text medium" type="number" name="QRW" min="0"
                                        value="<?php echo $row['QRW']; ?>" <?php enableQuant("William");  ?>></td>
                                <td><input class="element text medium" type="number" name="QLW" min="0"
                                        value="<?php echo $row['QLW']; ?>" <?php enableQuant("William");  ?>></td>
                                <td><input class="element text medium" type="number" name="QRJ" min="0"
                                        value="<?php echo $row['QRJ']; ?>" <?php enableQuant("Jean Philippe");  ?>></td>
                                <td><input class="element text medium" type="number" name="QLJ" min="0"
                                        value="<?php echo $row['QLJ']; ?>" <?php enableQuant("Jean Philippe");  ?>></td>
                                <td><input class="element text medium" type="number" name="QPL" min="0" max="100"
                                        value="<?php echo 100*$row['QPL']; ?>"></td>
                            </tr>
                        </tbody>
                    </table>
                </li>


                <input style="display:none" id="element_6" name="ID" class="element text medium" type="text"
                    maxlength="255" value=" <?php echo $row["ID"]; ?> " />
                <li class="buttons">
                   <!--  <input type="hidden" name="form_id" value="7328" /> -->
                    <input id="saveForm" class="btn btn-outline-primary" type="submit"
                        name="<?php echo $namemodifierORadd; ?>" value="<?php echo $modifierORadd; ?>" />
                </li>
            </ul>



        </form>
    </div>
</body>