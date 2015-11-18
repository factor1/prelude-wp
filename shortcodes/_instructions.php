<div class="wrap">
    <div id="icon-options-general" class="icon32"><br></div>

    <h2>Available Shortcodes:</h2>

    <?php foreach( $this->short_codes as $short_code=>$options ) : ?>
        <p>
            <strong style="font-size:16px;">[<?php echo $short_code; ?>]</strong>
            <?php if( count( $options['args'] ) ) : ?><br />
                <strong>available arguments: </strong><?php echo implode( ", ", $options['args'] ); ?>
            <?php endif; ?>
        </p>
        <?php echo $this->_shortcode_get_instructions( $short_code ); ?>
    <?php endforeach; ?>
</div>
