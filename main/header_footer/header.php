<?php

    /*
        ../../root/session/outsession.php
        
    */

    /**
     * 
     */
    function gethaderhtml($ds , $sign_in_flug , $administrator_flug , $userid){

        if($sign_in_flug){
            //サインインしている
            
            $user_company = 'indei㈱';
            $user_name = '須藤　康成';


            if($administrator_flug){
                //管理者権限あり
                $admin_field = '<li><a class="dropdown-item" href="#">管理者設定</a></li>';

            }else{
                //管理者権限なし

                $admin_field = '';
            }



            $userfield = '
                <div class="nav-item dropdown">

                    <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        須藤　康成
                    </button>

                    <ul class="dropdown-menu dropdown-menu-dark">
                        '.$admin_field.'
                        <li><a class="dropdown-item" href="#">アカウント設定</a></li>
                        <li><a class="dropdown-item" href="#">個人設定</a></li>
                        <li><a class="dropdown-item" href="#">ユーザーヘルプ</a></li>
                        <li><a class="dropdown-item" href="#">ログアウト</a></li>
                    </ul>

                </div>';

            //検索フィールド
            $userfield .='
                <div class="form-inline my-2 my-lg-0" style="display: flex;">
                    <input class="form-control mr-sm-2" type="text" placeholder="フリー検索" aria-label="Search" style="margin-right: .5rem!important;">
                    <button class="btn btn-outline-light my-3 my-sm-0" type="submit">
                        Search
                    </button>
                </div>';     

        }else{
            //サインインしていない -> サインインフィールド表示

            $userfield = '
                <div class="form-inline my-2 my-lg-0" style="display: flex;">
                    <input class="form-control mr-sm-2" type="text" placeholder="ユーザーID" aria-label="Search" style="margin-right: .5rem!important; width:200px;">
                    <input class="form-control mr-sm-2" type="password" placeholder="パスワード" aria-label="Search" style="margin-right: .5rem!important; width:200px;">
                    <button class="btn btn-primary my-2 my-sm-0" type="submit" style=" margin-right: .5rem!important; min-width:80px;">
                        Sign in
                    </button>
                </div>';
        }

        //header生成
        $headerhtml = '
            <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top" style="padding: .5rem 1rem;">

                <a class="navbar-brand" href="#">FlowCore</a>
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsExampleDefault">

                    <ul class="navbar-nav mr-auto" style="margin-right: auto!important;">

                        <li class="nav-item active">
                            <a class="nav-link" href="#">'.$user_company.'</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">'.$user_name.'</a>
                        </li>

                    </ul>

                    '.$userfield.'

                    
                </div>

            </nav>';

        return $headerhtml;
    }


?>


