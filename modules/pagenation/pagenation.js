$(function() {

    /**
     * ページデータを取得し、要素に埋め込む
     * @param int current  現在のページ位置
     * @param int splitrow レコードを何行で区切るか
     * @param date startdate  開始日
     * @param date enddate 終了日
     * @param string type order_entry=受注エントリ用のデータ
     */
    function getdata(current,splitrow,startdate,enddate,type){

        console.log("/modules/pagenation/pagenation_ajax.php?current="+current+"&splitrow="+splitrow+"&startdate="+startdate+"&enddate="+enddate+"&type="+type);

        $.ajax({
            url: "../../modules/pagenation/pagenation_ajax.php",
            type: "GET",
            dataType: "json",
            data: {
                "current" : current,
                "splitrow" : splitrow,
                "startdate" : startdate,
                "enddate" : enddate,
                "type" : type
            }
            
        }).done(function(data){
            /* 通信成功時 */

            $("#pagenation_field").html(data[0]);
            $("#datamaxrow").text(data[1]);
        }).fail(function(data){
            /* 通信失敗時 */
            alert('通信に失敗しました_template_pagenation.js->getdata');
        });   
    }

});