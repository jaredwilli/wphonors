	<div id="tabs">
		<ul>
			<li><a href="#site">Site</a></li>
			<li><a href="#plugin">Plugin</a></li>
			<li><a href="#theme">Theme</a></li>
			<li><a href="#person">Personality</a></li>
		</ul>
		
		<div id="site" class="default">
			<h3 class="nominate">Nominate A New Site</h3>
			<form id="new_site" name="new_post" method="post" action="<?php bloginfo('template_directory');?>/functions/post-process.php">
			
				<table border="0" cellpadding="5" cellspacing="0">
					<tr>
						<td><label for="title">Site:</label></td>
						<td><input type="text" name="title" id="title" size="30" value="" /></td>
					</tr>
					<tr>
						<td><label for="siteurl">Url:</label></td>
						<td><input value="http://" name="siteurl" id="siteurl" size="30" /></td>
					</tr>
					<tr>
						<td><label for="category">Category:</label></td>
						<td><?php wp_dropdown_categories( 'show_option_none=---&exclude=1,4,5,6,7,8,9,10,11,12,17,18,19,20,21&taxonomy=category&hide_empty=0' ); ?></td>
					</tr>
					<tr>
						<td><label for="tags">Tags:</label></td>
						<td><input type="text" name="tags" id="tags" value="" size="30" /></td>
					</tr>
					<tr>
						<td><label for="description">Description:</label></td>
						<td><textarea name="description" id="description" rows="4" cols="35" class="expand"></textarea></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="submit" id="submit" value="Submit Site" /></td>
					</tr>
				</table>

				<input type="hidden" name="post_type" id="post_type" value="site" />
				<input type="hidden" name="action" value="post" />
				<?php wp_nonce_field( 'new-post' ); ?>
			</form>
		</div>
		
		<div id="plugin">
			<h3 class="nominate">Nominate A New Plugin</h3>
			<form id="new_plugin" name="new_post" method="post" action="<?php bloginfo('template_directory');?>/functions/post-process.php ">

				<table border="0" cellpadding="5" cellspacing="0">
					<tr>
						<td><label for="title">Plugin:</label></td>
						<td><input type="text" name="title" id="title" size="30" value="" /></td>
					</tr>
					<tr>
						<td><label for="pluginurl">Url:</label></td>
						<td><input value="http://" name="pluginurl" id="pluginurl" size="30" class="url" /></td>
					</tr>
					<tr>
						<td><label for="category">Category:</label></td>
						<td><?php wp_dropdown_categories( 'show_option_none=---&exclude=1,4,5,6,7,8,11,12,13,14,15,16,17,18,19,20,21&taxonomy=category&hide_empty=0' ); ?></td>
					</tr>
					<tr>
						<td><label for="tags">Tags:</label></td>
						<td><input type="text" name="tags" id="tags" value="" size="30" /></td>
					</tr>
					<tr>
						<td><label for="description">Description:</label></td>
						<td><textarea name="description" id="description" rows="4" cols="35" class="expand"></textarea></td>
					</tr>
					<tr>
						<td></td>
						<td><input  type="submit" name="submit" id="submit" value="Submit Plugin" /></td>
					</tr>
				</table>

				<input type="hidden" name="post_type" id="post_type" value="plugin" />
				<input type="hidden" name="action" value="post" />
				<?php wp_nonce_field( 'new-post' ); ?>
			</form>
		</div>
	
		<div id="theme">
			<h3 class="nominate">Nominate A New Theme</h3>
			<form id="new_theme" name="new_post" method="post" action="<?php bloginfo('template_directory');?>/functions/post-process.php ">

				<table border="0" cellpadding="5" cellspacing="0">
					<tr>
						<td><label for="title">Theme:</label></td>
						<td><input type="text" name="title" id="title" size="30" value="" /></td>
					</tr>
					<tr>
						<td><label for="themeurl">Url:</label></td>
						<td><input name="themeurl" id="themeurl" size="30" value="http://" /></td>
					</tr>
					<tr>
						<td><label for="category">Category:</label></td>
						<td><?php wp_dropdown_categories( 'show_option_none=---&exclude=1,4,5,6,7,9,10,13,14,15,16,17,18,19,20,21&taxonomy=category&hide_empty=0' ); ?></td>
					</tr>
					<tr>
						<td><label for="tags">Tags:</label></td>
						<td><input type="text" name="tags" id="tags" value="" size="30" /></td>
					</tr>
					<tr>
						<td><label for="description">Description:</label></td>
						<td><textarea name="description" id="description" rows="4" cols="35" class="expand"></textarea></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="submit" id="submit" value="Submit Theme" /></td>
					</tr>
				</table>

				<input type="hidden" name="post_type" id="post_type" value="theme" />
				<input type="hidden" name="action" value="post" />
				<?php wp_nonce_field( 'new-post' ); ?>
			</form>
		</div>
		
		<div id="person">
			<h3 class="nominate">Nominate A New Person</h3>
			<form id="new_person" name="new_post" method="post" action="<?php bloginfo('template_directory');?>/functions/post-process.php ">

				<table border="0" cellpadding="5" cellspacing="0">
					<tr>
						<td><label for="title">Name:</label></td>
						<td><input type="text" name="title" id="title" size="30" value="" /></td>
					</tr>
					<tr>
						<td><label for="twitname">Twitter:</label>&nbsp;@&nbsp;</td>
						<td><input value="" name="twitname" id="twitname" size="30" /></td>
					</tr>
					<tr>
						<td><label for="personurl">Website:</label></td>
						<td><input value="http://" name="personurl" id="personurl" size="30" /></td>
					</tr>
					<tr>
						<td><label for="cat">Category:</label></td>
						<td><?php wp_dropdown_categories( 'show_option_none=---&exclude=1,4,5,6,7,8,9,10,11,12,13,14,15,16,21&taxonomy=category&hide_empty=0' ); ?></td>
					</tr>
					<tr>
						<td><label for="tags">Tags:</label></td>
						<td><input type="text" name="tags" id="tags" value="" size="30" /></td>
					</tr>
					<tr>
						<td valign="top"><label for="description">Description:</label></td>
						<td><textarea name="description" id="description" rows="4" cols="35" class="expand"></textarea></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="submit" class="submit" id="submit" value="Submit Person" /></td>
					</tr>
				</table>
		
				<input type="hidden" name="post_type" id="post_type" value="person" />
				<input type="hidden" name="action" value="post" />
				<?php wp_nonce_field( 'new-post' ); ?>
			</form>
		</div>
	</div>