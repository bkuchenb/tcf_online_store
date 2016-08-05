<?php
// Include the library
include('simplehtmldom_1_5/simple_html_dom.php');

//parse the order details
$html = file_get_html('http://marketplace.beckett.com/admin/search_orders/view/2497041');
//find all td elements
//$ret = $html->find('div.block corner-5');
//echo $html->getElementsByClassName("item_table");
$array = $html->find('div');
//$array = $html->find('body', 0)->children();
//echo count($ret);
//echo $ret[84];
for($i = 0; $i < count($array); $i++)
{
	/*for($j = 0; $j < count($es); $j++)
	{
		echo $es[$j];
	}*/
	echo 'child ' . $i . ' = ' . $array[$i]->tag . '__class = ' . $array[$i]->class .
	'__id = ' . $array[$i]->id . '<br>';
}
//echo $html->plaintext;

?>