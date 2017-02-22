<script src="/eprocurement/assets/js/jquery-1.10.2.min.js"></script>
<script src="/eprocurement/assets/js/bootstrap.min.js"></script>
<script src="/eprocurement/assets/js/bootstrap-paginator.js"></script>
<script src="/eprocurement/assets/js/jquery.scrollTo.js"></script>
<script language="JavaScript">
    var ajaxRequest;
    function getAjax() { //mengecek apakah web browser support AJAX atau tidak
        try {
            // Opera 8.0+, Firefox, Safari
            ajaxRequest = new XMLHttpRequest();
        } catch (e) {
            // Internet Explorer Browsers
            try {
                ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                try {
                    ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e) {
                    // Something went wrong
                    alert("Your browser broke!");
                    return false;
                }
            }
        }
    }
</script>
<?php
/*
<script>
    $(document).ready(function() {
        var elements = document.getElementsByTagName("INPUT");
        for (var i = 0; i < elements.length; i++) {
            elements[i].oninvalid = function(e) {
                e.target.setCustomValidity("");
                if (input.validity.valueMissing) {
                    e.target.setCustomValidity("Anda belum mengisi bagian ini");
                }
            };
            elements[i].oninput = function(e) {
                e.target.setCustomValidity("Wajib diisi");
            };
        }
    })
</script>
*/?>
<script>
    $(document).ready(function() {
        // Show or hide the sticky footer button
        $(window).scroll(function() {
            if ($(this).scrollTop() > 200) {
                $('.go-top').fadeIn(200);
            } else {
                $('.go-top').fadeOut(200);
            }
        });
        // Animate the scroll to top
        $('.go-top').click(function(event) {
            event.preventDefault();
            $('html, body').animate({scrollTop: 0}, 'slow');
        });
    });
</script>
<script>
    function navigate(event){
        event.preventDefault();
        $('html, body').animate({scrollTop:$('#daftar').position().top}, 'slow');
    }
</script>
<script>
    var counterFitur = 2;
    var counterKualifikasi = 2;
    $(document).ready(function() {
        $("#addFitur").click(function() {
            if (counterFitur > 10) {
                alert("Only 10 textboxes allow");
                return false;
            }
            var newTextBoxDiv = $(document.createElement('div')).attr("id", 'FiturDiv' + counterFitur).attr("class", 'form-group');
            newTextBoxDiv.after().html('<label class="col-sm-2 control-label">Fitur #' + counterFitur + ' : </label>' +
                    '<div class="col-sm-3"> ' +
                    '   <input type="text" class="form-control" placeholder="Fitur #' + counterFitur + '" id="textbox' + counterFitur +
                    '" name="fitur' + counterFitur + '">' +
                    '</div>' +
                    '<div class="col-sm-2 form-group"> ' +
                    '   <input type="text" class="form-control" placeholder="Bobot Fitur #' + counterFitur + '" id="textbox' + counterFitur +
                    '" name="bobot' + counterFitur + '" required>' +
                    '</div>' +
                    '<div class="col-sm-3 form-group"> ' +
                    '   <input type="text" class="form-control" placeholder="Keterangan Fitur #' + counterFitur + '" id="textbox' + counterFitur +
                    '" name="keterangan' + counterFitur + '" required>' +
                    '</div>' +
                    '<div class="col-sm-2 form-group"> ' +
                    '   <select class="form-control" name="indeks' + counterFitur + '">' +
                    '       <option value="1">+</option>' +
                    '       <option value="0">-</option>' +
                    '   </select>' +
                    '</div>');
            newTextBoxDiv.appendTo("#Fitur");
            counterFitur++;
        });
        $("#removeFitur").click(function() {
            if (counterFitur == 1) {
                alert("No more textbox to remove");
                return false;
            }
            counterFitur--;
            $("#FiturDiv" + counterFitur).remove();
        });
        $("#addKualifikasi").click(function() {
            if (counterKualifikasi > 10) {
                alert("Only 10 textboxes allow");
                return false;
            }
            var newTextBoxDiv = $(document.createElement('div')).attr("id", 'KualifikasiDiv' + counterKualifikasi).attr("class", 'form-group');
            newTextBoxDiv.after().html('<label class="col-sm-2 control-label">Kualifikasi #' + counterKualifikasi + ' : </label>' +
                    '<div class="col-sm-8"> ' +
                    '<textarea class="form-control" rows="3" placeholder="Kualifikasi #' + counterKualifikasi + '" id="textarea' + counterKualifikasi +
                    '" name="kualifikasi' + counterKualifikasi + '"></textarea>' +
                    '</div>');
            newTextBoxDiv.appendTo("#Kualifikasi");
            counterKualifikasi++;
        });
        $("#removeKualifikasi").click(function() {
            if (counterKualifikasi == 1) {
                alert("No more textbox to remove");
                return false;
            }
            counterKualifikasi--;
            $("#KualifikasiDiv" + counterKualifikasi).remove();
        });
    });
    function getCounter() {
        document.getElementById("counterFitur").value = counterFitur - 1;
        document.getElementById("counterKualifikasi").value = counterKualifikasi - 1;
    }
</script>
<script>
    $(document).ready(function() {
        //$(function() {
        var options = {
            bootstrapMajorVersion: 3,
            currentPage: <?php
global $pageID, $jumlahHalaman, $jenis;
if (!(isset($pageID)) || $pageID == '' || empty($pageID)) {
    $pageID = 1;
}
echo $pageID;
?>,
            numberOfPages: 3,
            totalPages: <?php echo $jumlahHalaman; ?>,
            itemContainerClass: function(type, page, current) {
                return (page === current) ? "active" : "";
            },
            pageUrl: function(type, page, current) {
                if (page == 1) {
<?php
if ($jenis == 'member') {
    $url = '/eprocurement/admin/member/semua/';
} else {
    $url = '/eprocurement/';
}
?>
                    return  "<?php echo $url; ?>";
                } else {
<?php
if ($jenis == 'member') {
    $url = '/eprocurement/admin/member/semua/';
} else {
    $url = '/eprocurement/lelang/semua/';
}
?>
                    return  "<?php echo $url; ?>" + page;
                }
            },
            useBootstrapTooltip: true,
            bootstrapTooltipOptions: {
                html: true,
                placement: 'bottom'
            }
        };
        $('#paging').bootstrapPaginator(options);
    }
    );
    $(document).ready(function() {
        //Handles menu drop down
        $('.dropdown-menu').find('form').click(function(e) {
            e.stopPropagation();
        });
    });
<?php /*
    function changePagination(pageId, liId) {
        $(".loading").show();
        $(".loading").fadeIn(400).html
                ('<br /><img src="assets/images/ajax-loader.gif" />');
        var dataString = 'pageId=' + pageId;
        $.ajax({
            type: "POST",
            url: "assets/daftarLelang.php",
            data: dataString,
            cache: false,
            success: function(result) {
                $(".loading").hide();
                $(".pagination li").removeClass("active");
                $("#" + liId + "_no").addClass("active");
                $("#pageData").html(result);
                $("#tesCetak").html(pageId + " " + liId);
            }
        });
    }
    */ ?>
</script>
</body>
<hr class="featurette-divider"> 

<center><p class="pull-right"><a href="#" class="go-top"><span class="glyphicon glyphicon-chevron-up"></span> Back to top</a></p></center>
<p>Copyright &copy; 2013 Ciputri Land Developer. All rights reserved. </p>
<p><i>Lovingly made by creators from our deepest heart</i> <span class="glyphicon glyphicon-heart"></span> <i>in Malang, Indonesia</i></p>
</div><!--/.countainer marketting-->
</html>