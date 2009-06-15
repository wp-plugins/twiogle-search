<?php
/*
Plugin Name: Twiogle
Plugin URI: http://twiogle.com
Description: Search Google and Twitter at the same time, adsense integration so ads are displayed on Twiogle.com for your account.
Version: 1.48
Author: Benjiballin
Author URI: http://twiogle.com
*/

add_action('admin_menu', 'add_twiogle_menu');

function add_twiogle_menu()
{
add_options_page('Twiogle', 'Twiogle', 8, 'twiogleoptions', 'twiogle_options_page');

}

function twiogle_options_page()   {

    // variables for the field and option names 
    $opt_name = 'mt_adsense_pub';
    $hidden_field_name = 'mt_submit_hidden';
    $data_field_name = 'mt_adsense_pub';

    $opt_name2 = 'mt_adsense_channel';
    $hidden_field_name2 = 'mt_submit_hidden2';
    $data_field_name2 = 'mt_adsense_channel';

    // Read in existing option value from database
    $opt_val = get_option( $opt_name );
    $opt_val2 = get_option( $opt_name2 );

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
        $opt_val = $_POST[ $data_field_name ];
        $opt_val2 = $_POST[ $data_field_name2 ];

        // Save the posted value in the database
        update_option( $opt_name, $opt_val );
        update_option( $opt_name2, $opt_val2 );

        // Put an options updated message on the screen

?>
<div class="updated"><p><strong><?php _e('Options saved.', 'mt_trans_domain' ); ?></strong></p></div>
<?php

    }

    // Now display the options editing screen

    echo '<div class="wrap">';

    // header

    echo "<h2>" . __( 'Twiogle Search Optoins', 'mt_trans_domain' ) . "</h2>";
echo "The Twiogle search plugin allows you to input your own adsense pub ID and it will display the advertisment on the search page to give credit to your adsense account.";
    // options form
    
    ?>

<form name="form1" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

<p><?php _e("Adsense Pub-id:", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name; ?>" value="<?php echo $opt_val; ?>" size="20">
ex: pub-5117280332430555</p><hr />







<p><?php _e("Channel:", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name2; ?>" value="<?php echo $opt_val2; ?>" size="20">
ex: 2758873412</p><hr />

<p class="submit">
<input type="submit" name="Submit" value="<?php _e('Update Options', 'mt_trans_domain' ) ?>" />
</p>

</form>
</div>

<?php
 
}

function wp_twiogle_widget() {
?>
<h2 class="widgettitle">Twiogle Search</h2>



<form onSubmit="openNew();" id="cse-search-box">

<input type="text" id="q" size="15"/>
<button type="submit">Twiogle it!</button>
</form>
<p></p>
<br></br>
<script type="text/javascript">

function openNew()
{

<?php
$pub = get_option( 'mt_adsense_pub' );
$channel = get_option( 'mt_adsense_channel' );
?>

var pub= "<?= $pub ?>";
var channel= "<?= $channel ?>";

window.open('http://twiogle.com?p='+pub+ '&c='+ channel +'&q=' + document.getElementById('q').value, '_blank');
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
