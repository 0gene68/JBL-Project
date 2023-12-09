<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
  <link rel="stylesheet" href="{{ asset('css/team.css') }}">
  <link rel="stylesheet" href="{{ asset('css/players.css') }}">
</head>
<body>
        {{-- 로그인 헤더 --}}
        <div id="header">
            <div id="mainLogo">
                <a href="/">
                    <img src="storage/images/logos/NPB_logo.svg.png" alt="" id="logoImage">
                </a>    
            </div>
            <div id="wrap">
                <ul>
                    <a href="/">
                        <li>일정</li>
                    </a>
                    <a href="/">
                        <li>순위</li>
                        </a>
                        <a href="/teams">
                            <li>구단 · 선수</li>
                        </a>
                        <a href="/">
                            <li>N/A</li>
                        </a>
                        <a href="/">
                            <li>N/A</li>
                        </a>
                    </ul>
                    <ul>
                        <a href="/dashboard">
                            <li>마이페이지</li>
                        </a>
                        <li id="logout-btn">로그아웃</li>
                        <form id="logout-form" method="POST" action="{{ route('logout') }}">
                            @csrf
                        </form>
                    </ul>
                </nav>
            </div>
        </div>
    <div id="teamInfoContainer">
        <div>
            <img src={{$selectedTeam->logo}} alt="으악!" id="teamLogo" data-team-id="{{$team_id}}">
        </div>
        <div id="teamInfo">
            <h1>{{$selectedTeam->teamName}}</h1>
            <h4>창단 | {{$selectedTeam->foundationDate}}</h4>
            <h4>연고지 | {{$selectedTeam->hometown}}</h4>
            <h4 id="winNumber">일본시리즈 우승 | {{$selectedTeam->winNumber}}회 (
                @foreach ($championYears as $championYear)
                {{$championYear->championYear}}
                @endforeach
            )</h4>
            <a href={{$selectedTeam->homeStadiumLink}} id="homeStadium"><h4>▶ 홈구장 | {{$selectedTeam->homeStadium}}</h4></a>
            <a href="{{$selectedTeam->homepageLink}}" id="homepage">
                <h4>▶ 구단 홈페이지</h4>
            </a>
        </div>
    </div>
    <br>
    <div id="menus">
        <h2 id="player_info">등록 선수 정보</h2>
        <h2 id="comments">응원 댓글</h2>
        <h2 id="wait">N/A</h2>
    </div>
    {{-- <h2 id="toggle-title">등록 선수 정보</h2> --}}
    <div id="toggle-container">
        <h3 class="toggle-button">　투수</h3>
        <br>
        <div class="toggle-content">
            @foreach ($pitchers as $pitcher)
            <div class="box" onclick="openModal('{{$pitcher->backNumber}}', '{{$pitcher->name_kr}}', '{{$pitcher->name_jp}}', '{{$pitcher->birthDate}}', '{{$pitcher->position}}','{{$pitcher->throw_bat}}')">
                <img src="storage/images/{{$team_id}}/{{$team_id}}{{$pitcher->backNumber}}.jpg" class="player-image" alt="">
                <div>{{$pitcher->backNumber}} {{$pitcher->name_kr}}</div>
            </div>
            @endforeach
        </div>
        <br>
        <h3 class="toggle-button">　포수</h3>
        <br>
        <div class="toggle-content">
            @foreach ($catchers as $catcher)
            <div class="box" onclick="openModal('{{$catcher->backNumber}}', '{{$catcher->name_kr}}', '{{$catcher->name_jp}}', '{{$catcher->birthDate}}', '{{$catcher->position}}','{{$catcher->throw_bat}}')">
                <img src="storage/images/{{$team_id}}/{{$team_id}}{{$catcher->backNumber}}.jpg" class="player-image" alt="">
                <div>{{$catcher->backNumber}} {{$catcher->name_kr}}</div>
            </div>
            @endforeach
        </div>
        <br>
        <h3 class="toggle-button">　내야수</h3>
        <br>
        <div class="toggle-content">
            @foreach ($infielders as $infielder)
            <div class="box" onclick="openModal('{{$infielder->backNumber}}', '{{$infielder->name_kr}}', '{{$infielder->name_jp}}', '{{$infielder->birthDate}}', '{{$infielder->position}}','{{$infielder->throw_bat}}')">
                <img src="storage/images/{{$team_id}}/{{$team_id}}{{$infielder->backNumber}}.jpg" class="player-image" alt="">
                <div>{{$infielder->backNumber}} {{$infielder->name_kr}}</div>
            </div>
            @endforeach
        </div>
        <br>
        <h3 class="toggle-button">　외야수</h3>
        <br>
        <div class="toggle-content">
            @foreach ($outfielders as $outfielder)
            <div class="box" onclick="openModal('{{$outfielder->backNumber}}', '{{$outfielder->name_kr}}', '{{$outfielder->name_jp}}', '{{$outfielder->birthDate}}', '{{$outfielder->position}}','{{$outfielder->throw_bat}}')">
                <img src="storage/images/{{$team_id}}/{{$team_id}}{{$outfielder->backNumber}}.jpg" class="player-image" alt="">
                <div>{{$outfielder->backNumber}} {{$outfielder->name_kr}}</div>
            </div>
            @endforeach
        </div>
        <br>
        <h3 class="toggle-button">　육성선수</h3>
        <br>
        <div class="toggle-content">
            @foreach ($nurtures as $nurture)
            <div class="box" onclick="openModal('{{$nurture->backNumber}}', '{{$nurture->name_kr}}', '{{$nurture->name_jp}}', '{{$nurture->birthDate}}', '{{$nurture->position}}', '{{$nurture->throw_bat}}')">
                <img src="storage/images/{{$team_id}}/{{$team_id}}{{$nurture->backNumber}}.jpg" class="player-image" alt="">
                <div>{{$nurture->backNumber}} {{$nurture->name_kr}}</div>
            </div>
            @endforeach
        </div>
    </div>    
    <div id="modal-background" onclick="closeModal()">
        <div id="modal" class="modal"> 
            <div class="modal-content">
                <img src="" class="player-image" alt="">
                <div class="player-info">
                    <h1 id="name_kr"></h1>
                    <h4 id="name_jp"></h4>
                    <h4 id="birthDate"></h4>
                    <h4 id="position"></h4>
                    <h4 id="throw_bat"></h4>
                </div>
            </div>
        </div>
    </div>
    <div id="comment-container">
        <div>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Optio, delectus!</div>
        <div>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Optio, delectus!</div>
        <div>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Optio, delectus!</div>
        <form action="/comments" method="POST" id="comment_form" >
            @csrf
            <input type="hidden" name="team_id" value="{{$selectedTeam->team_id}}">
            <input type="text" name="content" id="comment_content" autocomplete="off" placeholder="댓글을 입력하세요">
            <input type="submit" value="등록" id="register_button">
        </form>
    </div>
    <div id="test3">
        <img src="storage/images/Baseball_diamond.jpg" alt="으악!" id="diamond_img">
    </div>
    <div id="footer" style="color: white"></div>
    <script src="{{ asset('js/playerList.js') }}"></script>
    <script src="{{ asset('js/team.js') }}"></script>
    <script src="{{ asset('js/logout.js') }}"></script>
</body>
</html>