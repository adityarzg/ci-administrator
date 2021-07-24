<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <!-- <div class="col-lg-6 d-none d-lg-block"></div> -->
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900">Change your password for</h1>
                                    <h6 class="mb-4"><?= $this->session->userdata('reset_email'); ?></h6>
                                    <?php
                                    $email = $this->input->get('email');
                                    $token = $this->input->get('token');
                                    $cek = $this->db->get_where('user_token', ['email' => $this->session->userdata('reset_email')])->row_array();
                                    if ($this->session->userdata('reset_email') != $cek['email']) {
                                        redirect('auth/ilegalReset/' . urlencode($token));
                                    }
                                    ?>
                                </div>
                                <?= $this->session->flashdata('message'); ?>
                                <form class="user" method="post" action="<?= base_url('auth/changePassword'); ?>">
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="new_password" placeholder="New Password..." name="new_password">
                                        <?= form_error('new_password', '<small class="text-danger pl-3">', '</small>') ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="repeatnew_password" placeholder="Repeat Password..." name="repeatnew_password">
                                        <?= form_error('repeatnew_password', '<small class="text-danger pl-3">', '</small>') ?>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Change Password
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>