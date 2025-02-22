<section id="modal_media"></section>
<script src="<?= URL_ASSETS ?>/admin/js/mdb.min.js"></script>
<script src="<?= URL_ASSETS ?>/admin/js/popper.min.js" defer></script>
<script src="<?= URL_ASSETS ?>/admin/js/bootstrap.js" defer></script>
<script src="<?= URL_ASSETS ?>/admin/js/select2.min.js"></script>
<script src="<?= URL_ASSETS ?>/admin/js/inputmask.js" defer></script>
<script src="<?= URL_ASSETS ?>/admin/js/slug.js" defer></script>
<?php if ($ctl . $act != 'authlogin'):?>
    <script>
        const currency_format = Intl.NumberFormat('en-US');
        new WOW().init();
        $(".button-collapse").sideNav();
        var container = document.querySelector(".custom-scrollbar");
        var ps = new PerfectScrollbar(container, {
            wheelSpeed: 5,
            wheelPropagation: true,
            minScrollbarLength: 50
        });

        $(document).ready(function() {
            $('.inputmask').inputmask();
            $(function() {
                $('[data-toggle="tooltip"]').tooltip();
            });
        });

        function updateTimed() {
            for (const li of document.querySelectorAll('.timed')) {
                li.textContent = timestampToString(<?= time(); ?>, li.textContent);
            }
        }
        function updateTimes() {
            for (const li of document.querySelectorAll('.times')) {
                li.textContent = timestampToStrings(li.textContent);
            }
        }
        function updateMoney() {
            for (const li of document.querySelectorAll('.money')) {
                let value = $(li).text();
                $(li).text(currency_format.format(value));
            }
        }
        function updatePhone() {
            $('.phone').text(function(i, text) {
                return text.replace(/(\d{4})(\d{3})(\d{3})/, '$1.$2.$3');
            });
        }
        
        function toSlug(id,value){
            $("#"+id).val(stringToSlug(value));
        }
    </script>
<?php endif;?>