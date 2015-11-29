<?php if (isset($_SESSION['id'])) { ?>
	<input type="button" class="next"/>
	<input type="button" class="previous"/>
	<div class="wrapper">
		<h1></h1>
		<div class="mensal">
			<table>
				<tr class = "diasSemana">
					<td>Domingo</td>
					<td>Segunda</td>
					<td>Terca</td>
					<td>Quarta</td>
					<td>Quinta</td>
					<td>Sexta</td>
					<td>Sabado</td>
				</tr>
				<tr class = "semana">
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</table>
		</div>
	</div>
	<div id="teste">
	</div>
	<script type="text/javascript" src="js/mensal.js"></script>
<?php }?>
