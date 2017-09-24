//Global variables.
var home = 'http://localhost/tcf_online_store/index.php';
//var home = 'http://increase-efficiency.net/tcf_online_store/index.php';
var body_center = document.getElementById('body_center');
var sport = '';
var year = '';
var letter = '';
//Make the logo reset the web page when clicked.
document.getElementById('div_logo').addEventListener('click', function(event){
	window.location.href = home;
}, false);
//Create the sport buttons.
create_sport_buttons();
function create_sport_buttons(){
	var sport_btn_list = ['Baseball', 'Football', 'Basketball', 'Hockey',
						  'Nonsports', 'Multisport', 'Racing', 'Wrestling',
						  'Soccer', 'Golf', 'Magic', 'YuGiOh',
						  'Pokemon', 'Gaming', 'Diecast'];
	var row = 1;
	var div_temp = '';
	for(i = 0; i < sport_btn_list.length; i++){
		var btn_temp = document.createElement('button');
		create_listener_sport_button(btn_temp);
		btn_temp.innerHTML = sport_btn_list[i];
		btn_temp.className = 'xlarge green button';
		if(i == 0 || i == 4 || i == 8 || i == 12){
			div_temp = document.createElement('div');
			div_temp.id = 'btn_row_' + row;
			div_temp.className = 'div_sport_btn';
			row++;
			div_temp.appendChild(btn_temp);
			body_center.appendChild(div_temp);
		}
		else{
			var current_div = document.getElementById('btn_row_' + (row - 1));
			current_div.appendChild(btn_temp);
		}
	}
}
function create_listener_sport_button(btn_temp){
	btn_temp.addEventListener('click', function(event){
		event.preventDefault();
		//Save the name of the chosen sport.
		sport = btn_temp.innerHTML;
		//Update the navbar.
		document.getElementById('link_sport').innerHTML = sport;
		document.getElementById('link_sport').addEventListener('click', function(event){
			//Return to the homepage and reset all data.
			window.location.href = home;
		}, false);
		//Clear the buttons.
		body_center.innerHTML = '';
		create_year_buttons();
	}, false);
}
function create_year_buttons(){
	var row = 1;
	var div_temp = '';
	for(i = 1960; i < 2020; i++){
		var btn_temp = document.createElement('button');
		create_listener_year_button(btn_temp);
		btn_temp.innerHTML = i;
		btn_temp.className = 'large green button';
		if(i == 1960 || i == 1970 || i == 1980 || i == 1990
		|| i == 2000 || i == 2010 || i == 2020){
			div_temp = document.createElement('div');
			div_temp.id = 'btn_row_' + row;
			div_temp.className = 'div_year_btn';
			row++;
			div_temp.appendChild(btn_temp);
			body_center.appendChild(div_temp);
		}
		else{
			var current_div = document.getElementById('btn_row_' + (row - 1));
			current_div.appendChild(btn_temp);
		}
	}	
}
function create_listener_year_button(btn_temp){
	btn_temp.addEventListener('click', function(event){
		event.preventDefault();
		//Save the name of the chosen year.
		year = btn_temp.innerHTML;
		//Update the navbar.
		document.getElementById('link_year').innerHTML = year;
		document.getElementById('link_year').addEventListener('click', function(event){
			//Clear the buttons.
			body_center.innerHTML = '';
			create_year_buttons();
		}, false);
		//Clear the buttons.
		body_center.innerHTML = '';
		create_letter_buttons();
	}, false);
}
function create_letter_buttons(){
	var letter_btn_list = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
	'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', ' ', '%'];
	var row = 1;
	var div_temp = '';
	for(i = 0; i < letter_btn_list.length; i++){
		var btn_temp = document.createElement('button');
		create_listener_letter_button(btn_temp);
		btn_temp.innerHTML = letter_btn_list[i];
		if(letter_btn_list[i] == ' '){
			btn_temp.style.visibility = 'hidden';
		}
		btn_temp.className = 'medium green button';
		if(i == 0 || i == 7 || i == 14 || i == 21 || i == 28){
			div_temp = document.createElement('div');
			div_temp.id = 'btn_row_' + row;
			div_temp.className = 'div_letter_btn';
			row++;
			div_temp.appendChild(btn_temp);
			body_center.appendChild(div_temp);
		}
		else{
			var current_div = document.getElementById('btn_row_' + (row - 1));
			current_div.appendChild(btn_temp);
		}
	}	
}
function create_listener_letter_button(btn_temp){
	btn_temp.addEventListener('click', function(event){
		event.preventDefault();
		//Save the name of the chosen letter.
		letter = btn_temp.innerHTML;
		//Update the navbar.
		document.getElementById('link_letter').innerHTML = letter;
		document.getElementById('link_letter').addEventListener('click', function(event){
			//Clear the buttons.
			body_center.innerHTML = '';
			create_letter_buttons();
		}, false);
		//Clear the buttons.
		body_center.innerHTML = '';
		//Get the sets that that correspond to the chosen buttons.
		get_set_list();
	}, false);
}
function get_set_list(){
	var xhttp = new XMLHttpRequest();
	var post_data = 'category=' + sport + '&year=' + year + '&letter=' + letter;
	xhttp.onreadystatechange = function(){
		if (xhttp.readyState == 4 && xhttp.status == 200){
			//Get the set list with sales totals.
			var set_list = JSON.parse(xhttp.responseText);
			//Display the results.
			create_set_list_table(set_list);
		}
	}
	xhttp.open("POST", "ajax.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(post_data);
}
function create_set_list_table(set_list){
	var table_temp = document.createElement('table');
	var tr_temp = document.createElement('tr');
	tr_temp.className = 'header';
	var th_year = document.createElement('th');
	th_year.innerHTML = 'Year';
	th_year.className = 'setCol_year';
	var th_set = document.createElement('th');
	th_set.innerHTML = 'Set';
	th_set.className = 'setCol_setResults';
	var th_sales = document.createElement('th');
	th_sales.innerHTML = 'Sales';
	th_sales.className = 'setCol_triple';
	tr_temp.appendChild(th_year);
	tr_temp.appendChild(th_set);
	tr_temp.appendChild(th_sales);
	table_temp.appendChild(tr_temp);
	document.getElementById('body_center').appendChild(table_temp);
}