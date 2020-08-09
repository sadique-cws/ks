<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a href="" class="navbar-brand">Admin Panel</a>

<?php 
 if($this->session->userdata('admin')):?>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="<?= base_url('auth/admin_logout');?>" class="btn btn-sm btn-danger">Logout</a></li>
        </ul>
    <?php endif; ?>
    </div>
</nav>
