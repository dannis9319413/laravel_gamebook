<!DOCTYPE html>
<html lang="en">

<head>

    @include('web.layouts.head')

</head>

<body>

    @include('web.layouts.navbar')

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-12">
                <nav class="my-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('index')}}">首頁</a></li>
                        <li class="breadcrumb-item active" aria-current="page">關於我們</li>
                    </ol>
                </nav>
            </div>


            <div class="col-lg-12">

                <div class="row justify-content-center">

                    <div class="my-4 col-8 col-md-8 col-lg-4">
                        <div class="row">
                            <img src="../img/gamebook.png" alt="GAMEBOOK" style="width: 100%; height:auto;">
                        </div>
                    </div>

                    <ul class="my-4 ml-4 col-10 col-md-10 col-lg-5" style="list-style-type:none;">
                        <li>
                            <small>GAMEBOOK 提供整合遊戲平台，包括購買、販售、行銷、社群等等遊戲整合服務。
                            </small>
                        </li>
                        <br>
                        <li>
                            <small>遊戲開發商可以上架自身開發遊戲至GAMEBOOK，提供消費者購買及下載，也能透過GAMEBOOK行銷界面行銷，如最新消息專欄、關鍵字搜尋等等。

                            </small>
                        </li>
                        <br>
                        <li>
                            <small>消費者能在GAMEBOOK上輕鬆購買到遊戲，會員系統功能完善，能與其他玩家互相加入好友，並透過語音隨時約戰。能記錄玩家們的遊戲習慣，如遊戲時數、最喜愛的遊戲等等，並且能透過遊戲討論區與其他玩家交流遊戲資訊。

                            </small>
                        </li>

                    </ul>

                </div>
            </div>


        </div>

    </div>

    @include('web.layouts.footer')

</body>

</html>