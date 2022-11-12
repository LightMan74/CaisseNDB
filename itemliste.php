<script>
var bierre = 0;
var coca = 0;

function onClick(item) {
    bierre += 1;
    document.getElementById("bierre").innerHTML = bierre;
    document.getElementById("bierretotal").innerHTML = bierre * 2.5;
    coca += 1;
    document.getElementById("coca").innerHTML = coca;
    document.getElementById("cocatotal").innerHTML = coca * 2;



    document.getElementById("total").innerHTML = coca * 2 + bierre * 2.5;
    document.getElementById("conso").value = coca * 2 + bierre * 2.5;
};
</script>

<button type="button" onClick="onClick('bierre')">Bierre : 2€50</button>
<p>Nbres: <a id="bierre">0</a></p>
<p>Total: <a id="bierretotal">0</a></p>


<button type="button" onClick="onClick('coca')">coca : 2€00</button>
<p>Nbres: <a id="coca">0</a></p>
<p>Total: <a id="cocatotal">0</a></p>

<p>Total general: <a id="total" name="total" value="0">0</a></p>
<input style="display:none" id="conso" name="conso" class="element text medium" type="text" maxlength="255" value="0" />

<?php