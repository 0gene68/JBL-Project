<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>JBL</title>
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
  <link rel="stylesheet" href="{{ asset('css/team.css') }}">
  <link rel="stylesheet" href="{{ asset('css/players.css') }}">
</head>
<body>
    {{-- 로그인 헤더 --}}
    <div id="header">
        <div id="mainLogo">
            <a href="/">
                <img src="storage/images/logos/projectLogo.png" alt="" id="logoImage">
            </a>    
        </div>
        <div id="wrap">
            <ul>
                <a href="/league">
                    <li>NPB 리그</li>
                </a>
                <a href="/rank">
                    <li>순위</li>
                </a>
                <a href="/teams">
                    <li>구단 · 선수</li>
                </a>
                <a href="/board">
                    <li>게시판</li>
                </a>
            </ul>
            <ul>
              <a href="/dashboard">
                <li id="userName">{{$user->name}}</li>
              </a>
              <li id="logout-btn">로그아웃</li>
              <form id="logout-form" method="POST" action="{{ route('logout') }}">
                @csrf
              </form>
            </ul>
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
    <h2 id="player-info">등록 선수 정보</h2>
    <div id="toggle-container">
        <h3 class="toggle-button">　투수</h3>
        <br>
        <div class="toggle-content">
            @foreach ($pitchers as $pitcher)
            <div class="box" onclick="openModal('{{$pitcher->backNumber}}', '{{$pitcher->name_kr}}', '{{$pitcher->name_jp}}', '{{$pitcher->birthDate}}', '{{$pitcher->position}}', '{{$pitcher->throw_bat}}', '{{$pitcher->origin}}')">
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
            <div class="box" onclick="openModal('{{$catcher->backNumber}}', '{{$catcher->name_kr}}', '{{$catcher->name_jp}}', '{{$catcher->birthDate}}', '{{$catcher->position}}','{{$catcher->throw_bat}}', '{{$catcher->origin}}')">
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
            <div class="box" onclick="openModal('{{$infielder->backNumber}}', '{{$infielder->name_kr}}', '{{$infielder->name_jp}}', '{{$infielder->birthDate}}', '{{$infielder->position}}','{{$infielder->throw_bat}}', '{{$infielder->origin}}')">
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
            <div class="box" onclick="openModal('{{$outfielder->backNumber}}', '{{$outfielder->name_kr}}', '{{$outfielder->name_jp}}', '{{$outfielder->birthDate}}', '{{$outfielder->position}}','{{$outfielder->throw_bat}}', '{{$outfielder->origin}}')">
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
            <div class="box" onclick="openModal('{{$nurture->backNumber}}', '{{$nurture->name_kr}}', '{{$nurture->name_jp}}', '{{$nurture->birthDate}}', '{{$nurture->position}}', '{{$nurture->throw_bat}}', '{{$nurture->origin}}')">
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
                    <h4 id="origin"></h4>
                </div>
            </div>
        </div>
    </div>
    {{-- 푸터 --}}
    <div id="footer">
        <div id="teamHomepageLinks">
            <div id="centralTeams">
                @foreach ($centralTeams as $centralTeam)
                    <a href="{{$centralTeam->homepageLink}}">
                        <img src="storage/images/logos/{{$centralTeam->team_id}}.svg" alt="꽥!" class="teamLogos">
                    </a>
                @endforeach                    
            </div>
            <div id="pacificTeams">
                @foreach ($pacificTeams as $pacificTeam)
                    @if ($pacificTeam->team_id == 'Fighters')
                        <a href="{{$pacificTeam->homepageLink}}">
                            <img src="storage/images/logos/{{$pacificTeam->team_id}}.png" alt="꽥!" class="teamLogos">
                        </a>
                    @else
                        <a href="{{$pacificTeam->homepageLink}}">
                            <img src="storage/images/logos/{{$pacificTeam->team_id}}.svg" alt="꽥!" class="teamLogos">
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
        
        <div>* 모든 선수 정보는 2023 시즌 기준입니다.</div><br>
        <div>* 아이디어 제공: 
            <a href="https://npb.jp/">▶ NPB 사이트</a>
        </div>
    </div>
    <script src="{{ asset('js/playerList.js') }}"></script>
    <script src="{{ asset('js/team.js') }}"></script>
    <script src="{{ asset('js/logout.js') }}"></script>
</body>
</html>