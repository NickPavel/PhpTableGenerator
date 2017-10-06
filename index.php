<?php
echo '<!doctype html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" type="image/png" href="favicon.ico">
		<link rel="stylesheet" href="style.css">
		<title>BowlingTable</title>
	</head>';
$leagues = 1;
while (is_dir('league.'.$leagues))
{
	$leagues++;
}
$leagues--;
if (empty($_GET['league']))
{
	$x = 1;
} elseif (!preg_match('/^[1-9]{1}$/', $_GET['league'])) {
	$x = 1;
} elseif ($_GET['league'] > $leagues) {
	$x = 1;
} else {
	$x = $_GET['league'];
}
$seasons = 1;
while (is_dir('league.'.$x.'/season.'.$seasons))
{
	$seasons++;
}
$seasons--;
if (empty($_GET['season']))
{
	$y = $seasons;
} elseif (!preg_match('/^[1-9]{1}$/', $_GET['season'])) {
	$y = $seasons;
} elseif ($_GET['season'] > $seasons) {
	$y = $seasons;
} else {
	$y = $_GET['season'];
}
$leagueVars = 'league.'.$x.'/vars.php';
if (file_exists($leagueVars)) require($leagueVars);
$seasonVars = 'league.'.$x.'/season.'.$y.'/vars.php';
if (file_exists($seasonVars)) require($seasonVars);
echo '
		<header>
			<h1>'.$league_name.' Bowling League</h1>
			<h2>'.$day.'s at '.$time.' in '.$town.'</h2>
				<form action="index.php">
					<select name="season">
						<option value="'.$y.'" selected>Season: '.$season_name.'</option>';
for ($z=$seasons;$z>=1;$z--)
{
	$seasonVars = 'league.'.$x.'/season.'.$z.'/vars.php';
	if (file_exists($seasonVars))
	{
		require($seasonVars);
		if ($y != $z)
		{
			echo '
						<option value="'.$z.'">Season: '.$season_name.'</option>';
		}
	}
}
echo '
					</select>
					<input type="hidden" name="league" value="'.$x.'">
					<input type="submit" value="Change Season">
				</form>
			<br>
		</header>';
echo '
		<body>
			<table>';
$leagueVars = 'league.'.$x.'/vars.php';
if (file_exists($leagueVars)) require($leagueVars);
$seasonVars = 'league.'.$x.'/season.'.$y.'/vars.php';
if (file_exists($seasonVars)) require($seasonVars);
$week = 1;
while ($week <= $weeks)
{
	$tr_week = (($week - 1)/$columns);
	if (is_int($tr_week))
	{
		if (file_exists('league.'.$x.'/season.'.$y.'/week'.$week.'of'.$weeks.'.pdf'))
		{
			echo '
				<tr><td><a href="league.'.$x.'/season.'.$y.'/week'.$week.'of'.$weeks.'.pdf">Week '.$week.' of '.$weeks.'</a>';
		} else {
			echo '
				<tr><td>Week '.$week.' of '.$weeks;
		}
	} else {
		if (file_exists('league.'.$x.'/season.'.$y.'/week'.$week.'of'.$weeks.'.pdf'))
		{
			echo '
				<td><a href="league.'.$x.'/season.'.$y.'/week'.$week.'of'.$weeks.'.pdf">Week '.$week.' of '.$weeks.'</a>';
		} else {
			echo '
				<td>Week '.$week.' of '.$weeks;
		}
	}
	$week++;
}
echo '
			</table>
			<br>
			<form action="index.php">
				<select name="league">
					<option value="'.$x.'" selected>League: '.$league_name.'</option>';
for ($z=1;$z<=$leagues;$z++)
{
	$leagueVars = 'league.'.$z.'/vars.php';
	if (file_exists($leagueVars))
	{
		require($leagueVars);
		if ($x != $z)
		{
			echo '
						<option value="'.$z.'">League: '.$league_name.'</option>';
		}
	}
}
echo '
				</select>
				<input type="submit" value="Change League">
			</form>
		</body>';
echo '
	</div>
	<footer>
	</footer>
</html>';

