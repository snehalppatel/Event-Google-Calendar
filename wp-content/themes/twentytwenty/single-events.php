<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */
get_header();
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

    <?php
    get_template_part('template-parts/entry-header');

    if (!is_search()) {
        get_template_part('template-parts/featured-image');
    }
    ?>

    <br/><br/>
    <div class="section-inner">

        <?php the_field('locatios'); ?><br/><br/>
        <?php the_field('date'); ?><br/><br/>
        <?php
        $address = the_field('locatios');
        $data_location = "https://maps.google.com/maps/api/geocode/json?key=AIzaSyC_jsl4AwbLyzmnmKAh5puxKPqVlh9eN7I&address=" . $address . "&sensor=false";
        $google_api_response = wp_remote_get($data_location);
        $results = json_decode($google_api_response['body']);
        $results = (array) $results; 
        $status = $results["status"];
        $location_all_fields = (array) $results["results"][0];
        $location_geometry = (array) $location_all_fields["geometry"];
        $location_lat_long = (array) $location_geometry["location"];

        if ($status == 'OK') {
            $latitude = $location_lat_long["lat"];
            $longitude = $location_lat_long["lng"];
        } else {
            $latitude = '';
            $longitude = '';
        }
        ?>


        <div id="map_canvas" style="width: 70%; height: 500px;"></div><br/><br/>
        <input type="hidden" id="title_data" value="<?php the_title()?>" />
        <input type="hidden" id="date_data" value="<?php the_field('date') ?>" />
        <a class="g_cal">Add to Google Calendar</a><br/><br/>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyC_jsl4AwbLyzmnmKAh5puxKPqVlh9eN7I&sensor=false"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script type="text/javascript">
            $(window).load(function () {
                init();
            });

            var map;
            var center = new google.maps.LatLng('<?php echo $latitude ?>', '<?php echo $longitude ?>');

            function init() {

                var mapOptions = {
                    zoom: 13,
                    center: center,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                }

                map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

                var marker = new google.maps.Marker({
                    map: map,
                    position: center,
                });
            }
        </script>
    </div>

</article>
<?php get_footer(); ?>