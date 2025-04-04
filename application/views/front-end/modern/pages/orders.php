<!-- breadcrumb -->
<div class="content-wrapper">
    <section class="wrapper bg-soft-grape">
        <div class="container py-3 py-md-5">
            <nav class="d-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 bg-transparent">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>" class="text-decoration-none"><?= !empty($this->lang->line('home')) ? $this->lang->line('home') : 'Home' ?></a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('my-account/profile') ?>" class="text-decoration-none"><?= !empty($this->lang->line('dashboard')) ? $this->lang->line('dashboard') : 'Dashboard' ?></a></li>
                    <?php if (isset($right_breadcrumb) && !empty($right_breadcrumb)) {
                        foreach ($right_breadcrumb as $row) {
                    ?>
                            <li class="breadcrumb-item"><?= $row ?></li>
                    <?php }
                    } ?>
                    <li class="breadcrumb-item active text-muted" aria-current="page"><?= !empty($this->lang->line('orders')) ? $this->lang->line('orders') : 'Orders' ?></li>
                </ol>
            </nav>
            <!-- /nav -->
        </div>
        <!-- /.container -->
    </section>
</div>
<!-- end breadcrumb -->

<!-- <section class="my-account-section">
    <div class="container mb-15">
        <div class="col-md-12 mt-12 mb-3">

        </div>
        <div class="row m5">
            <div class="col-md-4">
                <? //php $this->load->view('front-end/' . THEME . '/pages/my-account-sidebar') 
                ?>
            </div> -->
