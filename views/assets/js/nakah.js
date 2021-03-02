//SWEET ALERT
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

function naka() {
    $("#changeclass").hide();
    $("#branch").hide();
    $("#infom").hide();

    $("#ohc").hide();
    $("#ohs").hide();

    $("#pvc").click(function () {
        var radab = "pvc";
        console.log(radab);
        $("#changeclass").show();
        $("#pvc").addClass("pn-active");
        $("#pvs").hide();
        $("#pvc-r").removeClass("col-sm-6");
        $("#pvc-r").addClass("col-sm-12");
        $("#branch").show();
        $("#infom").show();
        $("#ohc").show();

    });
    $("#pvs").click(function () {
        var radab = "pvs";
        console.log(radab);
        $("#changeclass").show();
        $("#pvs").addClass("pn-active");
        $("#pvc").hide();
        $("#pvs-r").removeClass("col-sm-6");
        $("#pvs-r").addClass("col-sm-12");
        $("#branch").show();
        $("#infom").show();

        $("#ohs").show();

    });

    $("#changeclass").click(function () {
        $("#changeclass").hide();
        $("#pvc-r").addClass("col-sm-6");
        $("#pvc-r").removeClass("col-sm-12");
        $("#pvs-r").addClass("col-sm-6");
        $("#pvs-r").removeClass("col-sm-12");

        $("#pvs").removeClass("pn-active");
        $("#pvc").removeClass("pn-active");
        $("#pvs").show();
        $("#pvc").show();
        $("#branch").hide();
        $("#infom").hide();

        $("#ohc").hide();
        $("#ohs").hide();

        var radab = "";
        console.log(radab);

    });
    $('#seloo').on('change', function () {
        var phanak = this.value;
        console.log(phanak);
    });
    $('#selootwo').on('change', function () {
        var phanaksong = this.value;
        console.log(phanaksong);
    });

    $('#seloos').on('change', function () {
        var phanak = this.value;
        console.log(phanak);
    });
    $('#seloostwo').on('change', function () {
        var phanaksong = this.value;
        console.log(phanaksong);
    });

    $('#provinces').change(function () {
        var id_province = $(this).val();

        $.ajax({
            type: "POST",
            url: "/api/v1/ajaxdb",
            data: { id: id_province, function: 'provinces' },
            success: function (data) {
                $('#amphures').html(data);
                $('#districts').html(' ');
                $('#districts').val(' ');
                $('#zip_code').val(' ');
            }
        });
    });

    $('#amphures').change(function () {
        var id_amphures = $(this).val();

        $.ajax({
            type: "POST",
            url: "/api/v1/ajaxdb",
            data: { id: id_amphures, function: 'amphures' },
            success: function (data) {
                $('#districts').html(data);
            }
        });
    });

    $('#districts').change(function () {
        var id_districts = $(this).val();

        $.ajax({
            type: "POST",
            url: "/api/v1/ajaxdb",
            data: { id: id_districts, function: 'districts' },
            success: function (data) {
                $('#zip_code').val(data)
            }
        });

    });

}
