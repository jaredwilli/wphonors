<?php get_template_part( 'branding' ); ?>
<?php
session_name("fancyform");
session_start();

$_SESSION['n1'] = rand(1, 10);
$_SESSION['n2'] = rand(1, 10);
$_SESSION['expect'] = $_SESSION['n1'] + $_SESSION['n2'];

$str = '';
if($_SESSION['errStr']) {
    $str = '<div class="error">'.$_SESSION['errStr'].'</div>';
    unset($_SESSION['errStr']);
}

$success = '';
if($_SESSION['sent']) {
    $success = '<h3>Thank you!</h3>';
    $css = '<style type="text/css">#contact-form{display:none;}</style>';
    
    unset($_SESSION['sent']);
}
// End PHP Mail process
?>

<div id="content" class="inner clearfix">
    <div id="content-main">

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <div id="page-<?php the_ID(); ?>" class="page clearfix">
                <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="entry">

                    <?php the_content( __( '(More ...)' )); ?>

                    <div id="">
                        <form id="contact-form" name="contact-form" method="post" action="<?php bloginfo('template_directory');?>/functions/contactsubmit.php">
                            <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                <tr>
                                  <td width="22%" align="right" valign="top"><label for="message">Message</label></td>
                                  <td width="24%" valign="top"><textarea name="message" id="message" class="validate[required]" cols="45" rows="8"><?=$_SESSION['post']['message']?></textarea></td>
                                    <td valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td width="22%" align="right" valign="top"><label for="name">Name</label></td>
                                  <td width="24%" valign="top"><input name="name" type="text" class="validate[required,custom[onlyLetter]]" id="name" value="<?=$_SESSION['post']['name']?>" size="50" /></td>
                                    <td width="54%" id="errOffset">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td width="22%" align="right" valign="top"><label for="email">Email</label></td>
                                  <td width="24%" valign="top"><input name="email" type="text" class="validate[required,custom[email]]" id="email" value="<?=$_SESSION['post']['email']?>" size="50" /></td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td width="22%" align="right" valign="top"><label for="subject">Subject</label></td>
                                    <td width="24%" valign="top"><select name="subject" id="subject">
                                    <option value="" selected="selected"> - Choose -</option>
                                    <option value="Question">Question</option>
                                    <option value="Business proposal">Business proposal</option>
                                    <option value="Advertisement">Advertising</option>
                                    <option value="Complaint">Complaint</option>
                                  </select></td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td width="22%" align="right" valign="top"><label for="captcha"><?=$_SESSION['n1']?> + <?=$_SESSION['n2']?>&nbsp;=&nbsp;</label></td>
                                  <td width="24%" valign="top"><input type="text" class="validate[required,custom[onlyNumber]]" name="captcha" id="captcha" /></td>
                                    <td valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td width="22%" valign="top">&nbsp;</td>
                                  <td valign="top"><input type="submit" name="button" id="button" value="Submit" />
                                    <!--<input type="reset" name="button2" id="button2" value="Reset" />-->                                
                                <?=$str?>
                                <img src="<?php bloginfo('template_directory');?>/images/loadng.gif" alt="" name="loading" id="loading" /></td>
                                <td>&nbsp;</td>
                                </tr>
                          </table>
                        </form>
                        <?=$success?> 
                        <?=$css?>
                    </div>
  
                  </div>
            </div>

    <?php endwhile; ?>

        <?php if( function_exists( 'wp_pagenavi' )) { wp_pagenavi(); } else { ?>
        <div class="navigation clearfix">
            <div class="alignleft"><?php next_posts_link('&laquo; Previous Entries'); ?></div>
            <div class="alignright"><?php previous_posts_link('Next Entries &raquo;'); ?></div>
        </div>
        <?php } ?>

    <?php else : ?>
        <h2 class="title">Not Found</h2>
        <p>There is nothing posted here.</p>
    <?php endif; ?>
    
    </div><!-- end #content-main -->
    <div id="content-sub">
        <?php get_sidebar(); ?>
    </div> <!-- end #content-sub -->

</div><!-- end #content -->
<?php get_footer(); ?>