<section class="my-account-section">
    <div class="container mb-15">
        <div class="my-8">
            <?php $this->load->view('front-end/' . THEME . '/pages/dashboard') ?>
        </div>
        <div class="col-12">
            <div class="card-header bg-white">
                <h1 class="h4"><?= !empty($this->lang->line('orders')) ? $this->lang->line('orders') : 'Orders' ?></h1>
            </div>

            <?php if (!isset($orders['order_data']) && empty($orders['order_data']) || $orders['order_data'] == []) { ?>

                <div class="align-items-center d-flex flex-column">
                    <img src="<?= base_url('assets/front_end/modern/img/empty-orders.webp') ?>" alt="Empty Orders" class="w-23" />
                    <h1 class="h2 text-center"><?= !empty($this->lang->line('no_orders_found')) ? $this->lang->line('no_orders_found') : 'No Order placed Yet.' ?></h1>
                </div>
            <?php } ?>

            <hr class="mt-4 mb-4">
            <div class="card-body orders-section">
                <?php

                // echo "<pre>";
                // print_r($orders['order_data'][0]);
                foreach ($orders['order_data'] as $row) {
                    // print_r($row);
                ?>
                    <div class=" border-0">
                        <div class="card mb-2">
                            <div class="card-header bg-white p-2">
                                <div class="d-flex justify-content-between">
                                    <div class="d-sm-flex justify-content-between w-100">
                                        <p class="text-muted m-1"> <?= !empty($this->lang->line('order_id')) ? $this->lang->line('order_id') : 'Order ID' ?> <span class="font-weight-bold text-dark"> : <?= $row['id'] ?></span></p>
                                        <p class="text-muted m-1"> <?= !empty($this->lang->line('place_on')) ? $this->lang->line('place_on') : 'Place On' ?> <span class="font-weight-bold text-dark"> : <?= $row['date_added'] ?></span> </p>
                                        <!-- <?php if ($row['otp'] != 0) { ?>
                                                <p class="text-muted"> <?= !empty($this->lang->line('otp')) ? $this->lang->line('otp') : 'OTP' ?> <span class="font-weight-bold text-dark"> : <?= $row['otp'] ?></span> </p>
                                            <?php } ?> -->
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="card-body p-2">
                                <div class="media flex-row">
                                    <?php if (count($row['order_items']) == 1) { ?>
                                        <div class="img-mob">
                                            <img class="align-self-center img-fluid" src="<?= $row['order_items'][0]['image_sm'] ?>" width="180 " height="180" style="object-fit: cover;">
                                        </div>
                                    <?php } ?>
                                    <div class="media-body ms-3">
                                        <?php

                                        foreach ($row['order_items'] as $key => $item) {  ?>
                                            <h5 class="bold mt-1 mb-0"><?= ($key + 1) . '. ' . $item['name'] ?></h5>
                                            <?php
                                            if (!empty($item['variant_values'])) {
                                                $values = explode(', ', $item['variant_values']);
                                                $attributes = explode(', ', $item['attr_name']);
                                                // Initialize an empty string to store the final output
                                                $output = '';
                                                // Iterate through both arrays simultaneously
                                                foreach ($attributes as $key => $attribute) {
                                                    // Append the attribute name and corresponding value to the output string
                                                    $output .= '<p class="mb-0 text-dark">' . $attribute . ': ' . $values[$key] . '</p>';
                                                    // Add line break if it's not the last attribute
                                                    if ($key < count($attributes) - 1) {
                                                        $output .= ",";
                                                    }
                                                }

                                            ?>
                                                <div class="d-flex gap-2 mb-0 text-dark"><?= $output ?></div>
                                            <?php } ?>
                                            <p class="text-muted my-1"> <?= !empty($this->lang->line('quantity')) ? $this->lang->line('quantity') : 'Quantity' ?> : <?= $item['quantity'] ?></p>
                                            <div class="col-md-12 pl-0 product-rating-small" dir="ltr">
                                                <input id="input" name="rating" class="rating rating-loading d-none" data-size="xs" value="<?= $item['product_rating'] ?>" data-show-clear="false" data-show-caption="false" readonly>
                                            </div>
                                        <?php } ?>
                                        <?php if ($item['otp'] != 0) { ?>
                                            <p class="text-muted mb-0"> <?= !empty($this->lang->line('otp')) ? $this->lang->line('otp') : 'OTP' ?> <span class="font-weight-bold text-dark"> : <?= $item['otp'] ?></span> </p>
                                        <?php } ?>
                                        <h4 class=""> <span class="mt-5"><i><?= $settings['currency'] ?></i></span> <?= number_format($row['final_total'], 2) ?> <span class="small text-muted"> <?= !empty($this->lang->line('via')) ? $this->lang->line('via') : 'via' ?> (<?= $row['payment_method'] ?>) </span></h4>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="card-footer bg-white p-3">
                                <div class="d-flex align-items-center justify-content-end flex-wrap">
                                    
                                    <a href="<?= base_url('my-account/order-details/' . $row['id']) ?>" class='btn btn-outline-primary btn-sm m-1'><?= !empty($this->lang->line('view_details')) ? $this->lang->line('view_details') : 'View Details' ?></a>
                                        <!-- </h6> -->

                                        <?php
                                        $items = $row["order_items"];
                                        $variants = "";
                                        $qty = "";
                                        foreach ($items as $item) {
                                            if ($variants != "") {
                                                $variants .= ",";
                                                $qty .= ",";
                                            }
                                            $variants .= $item["product_variant_id"];
                                            $qty .= $item["quantity"];
                                        }

                                        ?>
                                        <button class="btn btn-outline-primary btn-sm reorder-btn m-1" data-variants="<?= $variants ?>" data-quantity="<?= $qty ?>"><?= !empty($this->lang->line('reorder')) ? $this->lang->line('reorder') : 'Reorder' ?></button>
                                    <?php
                                    $status = ["awaiting", "received", "processed", "shipped", "delivered", "cancelled", "returned"];
                                    $cancelable_till = $item['cancelable_till'];
                                    $active_status = $item['active_status'];
                                    $cancellable_index = array_search($cancelable_till, $status);
                                    $active_index = array_search($active_status, $status);
                                    if (!$item['is_already_cancelled'] && $item['is_cancelable'] && $active_index <= $cancellable_index && $row['type'] != 'digital_product') { ?>
                                       
                                        <a href="javascript:void(0)" class="btn btn-outline-primary btn-sm update-order block buttons m-1" data-status="cancelled" data-order-id="<?= $row['id'] ?>"><?= !empty($this->lang->line('cancel')) ? $this->lang->line('cancel') : 'Cancel' ?></a>
                                            
                                    <?php } ?>

                                    <?php
                                    $order_date = $row['order_items'][0]['status'][3][1];
                                    if ($row['is_returnable'] && !$row['is_already_returned'] && isset($order_date) && !empty($order_date)) { ?>
                                        <?php
                                        $settings = get_settings('system_settings', true);
                                        $timestemp = strtotime($order_date);
                                        $date = date('Y-m-d', $timestemp);
                                        $today = date('Y-m-d');
                                        $return_till = date('Y-m-d', strtotime($order_date . ' + ' . $settings['max_product_return_days'] . ' days'));
                                        echo "<br>";
                                        if ($today < $return_till && $row['type'] != 'digital_product') { ?>
                                            
                                                <a class="update-order block buttons btn-sm btn btn-outline-primary btn-6-3 m-1" data-status="returned" data-order-id="<?= $row['id'] ?>"><?= !empty($this->lang->line('return')) ? $this->lang->line('return') : 'Return' ?></a>
                                           
                                        <?php } ?>
                                    <?php } ?>
                                    <?php if ($row['payment_method'] == 'Bank Transfer') { ?>
                                        
                                        <a class="block buttons btn-sm btn btn-outline-primary m-1" href="<?= base_url('my-account/order-details/' . $row['id']) ?>"> <?= !empty($this->lang->line('send_bank_payment_receipt')) ? $this->lang->line('send_bank_payment_receipt') : 'Send Bank Payment Receipt' ?></i>
                                                    <!-- <input type="file"  name="receipt" class="form-control"/>  -->
                                        </a>
                                            
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="text-center">
                    <?= $links ?>
                </div>
            </div>
            <!-- </div> -->
        </div>
    </div>
</section>

<!-- </div>
    </div>
</section> -->