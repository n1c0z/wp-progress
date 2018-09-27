<?php
/* Template Name: 15Zine Homepage */

//get_header renders the header + navigation menu on the website. Please do not remove
get_header();
global $post;
$cb_page_id = get_the_ID();
$cb_breadcrumbs = ot_get_option('cb_breadcrumbs', 'on');
$cb_page_comments = get_post_meta($cb_page_id, 'cb_page_comments', true);
$cb_featured_image_style = get_post_meta($cb_page_id, 'cb_featured_image_style', true);
$cb_sidebar = get_post_meta($cb_page_id, 'cb_full_width_post', true);
$cb_page_title = get_post_meta($cb_page_id, 'cb_page_title', true);
$cb_title_header = $cb_no_sidebar = $cb_slider_class = NULL;
$cb_flag = false;
?>


<?php
/* Slider of Grid of 3 */
$i = 1;
if (!isset($cb_amount)) {
    $cb_amount = 9;
}
if ($cb_amount > 3) {
    $cb_slider_class = ' cb-slider-grid-3';
}
//To change the number of posts displayed in the "latest" articles grid change the value that 'posts per page' below point to
$cb_qry_latest = new WP_Query(array('posts_per_page' => 9, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true, 'order' => 'DESC'));
?>

<!--SECTION LATEST - Show the 9 latest posts--> 
<section id="cb-section-a" class="cb-site-padding wrap cb-hp-section clearfix"> 
    <div class="cb-module-header">
        <!--        Number inside the_permalink is the page-id number of the page where all latest posts are isplayed-->
        <a href="<?php the_permalink(93) ?>"><h2 class="cb-module-title">Latest</h2></a>
    </div>

    <?php
    if ($cb_qry_latest->have_posts()) : while ($cb_qry_latest->have_posts()) : $cb_qry_latest->the_post();

            $cb_post_id = $post->ID;
            $cb_title_header = '<div class="cb-module-header"><h2 class="cb-module-title" >Latest</h2></div>';
            $cb_feature_width = '378';
            $cb_feature_height = '300';
            $cb_feature_tile_size = 'cb-s';

            if ($i == 1) {
                $cb_feature_width = '759';
                $cb_feature_height = '600';
                $cb_feature_tile_size = 'cb-l';
            }
            if (( $i == 1 ) && ( $cb_flag == false )) {
                echo '<div class="cb-grid-block cb-module-block cb-s-5 clearfix"><div class="cb-grid-x cb-grid-3 cb-arrows-tr  cb-relative clearfix' . $cb_slider_class . '"><ul class="slides cb-full-height clearfix cb-no-margin">';
            }
            if ($i == 1) {
                echo '<li class="cb-full-height clearfix cb-no-margin"><ul class="cb-full-height clearfix cb-no-margin">';
            }
            ?>

            <li class="cb-grid-feature cb-feature-<?php echo esc_attr($i) . ' ' . esc_attr($cb_feature_tile_size) . ' ' . ot_get_option("cb_grid_tile_design", "cb-meta-style-4"); ?>">
                <div class="cb-grid-img">
                    <?php cb_thumbnail($cb_feature_width, $cb_feature_height); ?>
                </div>
                <div class="cb-article-meta">
                    <h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
                    <?php cb_byline($cb_post_id); ?>
                </div>
                <a href="<?php the_permalink() ?>" class="cb-link"></a>
            </li>

            <?php
            $i++;
            $cb_flag = true;
            if ($i == 4) {
                echo '</ul>';
                $i = 1;
            }
        endwhile;
    endif;
    echo '</ul></div></div>';
    wp_reset_postdata();  // Restore global post data
    ?>

</section>

