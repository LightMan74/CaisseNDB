function toogleForm(obj) {
	document.getElementById(obj).classList.toggle(obj + "_show");
}

function closeForm(obj) {
  document.getElementById(obj).classList.remove(obj + "_show");
  window.location.href = "liste.php";
}



