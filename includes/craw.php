<div class="wp-craw">
	<div class="field-craw">
		<form method="post" action="" class="form-craw">
			<div class="left">
				<div class="loading">
					<img src="<?php echo OT_URL.'assets/images/loading.gif' ?>" alt="">
				</div>
				<div class="field_item" title="Limit per page">
					<label><?php esc_html_e( 'Per page', 'ot' ) ?></label>
					<input type="number" name="field_per_page" class="field_per_page" placeholder="2" />
				</div>
				<div class="field_item">
					<label><?php esc_html_e( 'Website', 'ot' ) ?></label>
					<input type="url" name="field_url1" class="field_url1" placeholder="http://www.yourtheme/blog" required="required" />
				</div>
				<div class="field_item">
					<label><?php esc_html_e( 'Param', 'ot' ) ?></label>
					<input type="text" name="field_pr" class="field_pr" placeholder="?page=" required="required" />
					<p>EX: http://www.yourtheme/blog<strong style="color:red">?page=</strong> or http://www.yourtheme/blog<strong style="color:red">/page/</strong></p>
				</div>
				<div class="field_item">
					<label><?php esc_html_e( 'Item', 'ot' ) ?></label>
					<input type="text" name="field_item1" class="field_item1" placeholder="" required="required" />
				</div>
				<div class="field_item">
					<label><?php esc_html_e( 'Not Item', 'ot' ) ?></label>
					<input type="text" name="field_not_item" class="field_not_item" placeholder="" />
				</div>
				<div class="field_item">
					<label><?php esc_html_e( 'To link', 'ot' ) ?></label>
					<input type="text" name="field_perlink" class="field_perlink" placeholder="class" required="required"/>
				</div>
				<div class="field_item">
					<label><?php esc_html_e( 'Title', 'ot' ) ?></label>
					<input type="text" name="field_title" class="field_title" placeholder="" required="required"/>
				</div>
				<div class="field_item">
					<label><?php esc_html_e( 'Image', 'ot' ) ?></label>
					<input type="text" name="field_image" class="field_image" placeholder="" />
				</div>
				<div class="field_item">
					<label><?php esc_html_e( 'Content', 'ot' ) ?></label>
					<input type="text" name="field_content" class="field_content" placeholder="" />
				</div>
				<div class="btn-save">
					<button type="submit" class="btn-craw"><?php esc_html_e( 'Start', 'ot' ) ?></button>
				</div>
			</div>
			<div class="right">
				<h2><?php esc_html_e( 'Total: ', 'ot' ) ?> <span class="count">0</span></h2>
				<div class="demo"></div>
				<div id="mess"></div>
			</div>
		</form>
		<a href="javascript:;" class="stop">Stop</a>
		<!-- show content -->
	</div>
</div>