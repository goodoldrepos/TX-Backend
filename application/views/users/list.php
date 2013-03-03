
<div class="container">
	<div class="row">
		<div class="span12">
			<h1>Administration Utilisateurs</h1>
			<table class="table">
				<tr><td>Nom</td><td>Email</td></tr>
				<?php foreach($users as $user){ ?>
				<tr>
					<td>
						<a href="<?php echo site_url('users/') ?>"><?php echo $user->nom . ' ' . $user->prenom; ?></a>
					</td>
					<td>
						<?php echo $user->email; ?>
					</td>
				</tr>
				<?php } ?>
			</table>
		</div>
	</div>
</div>

