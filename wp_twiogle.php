<?php
/*
Plugin Name: Twiogle Search - Search Google & Twitter at the same time
Plugin URI: http://twiogle.com
Description: This adds a widgit so you can search Google and Twitter at the same time.
Version: 1.6
Author: Benjiballin , Armastevs
Author URI: http://twiogle.com
*/

function wp_twiogle_widget() {
?>
<h2 class="widgettitle">Twiogle Search</h2>
<form onSubmit="openNew();" id="cse-search-box">

<input type="text" id="q" size="15"/>
<button onclick="javascript: openNew();">Twiogle it!</button>
</form>

<script type="text/javascript">
function openNew()
{
window.open('http://twiogle.com?q=' + document.getElementById('q').value, '_blank');
}
</script>
<script type="text/javascript" src="http://www.google.com/coop/cse/brand?form=cse-search-box&amp;lang=en"></script>

<?php
}
function wp_twiogle_init()
{
register_sidebar_widget(__('Twiogle Search'), 'wp_twiogle_widget');
}
add_action("plugins_loaded", "wp_twiogle_init");
?>
