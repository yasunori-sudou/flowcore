$(function() {


    /*-------------------------------------------------------------------*/
    /*---------------------データ登録ボタンを押した------------------------*/
    /*-------------------------------------------------------------------*/
    $(document).on('click', '#execute_button', function() {

        //バリデーションチェックを行う
        //空のバリデーションチェック
        let varidation_out = false;
        $(".empty_check").each(function(){

            if($(this).val() == ""){
                varidation_out = true;
                $(this).css("background-color","#fbc7e3");
            }else{
                $(this).css("background-color","#fff");
            }

        });

        if(varidation_out){
            alert("入力してください");
            return false;
        }

        if(!window.confirm("登録しますか?")) return false;

        let execute_type = 'insert';
        let dbarray = {};

        //要素のIDにはDBの項目名が入っていること
        $(".execute_subject").each(function(){
            dbarray[$(this).attr("id")] = $(this).val();
        });

        const json_text = JSON.stringify(dbarray);

        console.log("view/flow/3_order/entry/order_entry_ajax.php?execute=true&execute_type="+execute_type+"&json_text="+json_text)

        $.ajax({
            url: '../../view/flow/3_order/entry/order_entry_ajax.php',
            type: 'GET',
            dataType: 'json',
            data: {
                "execute" : true,
                "execute_type" : execute_type,
                "json_text" : json_text
            }

        }).done(function(data) {
            /* 通信成功時 */
            console.log(data);
            $(".no_answer_field").html('未回答<div class="no_answer_notice">'+data[1]+'</div>');

        }).fail(function(data) {
            /* 通信失敗時*/
            console.log(data);

        });
    });



});