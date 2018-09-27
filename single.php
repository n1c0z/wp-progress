<?php
get_header();
$cb_post_id = $post->ID;
$cb_featured_image_style_override_onoff = ot_get_option('cb_post_style_override_onoff', 'off');
$cb_featured_image_style_override_style = ot_get_option('cb_post_style_override', 'standard');
$cb_post_format = get_post_format();
$cb_featured_image_style = get_post_meta($cb_post_id, 'cb_featured_image_style', true);
$cb_featured_image_style_override_post_onoff = get_post_meta($cb_post_id, 'cb_featured_image_style_override', true);
$cb_sidebar_position = cb_get_sidebar_setting();
$cb_featured_image_style_cache = $cb_content_class = $cb_fis_size_output = NULL;
$cb_review_checkbox = get_post_meta($cb_post_id, 'cb_review_checkbox', true);
$cb_byline = $cb_date = $cb_author = $cb_cat_output = $cb_author_avatar = $cb_views_output = $cb_lks_output = NULL;


if (( $cb_featured_image_style_override_onoff == 'on' ) && ( $cb_featured_image_style_override_post_onoff != 'on')) {
    $cb_featured_image_style = $cb_featured_image_style_override_style;
}

if ($cb_featured_image_style == NULL) {
    $cb_featured_image_style = 'standard';
}
if ($cb_featured_image_style == 'standard-uncrop') {
    $cb_featured_image_style = 'standard';
}

if (( $cb_post_format == 'video') || ( $cb_post_format == 'audio')) {
    $cb_featured_image_style_cache = $cb_featured_image_style;
    $cb_featured_image_style = $cb_post_format;
}
if ($cb_post_format == 'gallery') {
    $cb_gallery_post_images = get_post_meta($cb_post_id, 'cb_gallery_post_images', true);

    if ($cb_gallery_post_images != NULL) {

        $cb_featured_image_style = $cb_post_format;
    }
}

$cb_fis_size = cb_get_fis_size($cb_post_id);

if (( ot_get_option('cb_postload_onoff', 'off') == 'off' ) && ( $cb_fis_size == 'box' )) {
    $cb_content_class = 'wrap ';
}
?>

<div id="cb-content" class="<?php echo esc_attr($cb_content_class); ?>clearfix">

    <div class="cb-entire-post cb-first-alp clearfix<?php echo esc_attr($cb_fis_size_output); ?>"<?php cb_alp($cb_post_id); ?>>

        <?php
        if (( $cb_featured_image_style != 'off' ) && ( $cb_featured_image_style_cache != 'off' ) && ( $cb_featured_image_style != 'standard' ) && ( $cb_featured_image_style_cache != 'standard' )) {
            do_shortcode(cb_featured_image_style($cb_featured_image_style, $post));
        }
        ?>

        <div class="cb-post-wrap cb-wrap-pad wrap clearfix<?php
        echo esc_attr(cb_get_post_sidebar_position($cb_post_id));
        echo esc_attr(cb_get_singular_fs($cb_post_id));
        ?>">

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                    <?php cb_schema_meta($post); ?>

                    <div class="cb-main clearfix">

                        <?php cb_breadcrumbs(); ?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>

                            <?php
                            if (( $cb_featured_image_style == 'off' ) || ( $cb_featured_image_style == 'standard' ) || ( $cb_featured_image_style_cache == 'standard' ) || ( $cb_featured_image_style_cache == 'off' )) {
                                cb_featured_image_style($cb_featured_image_style, $post);
                            };
                            ?>

                            <section class="cb-entry-content clearfix" <?php
                            if (( $cb_review_checkbox == 'on' ) || ( $cb_review_checkbox == '1' )) {
                                echo 'itemprop="reviewBody"';
                            } else {
                                echo 'itemprop="articleBody"';
                            }
                            ?>>

                                <?php the_content(); ?>
                                <?php wp_link_pages('before=<div class="cb-pagination clearfix">&after=</div>&next_or_number=number&pagelink=<span class="cb-page">%</span>'); ?>

                            </section> <!-- end article section -->

                            <footer class="cb-article-footer">

                                <?php
                                if (ot_get_option('cb_tags_onoff', 'on') != 'off') {
                                    the_tags('<p class="cb-tags cb-post-footer-block"> ', '', '</p>');
                                }
                                echo cb_sharing_block($post);
                                echo cb_post_footer_ad();
                                if ($post->post_type != 'attachment') {
                                    cb_previous_next_links();
                                }

                                $cb_authors = get_coauthors();
                                foreach ($cb_authors as $cb_author) {
                                    $author_id = $cb_author->ID;
                                    echo cb_about_author($post, $author_id);
                                }
                                ?>

                                <a href="http://www.politicalquarterly.org.uk/">
                                    <div class="visit-journal">
                                        <div class="site-icon-logo">
                                            <img src="<?php echo get_site_icon_url() ?>" >
                                        </div>
                                        <div class="cb-title cb-font-header">
                                            <p>Click here to read more articles from our online journal</p>
                                        </div>
                                    </div>
                                </a>

                                <?php
                                cb_related_posts();
                                comments_template();
                                ?>
                            </footer> <!-- end article footer -->

                        </article> <!-- end article -->						

                    </div> <!-- end .cb-main -->

                <?php endwhile; ?>

            <?php endif; ?>

            <?php
            if (( $cb_sidebar_position != 'nosidebar' ) && ( $cb_sidebar_position != 'nosidebar-fw' )) {
                get_sidebar();
            }
            ?>

        </div>

    </div>	

</div> <!-- end #cb-content -->
<?php cb_alp_ldr(); ?>

<?php get_footer(); ?>