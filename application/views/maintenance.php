<!doctype html>
<title>Site Maintenance</title>
<head>
	<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
	<script> var BASE_URL = "<?php echo base_url(); ?>"; </script>
</head>
<style>
  body { text-align: center; padding: 150px; }
  h1 { font-size: 50px; }
  body { font: 20px Helvetica, sans-serif; color: #333; }
  article { display: block; text-align: left; width: 650px; margin: 0 auto; }
  a { color: #dc8100; text-decoration: none; }
  a:hover { color: #333; text-decoration: none; }
</style>

<article>
    <h1>We&rsquo;ll be back soon!</h1>
    <div>
        <p>Sorry for the inconvenience but we&rsquo;re performing some maintenance at the moment. If you need to you can always contact us, otherwise we&rsquo;ll be back online shortly!</p>
        <p>&mdash; The Team</p>
				<?php if(! empty($this->_user)) : ?>
				<span style="float:right; margin-left:10px;"><button style="padding:15px;" onclick="logout()">LOGOUT</button></span>
				<?php else : ?>
					<span style="float:right; margin-left:10px;"><button style="padding:15px;" onclick="login()">LOGIN</button></span>
				<?php endif; ?>

				<?php if($this->pm->can_add OR $this->pm->can_edit OR $this->pm->can_delete) : ?>
					<span style="float:right; margin-left:10px;"><button style="padding:15px;" onclick="enterSystem()">ENTER SYSTEM</button></span>
					<script>
						function enterSystem() {
							window.location.href = BASE_URL;
						}
					</script>
				<?php endif; ?>
    </div>
</article>

<article>

</article>
<script>
setInterval(function(){
	$.get(BASE_URL + 'maintenance/check_open_system', function(rs){
		if(rs == 'open'){
			window.location.href = BASE_URL;
		}
	});
}, 10000);

function logout() {
	window.location.href = BASE_URL + 'authentication/logout';
}

function login() {
	window.location.href = BASE_URL + 'authentication';
}
</script>
