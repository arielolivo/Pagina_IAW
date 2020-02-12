<div class="h-header">
	<div class="h-logo"><a href="home.php"><img src="images/logo.png" width="130"></a></div>
	<div class="h-search"><input type="text" placeholder="Busca" class="search"></div>
	<div class="h-account">
		<a href=""><img src="images/icons/explorar.png" class="i-icon"></a>
		<a href="perfil.php?username=<?php echo $_SESSION['username'];?>">
			<img src="images/icons/perfil.png" class="i-icon">
		</a>
		<a href="logout.php">
			<img src="images/icons/close.png" class="i-icon" width="24px">
		</a>
	</div>
</div>