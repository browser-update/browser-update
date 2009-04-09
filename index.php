<?php
require_once("lib/init.php");
require_once("lib/lang.php");
include("header.php");
?>

   
<div class="left">
	<div class="message">
		<?php tt('index-teaser.php'); ?>
	</div>

		<h2><?php echo t('How it works'); ?></h2>
		<?php tt('index-steps.php'); ?>
		<h2><?php echo t('Features'); ?></h2>
		<?php tt('index-features.php'); ?>
		<h2 id="install"><?php echo t('Install notification on your site'); ?></h2>
		<?php tt('index-install-head.php'); ?>
		<div class="generate">
        <p><?php echo t('Following browsers will be notified:'); ?></p>
        <div id="browserversionchooser">
		<span class="browser">
			<label for="f-i">IE</label> 
			<select id="f-i" onchange="code();">
				<option value="5.5">&lt;= 5.5</option>
				<option value="6" selected="selected">&lt;= 6</option>
				<option value="7">&lt;= 7</option>
			</select>
		</span>
		<span class="browser">
			<label for="f-f">Firefox</label>  
			<select id="f-f" onchange="code();">
				<option value="1">&lt;= 1.0</option>
				<option value="1.5">&lt;= 1.5</option>
				<option value="2" selected="selected">&lt;= 2.0</option>
			</select>
		</span>
		<span class="browser">
			<label for="f-o">Opera</label> 
			<select id="f-o" onchange="code();">
				<option value="8">&lt;= 8.0</option>
				<option value="9">&lt;= 9.0</option>
				<option value="9.2" selected="selected">&lt;= 9.2</option>
			</select>
		</span>
		<span class="browser">
			<label for="f-s">Safari</label>  
			<select id="f-s" onchange="code();">
				<option value="1">&lt;= 1.0</option>
				<option value="1.2">&lt;= 1.2</option>
				<option value="2" selected="selected">&lt;= 2.0</option>
				<option value="3">&lt;= 3.0</option>
			</select>
		</span>
		<span class="browser">
			<label for="f-s">Chrome: </label>
			<span class="popupinfo">auto<span class="popup">Google Chrome besitzt eine immer aktive automatische Update-Funktion und ist deshalb immer aktuell.</span></span>
		</span>
        </div>
        <div>
            <input type="checkbox" checked="checked" id="autoupdate" onchange="code();"/>
            <label for="autoupdate"><?php tt('index-install-autoupdate.php'); ?></label>
        </div>
		<h3><?php echo t('Your Code'); ?></h3>
		<textarea id="f-code" rows="10" cols="80">
&lt;script type="text/javascript">
var $buoop = {}
$buoop.ol = window.onload;
window.onload=function(){
     if ($buoop.ol) $buoop.ol();
     var e = document.createElement("script");
     e.setAttribute("type", "text/javascript");
     e.setAttribute("src", "http://browser-update.org/update.js");
     document.body.appendChild(e);
}
&lt;/script>
		</textarea>
		
		</div>
		<p>
		</p>
		<h2><?php echo t('Why you should tell users to update'); ?></h2>
		<?php tt('index-why.php'); ?>
		<h2><?php echo t('Help this project'); ?></h2>
		<?php tt('index-project.php'); ?>
</div>

<script type="text/javascript">
var $buoop = {};
$buoop.ol = window.onload;
window.onload=function(){
     var e = document.createElement("script");
     e.setAttribute("type", "text/javascript");
     e.setAttribute("src", "/update.js");
     document.body.appendChild(e);
     if ($buoop.ol) $buoop.ol();
}
code();
</script>
	

<?php include("footer.php");?>

