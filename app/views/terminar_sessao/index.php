<?php session_start(); ?>

<style>
	body, #logo_left, #logo_right {
		display: flex;
		justify-content: center;
		align-items: center;
	}

	#logo {
		animation: opacidade 2s infinite;
	}

	#logo_left {
		animation: logo_left 1s infinite;
	}

	#logo_right {
		animation: logo_right 1s infinite;
	}

	@keyframes logo_right{
		0%{
			filter: opacity(10%);
			width: 2%;
			transform: rotate(0deg);
		}
		
		50%{
			filter: opacity(80%);
			width: 15%;
			transform: rotate(180deg);
		}

		100%{
			filter: opacity(10%);
			width: 2%;
			transform: rotate(320deg);
		}
	}

	@keyframes logo_left{
		0%{
			filter: opacity(10%);
			width: 2%;
			transform: rotate(0deg);
		}
		
		50%{
			filter: opacity(80%);
			width: 15%;
			transform: rotate(180deg);
		}

		100%{
			filter: opacity(10%);
			width: 2%;
			transform: rotate(320deg);
		}
	}

	@keyframes opacidade{
		0%{
			filter: opacity(10%);
			width: 5%;
			
		}
		
		50%{
			filter: opacity(80%);
			width: 20%;
			
		}

		100%{
			filter: opacity(10%);
			width: 5%;
			
		}
	}
</style>

<body style="background: #222">

	<div id="logo_left">
		<img src="../../../assets/img/logo.png" style="border-radius: 50%" width="50%" alt="">
	</div>

	<div id="logo">
		<img src="../../../assets/img/logo.png" style="border-radius: 50%" width="100%" alt="">
	</div>

	<div id="logo_right">
		<img src="../../../assets/img/logo.png" style="border-radius: 50%" width="50%" alt="">
	</div>


	<script>
		setTimeout(() => {
			window.location = "../inicio";
		}, 3000);
	</script>	
</body>

<?php session_destroy(); ?>