<!--bridge section of the relevant post tags--> 
<section style="padding-top:0" id="cb-section-a" class="cb-site-padding wrap cb-hp-section clearfix"> 
    <div class="cb-grid-block cb-module-block cb-s-5 clearfix">

        <div class="cb-byline">
            <!--Change the line below for the text to be shown above the button tags of the homepage-->
            <h5>Browse articles by topic</h5>
        </div>    

        <div class="cb-meta clearfixr">
            <!--Activate or dactivate tags by commenting out or uncommenting the relevant line of code.-->   
            <!--<a href="<?php // echo get_tag_link(get_term_by('name', 'Brexit', 'post_tag')   ?> "<button class="btn-category">Brexit</button></a>-->
            <a href="<?php echo get_tag_link(get_term_by('name', 'Europe', 'post_tag')->term_id) ?> "<button class="btn-category">Europe</button></a>  
            <a href="<?php echo get_tag_link(get_term_by('name', 'Economy', 'post_tag')->term_id) ?> "<button class="btn-category">Economy</button></a>  
            <a href="<?php echo get_tag_link(get_term_by('name', 'Elections', 'post_tag')->term_id) ?> "<button class="btn-category">Elections</button></a>  
            <a href="<?php echo get_tag_link(get_term_by('name', 'Law and Justice', 'post_tag')->term_id) ?> "<button class="btn-category">Law & justice</button></a>  
            <!--<a href="<?php // echo get_tag_link(get_term_by('name', 'Devolution', 'post_tag')->term_id)   ?> "<button class="btn-category">Devolution</button></a>-->  
            <a href="<?php echo get_tag_link(get_term_by('name', 'Welfare', 'post_tag')->term_id) ?> "<button class="btn-category">Welfare & Inequality</button></a>  
            <!--<a href="<?php // echo get_tag_link(get_term_by('name', 'Feminism', 'post_tag')->term_id)   ?> "<button class="btn-category">Feminism</button></a>-->
            <!--<a href="<?php // echo get_tag_link(get_term_by('name', 'Environment', 'post_tag')->term_id)   ?> "<button class="btn-category">Environment</button></a>-->  
            <a href="<?php echo get_tag_link(get_term_by('name', 'Media and culture', 'post_tag')->term_id) ?> "<button class="btn-category">Media & Culture</button></a>  
            <!--<a href="<?php // echo get_tag_link(get_term_by('name', 'Education', 'post_tag')->term_id)   ?> "<button class="btn-category">Education</button></a>--> 
            <!--<a href="<?php // echo get_tag_link(get_term_by('name', 'Scotland', 'post_tag')->term_id)   ?> "<button class="btn-category">Scotland</button></a>-->  
            <!--<a href="<?php // echo get_tag_link(get_term_by('name', 'Wales', 'post_tag')->term_id)   ?> "<button class="btn-category">Wales</button></a>-->  
            <!--<a href="<?php // echo get_tag_link(get_term_by('name', 'Northern Ireland', 'post_tag')->term_id)   ?> "<button class="btn-category">Northern Ireland</button></a>-->
        </div>
    </div>
</section>

