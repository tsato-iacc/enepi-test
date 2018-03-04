<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?= Html::meta($meta); ?>
  <title><?= $title; ?></title>

  <script>
    (function(i,s,o,g,r,a,m){
      i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)
      },
      i[r].l=1*new Date();
      a=s.createElement(o), m=s.getElementsByTagName(o)[0];
      a.async=1;
      a.src=g;
      m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-66015925-1', 'auto');
    ga('send', 'pageview');
  </script>


  <script type="text/javascript">
    window._pt_lt = new Date().getTime();
    window._pt_sp_2 = [];
    _pt_sp_2.push('setAccount,1498b80c');
    var _protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
    (function() {
        var atag = document.createElement('script'); atag.type = 'text/javascript'; atag.async = true;
        atag.src = _protocol + 'js.ptengine.jp/pta.js';
        var stag = document.createElement('script'); stag.type = 'text/javascript'; stag.async = true;
        stag.src = _protocol + 'js.ptengine.jp/pts.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(atag, s); s.parentNode.insertBefore(stag, s);
    })();
  </script>


  <!-- Yahoo Code for your Target List -->
  <script type="text/javascript" language="javascript">
    /* <![CDATA[ */
    var yahoo_retargeting_id = 'OHJ9T2SB5Y';
    var yahoo_retargeting_label = '';
    var yahoo_retargeting_page_type = '';
    var yahoo_retargeting_items = [{item_id: '', category_id: '', price: '', quantity: ''}];
    /* ]]> */
  </script>
  <script type="text/javascript" language="javascript" src="https://b92.yahoo.co.jp/js/s_retargeting.js"></script>
  <!-- Yahoo Code for your Target List END-->


  <!-- YDN -->
  <script type="text/javascript">
    /* <![CDATA[ */
    var google_conversion_id = 835778474;
    var google_custom_params = window.google_tag_params;
    var google_remarketing_only = true;
    /* ]]> */
  </script>
  <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
  </script>
  <noscript>
    <div style="display:inline;">
      <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/835778474/?guid=ON&amp;script=0"/>
    </div>
  </noscript>
  <!-- YDN END -->


  <!-- Facebook Pixel Code -->
  <script>
    !function(f,b,e,v,n,t,s){
      if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)
      };
      if(!f._fbq)f._fbq=n;
      n.push=n;n.loaded=!0;
      n.version='2.0';
      n.queue=[];t=b.createElement(e);
      t.async=!0;
      t.src=v;
      s=b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t,s)
    }(window, document,'script', 'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '593069570863388');
    fbq('track', 'PageView');
  </script>
  <noscript>
    <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=593069570863388&ev=PageView&noscript=1"/>
  </noscript>
  <!-- End Facebook Pixel Code -->


  <script src="https://ca.iacc.tokyo/js/ca.js"></script>
  <script>capv();</script>

  <?= render('shared/google_tag_manager'); ?>

</head>

<?= render('shared/google_tag_manager_noscript.php'); ?>

<body id="top" class="lp-001">
  <div class="navigation-wrapper">
    <div class="navigation navigation-inverse">
      <div class="navigation-inner">
        <div class="navigation-collapse">
          <ul class="nav">
            <li><a href="#trouble">こんなガスのお悩み、ありませんか？</a></li>
            <li><a href="#three-reason">エネピが選ばれている、3つの理由</a></li>
            <li><a href="#results-sample">LPガス変更の流れ</a></li>
            <li><a href="#user-voice">お客様の声</a></li>
            <li><a href="#qa">よくあるご質問</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <header>
    <div class="container">
      <? if($_SERVER['FUEL_ENV'] != \Fuel::PRODUCTION){ ?>
        <div style="padding: 0.4em; background-color: #EFEFEF;">
          <?//= MyView::form_tag url_for, ["method" => 'GET' { ?>
            (<?//= Rails.env ?>) 経由元: <?//= pr_tracking_parameter.try(:name) || "無し" ?>
            デバッグ用: <?//= text_field_tag :now, @now, ["class" => 'datepicker' ?> 10:31
            <?//= submit_tag '現在時刻を変更' ?>
          <?// } ?>
        </div>
      <? } ?>

      <div class="logo-lp"></div>
      <div class="tel">
        <span class="number">0120-771-664</span>
        <p class="supply">受付時間：10:00-20:00まで</p>
      </div>
    </div>

    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
    <?= Asset::js('bootstrap.min.js'); ?>

    <?= Asset::css('lp.css'); ?>
    <?= Asset::js('lp.js'); ?>

    <style>
      .lp-001 header .logo-lp {
        background-image: url("/assets/images/logo.png");
      }

      .lp-001 .mainview .inner {
        background-image: url("/assets/images/lp/001/mainview-img.png");
      }

      @media (max-width: 767px){
        .lp-001 .mainview .inner{background-image:none;overflow:hidden;text-align:center}
      }

      .lp-001 .flow-list dd {
        height: auto;
      }
    </style>

  </header>

  <!-- Mainview ================================================== -->
  <div class="mainview">
    <div class="container">
      <div class="inner">
        <div class="hidden_pc" style="margin-top: 40px;">
          <h1 class="fadeInDown">
            <?= MyView::image_tag("lp/001/catch/catch_mainview07.png", ["alt" => "簡単3分！ガス料金を徹底比較！"]); ?>
          </h1>
        </div>
        <div class="hidden_sp">
          <h1 class="fadeInDown">
            <?= MyView::image_tag("lp/001/catch-sp/catch_mainview07.png", ["alt" => "簡単3分！ガス料金を徹底比較！"]); ?>
          </h1>
        </div>
        <a <?= MyView::link_to('/lpgas_contacts/new_form', ["class" => "btn btn-large btn-estimate"]); ?> >
          無料一括見積もり依頼はこちら
        </a>
      </div>
    </div>
  </div>

  <div class="bk-white" id="trouble" name="trouble">
    <div class="container marketing">
      <div class="row">
         <h2 class="maintitle-contents ttl-orange">こんなガスのお悩み、ありませんか？</h2>
        <div class="trouble-box">
          <ul class="trouble-list">
            <li>毎月のガス料金が高い！</li>
            <li>ガス会社の担当者の対応が良くない</li>
            <li>本当はガス会社を切り替えたいけど、直接伝えるのはちょっと面倒…</li>
          </ul>
        </div>
        <div class="trouble-img">
          <?= MyView::image_tag("lp/001/trouble-img.png"); ?>
        </div>
      </div><!-- /.row -->
    </div>
  </div>

  <div class="bk-orange" id="three-reason" name="three-reason">
    <div class="container marketing">
      <div class="row">
        <h2 class="maintitle-contents ttl-orange">エネピが選ばれている、3つの理由</h2>
        <div class="reason-box">
          <?= MyView::image_tag("lp/001/img-reason1.png"); ?>
          <h3>比較するから<br>安くできる！</h3>
          <p>見積もりを比較することで、料金は安くなり、より安心して選択していただくことができます。</p>
          <p>特定のガス会社に偏らない、中立な立場で運営しているエネピだからこそできるのです。</p>
        </div>
        <div class="reason-box">
          <?= MyView::image_tag("lp/001/img-reason2.png"); ?>
          <h3>厳選したLPガス会社を<br>ご紹介</h3>
          <p>LPガス会社は、全国に20,000社以上も存在します。</p>
          <p>エネピがご紹介する会社は、「会社の信頼性」、「適正なガス料金価格」、「保安体制を含めたサービス内容」といった3つの基準から、加盟企業を厳選しています。</p>
        </div>
        <div class="reason-box">
          <?= MyView::image_tag("lp/001/img-reason3.png"); ?>
          <h3>カスタマーサポートによる<br>完全個別対応</h3>
          <p>エネピは、複数のガス会社から見積もりを受け取り、お客様にご納得いただける意思決定をしていただくまで様々なご相談に親身にお受けしています。</p>
          <p>もちろん、お見積もり結果にご納得頂けない場合は、遠慮なくお断りください！</p>
        </div>
      </div><!-- /.row -->
      <div class="cta-area-top">
        <p>光熱費が最もかかる冬をお得に乗り越えるために…！<br><span>無料で一番安いLPガス会社を見つけよう！！</span></p>
        <a <?= MyView::link_to('/lpgas_contacts/new_form', ["class" => "btn btn-large btn-estimate"]); ?> >
          無料一括見積もり依頼はこちら
        </a>
      </div>
    </div>
  </div>

  <div class="bk-white" id="results-sample" name="results-sample">
    <div class="container marketing">
      <div class="row">
        <h2 class="maintitle-contents ttl-orange">LPガス変更の流れ</h2>
        <div class="estimate-simulation">
          <?= MyView::image_tag("lp/001/img-estimate-simulation.jpg"); ?>
        </div>
        <h2 class="maintitle-contents">LPガス会社の変更は<br>すべてエネピと新ガス会社が代行します</h2>
      </div>
      <div class="row">
        <div class="flow-list-area">
          <dl class="flow-list">
            <dt>STEP1<br>ガス会社探しを依頼</dt>
            <dd><p>お電話またはお問い合わせフォーム（メール）にて、エネピにご依頼ください。<span>（お客様）</span></p></dd>
          </dl>
          <div class="below-arrow"></div>
          <dl class="flow-list">
            <dt>STEP2<br>優良ガス会社をご紹介</dt>
            <dd><p>お客様の条件（配送エリア、料金等）を満たす優良ガス会社から複数の見積もりを取り、見積もり結果をお客様にご案内します。<span>（エネピ　カスタマーサポート）</span></p></dd>
          </dl>
          <div class="below-arrow"></div>
          <dl class="flow-list">
            <dt>STEP3<br>新ガス会社を選択</dt>
            <dd><p>お見積もりを比較して、もっとも納得のいくガス会社をお選びください。なお、現在ご利用中のガス会社には、お客様より解約の連絡をして頂く必要はありません。新ガス会社が連絡を代行します。<span>（お客様）</span></p></dd>
          </dl>
          <div class="below-arrow"></div>
          <dl class="flow-list">
            <dt>STEP4<br>電話連絡&amp;訪問打ち合わせ</dt>
            <dd><p>新ガス会社よりお客様に直接ご連絡が入ります。お電話およびご訪問でのお打ち合わせの上、新ガス会社より最終的なお見積もりが提出されます。<span>（新ガス会社）</span></p></dd>
          </dl>
          <div class="below-arrow"></div>
          <dl class="flow-list">
            <dt>STEP5<br>申込書にサイン</dt>
            <dd><p>新ガス会社より、ガスの状況確認やガス料金の説明を受け、納得できたら申込書に署名・捺印をお願いします。この申込書は、現在のガス会社に対する解約手続きを兼ねています。<span>（お客様）</span></p></dd>
          </dl>
          <div class="below-arrow"></div>
          <dl class="flow-list">
            <dt>STEP6<br>ボンベとメーターを交換し<br>新会社で利用開始</dt>
            <dd><p>申込書が現在のガス会社に到着した日から約１週間後に、ガスボンベとメーターを交換する工事を行います（切替工事）。所用時間は、30分から1時間程です。切替工事が完了し、点火テストが済めば、すぐにご利用いただけます！<span>（新ガス会社）</span></p></dd>
          </dl>
        </div>
      </div><!-- /.row -->
      <div class="cta-area">
        <p>光熱費が最もかかる冬をお得に乗り越えるために…！<br><span>無料で一番安いLPガス会社を見つけよう！！</span></p>
        <a <?= MyView::link_to('/lpgas_contacts/new_form', ["class" => "btn btn-large btn-estimate"]); ?> >
          無料一括見積もり依頼はこちら
        </a>
      </div>
    </div>
  </div>

  <div class="bk-orange" id="user-voice" name="user-voice">
    <div class="container marketing">
      <div class="row">
        <h2 class="maintitle-contents ttl-orange">お客様の声</h2>

        <div class="user-voice-box-area">
          <div class="user-voice-box">
            <h3>相見積もりで、ガス料金が<br>すごく安くなりました！</h3>
            <div class="thumb">
              <?= MyView::image_tag("lp/001/img-voice04.png"); ?>
            </div>
            <p>もう少しガス料金が安くならないかな…と思い、試しに見積もり依頼をしてみました。結果的に、3社のプロパンガス会社の見積もりをもらい、納得して選ぶことができました。半額近くの料金になり、とても満足しています。</p>
            <p class="user-profile">東京都/40代　女性</p>
          </div>
        </div>

        <div class="user-voice-box-area">
          <div class="user-voice-box">
            <h3>ガス会社を変えられるとは<br>知りませんでした。</h3>
            <div class="thumb">
              <?= MyView::image_tag("lp/001/img-voice02.png"); ?>
            </div>
            <p>もう20年近く同じプロパンガス会社を利用していたので、ガス会社を変えられると知ってビックリしました。実際に変えてみて、ガス料金はとても安くなりましたし、こんなに簡単に変えられると分かってまたビックリしました！</p>
            <p class="user-profile">宮城県/50代　男性</p>
          </div>
        </div>

        <div class="user-voice-box-area">
          <div class="user-voice-box">
            <h3>カスタマーサポートが丁寧に<br>説明してくれてよかったです。</h3>
            <div class="thumb">
              <?= MyView::image_tag("lp/001/img-voice03.png"); ?>
            </div>
            <p>エネピのカスタマーサポートの人が、分かりやすく丁寧に説明してくれたため、新しいガス会社にスムーズに切り替えることができました。ガス会社と個別に話す必要がなく、大変効率が良かったです。</p>
            <p class="user-profile">福岡県/40代　男性</p>
          </div>
        </div>

        <div class="user-voice-box-area">
          <div class="user-voice-box">
            <h3>かんたんに見積もり依頼が<br>できました。</h3>
            <div class="thumb">
              <?= MyView::image_tag("lp/001/img-voice01.png"); ?>
            </div>
            <p>入力項目がわかりやすく、スマートフォンから簡単に見積もりできました。わからない項目もあったのですが、カスタマーサポートの人が後で電話で説明してくれたので大丈夫でした。</p>
            <p class="user-profile">青森県/30代　女性</p>
          </div>
        </div>
      </div><!-- /.row -->

      <p class="notes">お客様の声はあくまでも個人の感想です。実際のサービスご利用にあたり、感じ方には個人差があります。</p>
    </div>
  </div>

  <div class="bk-white" id="qa" name="qa">
    <div class="container marketing">
      <div class="row">

        <h2 class="maintitle-contents ttl-orange">よくあるご質問</h2>
        <div class="span12">
          <dl class="qa-list">
            <dt>
              <h3><span>【Q】</span>LPガスは、電気代や都市ガスのような公共料金ではないの？</h3>
            </dt>
            <dd>
              <h4><span>【A】</span>公共料金ではありません。</h4>
              <p>電気料金や都市ガス料金は、いわゆる公共料金という位置づけになるので、契約会社によって極端に料金が高くなったり安くなったりはせず、料金が値上げする場合もちゃんと事前に告知され、使用単価も明確に表記されています。</p>

              <p>一方LPガスの料金は、ガス会社によって、基本料金も使用する単価もすべて自由に決められるので、地域や業者によって、料金に開きがあり、安い単価と比較すると、3倍以上の料金になる場合もあります。</p>
            </dd>
            <dt>
              <h3><span>【Q】</span>うちのガス料金って高いと思うけど、相場はいくらくらいなの？</h3>
            </dt>
            <dd>
              <h4><span>【A】</span>地域や使用量によって異なります。</h4>
              <p>ガス料金には、基本料金＋従量料金（使った分だけ払う料金）で構成されていますが、基本料金も従量料金も業者によってかなり開きがあります。全国平均で見ると基本料金は一戸建て住宅の場合1,600～1,800円前後で、従量単価は300～500円前後になっていて、これが集合住宅の場合は、基本料金、従量料金共に１割程度高くなります。</p>

              <p>配送コストが安い関東方面の料金は平均値よりも安めで、逆に配送コストがかかる北海道・東北・九州などは高めになっている傾向があります。基本料金や従量料金の単価は、料金表には記載していない業者が実際はかなり多いので、はっきり内訳がわからない場合は、まずはenepiお客様サポートにお問い合わせください。</p>
            </dd>
            <dt>
              <h3><span>【Q】</span>他の業者さんに変えると料金は安くなるの？</h3>
            </dt>
            <dd>
              <h4><span>【A】</span>安くなる可能性が高いです。</h4>
              <p>もともとＬＰガス料金は自由化されていて、適正価格を知らずに高い料金を払っていたり、気づかないうちに値上げされていたりするケースは非常に多くあり、それが業者を変えることで適正価格よりもさらに安く契約する事が出来ます。</p>
            </dd>
            <dt>
              <h3><span>【Q】</span>今の業者さんに価格交渉して安くしてもらってはダメなの？</h3>
            </dt>
            <dd>
              <h4><span>【A】</span>信頼できるガス会社かどうか、見極めが必要です。</h4>
              <p>価格交渉すれば、業者さんによっては安くしてくれるところはありますが、業者さんの料金に対する考え方や、他のお客さんへの公平性を考えると、あまり好んでは値下げには応じてくれないケースが多くあります。一次出来に料金が値下げされたとしても、途中から様々な理由によって値上げされる可能性は高く、はじめから長期的に安い料金で提供してくれる業者さんとの契約の方がお得です。</p>
            </dd>
            <dt>
              <h3><span>【Q】</span>集合住宅に住んでいる場合も簡単に変更できるの？</h3>
            </dt>
            <dd>
              <h4><span>【A】</span>大家さんの了承が必要です。</h4>
              <p>アパートやマンションなどの集合住宅の場合は、大家さんがまとめて業者さんと契約している場合がほとんどなので、まずは大家さんに相談してみることが必要です。直接個人が安い業者さんとの契約は出来なくても、大家さんに安い業者さんと契約するように勧めてみて、うまく安い業者さんと大家さんが契約してくれれば、自分の所のガス料金が安くなることも可能です。</p>
            </dd>
            <dt>
              <h3><span>【Q】</span>ガス会社を変更すると設備の変更などは必要なの？</h3>
            </dt>
            <dd>
              <h4><span>【A】</span>ガスボンベとメーターのみ変更します。</h4>
              <p>建物の外にあるガスボンベと、使用量を確認するメーターの差し替えの作業が必要になります。ガス給湯器やガスコンロを使用している場合は、今使っている物を継続してそのまま使うことが出来るので、長時間の作業や大がかりの工事などは不要です。差し替えの工事の時間もおよそ30分程度なので、その間に契約書の記載をしていると、すべての手続きはそれだけで完了します。</p>
            </dd>
            <dt>
              <h3><span>【Q】</span>都市ガスは切替することができるの？</h3>
            </dt>
            <dd>
              <h4><span>【A】</span>申し訳ございません。現時点ではできません。</h4>
              <p>LPガス（プロパンガス）は既に小売自由化されていますが、都市ガスは2017年4月より小売全面自由化される予定です。enepiでは、そのタイミングで都市ガスの切替サービスを開始する予定ですので、ご期待ください。</p>
            </dd>
          </dl>
          <div class="cta-area-bottom">
            <p>光熱費が最もかかる冬をお得に乗り越えるために…！<br><span>無料で一番安いLPガス会社を見つけよう！！</span></p>
            <a <?= MyView::link_to('/lpgas_contacts/new_form', ["class" => "btn btn-large btn-estimate"]); ?> >
              無料一括見積もり依頼はこちら
            </a>
          </div>
        </div><!-- /.row -->
      </div>
    </div>

    <!-- FOOTER -->
    <footer class="footer-area">
      <ul>
        <li><a data-toggle="modal" data-target="#privacy_modal">利用規約</a></li>
        <li><a href="http://www.iacc.co.jp/privacy/" target="_blank">プライバシーポリシー</a></li>
        <li class="last"><a href="http://www.iacc.co.jp/" target="_blank">運営会社</a></li>
      </ul>
    </footer>

  </div><!-- /.container -->

  <div class="top-scroll">
    <a href="#top">
      <?= MyView::image_tag("lp/001/scrolltop-icon.png"); ?>
    </a>
  </div>

  <?= render("shared/lp_footer_privacy") ?>

  <?//// /lp/001 でクロスマーケのCVタグを表示 ?>
  <?// if pr_tracking_parameter.try(:name) == "xmarke" ?>
    <?//= conversion_MyView::image_tag("https://rsch.jp/common/prom/connectlpimg.php?eqid=8def6277d77504dbc3b8bbaf8e447c56546cb41c&po=0022" ?>
  <?// } ?>

  <?//// https://iacc.backlog.jp/view/RSD-1132 ?>
  <?//= render 'shared/yahoo_retargeting' ?>
  <?//= render 'shared/google_remarketing' ?>
</body>
</html>
