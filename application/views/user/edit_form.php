<main>
    <div class="container-fluid">
        <ol>
            <!-- Daftar breadcrumb atau item lain jika diperlukan -->
        </ol>

        <div class="card mb-4">
            <div class="card-body">
                <form action="<?php echo site_url('user/edit') ?>" method="post">
                    <div class="mb-3">
                        <label for="username">USERNAME <code>*</code></label>
                        <input class="form-control" type="hidden" name="id" value="<?= $user->id; ?>" required />
                        <input class="form-control <?php echo form_error('username') ? 'is-invalid' : ''; ?>" type="text" name="username" value="<?= $user->username; ?>" placeholder="USERNAME" required />
                        <div class="invalid-feedback">
                            <?php echo form_error('username') ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="full_name">FULL NAME <code>*</code></label>
                        <input class="form-control" type="text" name="full_name" value="<?= $user->full_name; ?>" placeholder="FULL NAME" required />
                    </div>

                    <div class="mb-3">
                        <label for="phone">PHONE</label>
                        <input class="form-control" type="text" name="phone" value="<?= $user->phone; ?>" placeholder="PHONE" required />
                    </div>

                    <div class="mb-3">
                        <label for="email">EMAIL</label>
                        <input class="form-control" type="email" name="email" value="<?= $user->email; ?>" placeholder="EMAIL" required />
                    </div>

                    <div class="mb-3">
                        <label for="role">Role</label>
                        <select class="form-select" id="role" name="role" required>
                            <?php if ($user->role == 'owner') { ?>
                                <option value="owner" selected>OWNER</option>
                                <option value="manager">manager</option>
                                <option value="staff">STAFF</option>
                                <option value="kasir">KASIR</option>
                            <?php } else if ($user->role == 'maneger') { ?>
                                <option value="owner">OWNER</option>
                                <option value="manager"selected>manager</option>
                                <option value="staff">STAFF</option>
                                <option value="kasir">KASIR</option>
                            <?php } else if ($user->role == 'staff') { ?>
                                <option value="owner">OWNER</option>
                                <option value="manager">manager</option>
                                <option value="staff"selected>STAFF</option>
                                <option value="kasir">KASIR</option>
                            <?php } else { ?>
                                <option value="owner">OWNER</option>
                                <option value="manager">MANAGER</option>
                                <option value="staff">STAFF</option>
                                <option value="kasir"selected>KASIR</option>
                            <?php } ?>
                        </select>
                    </div>

                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-plus"></i> Save
                    </button>
                </form>
            </div>
        </div>

        <div style="height: 100vh"></div>
    </div>
</main>
