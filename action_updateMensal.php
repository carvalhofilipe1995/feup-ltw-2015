<?php
	echo "<h1> $months[$temp] </h1>";
	echo "<div class=mensal><table><tr class = dias>";
	for ($i=0;$i<$columns;$i++){
		echo '<td>';
		echo $daysOfWeek[$i];
		echo '</td>';
	}
	echo '</tr>';
	
	for ($i=0;$i<$rows;$i++){
		echo '<tr class=linha "$row">';
		for ($j=1;$j<=$columns; $j++) {
			if ($i==0 && $j<$firstDay || $count > $daysOfMonth) {
				echo '<td class=naoValido></td>';
			}
			else {
				if (($count) == $currentDay) {
					echo "<td class=hoje> $count </td>";
				}
				else {
					echo "<td class=valido> $count </td>";
					}
			$count++;
			}
		}
		echo '</tr>';
	}
	echo "</table></div>"
?>