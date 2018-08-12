<?php

include("../config.php");

if (isset($_POST['songId']) && isset($_POST['playlistId'])) {
	
	$songId = $_POST['songId'];
	$playlistId = $_POST['playlistId'];

	$query = mysqli_query($con, "SELECT MAX(playlistOrder) +1 as playlistOrder FROM playlistsongs WHERE playlistId='$playlistId'");
	$row = mysqli_fetch_array($query);
	$order = $row['playlistOrder'];
	if (is_null($order)) {
		$order = 1;
	}

	mysqli_query($con, "INSERT INTO playlistsongs ( songId, playlistId, playlistOrder) VALUES( '$songId', '$playlistId', '$order')");
}
else {
	echo "songId or playlistId is not passed to songToPlaylist.php";
}


?>