<!-- MESSAGE BOX-->
<div class="message-box message-box-danger animated fadeIn" data-sound="fail" id="mb-signout">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-power-off"></span> Keluar ?</div>
            <div class="mb-content">
                <p>Anda yakin ingin keluar ?</p>
                <p>Tekan Yes jika iya, tekan No jika tidak</p>
            </div>
            <div class="mb-footer">
                <div class="pull-right">
                    <a href="<?=$base_url;?>proses/logout.php" class="btn btn-success btn-lg">Yes</a>
                    <button class="btn btn-default btn-lg mb-control-close">No</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MESSAGE BOX-->

<!-- START PRELOADS -->
<audio id="audio-alert" src="<?=$base_url;?>assets/audio/alert.mp3" preload="auto"></audio>
<audio id="audio-fail" src="<?=$base_url;?>assets/audio/fail.mp3" preload="auto"></audio>
<!-- END PRELOADS -->

<!-- START SCRIPTS -->
<!-- START PLUGINS -->
<script type="text/javascript" src="<?=$base_url;?>assets/js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="<?=$base_url;?>assets/js/plugins/jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?=$base_url;?>assets/js/plugins/bootstrap/bootstrap.min.js"></script>
<!-- END PLUGINS -->

<!-- THIS PAGE PLUGINS -->
<script type='text/javascript' src='<?=$base_url;?>assets/js/plugins/icheck/icheck.min.js'></script>
<script type="text/javascript" src="<?=$base_url;?>assets/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js">
</script>
<script type="text/javascript" src="<?=$base_url;?>assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=$base_url;?>assets/js/plugins/owl/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?=$base_url;?>assets/js/plugins/bootstrap/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?=$base_url;?>assets/js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="<?=$base_url;?>assets/js/plugins/jquery-mask.min.js"></script>
<!-- END PAGE PLUGINS -->

<!-- START TEMPLATE -->
<!-- <script type="text/javascript" src="<?=$base_url;?>assets/js/settings.js"></script> -->

<script type="text/javascript" src="<?=$base_url;?>assets/js/plugins.js"></script>
<script type="text/javascript" src="<?=$base_url;?>assets/js/actions.js"></script>
<!-- END TEMPLATE -->
<!-- END SCRIPTS -->
<script type="text/javascript">
// function scan_input_id() {
//     var scan = $("#scan_input").val();
//     alert(scan);
// }
$(document).ready(function() {

    $('#check_all').on('click', function() {
        if (this.checked) {
            $('.check').each(function() {
                this.checked = true;
            });
        } else {
            $('.check').each(function() {
                this.checked = false;
            });
        }
    });

    $('.check').on('click', function() {
        if ($('.check:checked').length == $('.check').length) {
            $('#check_all').prop('checked', true);
        } else {
            $('#check_all').prop('checked', false);
        }
    });
    $('.uang').mask('000.000.000.000.000', {
        reverse: true
    });
    $('.nim').mask('000000000', {
        reverse: true
    });
    $('.nip').mask('00000000 000000 0 000', {
        reverse: true
    });
    $("#scan_input").focus();
    $("#scan_input").on("input", function() {
        var scan = $(this).val();

        $.ajax({
            type: "POST",
            url: "<?=$base_url;?>proses/add_to_cart.php",
            data: {
                scan: scan
            },
            dataType: 'json',
            success: function(e) {
                console.log(e);

                $("#scan_input").val("");
                window.location.href = "<?=$base_url;?>?pinjam";

            }
        });
    });
    $("#input").on("change", function() {
        var scan = $(this).val();

        $.ajax({
            type: "POST",
            url: "<?=$base_url;?>proses/add_to_cart.php",
            data: {
                scan: scan
            },
            dataType: 'json',
            success: function(e) {
                console.log(e);

                $("#scan_input").focus();
                window.location.href = "<?=$base_url;?>?pinjam";

            }
        });
    });
    $("#scan_pengunjung").focus();
    $("#scan_pengunjung").on("input", function() {
        var scan = $(this).val();

        $.ajax({
            type: "POST",
            url: "<?=$base_url;?>proses/pengunjung.php",
            data: {
                scan: scan
            },
            dataType: 'json',
            success: function(e) {
                console.log(e);
                $('[name="pengunjung_id"]').val(e[1]);
                $('[name="nama_lengkap"]').val(e[2]);
                $("#scan_pengunjung").val("");

            }
        });
    });
    $("#input_pengunjung").on("change", function() {
        var scan = $(this).val();

        $.ajax({
            type: "POST",
            url: "<?=$base_url;?>proses/pengunjung.php",
            data: {
                scan: scan
            },
            dataType: 'json',
            success: function(e) {
                console.log(e);
                $('[name="pengunjung_id"]').val(e[1]);
                $('[name="nama_lengkap"]').val(e[2]);
                $("#scan_pengunjung").focus();

            }
        });
    });
    $('#peminjam_id').on("change", function() {
        $(this).prop("readonly", true);
        $('#kode_buku').prop("readonly", false);
        $('#kode_buku').focus();
        $(this).prop("autofocus", false);
    });
    $('#kode_buku').on("change", function() {
        $(this).prop("readonly", true);
        var peminjam_id = $('#peminjam_id').val();
        var kode_buku = $('#kode_buku').val();
        var action = '<?=$base_url;?>?kembalikan&peminjamID=' + peminjam_id + '&kodeBuku=' + kode_buku;
        $('#cek-peminjaman').attr('action', action).submit();
    });
})

function update_jml(x) {
    var jml = $('#' + x).val();

    $.ajax({
        type: "POST",
        url: "<?=$base_url;?>proses/add_to_cart.php",
        data: {
            id: x,
            update: 'jml_update',
            jml: jml
        },
        dataType: 'json',
        success: function(e) {
            // console.log(e);
            $("#scan_input").focus();
            $('#' + x).val(e);
        },
        error: function() {
            $("#scan_input").focus();
        }
    });
};
</script>