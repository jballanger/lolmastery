<?php
require 'lib/autoload.php';
if(isset($_POST['summoner']))
{
	$nOfSummoner = count($_POST['summoner']);
	for($i =  0; $i < $nOfSummoner; $i++)
	{
		if(isset($_POST['summoner'][$i]['name']) && isset($_POST['summoner'][$i]['region']))
		{
			${'summoner'.$i} = new Summoner($_POST['summoner'][$i]['name'], $_POST['summoner'][$i]['region']);
			if(empty(${'summoner'.$i}->id()))
			{
				echo 'The summoner <b>'. utf8_decode(${'summoner'.$i}->name()) .'</b> is non-existant or unavailable on '. strtoupper(${'summoner'.$i}->region()) .' region.<br>';
				unset(${'summoner'.$i});
			}
			else
			{
				${'summonerMastery'.$i} = new SummonerMastery(${'summoner'.$i});
				${'summonerMastery'.$i}->getChampionLevel(${'summonerMastery'.$i}->mastery());
				${'summonerMastery'.$i}->getTotalPoint(${'summonerMastery'.$i}->mastery());
			}
		}
	}
	?>

	<?php require_once('header.php'); ?>
		<a class="back_to_index" href='index.php'><i class="fa fa-long-arrow-left"></i> Back to index</a>
		<br />
		<canvas id='myChart' width="1080" height="540" style="width: 1080px; height: 540px;"></canvas>

		<div class="result_chart">
		<?php
			for($i = 0; $i < $nOfSummoner; $i++)
			{
				if(isset(${'summoner'.$i}))
				{
					echo "<p><span>". htmlentities(${'summoner'.$i}->name()) ."</span> has a total of <span>". ${'summonerMastery'.$i}->totalPoint() ." points</span></p>";
				}
			}
		?>
		</div>

		<script type="text/javascript" charset="utf-8" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script type="text/javascript" charset="utf-8" src='assets/js/Chart.js'></script>
		<script type="text/javascript" charset="utf-8">
			<?php
				for($i = 0; $i < $nOfSummoner; $i++)
				{
					if(isset(${'summoner'.$i}))
					{
						echo "var summonerData".$i."=". json_encode(${'summonerMastery'.$i}->championLevel()) . ";\n";
					}
				}
			?>

			var randomColorFactor = function() {
	        	return Math.round(Math.random() * 255);
	        };
	        var randomColor = function() {
	            return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',.7)';
	        };


			var barChartData = {
			    labels: ["Level 1", "Level 2", "Level 3", "Level 4", "Level 5"],
			    datasets: [
			        <?php
			        for($i = 0; $i < $nOfSummoner; $i++)
			        {
			        	if(isset(${'summoner'.$i}))
			        	{
				        	echo "{
				        			label: '". ${'summoner'.$i}->name() ."',
				        			backgroundColor: randomColor(),
				        			borderColor: 'rgba(157,148,148,1)',
				        			borderWidth: 1,
				        			data: [summonerData".$i."[1], summonerData".$i."[2], summonerData".$i."[3], summonerData".$i."[4], summonerData".$i."[5]]
				        		  }";
				        	if($i != ($nOfSummoner - 1))
			        		{
			        			echo ",";
			        		}
				        }
			        }
			        ?>
			    ]
			};

			window.onload = function() {
	            var ctx = document.getElementById("myChart").getContext("2d");
	            window.myBar = new Chart(ctx, {
	                type: 'bar',
	                data: barChartData,
	                options: {
	                    elements: {
	                        rectangle: {
	                            borderWidth: 2,
	                            borderColor: 'rgb(0, 255, 0)',
	                            borderSkipped: 'bottom'
	                        }
	                    },
	                    responsive: true,
	                    legend: {
	                        position: 'top',
	                    },
	                    title: {
	                        display: true,
	                        text: 'Champion Mastery Level',
													fontColor: '#FFF',
													fontFamily: 'Oswald',
													fontSize: 20
	                    },
						scales: {
						    yAxes: [{
						        ticks: {
						            beginAtZero:true
						        }
						    }]
						},
	                }
	            });
	        };

			var addDataset = function() {
	            var newDataset = {
	                label: 'S2 ',
	                backgroundColor: randomColor(),
	                borderColor: "rgba(157,148,148,1)",
			        borderWidth: 1,
	                data: [playerData[1], playerData[2], playerData[3], playerData[4], playerData[5]]
	            };

	            barChartData.datasets.push(newDataset);
	            window.myBar.update();
	        };
		</script>
<?php
}
else
{
	header('Location:index.php');
}
 require_once('footer.php');
