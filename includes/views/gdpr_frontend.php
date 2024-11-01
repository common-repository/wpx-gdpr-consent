<div class="wgc_wrapper wgc_<?php echo esc_attr($theme_display); ?>" id='wgc_gdpr_block'>
    <div class="wgc_content_body">
        <div class="wgc_message">
			<?php echo wp_kses_post($cokie_msg); ?>
			<?php if ( ! empty( $privacy_page ) && ! empty( $privacy_text ) ): ?>
                <a class="wgc_more_link" href="<?php echo esc_url( get_page_link( $privacy_page ) ); ?>" target='_blank'>
					<?php echo esc_html($privacy_text); ?>
                </a>
			<?php endif; ?>
        </div>
        <div class="wgc_actions"> 
            <div class='wgc_button gdpr-acpt-btn'>
				<?php echo esc_html( $cokie_btn ); ?>
            </div>
        </div>
    </div>
</div>