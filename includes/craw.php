<div class="wp-craw">
	<div class="field-craw">
		<form method="post" action="" class="form-craw">
			<div class="left">
				<div class="loading">
					<img src="<?php echo OT_URL.'assets/images/loading.gif' ?>" alt="">
				</div>
				<div class="field_item">
					<label><?php esc_html_e( 'Per page', 'ot' ) ?></label>
					<input type="number" name="field_per_page" class="field_per_page" placeholder="2" />
					<p>Limit per page</p>
				</div>
				<div class="field_ite">
					<label><?php esc_html_e( 'Website', 'ot' ) ?></label>
					<input type="url" name="field_url1" class="field_url1" placeholder="URL" value="" />
					<p>EX: http://www.yourtheme/blog</p>
				</div>
				<div class="field_item">
					<label><?php esc_html_e( 'Item', 'ot' ) ?></label>
					<input type="text" name="field_item1" class="field_item1" placeholder="class" value="" />
					<p>Get class item</p>
				</div>
				<div class="field_item">
					<label><?php esc_html_e( 'Not Item', 'ot' ) ?></label>
					<input type="text" name="field_not_item" class="field_not_item" placeholder="class" value="" />
				</div>
				<div class="field_item">
					<label><?php esc_html_e( 'To link', 'ot' ) ?></label>
					<input type="text" name="field_perlink" class="field_perlink" placeholder="class" value="" />
					<p>Get class item to per link</p>
				</div>
				<div class="field_item">
					<label><?php esc_html_e( 'Title', 'ot' ) ?></label>
					<input type="text" name="field_title" class="field_title" placeholder="class title" value="" />
					<p>Get title in single page</p>
				</div>
				<div class="field_ite">
					<label><?php esc_html_e( 'Image', 'ot' ) ?></label>
					<input type="text" name="field_image" class="field_image" placeholder="class image" />
					<p>Get image in single page</p>
				</div>
				<div class="field_item">
					<label><?php esc_html_e( 'Content', 'ot' ) ?></label>
					<input type="text" name="field_content" class="field_content" placeholder="class content" />
					<p>Get content in single page</p>
				</div>
				<div class="btn-save">
					<button type="submit" class="btn-craw"><?php esc_html_e( 'Craw', 'ot' ) ?></button>
				</div>
			</div>
			<div class="right">
				<div id="mess"></div>
			</div>
		</form>
		<!-- show content -->
	</div>
</div>