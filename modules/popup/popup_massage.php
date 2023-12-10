<script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/0.0.11/push.min.js"></script>
<script>
    function push(){
        Push.create("更新情報", 
        {
            body: "ブログの更新をお知らせします!",
            icon: '../../img/mass.png',
            timeout: 8000,
            onClick: function () {
            window.focus(); 
            this.close();
            }
        })
    }
</script>

<input type="button" id="push" onclick="return push()" value="クリックするとプッシュ通知が送られます">
