
<html>
<head>
<meta charset="UTF-8">
<title> knjige </title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<p><b>Pretraga svih knjiga:</b></p>
<form action="index.php" method="GET">
		<input type="submit" value="Pretraži" name="pretraga"> <br>
</form>
<?php
require_once("funkcije.php");
$upit="SELECT * FROM knjige";	
$rez=mysqli_query($db, $upit);
if(mysqli_error($db))
{
    echo mysqli_errno($db)."<br>".mysqli_error($db)."<hr>";
    exit(1);
}
if(isset($_GET['pretraga'])) {
echo "Broj knjiga: ".mysqli_num_rows($rez)."<br>";

while($red=mysqli_fetch_assoc($rez))
echo "{$red['id']}. {$red['pisac']} - {$red['naslov']} ({$red['izdavac']})<br>";  }
?>



<hr>
<p><b>Pretraga određene knjige:</b></p>
<form action="index.php" method="GET">
		<input type="text" placeholder="Pretraži knjige" name="pretrazi"><br><br>
		<input type="submit" value="Pretraži"> <br>
</form>
<?php
require_once('funkcije.php');
if(isset($_GET['pretrazi'])) {
	if(!empty($_GET['pretrazi'])) {
		$pretrazi = trim($_GET['pretrazi']);
		$pretrazi = mysqli_real_escape_string($db,$pretrazi);
		$query = "SELECT * FROM knjige WHERE naslov LIKE '%{$pretrazi}%' OR pisac LIKE '%{$pretrazi}%'OR izdavac LIKE '%{$pretrazi}%'";
		$result  = mysqli_query($db,$query);
				if(mysqli_num_rows($result)>0){
					while($row = mysqli_fetch_assoc($result)) {
						?>
	
						<div>
					<p>Id: <?php echo $row['id'] ?> </p>
					<p>Naslov: <?php echo $row['naslov'] ?> </p>
					<p>Pisac: <?php echo $row['pisac']; ?> </p>
					<p>Izdavač: <?php echo $row['izdavac']; ?> </p>
						</div>
						
						
						<?php
					}
					
					echo "Broj rezultata: " . mysqli_num_rows($result);
					
				} else {
					
					echo "Nema rezultata";
				}
	}else {
		echo "Pretraga je prazna";
	}
	
}
?>


<hr>	
<p><b>Unos novih knjiga:</b></p>
<form action="index.php" method="POST">
		
		<label> Naslov: <br>
		<input type="text" name="naslov"> </label><br>
			<label> Pisac: <br>
		<input type="text" name="pisac"> </label><br>
			<label> Izdavač: <br>
		<input type="text" name="izdavac"> </label><br><br>
		
		<input type="submit" name="insert" value="Ubaci u bazu podataka"> <br>
		
</form>
		
<?php
if(isset($_POST['insert'])) {
			
	if(isset($_POST['naslov']) && isset($_POST['pisac']) && isset($_POST['izdavac'])) {
			
		if(!empty($_POST['naslov']) && !empty($_POST['pisac']) && !empty($_POST['izdavac'])) {
					
				$naslov = trim($_POST['naslov']);
				$pisac = trim($_POST['pisac']);
				$izdavac = trim($_POST['izdavac']);	
			
				require_once('funkcije.php');
			
			$naslov = mysqli_real_escape_string($db,$naslov);
			$pisac = mysqli_real_escape_string($db,$pisac);
			$izdavac = mysqli_real_escape_string($db,$izdavac);
			
			$query = "INSERT INTO knjige(naslov, pisac, izdavac) VALUES ('{$naslov}','{$pisac}','{$izdavac}')";
			
			if (mysqli_query($db,$query) === TRUE){
				echo "Novi naslov je ubacen u bazu";
			} 
			else {
				echo "Greška!";
			}
			} 
			else {
				echo "Svi podaci moraju biti uneti.";
			}
		}	
		else {
			
			echo "Svi podaci moraju biti poslati.";	
		}
		}
?>
	
	
<hr>
<p><b>Brisanje knjiga:</b></p>
<form action="index.php" method="GET">
		<input type="text" placeholder="Id knjige" name="id"><br><br>
		<input type="submit" value="Briši"> <br>
</form>
	<?php
if(isset($_GET['id'])) {
	$id = $_GET['id'];
	require_once("funkcije.php");
	$query = "DELETE FROM knjige WHERE id = {$id}";
	mysqli_query($db,$query);
	echo "Knjiga pod rednim brojem $id je obrisana.";
}
	?>

</body>

</html>