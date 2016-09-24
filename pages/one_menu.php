<h2>Menu</h2>
<div class="ui segment">
    <div class="ui breadcrumb">
        <a href="#" class="section tab-item">Hem</a>
        <i class="right chevron icon divider"></i>
        <a data-tab="menu" class="section tab-itemer">Menu</a>
        <i class="right chevron icon divider"></i>
        <a class="active section">Menu item</a>
    </div>
</div>
<div class="ui segment">
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
            $('#ansoktss').validate({
                submitHandler: function (form) {
                    $(form).ajaxSubmit({
                        success: function (resp) {
                            $("#success-producters").fadeIn(300).html(resp);
                        }
                    });
                }
            });
        });
    </script>
    <h3>Edit</h3>
    <div class="ui divider"></div>
    <div id="result" style="display: none;" class="ui error message"></div>
    <div id="success-producters" style="display: none;" class="ui success message"></div>
    <form action="edit_menu.php" method="post" id="ansoktss" class="ui form">
        <input id="menu_id" name="menu_id" type="hidden" value="<?php echo $menu_id; ?>">
        <div class="field required">
            <label>Namn</label>
            <input placeholder="" title="Fyll i ett namn" id="name" name="name" type="text" value="<?php echo $name; ?>"
                   required>
        </div>
        <div class="field required">
            <label>Länk</label>
            <input placeholder="" title="Fyll i en länk" id="link" name="link" type="text" value="<?php echo $link; ?>"
                   required>
        </div>
        <div class="field required">
            <label>Placering</label>
            <input placeholder="" value="<?php echo $location; ?>" id="location" title="Fyll i en placering"
                   name="location" type="text" required>
        </div>
        <div class="field">
            <input type="submit" value="Ändra" class="ui button">
        </div>
    </form>
</div>
<script>
    $(function () {
        $('.tab-itemer').tab({
            history: false,
            cache: false,
            apiSettings: {
                url: 'pages/{$tab}.php'
            }
        })
        ;
    });
</script>
    