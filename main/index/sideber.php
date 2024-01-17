<?php


    function sideber(){
        $sideber = '

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>問い合わせ</span>
            </h6>

            <ul class="nav flex-column">
                <li class="nav-item">
                    <a id="nav-link1" class="nav-link" href="#">
                        <button type="button" class="btn btn-success btn-sm">新規登録</button>
                    </a>
                </li>

                <li class="nav-item">
                    <a id="nav-link2" class="nav-link notice_field draft_field" href="#">
                        下書き中
                    </a>
                </li>

                <li class="nav-item">
                    <a id="nav-link3" class="nav-link notice_field no_answer_field" href="#">
                        未回答
                    </a>
                </li>

                <li class="nav-item">
                    <a id="nav-link4" class="nav-link notice_field yes_answer_field" href="#">
                        回答済
                    </a>
                </li>

            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>契約情報</span>
            </h6>

            <ul class="nav flex-column">

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        御見積一覧
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        契約済案件
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        契約終了案件
                    </a>
                </li>

            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>請求情報</span>
            </h6>
            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        請求書の確認
                    </a>
                </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>ユーザー情報</span>
            </h6>
            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        ユーザー一覧
                    </a>
                </li>
            </ul>
        ';



        return $sideber;
    }

?>