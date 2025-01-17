<?php
require_once "common.php";
require_once "connection.php";
require_once "header.php";

$stats = $rpc->query("stats.get", []);
?>

<h2>Network Overview</h2>

<?php
$array_of_stats = (array)$stats;

/* What if someone wants to add their own stats... */
Hook::run(HOOKTYPE_PRE_OVERVIEW_CARD, $array_of_stats);

/* This makes sure that a plugin which called the parameter
 * by reference can add/update the stats for display here.
*/
$stats = (object) $array_of_stats;

$userlist = [];
Hook::run(HOOKTYPE_GET_USER_LIST, $userlist);
$num_of_panel_admins = count($userlist);

?>
<div class="container">

	<div class="row mt-3">
		<div class="col-sm mb-3">
			<div class="card text-center">
				<div class="card-header bg-success text-white">
					<div class="row">
						<div class="col">
							<i class="fa fa-users fa-3x"></i><span class="position-absolute badge rounded-pill badge-warning">
							<?php echo "Record: ".$stats->user->record; ?>
						</span>
						</div>
						<div class="col">
							<h3 id="stats_user_total" class="display-4"><?php echo $stats->user->total; ?></h3>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col">
							<h6>Users Online</h6>
						</div>
						<div class="col"> <a class="btn btn-primary" href="<?php echo BASE_URL; ?>users">View</a></div>
					</div>
				</div>
			</div>
			

		</div>
		<div class="col-sm mb-3">
			<div class="card text-center">
				<div class="card-header bg-primary text-white">
					<div class="row">
						<div class="col">
							<i class="fa fa-hashtag fa-3x"></i>
						</div>
						<div class="col">
							<h3 id="stats_channel_total" class="display-4"><?php echo $stats->channel->total; ?></h3>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col">
							<h6>Channels</h6>
						</div>
						<div class="col"><a class="btn btn-primary" href="<?php echo BASE_URL; ?>channels">View</a></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm mb-3">
			<div class="card text-center">
				<div class="card-header bg-warning">
					<div class="row">
						<div class="col">
							<i class="fa fa-shield-halved fa-3x"></i>
						</div>
						<div class="col">
							<h3 id="stats_oper_total" class="display-4"><?php echo $stats->user->oper; ?></h3>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col">
							<h6>Opers</h6>
						</div>
						<div class="col"><a class="btn btn-primary" href="<?php echo BASE_URL."users/?operonly"; ?>">View</a></div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-sm mb-3">
			<div class="card text-center">
				<div class="card-header bg-secondary text-white">
					<div class="row">
						<div class="col">
							<i class="fa fa-network-wired fa-3x"></i>
						</div>
						<div class="col">
							<h3 id="stats_server_total" class="display-4"><?php echo $stats->server->total; ?></h3>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col">
							<h6>Servers</h6>
						</div>
						<div class="col"> <a class="btn btn-primary" href="<?php echo BASE_URL; ?>servers">View</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container mt-3">

	<div class="row">
		<div class="col-sm mb-3">
			<div class="card text-center">
				<div class="card-header bg-danger text-white">
					<div class="row">
						<div class="col">
							<i class="fa fa-ban fa-3x"></i>
						</div>
						<div class="col">
							<h3 id="num_server_bans" class="display-4"><?php echo $stats->server_ban->server_ban; ?></h3>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col">
							<h6>Server Bans</h6>
						</div>
						<div class="col"> <a class="btn btn-primary" href="<?php echo BASE_URL; ?>server-bans">View</a></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm mb-3">
			<div class="card text-center">
				<div class="card-header bg-secondary text-white">
					<div class="row">
						<div class="col">
							<i class="fa fa-filter fa-3x"></i>
						</div>
						<div class="col">
							<h3 id="num_spamfilter_entries" class="display-4"><?php echo $stats->server_ban->spamfilter; ?></h3>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col">
							<h6>Spamfilter</h6>
						</div>
						<div class="col"> <a class="btn btn-primary" href="<?php echo BASE_URL; ?>spamfilter.php">View</a></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm mb-3">
			<div class="card text-center">
				<div class="card-header bg-primary text-white">
					<div class="row">
						<div class="col">
							<i class="fa fa-door-open fa-3x"></i>
						</div>
						<div class="col">
							<h3 id="num_ban_exceptions" class="display-4"><?php echo $stats->server_ban->server_ban_exception; ?></h3>
						</div>
					</div>
				</div>

				<div class="card-body">
					<div class="row">
						<div class="col">
							<h6>Server Ban Exceptions</h6>
						</div>
						<div class="col"> <a class="btn btn-primary" href="<?php echo BASE_URL; ?>server-bans/ban-exceptions.php">View</a></div>
					</div>
				</div>
			</div>
		</div>
		<?php
		if ($stats->server->ulined) {
			$bg = "bg-success";
			$tooltip = "Users / Servers";
		}
		else
			$bg = "bg-warning";
		?> 
		<div class="col-sm mb-3">
			<div class="card text-center">
				<div class="card-header <?php echo $bg; ?> text-white">
					<div class="row">
						<div class="col">
							<i class="fa fa-database fa-3x"> </i>
						</div>
						<div class="col">
						<span data-toggle="tooltip" title="<?php echo $tooltip; ?>" style="border-bottom: 1px dotted #000000">
						<h3 id="stats_uline_total" class="display-4"><?php echo $stats->user->ulined; ?>/<?php echo $stats->server->ulined; ?></h3>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col">
							<h6>Services Online</h6>
						</div>
						<div class="col"> <a class="btn btn-primary" href="<?php echo BASE_URL."users/?servicesonly"; ?>">View</a></div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>


<script>
    function updateStats() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = JSON.parse(this.responseText);
                document.getElementById("stats_user_total").innerHTML = data.user.total;
                document.getElementById("stats_channel_total").innerHTML = data.channel.total;
				document.getElementById("stats_oper_total").innerHTML = data.user.oper;
				document.getElementById("stats_server_total").innerHTML = data.server.total;
				document.getElementById("num_server_bans").innerHTML = data.server_ban.server_ban;
				document.getElementById("num_spamfilter_entries").innerHTML = data.server_ban.spamfilter;
				document.getElementById("num_ban_exceptions").innerHTML = data.server_ban.server_ban_exception;
				document.getElementById("stats_uline_total").innerHTML = data.user.ulined + "/" + data.server.ulined;
            }
        };
        xhttp.open("GET", "api/overview.php", true);
        xhttp.send();
    }
    updateStats();
    setInterval(updateStats, 1000); // Update stats every second
</script>

<div class="container mt-3">

			<div class="row">
				<div class="col-sm-3">
					<div class="card text-center">
						<div class="card-header bg-success text-white">
							<div class="row">
								<div class="col">
									<i class="fa fa-lock-open fa-3x"></i>
								</div>
								<div class="col">
									<h3 class="display-4"><?php echo $num_of_panel_admins; ?></h3>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col">
									<h6>Panel Access</h6>
								</div>
								<div class="col"> <a class="btn btn-primary" href="<?php echo BASE_URL; ?>settings">View</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>	
<?php

Hook::run(HOOKTYPE_OVERVIEW_CARD, $stats);

require_once "footer.php";
