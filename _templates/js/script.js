// Open and close divs
function open_div(id){
	document.getElementById(id).style.display = "block";
	document.getElementById(id).classList.add("show");
	document.getElementById(id).classList.remove("hide");
}
function close_div(id){
	document.getElementById(id).classList.remove("show");
	document.getElementById(id).classList.add("hide");
	setTimeout(function(){
		document.getElementById(id).scrollTop = 0;
		document.getElementById(id).style.display = "none";
	}, 250);
}
// SERCH BAR
function filter() {
	// Declare variables
	var search_bar, filter, table_to_filter, tr, td, i, txtValue;
	search_bar = document.getElementById('search');
	filter = search_bar.value.toUpperCase();
	table_to_filter = document.getElementsByClassName("table_to_filter")[0];
	tr = table_to_filter.getElementsByTagName('tr');

	// Loop through all list items, and hide those who don't match the search query
	for(i=1;i<tr.length;i++){
		td = tr[i].getElementsByTagName("td")[0];
		txtValue = td.textContent || td.innerText;
		if (txtValue.toUpperCase().indexOf(filter) > -1) {
			tr[i].style.display = "";
		} else {
			tr[i].style.display = "none";
		}
	}
}
// shosen
$(".chosen-select").chosen();
// menu
function open_menu(id){
	document.getElementById(id).style.display = "block";
	document.getElementById(id).classList.add("show");
	document.getElementById(id).classList.remove("hide");
	scrollPosition = window.pageYOffset;
	setTimeout(function(){
		document.body.style.position = "fixed";
	}, 250);
}
function close_menu(id){
	document.getElementById(id).classList.remove("show");
	document.getElementById(id).classList.add("hide");
	setTimeout(function(){
		document.getElementById(id).scrollTop = 0;
		document.getElementById(id).style.display = "none";
	}, 250);
	document.body.style.position = "relative";
	window.scrollTo(0, scrollPosition);
}