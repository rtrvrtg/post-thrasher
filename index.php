<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	header('Content-Type: application/json');
	print json_encode([
		'result' => rand(0, 999999),
	]);
	die();
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>POST Thrasher</title>
<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
</head>
<body>
<input type="number" id="delay" value="10" /><button id="go">GO!</button>
<div id="debug">
</div>
<script>
$(document).ready(function() {
$('#debug').text('Ready');
var timeout = null;
var delay = 1000;
var ping = function() {
	$.post('/index.php', '', function(data, status, xhr) {
		$('#debug').text($('#debug').text() + ', ' + data.result);
		timeout = setTimeout(function() {
			ping();
		}, delay);
	}, 'json');
};
$('#go').click(function() {
	$('#go').attr('disabled', 'true');
	delay = parseInt($("#delay").val(), 10);
	if (!isNaN(delay) && delay > 0) {
		ping();
	}
	else {
		$('#debug').text('Delay is no good.');
	}
});
});
</script>
</body>
</html>
