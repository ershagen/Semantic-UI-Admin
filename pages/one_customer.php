<h2>Customers</h2>
<div class="ui segment">
    <div class="ui breadcrumb">
        <a href="#" class="section tab-item">Hem</a>
        <i class="right chevron icon divider"></i>
        <a data-tab="customers" class="section tab-itemer">Customers</a>
        <i class="right chevron icon divider"></i>
        <a class="active section">Customer name</a>
    </div>
</div>
<div class="ui segment">
    <h3 style="float:left;">List</h3>
    <script>
        $(function () {
            $('.overviews.menu .item')
                .tab()
            ;
        });
    </script>
    <div class="ui overviews secondary pointing menu" style=" margin: 0; border-width: 0px; float: right;">
        <a class="item active" data-tab="latest">Alla</a>
        <a class="item grey" data-tab="processing">Mottagen</a>
        <a class="item yellow" data-tab="processed">Bearbetas</a>
        <a class="item red" data-tab="denied">Nekades</a>
        <a class="item green" data-tab="finish">Klar</a>
        <a class="item green" data-tab="finpaid">Klar/betald</a>
    </div>
    <div style="clear: both; margin-bottom: -13px;"></div>
    <div class="ui divider"></div>
    <div class="ui tab active" data-tab="latest"> <!-- senaste -->
        <table class="ui table orders-customers-table" style="border-radius: 0px;" cellspacing="0"
               id="orders-customers-table">
            <thead>
            <tr>
                <th>Order.nr</th>
                <th>Produkt</th>
                <th>Datum</th>
                <th>IMEI</th>
                <th>Modell</th>
                <th>Pris</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <?php echo $ord['order_id']; ?>
                </td>
                <td>
                    <?php if (!empty($productids)) {
                        foreach ($productids as $produs) {
                            echo $produs['carrier'] . " " . $produs['mobile'];
                        }
                    } ?>
                </td>
                <td>
                    <?php echo $ord['date']; ?>
                </td>
                <td>
                    <?php echo $ord['imei_number']; ?>
                </td>
                <td>
                    <?php echo $ord['model']; ?>
                </td>
                <td>
                    <?php echo $ord['price']; ?>
                </td>
                <td>
                    <script>
                        $(function () {
                            $('#customer_status<?php echo $ord['order_id']; ?>').change(function () {
                                var option = $(this).find('option:selected').val();
                                var id = "<?php echo $ord['order_id']; ?>";
                                var customer_id = "<?php echo $customer_id; ?>";
                                var dataString = 'id=' + id + '&option=' + option + '&customer_id=' + customer_id;

                                $.ajax({
                                    type: "POST",
                                    url: "http://valfrimobil.se/admin/update_customerorder_status_2.php",
                                    data: dataString,
                                    cache: false,
                                    success: function (html) {
                                    }
                                });


                            });

                        });
                    </script>
                    <select name="customer_status" class="ui compact dropdown"
                            id="customer_status<?php echo $ord['order_id']; ?>">
                        <option value="1" <?php if ($ord['status'] == '1') echo "selected" ?>>Mottagen</option>
                        <option value="2" <?php if ($ord['status'] == '2') echo "selected" ?>>Bearbetas</option>
                        <option value="3" <?php if ($ord['status'] == '3') echo "selected" ?>>Nekades</option>

                        <option value="4" <?php if ($ord['status'] == '4') echo "selected" ?>>Klar</option>
                        <option value="5" <?php if ($ord['status'] == '5') echo "selected" ?>>Klar/Betald
                        </option>


                    </select>
                </td>
            </tr>
            </tbody>
        </table>


    </div>
    <div class="ui tab" data-tab="processing"> <!-- behandlas -->
        <table class="ui table orders-customers-table" style="border-radius: 0px;" cellspacing="0"
               id="orders-customers-table">
            <thead>
            <tr>
                <th>Order.nr</th>
                <th>Produkt</th>
                <th>Datum</th>
                <th>IMEI</th>
                <th>Modell</th>
                <th>Pris</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <?php echo $ord['order_id']; ?>
                </td>
                <td>
                    <?php if (!empty($productids)) {
                        foreach ($productids as $produs) {
                            echo $produs['carrier'] . " " . $produs['mobile'];
                        }
                    } ?>
                </td>
                <td>
                    <?php echo $ord['date']; ?>
                </td>
                <td>
                    <?php echo $ord['imei_number']; ?>
                </td>
                <td>
                    <?php echo $ord['model']; ?>
                </td>
                <td>
                    <?php echo $ord['price']; ?>
                </td>
                <td>
                    <script>
                        $(function () {
                            $('#customer_status<?php echo $ord['order_id']; ?>').change(function () {
                                var option = $(this).find('option:selected').val();
                                var id = "<?php echo $ord['order_id']; ?>";
                                var customer_id = "<?php echo $customer_id; ?>";
                                var dataString = 'id=' + id + '&option=' + option + '&customer_id=' + customer_id;

                                $.ajax({
                                    type: "POST",
                                    url: "http://valfrimobil.se/admin/update_customerorder_status_2.php",
                                    data: dataString,
                                    cache: false,
                                    success: function (html) {
                                    }
                                });


                            });

                        });
                    </script>
                    <select name="customer_status" class="ui compact dropdown"
                            id="customer_status<?php echo $ord['order_id']; ?>">
                        <option value="1" <?php if ($ord['status'] == '1') echo "selected" ?>>Mottagen</option>
                        <option value="2" <?php if ($ord['status'] == '2') echo "selected" ?>>Bearbetas</option>
                        <option value="3" <?php if ($ord['status'] == '3') echo "selected" ?>>Nekades</option>

                        <option value="4" <?php if ($ord['status'] == '4') echo "selected" ?>>Klar</option>
                        <option value="5" <?php if ($ord['status'] == '5') echo "selected" ?>>Klar/Betald
                        </option>


                    </select>
                </td>
            </tr>
            </tbody>
        </table>


    </div>
    <div class="ui tab" data-tab="processed">
        <table class="ui table orders-customers-table" style="border-radius: 0px;" cellspacing="0"
               id="orders-customers-table">
            <thead>
            <tr>
                <th>Order.nr</th>
                <th>Produkt</th>
                <th>Datum</th>
                <th>IMEI</th>
                <th>Modell</th>
                <th>Pris</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <?php echo $ord['order_id']; ?>
                </td>
                <td>
                    rere
                </td>
                <td>
                    <?php echo $ord['date']; ?>
                </td>
                <td>
                    <?php echo $ord['imei_number']; ?>
                </td>
                <td>
                    <?php echo $ord['model']; ?>
                </td>
                <td>
                    <?php echo $ord['price']; ?>
                </td>
                <td>
                    <script>
                        $(function () {
                            $('#customer_status<?php echo $ord['order_id']; ?>').change(function () {
                                var option = $(this).find('option:selected').val();
                                var id = "<?php echo $ord['order_id']; ?>";
                                var customer_id = "<?php echo $customer_id; ?>";
                                var dataString = 'id=' + id + '&option=' + option + '&customer_id=' + customer_id;

                                $.ajax({
                                    type: "POST",
                                    url: "http://valfrimobil.se/admin/update_customerorder_status_2.php",
                                    data: dataString,
                                    cache: false,
                                    success: function (html) {
                                    }
                                });


                            });

                        });
                    </script>
                    <select name="customer_status" class="ui compact dropdown"
                            id="customer_status<?php echo $ord['order_id']; ?>">
                        <option value="1" <?php if ($ord['status'] == '1') echo "selected" ?>>Mottagen</option>
                        <option value="2" <?php if ($ord['status'] == '2') echo "selected" ?>>Bearbetas</option>
                        <option value="3" <?php if ($ord['status'] == '3') echo "selected" ?>>Nekades</option>

                        <option value="4" <?php if ($ord['status'] == '4') echo "selected" ?>>Klar</option>
                        <option value="5" <?php if ($ord['status'] == '5') echo "selected" ?>>Klar/Betald
                        </option>


                    </select>
                </td>
            </tr>

            <?php
            }
            }
            ?>
            </tbody>
        </table>
    </div>
    <div class="ui tab" data-tab="denied">
        <table class="ui table orders-customers-table" style="border-radius: 0px;" cellspacing="0"
               id="orders-customers-table">
            <thead>
            <tr>
                <th>Order.nr</th>
                <th>Produkt</th>
                <th>Datum</th>
                <th>IMEI</th>
                <th>Modell</th>
                <th>Pris</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <?php echo $ord['order_id']; ?>
                </td>
                <td>
                   erg
                </td>
                <td>
                    <?php echo $ord['date']; ?>
                </td>
                <td>
                    <?php echo $ord['imei_number']; ?>
                </td>
                <td>
                    <?php echo $ord['model']; ?>
                </td>
                <td>
                    <?php echo $ord['price']; ?>
                </td>
                <td>
                    <script>
                        $(function () {
                            $('#customer_status<?php echo $ord['order_id']; ?>').change(function () {
                                var option = $(this).find('option:selected').val();
                                var id = "<?php echo $ord['order_id']; ?>";
                                var customer_id = "<?php echo $customer_id; ?>";
                                var dataString = 'id=' + id + '&option=' + option + '&customer_id=' + customer_id;

                                $.ajax({
                                    type: "POST",
                                    url: "http://valfrimobil.se/admin/update_customerorder_status_2.php",
                                    data: dataString,
                                    cache: false,
                                    success: function (html) {
                                    }
                                });


                            });

                        });
                    </script>
                    <select name="customer_status" class="ui compact dropdown"
                            id="customer_status<?php echo $ord['order_id']; ?>">
                        <option value="1" <?php if ($ord['status'] == '1') echo "selected" ?>>Behandlas</option>
                        <option value="2" <?php if ($ord['status'] == '2') echo "selected" ?>>Bearbetas</option>
                        <option value="3" <?php if ($ord['status'] == '3') echo "selected" ?>>Nekades</option>

                        <option value="4" <?php if ($ord['status'] == '4') echo "selected" ?>>Klar</option>
                        <option value="5" <?php if ($ord['status'] == '5') echo "selected" ?>>Klar/Betald
                        </option>
                    </select>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="ui tab" data-tab="finish">
        <div style="position: absolute; left: 200px; top: 65px;">
            <div class="ui green label">
                Totalt
                <div class='detail'>$44</div>
                ?>
            </div>
        </div>


        <table class="ui table orders-customers-table" style="border-radius: 0px;" cellspacing="0"
               id="orders-customers-table">
            <thead>
            <tr>
                <th>Order.nr</th>
                <th>Produkt</th>
                <th>Datum</th>
                <th>IMEI</th>
                <th>Modell</th>
                <th>Pris</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <?php echo $ord['order_id']; ?>
                </td>
                <td>
                    erge
                </td>
                <td>
                    <?php echo $ord['date']; ?>
                </td>
                <td>
                    <?php echo $ord['imei_number']; ?>
                </td>
                <td>
                    <?php echo $ord['model']; ?>
                </td>
                <td>
                    <?php echo $ord['price']; ?>
                </td>
                <td>
                    <script>
                        $(function () {
                            $('#customer_status<?php echo $ord['order_id']; ?>').change(function () {
                                var option = $(this).find('option:selected').val();
                                var id = "<?php echo $ord['order_id']; ?>";
                                var customer_id = "<?php echo $customer_id; ?>";
                                var dataString = 'id=' + id + '&option=' + option + '&customer_id=' + customer_id;

                                $.ajax({
                                    type: "POST",
                                    url: "http://valfrimobil.se/admin/update_customerorder_status_2.php",
                                    data: dataString,
                                    cache: false,
                                    success: function (html) {
                                    }
                                });


                            });

                        });
                    </script>
                    <select name="customer_status" class="ui compact dropdown"
                            id="customer_status<?php echo $ord['order_id']; ?>">
                        <option value="1" <?php if ($ord['status'] == '1') echo "selected" ?>>Behandlas</option>
                        <option value="2" <?php if ($ord['status'] == '2') echo "selected" ?>>Bearbetas</option>
                        <option value="3" <?php if ($ord['status'] == '3') echo "selected" ?>>Nekades</option>
                        <option value="4" <?php if ($ord['status'] == '4') echo "selected" ?>>Klar</option>
                        <option value="5" <?php if ($ord['status'] == '5') echo "selected" ?>>Klar/Betald
                        </option>
                    </select>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="ui tab" data-tab="finpaid">
        <div style="position: absolute; left: 200px; top: 65px;">
            <div class="ui green label">
                Totalt
                <div class='detail'>$44</div>
            </div>
        </div>
        <table class="ui table orders-customers-table" style="border-radius: 0px;" cellspacing="0"
               id="orders-customers-table">
            <thead>
            <tr>
                <th>Order.nr</th>
                <th>Produkt</th>
                <th>Datum</th>
                <th>IMEI</th>
                <th>Modell</th>
                <th>Pris</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <?php echo $ord['order_id']; ?>
                </td>
                <td>
                    erg
                </td>
                <td>
                    <?php echo $ord['date']; ?>
                </td>
                <td>
                    <?php echo $ord['imei_number']; ?>
                </td>
                <td>
                    <?php echo $ord['model']; ?>
                </td>
                <td>
                    <?php echo $ord['price']; ?>
                </td>
                <td>
                    <script>
                        $(function () {
                            $('#customer_status<?php echo $ord['order_id']; ?>').change(function () {
                                var option = $(this).find('option:selected').val();
                                var id = "<?php echo $ord['order_id']; ?>";
                                var customer_id = "<?php echo $customer_id; ?>";
                                var dataString = 'id=' + id + '&option=' + option + '&customer_id=' + customer_id;

                                $.ajax({
                                    type: "POST",
                                    url: "http://valfrimobil.se/admin/update_customerorder_status_2.php",
                                    data: dataString,
                                    cache: false,
                                    success: function (html) {
                                    }
                                });
                            });
                        });
                    </script>
                    <select name="customer_status" class="ui compact dropdown"
                            id="customer_status<?php echo $ord['order_id']; ?>">
                        <option value="1" <?php if ($ord['status'] == '1') echo "selected" ?>>Behandlas</option>
                        <option value="2" <?php if ($ord['status'] == '2') echo "selected" ?>>Bearbetas</option>
                        <option value="3" <?php if ($ord['status'] == '3') echo "selected" ?>>Nekades</option>

                        <option value="4" <?php if ($ord['status'] == '4') echo "selected" ?>>Klar</option>
                        <option value="5" <?php if ($ord['status'] == '5') echo "selected" ?>>Klar/Betald
                        </option>
                    </select>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="ui segment"> <!-- Ändra kunder, produkter -->
    <h3>List</h3>
    <div class="ui divider"></div>
    <table class="ui table stripe products-table" style="border-radius: 0px;" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Produktnamn</th>
            <th>Modeller</th>
            <th>Pris</th>
            <th>Datum</th>
            <th>Status</th>
            <th>Åtgärder</th>
        </tr>
        </thead>
        <tbody>
        <tr class="record">
            <td><?php echo $pro['product_id']; ?></td>
            <td><?php echo $pro['carrier']; ?><?php echo $pro['mobile']; ?></td>
            <td><?php echo $pro['model']; ?></td>
            <td><?php echo $pro['price']; ?><?php echo $pro['currency']; ?></td>
            <td><?php echo $pro['date']; ?></td>
            <td>
                <script>
                    $(function () {
                        $('#product<?php echo $pro['product_id']; ?>').change(function () {
                            var option = $(this).find('option:selected').val();
                            var id = "<?php echo $pro['product_id']; ?>";
                            var dataString = 'id=' + id + '&option=' + option;
                            $.ajax({
                                type: "POST",
                                url: "update_status_product.php",
                                data: dataString,
                                cache: false,
                                success: function (html) {
                                }
                            });
                        });
                    });
                </script>
                <select name="status" class="ui compact dropdown" id="product<?php echo $pro['product_id']; ?>">
                    <option value="1" <?php if ($pro['published'] == '1') echo "selected" ?>>Publicerad</option>
                    <option value="0" <?php if ($pro['published'] == '0') echo "selected" ?>>Inte publicerad
                    </option>
                </select>
            </td>
            <td>
                <a class="tab-itemers ui button compact icon green"
                   data-tab="products/<?php echo $pro['product_id']; ?>">
                    <i class="edit icon"></i>
                </a>
                <a href="javascript:void();"
                   class="delbuttoner<?php echo $pro['product_id']; ?> ui button compact icon">
                    <i class="trash icon"></i>
                </a>
                <script type="text/javascript">
                    $(function () {
                        $(".delbuttoner<?php echo $pro['product_id']; ?>").click(function () {
                            var del_id = "<?php echo $pro['product_id']; ?>";
                            var info = 'id=' + del_id;
                            if (confirm("Vill du ta bort den här produkten?")) {
                                $.ajax({
                                    type: "POST",
                                    url: "http://valfrimobil.se/admin/delete_product.php",
                                    data: info,
                                    success: function () {
                                    }
                                });

                                $(this).parents(".record").animate({backgroundColor: "#fbc7c7"}, "fast")
                                    .animate({opacity: "hide"}, "slow");
                            }
                            return false;
                        });

                    });
                </script>
            </td>
        </tr>
        </tbody>
    </table>