<!--SECTION UK POLITICS - Show 2 the latest posts in this category--> 
<section id="cb-section-b" class="cb-site-padding wrap cb-hp-section clearfix">
    <div class="cb-main"> 

        <div class="cb-module-a cb-module-block  clearfix">
            <div class="cb-module-header">
                <a href="<?php echo get_category_link(get_cat_ID('UK Politics')) ?>"><h2 class="cb-module-title">UK Politics </h2></a>
            </div>      

            <?php
            /* Blog Style A */
            $cb_count_uk = 1;
            //To change the number of posts displayed in this category, change the value that 'posts per page' below points to
            $cb_qry_uk = new WP_Query(array('posts_per_page' => 2, 'category_name' => 'UK Politics'));

            if ($cb_qry_uk->have_posts()) : while ($cb_qry_uk->have_posts()) : $cb_qry_uk->the_post();
                    $cb_post_id = $post->ID;
                    ?>  

                    <article id="post-<?php the_ID(); ?>" <?php post_class("cb-blog-style-b cb-bs-c cb-module-a cb-article cb-article-row-3 cb-article-row cb-img-above-meta clearfix cb-no-$cb_count_uk"); ?>>
                        <div class="cb-mask cb-img-fw" <?php cb_img_bg_color($cb_post_id); ?>>
                            <?php cb_thumbnail('360', '240'); ?>
                            <?php cb_review_ext_box($cb_post_id); ?>
                        </div>
                        <div class="cb-meta">
                            <h2 class="cb-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <?php cb_byline($cb_post_id); ?>
                            <?php cb_post_meta($cb_post_id); ?>
                        </div>
                    </article>

                    <?php
                    $cb_count_uk++;
                endwhile;
            endif;
            wp_reset_postdata();
            ?>

        </div>
        <!--SECTION INTERNATIONAL - Show the 2 latest posts in this category--> 
        <div class="cb-module-a cb-module-block  clearfix">
            <div class="cb-module-header">
                <a href="<?php echo get_category_link(get_cat_ID('International politics')) ?>"><h2 class="cb-module-title">International </h2></a>
            </div>      

            <?php
            /* Blog Style B */
            $cb_count_ip = 1;
            //To change the number of posts displayed in this category, change the value that 'posts per page' below points to
            $cb_qry_ip = new WP_Query(array('posts_per_page' => 2, 'category_name' => 'International politics'));

            if ($cb_qry_ip->have_posts()) : while ($cb_qry_ip->have_posts()) : $cb_qry_ip->the_post();

                    $cb_post_id = $post->ID;
                    ?>  

                    <article id="post-<?php the_ID(); ?>" <?php post_class("cb-blog-style-b cb-bs-c cb-module-a cb-article cb-article-row-3 cb-article-row cb-img-above-meta clearfix cb-no-$cb_count_uk"); ?>>
                        <div class="cb-mask cb-img-fw" <?php cb_img_bg_color($cb_post_id); ?>>
                            <?php cb_thumbnail('360', '240'); ?>
                            <?php cb_review_ext_box($cb_post_id); ?>
                        </div>
                        <div class="cb-meta">
                            <h2 class="cb-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <?php cb_byline($cb_post_id); ?>
                            <?php cb_post_meta($cb_post_id); ?>
                        </div>
                    </article>

                    <?php
                    $cb_count_ip++;
                endwhile;
            endif;
            wp_reset_postdata();
            ?>
        </div>
    </div>

    <!--DISPLAY SIDEBAR next to UK POLITICS AND INTERNATIONAL --> 
    <?php
    $cb_sidebar_select = get_post_meta($cb_page_id, 'cb_sidebar_select', true);
    $cb_sidebar_id = $cb_sidebar_select;
    if (is_active_sidebar($cb_sidebar_id) == true) {
        echo '<aside class="cb-sidebar clearfix">';
        dynamic_sidebar($cb_sidebar_id);
        echo '</aside>';
    }
    ?>
</section>        

<!--SECTION LONG READS - Show the 3 latest posts in this category--> 
<section id="cb-section-a" class="cb-site-padding wrap cb-hp-section clearfix"> 
    <div class="cb-grid-block cb-module-block cb-s-5 clearfix">
        <div class="cb-module-header">
            <a href="<?php echo get_category_link(get_cat_ID('Long reads')) ?>"><h2 class="cb-module-title">Long Reads</h2></a>
        </div>

        <?php
        /* Blog Style A */
        //To change the number of posts displayed in this category, change the value that 'posts per page' below points to
        $cb_qry_lr = new WP_Query(array('posts_per_page' => 3, 'category_name' => 'Long reads'));
        $cb_count_lr = 1;

        if ($cb_qry_lr->have_posts()) : while ($cb_qry_lr->have_posts()) : $cb_qry_lr->the_post();
                $cb_post_id = $post->ID;
                ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class('cb-blog-style-a cb-module-e cb-separated clearfix'); ?>>
                    <div class="cb-mask cb-img-fw" <?php cb_img_bg_color($cb_post_id); ?>>
                        <?php cb_thumbnail('260', '170'); ?>
                        <?php cb_review_ext_box($cb_post_id); ?>
                    </div>
                    <div class="cb-meta clearfix">
                        <h2 class="cb-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <?php cb_byline($cb_post_id); ?>
                        <div class="cb-excerpt"><?php echo cb_clean_excerpt(160); ?></div>
                        <?php cb_post_meta($cb_post_id); ?>
                    </div>
                </article>

                <?php
                $cb_count_lr++;
            endwhile;
        endif;
        wp_reset_postdata();
        ?>
    </div>
</section>

