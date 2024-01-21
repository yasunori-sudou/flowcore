$(function() {


    /*-------------------------------------------------------------------*/
    /*---------------------サイドバーのナビリンクを押した-------------------*/
    /*-------------------------------------------------------------------*/
    $(document).on('click', '.nav-link', function() {

        const thisid = $(this).attr("id");

        if(thisid == $("#nav-current").val()){
            //現在のページに飛ぼうとした
            return false;
        }

        console.log("view/flow/3_order/sideber/sideber_ajax_root.php?thisid="+thisid)

        $.ajax({
            url: '../../view/flow/3_order/sideber/sideber_ajax_root.php',
            type: 'GET',
            dataType: 'json',
            data: {
                "thisid" : thisid
            }

        }).done(function(data) {
            /* 通信成功時 */
            $("#mainfield").html(data);
            $("#nav-current").val(thisid);

        }).fail(function(data) {
            /* 通信失敗時*/
            console.log(data);

        });
    });



});