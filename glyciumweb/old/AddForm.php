
<head>
<!-- <link rel="stylesheet" type="text/css" href="CSS_JS/view.css" media="all">
<script type="text/javascript" src="CSS_JS/view.js"></script>
 -->
</head>
<body id="main_body" >
	
	<div id="form_container">
	<input class="button_close" type="button" onclick="toogleForm('add-popup')"  value="   [X]   " style="float: right;" />	
		<form id="form_7328" class="appnitro" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post" >
		
					<div class="form_description">
			<h2>AJOUTER DU MATERIEL AU STOCK</h2>
							
		</div>					
	
			<ul >
			
					<li id="li_1" >
		<label class="description" for="element_1">DESIGNATION</label>
		<div>
			<input id="element_1" name="DESIGNATION" class="element text medium" type="text" maxlength="255" value=""/> 
		</div> 
		</li>		<li id="li_2" >
		<label class="description" for="element_2">TYPE</label>
		<div>
			<input id="element_2" name="TYPE" class="element text medium" type="text" maxlength="255" value=""/> 
		</div> 
		</li>		<li id="li_5" >
		<label class="description" for="element_5">REFERENCE</label>
		<div>
			<input id="element_5" name="REFERENCE" class="element text medium" type="text" maxlength="255" value=""/> 
		</div> 
		</li>		<li id="li_7" >
		<label class="description" for="element_7">FOURNISEUR </label>
		<div>
		<input class="element text medium" id="element_7" name="FOURNISEUR" list="FOURNISEURlist"> 
		<datalist id="FOURNISEURlist">
<option value="STOCK" selected="selected">STOCK</option>
<option value="TBS" >TBS</option>
<option value="PPC" >PPC</option>
<option value="OEG" >OEG</option>
<option value="VIESSMANN" >VIESSMANN</option>
<option value="WEISHAUPT" >WEISHAUPT</option>
   </datalist>
		
		</div> 
		</li>		<li id="li_8" >
		<label class="description" for="element_8">PRIX PUBLIC</label>
			<span>
			<input id="element_8_1" name="PRIXPUBLIC1" class="element text currency" size="10" value="" type="text" /> €		
			<label for="element_8_1">Euros</label>
		</span>
		<span>
			<input id="element_8_2" name="PRIXPUBLIC0" class="element text" size="2" maxlength="2" value="" type="text" />
			<label for="element_8_2">Cents</label>
		</span>
		 
		</li>		<li id="li_9" >
		<label class="description" for="element_9">PRIX NET</label>
				<span>
			<input id="element_9_1" name="PRIXNET1" class="element text currency" size="10" value="" type="text" /> €		
			<label for="element_9_1">Euros</label>
		</span>
		<span>
			<input id="element_9_2" name="PRIXNET0" class="element text" size="2" maxlength="2" value="" type="text" />
			<label for="element_9_2">Cents</label>
		</span>
		 
		</li>		<li id="li_6" >
		<label class="description" for="element_6">REF CLIENT</label>
		<div>
			<input id="element_6" name="REFCLIENT" class="element text medium" type="text" maxlength="255" value=""/> 
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
    <td>LIMITE<br></td>
	<td>EN %<br></td>
  </tr>
  <tr>
<td><input class="element text medium" type="number" name="QRB" min="0" value="0"></td>
<td><input class="element text medium" type="number" name="QLB" min="0" value="0"></td>				
<td><input class="element text medium" type="number" name="QRW" min="0" value="0"></td>
<td><input class="element text medium"  type="number" name="QLW" min="0" value="0"></td>
<td><input class="element text medium"  type="number" name="QRJ" min="0" value="0"></td>
<td><input class="element text medium"  type="number" name="QLJ" min="0" value="0"></td>
<td><input class="element text medium"  type="number" name="QPL" min="0" max="100" value="0"></td>
  </tr>
  </tr>
</tbody>
</table>
	</li>	
					<li class="buttons">
			    <input type="hidden" name="form_id" value="7328" />
			    
				<input id="saveForm" class="btn btn-outline-primary" type="submit" name="additem" value="AJOUTER" />

		</li>
			</ul>
		</form>	
	</div>
	</body>



