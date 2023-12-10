window.onload = () => {
    const video  = document.querySelector("#camera");
    const canvas = document.querySelector("#picture");

    setBase64(1);
    setBase64(2);
    setBase64(3);
    setBase64(4);
    setBase64(5);
    setBase64(6);

    /** カメラ設定 */
    if(document.getElementById("camera_position").value == "front"){
        //フロントカメラを利用する
        var constraints = {
            audio: false,
            video: {
            width: 800,
            height: 800,
            facingMode: "user",
            }
        };
    }else{
        //リヤカメラを利用する
        var constraints = {
            audio: false,
            video: {
            width: 800,
            height: 800,
            facingMode: { exact: "environment" },
            }
        };
    }

    /**
    * カメラを<video>と同期
    */
    navigator.mediaDevices.getUserMedia(constraints)
    .then( (stream) => {
        video.srcObject = stream;
        video.onloadedmetadata = (e) => {
        video.play();
        };
    })
    .catch( (err) => {
        console.log(err.name + ": " + err.message);
    });

    /**
    * シャッターボタン
    */
    document.querySelector("#shutter").addEventListener("click", () => {
        
        const photono = document.getElementById("photono").value;
        const ctx = canvas.getContext("2d");
        // 演出的な目的で一度映像を止めてSEを再生する
        video.pause();  // 映像を停止
        setTimeout( () => {
        video.play();    // 0.5秒後にカメラ再開
        }, 500);

        // canvasに画像を貼り付ける
        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
        getBase64(photono);
        setBase64(photono);
        Camera_Save();
    });



};

// ●canvasからBase64文字列を取得し画面に表示する
function getBase64(photono){
    //キャンバス→Base64に変換する
    var cvs = document.getElementById('picture');
    var data = cvs.toDataURL("image/jpeg");  
    
    //Base64文字列を画面に表示する
    document.getElementById("base64_data_"+photono).value = data;
}


function setBase64(photono){
    //2Dコンテキストのオブジェクトを生成する
    var cvs = document.getElementById('photo_'+photono);
    var ctx= cvs.getContext('2d');
    
    //画像オブジェクトを生成
    var img = new Image();
    img.src = document.getElementById("base64_data_"+photono).value; //Base64データ
    
    //画像をcanvasに設定
    img.onload = function(){
        ctx.drawImage(img, 0, 0, 800, 800);
    }
}


/*-------------画像をDBに保存-------------*/
function Camera_Save(){
    const makeno = $("#makeno").val();
    const photono = $("#photono").val();
    const base64 = $("#base64_data_"+photono).val();

    $.ajax({
        url: './ajax_camera_save.php',
        type: 'POST',
        dataType: 'json',
        data: {
            "makeno": makeno,
            "base64" : base64,
            "photono" : photono
        }
    }).done(function(data) {
        $("#photo"+photono).prop('title',data);
    }).fail(function(data) {
        /* 通信失敗時 */
        alert('通信に失敗しました');
    });

}


$(function(){

    /*-------------画像をclickすると画像選択を変える-------------*/
    $(document).on('click', '.selectphoto', function(){
        const res = $(this).attr("id").split("_");
        $("#photono").val(res[1]);
        $("#delete_no").val(res[1]);
    });

    /*-------------画像を削除-------------*/
    $(document).on('click', '#delete', function(){
        const makeno = $("#makeno").val();
        const photono = $("#delete_no").val();
        if(!window.confirm("["+photono+"]の画像を消去しますか?")){
            return false;
        }

        console.log("ajax_camera_save.php?makeno="+makeno+"&photono="+photono+"&delete=1");
        $.ajax({
            url: './ajax_camera_save.php',
            type: 'GET',
            dataType: 'json',
            data: {
                "makeno": makeno,
                "photono" : photono,
                "delete" : 1
            }
        }).done(function(data) {
            alert('消去しました');
            location.reload();
        }).fail(function(data) {
            /* 通信失敗時 */
            alert('通信に失敗しました');
        });
    });


    
});
