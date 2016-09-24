<h2>Admin</h2>
<div class="ui segment" style="box-shadow: none;">
    <div class="ui breadcrumb">
        <a href="#" class="section">Hem</a>
        <i class="right chevron icon divider"></i>
        <a class="active section">Admin</a>
    </div>
</div>
<div class="ui segment">
    <h3>List</h3>
    <div class="ui divider"></div>
    <table id="orders-table" class="ui table striped" style="border-radius: 0px;" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>E-post</th>
            <th>Användarnamn</th>
            <th>Förnamn</th>
            <th>Efternamn</th>
            <th>Åtgärder</th>
        </tr>
        </thead>
        <tbody>
        <tr class="records">
            <td>example@example.com</td>
            <td>Admin</td>
            <td>Test</td>
            <td>Person</td>
            <td>
                <a href="javascript:void();" class="delbuttons1 ui button icon compact">
                    <i class="trash icon"></i>
                </a>
                <script type="text/javascript">
                    $(function () {
                        $(".delbuttons1").on('click', function () {
                            var del_id = "1";
                            var info = 'id=' + del_id;
                            if (confirm("Vill du ta bort den här administratören?")) {
                                /*$.ajax({
                                    type: "POST",
                                    url: "delete_admin.php",
                                    data: info,
                                    success: function () {
                                    }
                                });*/

                                $(this).parents(".records").animate({backgroundColor: "#fbc7c7"}, "fast")
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

        $('#orders-formser').validate({
            submitHandler: function (form) {
                $(form).ajaxSubmit({
                    success: function (resp) {
                        $("#success-orders").fadeIn(300).html(resp);
                    }
                });
            }
        });

    });
</script>
<div class="ui segment">
    <h3>Add</h3>
    <div class="ui divider"></div>
    <form class="ui form" id="orders-formser" action="add_admin.php" method="post">
        <div id="result" class="ui error message"></div>
        <div id="success-orders" class="ui success message"></div>
        <div class="field required">
            <label>Email</label>
            <input data-rule-email="true" placeholder="Ex. mail@live.com" id="email" name="email" type="text"
                   data-msg-email="Ange en giltig e-post" title="Fyll i en e-post" required>
        </div>
        <div class="field required">
            <label>Password</label>
            <input type="password" id="password" name="password" minlength="3" maxlength="15"
                   title="Fyll i ett lösenord" data-msg-minlength="Minst 3 tecken!" required>
        </div>
        <div class="field required">
            <label>Username</label>
            <input type="text" id="username" name="username" placeholder="" title="Fyll i ett användarnamn" required>
        </div>
        <div class="field required">
            <label>Firstname</label>
            <input type="text" id="firstname" name="firstname" placeholder="" title="Fyll i ett förnamn" required>
        </div>
        <div class="field required">
            <label>Lastname</label>
            <input type="text" id="lastname" name="lastname" placeholder="" title="Fyll i ett efternamn" required>
        </div>
        <input type="submit" value="Lägg till" class="ui button">
    </form>
</div>