</div>


<div class="ui segment" style="box-shadow: none;">


    <script>
        jQuery(document).ready(function ($) {
            $.validator.setDefaults({
                errorClass: 'errorField',
                errorElement: 'div',
                errorPlacement: function (error, element) {
                    error.addClass("ui red pointing above ui label error").appendTo(element.closest('div.field'));
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).closest("div.field").addClass("error").removeClass("success");
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).closest(".error").removeClass("error").addClass("success");
                }

            });

            $('#ansokts').validate({
                submitHandler: function (form) {
                    $(form).ajaxSubmit({
                        success: function (resp) {
                            $("#success-producter").fadeIn(300).html(resp);
                        }
                    });
                }
            });

        });
    </script>

    <h3>Ändra</h3>

    <div class="ui divider"></div>

    <div id="result" style="display: none;" class="ui error message"></div>
    <div id="success-producter" style="display: none;" class="ui success message"></div>


    <form action="http://valfrimobil.se/edit_customer.php" method="post" id="ansokts" class="ui form">

        <input id="customer_id" name="customer_id" type="hidden" value="<?php echo $customer_id; ?>">

        <div class="field required">
            <label>Kontaktperson</label>
            <input placeholder="" title="Fyll i en kontaktperson" id="name" name="name" type="text"
                   value="<?php echo $name; ?>" required>

        </div>
        <div class="field required">
            <label>Företagsnamn</label>
            <input placeholder="" title="Fyll i ett företagsnamn" id="company" name="company" type="text"
                   value="<?php echo $company_name; ?>" required>

        </div>

        <div class="field required">
            <label>Org.nr</label>
            <input placeholder="" title="Fyll i ett org.nr" id="orgnr" name="orgnr" type="text"
                   value="<?php echo $org_number; ?>" required>

        </div>


        <div class="field required">
            <label>Adress</label>
            <input placeholder="" value="<?php echo $address; ?>" id="address" title="Fyll i en adress" name="address"
                   type="text" required>

        </div>

        <div class="field required">
            <label>Postnummer</label>
            <input placeholder="" value="<?php echo $postnumber; ?>" id="postnumber" title="Fyll i ett postnummer"
                   name="postnumber" type="text" required>

        </div>

        <div class="field required">
            <label>Telefonnummmer</label>
            <input placeholder="" id="phone" title="Fyll i ett telefonnummer" name="phone" value="<?php echo $phone; ?>"
                   type="text" required>

        </div>

        <div class="field required">
            <label>E-post</label>
            <input placeholder="" value="<?php echo $email; ?>" id="email" title="Fyll i en e-postadress" name="email"
                   type="text" required>

        </div>


        <div class="field">
            <input type="submit" value="Ändra" class="ui button">
        </div>

    </form>

</div>
</div>


<script>
    $(function () {


        $('.tab-itemer').tab({
            history: false,
            cache: false,
            apiSettings: {
                url: 'pages2/{$tab}.php'
            }

        })
        ;

    });
</script>

<script>
    $(function () {


        $('.tab-itemers').tab({
            history: false,
            cache: false,
            apiSettings: {
                url: 'pages2/one_product.php?id={$tab}'
            }

        })
        ;

    });
</script>


<script>
    $(document).ready(function () {
        $('.orders-customers-table').dataTable({
            "pagingType": "full_numbers",
            "order": [[2, "desc"]],
            "language": {
                "lengthMenu": "Visa _MENU_ st per sida",
                "zeroRecords": "Inget hittades, tyvärr!",
                "info": "Visar sida _PAGE_ av _PAGES_",
                "infoEmpty": "Inget hittades",
                "infoFiltered": "(sökning mellan totalt _MAX_ beställningar)",
                "sSearch": "Sök:",
                "oPaginate": {
                    "sFirst": "Första",
                    "sPrevious": "Föregående",
                    "sNext": "Nästa",
                    "sLast": "Sista"
                }
            }

        });
    });
</script>
		
    
