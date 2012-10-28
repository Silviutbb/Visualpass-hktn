<html>
<head>
<title>Index</title>
<style type="text/css">
.swe {
position:absolute;
left: 132px;
top: 349px;
width: 107px;
height: 42px;
}

.swe2 {
position:absolute;
left: 359px;
top: 272px;
width: 143px;
height: 35px;
}
.swe3 {
position:absolute;
left: 678px;
top: 238px;
width: 126px;
height: 31px;
}
.swe4 {
position:absolute;
left: 400px;
top: 511px;
width: 126px;
height: 62px;
}
.swe5 {
position:absolute;
left: 560px;
top: 540px;
width: 126px;
height: 62px;
}
</style>
<style>
body {
0px;
padding: 0px;
}
#myCanvas {
border: 0px
}

</style>
</head>

<body>
<img src="head.png" width="965" height="429" style="position: relative; top: 0; left: 0;"/>
<a href="index.php">
<img src="main.png" width="107" height="42" class="swe"/>
</a>
<a href="gen.html">
<img src="generator.png" width="138" height="91" class="swe2"/>
</a>
<a href="about.html">
<img src="about.png" width="392" height="168" class="swe3">
</a>
<center>
<p><h2>Vrei o parola sigura si usor de retinut?</h2></p>
<p>Dimensiune:</p></center>
<form class='swe5'action="index.php?go=1" method="POST">
<input type="text" name="dimensiune"><br>
<input type="submit" value="Genereaza una">
</form>
<br><br><br><br>
<?php
if(isset($_GET['go']))
{?>
<center>
<canvas id="myCanvas" width="578" height="208">
</canvas>

<script>
var canvas = document.getElementById('myCanvas');
var context = canvas.getContext('2d');
context.clearRect(0, 0, canvas.width, canvas.height);
drawbackground(canvas, context);
drawlines(canvas, context);

function drawbackground(canvas, context, onload)
{

var imagePaper = new Image();


imagePaper.onload = function()
{


context.drawImage(imagePaper,1, 2, 578,208);
onload(canvas, context);
};

imagePaper.src = "keyboard1.png"; 
}



	

function drawlines(canvas, context)
{
context.beginPath();

<?php 
	if(isset($_POST['dimensiune'])) //primesc dimensiunea parolei minim 5 ch max 16, default 6 
		{$dim=intval($_POST['dimensiune']);
			if($dim<5)
				$dim=5;
			else
			if($dim>16)
				$dim=16;
		}
	else
		$dim=6;

 // generez o matrice de lucru care va tine literele tastaturii
 $tastatura[0][0]='1';// randul 1 (0)
 $tastatura[0][1]='2';
 $tastatura[0][2]='3';
 $tastatura[0][3]='4';
 $tastatura[0][4]='5';
 $tastatura[0][5]='6';
 $tastatura[0][6]='7';
 $tastatura[0][7]='8';
 $tastatura[0][8]='9';
 $tastatura[0][9]='0';
 $tastatura[1][0]='q';//randul 2 (1)
 $tastatura[1][1]='w';
 $tastatura[1][2]='e';
 $tastatura[1][3]='r';
 $tastatura[1][4]='t';
 $tastatura[1][5]='y';
 $tastatura[1][6]='u';
 $tastatura[1][7]='i';
 $tastatura[1][8]='o';
 $tastatura[1][9]='p';
 $tastatura[2][0]='a'; //randul 3 (2)
 $tastatura[2][1]='s';
 $tastatura[2][2]='d';
 $tastatura[2][3]='f';
 $tastatura[2][4]='g';
 $tastatura[2][5]='h';
 $tastatura[2][6]='j';
 $tastatura[2][7]='k';
 $tastatura[2][8]='l';
 $tastatura[2][9]='';
 $tastatura[3][0]='z';//randul 4 (3)
 $tastatura[3][1]='x';
 $tastatura[3][2]='c';
 $tastatura[3][3]='v';
 $tastatura[3][4]='b';
 $tastatura[3][5]='n';
 $tastatura[3][6]='m';
 $tastatura[3][7]='';
 $tastatura[3][8]='';
 $tastatura[3][9]='';
 
 $sw=1; // switck in caz ca este necesar sa se reia algoritmul
 while($sw==1){
 $k=0; 
 $res=''; // rezultatul
 
 while ($k==0){
  $i=rand(0,9);  //generez prima litera
  $j=rand(0,3);
  if ($tastatura[$j][$i]!='') //verific ca prima litera sa fie valida
	$k=1;
	$res=$tastatura[$j][$i];
    $poz[0][0]=$j;
    $poz[0][1]=$i;
  
  }


  $k=0;

 while ($k==0){ //generez a doua litera
  $i=$poz[0][1];
  $j=$poz[0][0];
  $j=$j - 1 + rand(0,2);
  if($j>=0 && $j<4){
	if($j==$poz[0][0])
		$i=$i-1+rand(0,2);
	if($j==$poz[0][0]-1)
		$i=$i+rand(0,1);
	if($j==$poz[0][0]+1)
		$i=$i-1+rand(0,1);
  if(($i==$poz[0][1] xor $j==$poz[0][0]) or ($i!=$poz[0][1] && $j!=$poz[0][0]))  // verific daca litera e diferita de precedenta
	if($i<=9 and $j<=3 and $i>0 && $j>0) //verific ca pozitiile sa fie inca in matrice
		if ($tastatura[$j][$i]!='') //verific ca a doua litera sa fie valida
			{$k=1; 
	
			$res=$res . $tastatura[$j][$i];
			$poz[1][0]=$j;
			$poz[1][1]=$i;
			}
		}
  }

  
  $count=1; //contorul de litere -1 consideram si zero o valoare, deja am produs doua litere dar scriem
  while($count<$dim-1){
	$k=0;
	$count=$count+1;
	while ($k==0){ //generez restul literelor
	$i=$poz[$count-1][1];
	$j=$poz[$count-1][0];
	$j=$j - 1 + rand(0,2);
	if($j>=0 && $j<4){ // definesc i in functie de pozitia j
		if($j==$poz[$count-1][0])
			$i=$i-1+rand(0,2);
		if($j==$poz[$count-1][0]-1)
			$i=$i+rand(0,1);
		if($j==$poz[$count-1][0]+1)
			$i=$i-1+rand(0,1);
	if(($i==$poz[$count-1][1] xor $j==$poz[$count-1][0]) or ($i!=$poz[$count-1][1] && $j!=$poz[$count-1][0]))  // verific daca litera e diferita de precedenta
		if($i<=9 and $j<=3 and $i>0 && $j>0) //verific ca pozitiile sa fie inca in matrice
			if ($tastatura[$j][$i]!='') //verific ca a doua litera sa fie valida 
				if($tastatura[$j][$i]!=$tastatura[$poz[$count-2][0]][$poz[$count-2][1]]) //verific ca litera sa nu se intoarca cu doua pozitii in urma
			{$k=1; 
	
			$res=$res . $tastatura[$j][$i];
			$poz[$count][0]=$j;
			$poz[$count][1]=$i;
			}
		}
	}
	}
	
	$nSup=0; //numarul de suprapuneri ale liniilor
	for($p1=1;$p1<$dim-2;$p1++) //verificam suprapunerile
		for($p2=$p1+1;$p2<$dim-1;$p2++)
			{if($poz[$p1][1]==$poz[$p2+1][1] && $poz[$p1][0]==$poz[$p2+1][0] && $poz[$p1-1][1]==$poz[$p2][1] && $poz[$p1-1][0]==$poz[$p2][0])
				{
				$nSup++;
				$sup[$nSup]=$p2;
			}
			if($poz[$p1][1]==$poz[$p2][1] && $poz[$p1][0]==$poz[$p2][0] && $poz[$p1-1][1]==$poz[$p2+1][1] && $poz[$p1-1][0]==$poz[$p2+1][0])
				{
				$nSup++;
				$sup[$nSup]=$p2;
			}
			}
	if($nSup<=2) // accept pana la doua suprapuneri
		$sw=0;
	}
	
	//incepem desenarea pe canvas-ul desenat anterior 
	  $culori[0]='green'; //vector culori ale linilor
	  $culori[1]='red';
	  $culori[2]='blue';
	  $ctCol=0; // culoarea curenta pentru linie
	
	$offseti=55;
	$offsetj=25; //offseturi de distanta
	$ofLinie=11;
	$ofCol=40;

	$i0=$offseti + $poz[0][1] * $ofCol + $poz[0][0] * $ofLinie; //punctul initial
	$j0=$offsetj + $poz[0][0]*40; ?>
    
	
	context.fillStyle ="CC0000"
	context.arc(<?php echo($i0); ?>, <?php echo($j0); ?>,5,0,Math.PI*2,true); 
	setTimeout(function alpha() {  <?php
 for($ct=1; $ct<$dim; $ct++)
 {
	$ddd=0;
	$i1=$offseti + $poz[$ct][1] * $ofCol + $poz[$ct][0] * $ofLinie;
	$j1=$offsetj + $poz[$ct][0]*43;
	for($ceva=1;$ceva<=$nSup;$ceva++) // nu mai stiu nume de variabile :)
		if($ct-1==$sup[$ceva])
			{$ctCol++;
			$ddd=1;
			} //desenam linie vectorial si apoi punctul
			
	?>
	context.moveTo(<?php echo($i0); ?>, <?php echo($j0); ?>);
	context.lineTo(<?php echo($i1); ?>, <?php echo($j1); ?>);
    context.lineWidth = 
	<?php $gr=4;  //micsoram grosimea liniei cand sunt suprapuneri
	if($ctCol!=0)
		echo($gr-2);
	else
		echo($gr);?>;
    context.strokeStyle = "<?php echo($culori[$ctCol]); ?>";
    context.stroke();
	
	context.fillStyle ="CC0000"
	context.beginPath();
	
	context.arc(<?php echo($i1); ?>, <?php echo($j1); ?>,5,0,Math.PI*2,true);
	context.closePath();
	context.fill();

	<?php
	$i0=$i1; // notam ca punct de origine punctul precedent
	$j0=$j1;
	if($ddd==1) 
		$ctCol--;
 }
?>
}, 200);
}


drawbackground(canvas, context, drawlines);


</script>
<p><h1>
<?php
echo($res);
?>
</h1></p>
<?php } ?>
</center>
<body>
</html>

