<?php if($this->sh5_tag == 'start'): ?>
    <<?php echo $this->sh5_type; ?> class="<?php echo $this->class; ?> block"<?php echo $this->cssID; ?><?php if ($this->style): ?> style="<?php echo $this->style; ?>"<?php endif; ?>>
    <?php if ($this->headline): ?>
        <<?php echo $this->hl; ?>><?php echo $this->headline; ?></<?php echo $this->hl; ?>>
    <?php endif; ?>
<?php else: ?>
    </<?php echo $this->sh5_type; ?>>
<?php endif; ?>