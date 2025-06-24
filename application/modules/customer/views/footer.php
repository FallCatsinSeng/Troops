<?php if ($this->uri->segment(1) !== 'customer') : ?>
<footer class="main-footer">
    <strong>Copyright &copy; 2022 <?php echo anchor(base_url(), get_store_name()); ?>.</strong>
</footer>
<?php endif; ?>
