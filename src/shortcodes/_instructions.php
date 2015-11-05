<div class="wrap">
    <div id="icon-options-general" class="icon32"><br></div>
    <h2>Available Shortcodes:</h2>
    <?php foreach($this->short_codes as $short_code=>$options) { ?>
    <p><strong style="font-size:16px;">[<?=$short_code?>]</strong> <?php if(count($options['args'])) { ?><br />
            <strong>available arguments: </strong><?=implode(", ", $options['args'])?><?php } ?></p>
    <?=$this->_shortcode_get_instructions($short_code)?>
    <?php } ?>
</div>