<!--SECTION INTERVIEWS - Show the 2 latest posts in this category--> 
<section id="cb-section-a" class="cb-site-padding wrap cb-hp-section clearfix"> 
    <div class="cb-grid-block cb-module-block cb-s-5 clearfix">
        <div class="cb-module-header">
            <a href="<?php echo get_category_link(get_cat_ID('Interviews')) ?>"><h2 class="cb-module-title">Interviews</h2></a>
        </div>
        <?php
        /* Blog Style J */
        //To change the number of posts displayed in this category, change the value that 'posts per page' below points to
        $cb_qry_int = new WP_Query(array('posts_per_page' => 2, 'category_name' => 'Interviews'));
        $cb_count_int = 1;

        if ($cb_qry_int->have_posts()) : while ($cb_qry_int->have_posts()) : $cb_qry_int->the_post();

                $cb_post_id = $post->ID;
                if ($cb_count_int == 4) {
                    $cb_count_int = 1;
                }
                ?>  

                <article id="post-<?php the_ID(); ?>" <?php post_class("cb-blog-style-k cb-article-big cb-article-review cb-article cb-meta-style-2 cb-article-row cb-no-$cb_count_int clearfix cb-article-row-3"); ?>>
                    <div class="cb-mask cb-img-fw">
                        <?php cb_thumbnail(759, 500, $cb_post_id); ?> 
                        <?php echo cb_get_review_ext_box($cb_post_id, false); ?>
                    </div>
                    <div class="cb-meta cb-article-meta">
                        <h2 class="cb-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <?php echo cb_get_byline_date($cb_post_id); ?>            
                    </div>

                </article>

                <?php
                $cb_count_int++;
            endwhile;
        endif;
        wp_reset_postdata();
        ?> 

    </div>
</section>

<!--SECTION BOOKS - Show 3 of the latest books--> 
<section id="cb-section-a" class="cb-site-padding wrap cb-hp-section clearfix"> 
    <div class="cb-grid-block cb-module-block cb-s-5 clearfix">
        <div class="cb-module-header">
            <a href="<?php echo get_category_link(get_cat_ID('Books')) ?>"><h2 class="cb-module-title">Books</h2></a>
        </div>
        <?php
        /* Blog Style J */
        //To change the number of posts displayed in this category, change the value that 'posts per page' below points to
        $cb_qry_b = new WP_Query(array('posts_per_page' => 3, 'category_name' => 'Books'));
        $cb_count_b = 1;

        if ($cb_qry_b->have_posts()) : while ($cb_qry_b->have_posts()) : $cb_qry_b->the_post();

                $cb_post_id = $post->ID;
                if ($cb_count_b == 4) {
                    $cb_count_b = 1;
                }
                ?>  

                <article id="post-<?php the_ID(); ?>" <?php post_class("cb-blog-style-j cb-article-big cb-article-review cb-article cb-meta-style-2 cb-article-row cb-no-$cb_count_b clearfix cb-article-row-3"); ?>>
                    <div class="cb-mask cb-img-fw">
                        <?php cb_thumbnail(360, 490, $cb_post_id); ?> 
                        <?php echo cb_get_review_ext_box($cb_post_id, false); ?>
                    </div>
                    <div class="cb-meta cb-article-meta">
                        <h2 class="cb-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <?php echo cb_get_byline_date($cb_post_id); ?>            
                    </div>
                </article>

                <?php
                $cb_count_b++;
            endwhile;
        endif;
        wp_reset_postdata();
        ?> 

    </div>
</section>

<!--SECTION EVENTS - Show the next event--> 
<section id="cb-section-a" class="cb-site-padding wrap cb-hp-section clearfix"> 
    <div class="cb-grid-block cb-module-block cb-s-5 clearfix">
        <div class="cb-module-header">
            <a href="<?php the_permalink(1327) ?>"><h2 class="cb-module-title">Events</h2></a>
        </div>
        <?php
        if (class_exists('EM_Events')) {
            //To change the number of events displayed in the homepage, change the value that 'limit' points to
            echo EM_Events::output(array('limit' => 1));
        }
        ?>        
    </div>
</section>

<!--get_footer() renders the footer + nwidgets on the website. Please do not remove-->
<?php get_footer(); ?>