$(function() {
    /*-------------------------------------------------------------------*/
    /*-----------------------ページタイルをclickした----------------------*/
    /*-------------------------------------------------------------------*/
    $(document).on('click', '.pagenation_toplast,.pagenation_notcurrent', function() {
        const res = $(this).attr("id").split("_");
        const current = res[1];//何番のタイルを選択したか
        const splitrow = $("#pagenation_splitrow").val();
        const startdate = $("#datastartdate").val();
        const enddate = $("#dataenddate").val();
        const type = "order_entry";

        if(startdate == "" || enddate == "") return false;

        getdata(current,splitrow,startdate,enddate,type);
    });

    /*-------------------------------------------------------------------*/
    /*----------------ページ数セレクトボックスを選択した-------------------*/
    /*-------------------------------------------------------------------*/
    $(document).on('change', '#pagenation_select', function() {
        const current = $(this).val();
        const splitrow = $("#pagenation_splitrow").val();
        const startdate = $("#datastartdate").val();
        const enddate = $("#dataenddate").val();
        const type = "order_entry";

        if(startdate == "" || enddate == "") return false;

        getdata(current,splitrow,startdate,enddate,type);
    });

    /*-------------------------------------------------------------------*/
    /*---------------------抽出範囲の日付を変更した------------------------*/
    /*-------------------------------------------------------------------*/
    $(document).on('change', '.datasetdate', function() {
        const current = 1;
        const splitrow = $("#pagenation_splitrow").val();
        const startdate = $("#datastartdate").val();
        const enddate = $("#dataenddate").val();
        const type = "order_entry";

        if(startdate == "" || enddate == "") return false;

        getdata(current,splitrow,startdate,enddate,type);
    });

});