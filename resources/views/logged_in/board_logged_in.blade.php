<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>JBL</title>
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
  <link rel="stylesheet" href="{{ asset('css/board.css') }}">
</head>
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
  <div id="board_container">
    <h1>게시판</h1>
    <span>좋아하는 팀을 응원해보세요!</span>
    <div id="post-container">
      <select name="team" id="select">
        <option selected>팀을 선택하세요</option>
        <option value="한신">한신 타이거즈</option>
        <option value="오릭스">오릭스 버팔로즈</option>
        <option value="히로시마">히로시마 도요 카프</option>
        <option value="롯데">치바 롯데 마린즈</option>
        <option value="DeNA">요코하마 DeNA 베이스타즈</option>
        <option value="소프트뱅크">후쿠오카 소프트뱅크 호크스</option>
        <option value="요미우리">요미우리 자이언츠</option>
        <option value="라쿠텐">도호쿠 라쿠텐 골든이글스</option>
        <option value="야쿠르트">도쿄 야쿠르트 스왈로즈</option>
        <option value="세이부">사이타마 세이부 라이온즈</option>
        <option value="주니치">주니치 드래곤즈</option>
        <option value="닛폰햄">홋카이도 닛폰햄 파이터즈</option>
      </select>
      <div id="post_title">
        <span class="team">응원팀</span>
        <span class="title">제목</span>
        <span class="writer">작성자</span>
        <span class="created_at">작성일자</span>
      </div>
      @foreach ($posts as $post)
        <div class="post">
          <span class="team">{{$post->team}}</span>
          <span class="title">{{$post->title}}</span>
          <span class="writer">{{$post->user_name}}</span>
          <span class="created_at">{{\Carbon\Carbon::parse($post->created_at)->format('Y-m-d')}}</span>
          <button id="show_post" onclick="openModal('{{$post->title}}', '{{$post->team}}', '{{$post->content}}', '{{$post->user_name}}', '{{\Carbon\Carbon::parse($post->created_at)->format('Y-m-d')}}')">상세</button>
          @if ($user->name == $post->user_name)
            <button class="modify_post" onclick="openModalModify('{{$post->id}}', '{{$post->title}}', '{{$post->team}}', '{{$post->content}}')">수정</button>
            <button type="submit" id="delete_post">삭제</button>
            <form action="/posts/{{$post->id}}" method="POST" id="delete_form">
              @csrf
              @method('DELETE')
            </form>          
          @endif
        </div>
      @endforeach
      <br>
      <div style="display: none" id="isLoggedIn">{{$isLoggedIn}}</div>
        <a href="/create_post" id="create_post_link">
          <button id="create_post_button">글 작성</button>
        </a> 
      </div>
    </div>
    <div id="modal-info-background">
      <div class="modal"> 
        <div class="modal-content">
          <div class="post-info">
            <span id="title"></span>
            <span id="created_at"></span>
          </div>
          <hr>
          <div class="post-info">
            <span id="team"></span>
            <span id="writer"></span>
          </div>
          <hr>
          <h4 id="content"></h4>
          <hr>
        </div>
      </div>
    </div>
    <div id="modal-modify-background">
      <div class="modal"> 
        <div class="modal-content">
          <div id="modify_post_container">
            <div id="modify-post-title">게시글 수정</div><br>
            <form action="" method="post" id="modify-form">
                @csrf
                @method('PUT')
                <label for="title">제목</label>
                <input type="text" name="title" id="modify-title" autocomplete="off" required><br><br>
                <label for="team">응원팀</label>
                <select name="team" id="modify-select" required>
                    <option selected>팀을 선택하세요</option>
                    <option value="한신">한신 타이거스</option>
                    <option value="오릭스">오릭스 버팔로즈</option>
                    <option value="히로시마">히로시마 도요 카프</option>
                    <option value="롯데">치바 롯데 마린즈</option>
                    <option value="DeNA">요코하마 DeNA 베이스타즈</option>
                    <option value="소프트뱅크">후쿠오카 소프트뱅크 호크스</option>
                    <option value="요미우리">요미우리 자이언츠</option>
                    <option value="라쿠텐">도호쿠 라쿠텐 골든이글스</option>
                    <option value="야쿠르트">도쿄 야쿠르트 스왈로즈</option>
                    <option value="세이부">사이타마 세이부 라이온즈</option>
                    <option value="주니치">주니치 드래곤즈</option>
                    <option value="닛폰햄">홋카이도 닛폰햄 파이터즈</option>
                  </select><br><br>
                  <textarea name="content" id="modify-content" autocomplete="off" cols="76" rows="15" required></textarea><br>
                  <input type="submit" value="수정" id="modify-button">
            </form>
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

  <script src="{{ asset('js/board.js') }}"></script>
  <script src="{{ asset('js/logout.js') }}"></script>
  <script src="{{ asset('js/deletePost.js') }}"></script>
</body>
</html>