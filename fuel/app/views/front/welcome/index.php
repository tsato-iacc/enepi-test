<?
$new_simple_simulation_path = "";
$local_contents_path = "";
$articles_path = "";

?>
<?= render('front/estimate_form'); ?>

<style>
.cvb_btn:hover{
    opacity: 0.8;
}
</style>

<div class="panel" id="knowing">
  <div class="panel-inner">
    <div class="qa-box">
      <p>なぜ、ガス会社を切り替えるとおトクになれるのかご存知ですか？</p>
      <div class="inner">
        <a href="#knowing_chooser" class="btn orange-button btn-rounded orange-ico" onclick="ga('send', 'event', 'top-button', 'click', 'shitteiru', 1);"]);>知っている<span class="ico_arrow"></span></a>
        <a href="#reason" class="btn blue-button btn-rounded blue-ico" onclick="ga('send', 'event', 'top-button', 'click', 'shiranai', 1);"]);>知らない<span class="ico_arrow"></span></a>
      </div>
    </div>
  </div>
</div>

<div class="panel" id="knowing_chooser">
  <div class="panel-inner">
    <h2><span class="orange-color">「知っている」</span>方は<br>今より<?= Asset::img('welcome/img_otoku.png', ['class' => 'goodbuy-img']); ?>になれるこちらのメニューへ</h2>

    <div class="introduce_area">
    <?= MyView::link_to($new_simple_simulation_path, ["class" => "btn blue-button service-detail", "onclick" => "ga('send', 'event', 'top-button', 'click', 'simulation', 1);"]); { ?>
      <div class="text-area">プロパンガス料金<br>シミュレーション</div><?= MyView::image_tag(MyView::asset_url("top/bt_bg_simulation.png")); ?><div class="arrow-area"></div><? } ?>

      <h3 class="rec-title">こんな方にオススメ！</h3>
      <div class="rec-detail">
        <ul>
          <li>自分の家のガス代は高いのか安いのか知りたい</li>
        </ul>
      </div>
    </div>

    <div class="introduce_area">
      <?= MyView::link_to("Rails.application.config.form_path", ["class" => "btn orange-button service-detail", "onclick" => "ga('send', 'event', 'top-button', 'click', 'irai', 1);"]); { ?>
      <div class="text-area">おトクなガス会社へ<br>無料切り替え依頼</div><?= MyView::image_tag(MyView::asset_url("top/bt_bg_estimate.png")); ?><div class="arrow-area"></div><? } ?>

      <h3 class="rec-title">こんな方にオススメ！</h3>
      <div class="rec-detail">
        <ul>
          <li>今のガス代が高いので別の会社を紹介してほしい</li>
          <li>ガス会社の対応が悪いので別の会社にしたい</li>
          <li>支払い方法をカード払いにしたい</li>
        </ul>
      </div>
    </div>

    <div class="introduce_area">
      <?= MyView::link_to($local_contents_path, ["class" =>  "btn green-button service-detail", "onclick" =>  "ga('send', 'event', 'top-button', 'click', 'price-search', 1);"]); { ?>
        <div class="text-area">都道府県別<br>ガス料金を検索</div><?= MyView::image_tag(MyView::asset_url("top/br_bg_search.png")); ?><div class="arrow-area"></div>
      <? } ?>

      <h3 class="rec-title">こんな方にオススメ！</h3>
      <div class="rec-detail">
        <ul>
          <li>住んでいる地域のガス代が知りたい</li>
          <li>引越し先の地域の平均ガス代が知りたい</li>
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="panel" id="merit">
  <div class="panel-inner">
    <h2><span>enepi</span>でガス料金を比較する<span class="merit-txt">４つのメリット</span></h2>
    <ul>
      <li>
        <?= MyView::image_tag(MyView::asset_url("top/ico_merit1.png")); ?>
        <h3>切替手続き無料</h3>
        <p>お見積もり依頼からガス会社の切り替えまで費用は一切かかりません。</p>
      </li>
      <li>
        <?= MyView::image_tag(MyView::asset_url("top/ico_merit2.png")); ?>
        <h3>解約手続き不要</h3>
        <p>お客様からガス会社への解約手続きのご連絡は不要です。※一部地域を除く</p>
      </li>
      <li>
        <?= MyView::image_tag(MyView::asset_url("top/ico_merit3.png")); ?>
        <h3>仲介手数料無料</h3>
        <p>新しいガス会社へ切り替えをされても仲介手数料などは一切いただきません。</p>
      </li>
      <li>
        <?= MyView::image_tag(MyView::asset_url("top/ico_merit4.png")); ?>
        <h3>エネピ紹介特典あり</h3>
        <p>エネピならではのガス切り替え特典があります！</p>
      </li>
    </ul>
  </div>
</div>

<div class="panel" id="article">
  <div class="panel-inner">
    <h2>プロパンガスについて詳しくなる</h2>

    <div class="category-ttl-area">
      <div class="hidden_pc">
        <div class="category-ttl">記事カテゴリ</div>
      </div>
      <div class="hidden_sp">
        <div class="category-ttl-sp">記事カテゴリ</div>
      </div>

      <ul class="article-list-menu">
        <li><?= MyView::link_to('コラム',  "/categories/lpgas/column"); ?></li>
        <li><?= MyView::link_to('節約術', "/categories/lpgas/saving"); ?></li>
        <li><?= MyView::link_to('会社一覧', "/categories/lpgas/company_list"); ?></li>
        <li><?= MyView::link_to('基礎知識', "/categories/lpgas/knowledge"); ?></li>
        <li><?= MyView::link_to('見積もりのコツ', "/categories/lpgas/estimate"); ?></li>
        <li><?= MyView::link_to('すべての記事', $articles_path); ?></li>
      </ul>
    </div>

    <p class="lead">プロパンガス(LPガス)に関する気になる情報・知りたい情報はココでチェック！<br>これからプロパンガスの切り替えを検討している方は、「見積もりのコツ」を読むのがオススメです！</p>

    <ul>
      <a href="/categories/lpgas/column"><li class="curled-box"><i></i>
      <?= MyView::image_tag(MyView::asset_url("top/ico_article_01.png")); ?><p>プロパンガスの<br>コラム</p></li></a>
      <a href="/categories/lpgas/saving"><li class="curled-box"><i></i>
      <?= MyView::image_tag(MyView::asset_url("top/ico_article_02.png")); ?><p>プロパンガス<br>節約術</p></li></a>
      <a href="/categories/lpgas/company_list"><li class="curled-box"><i></i>
      <?= MyView::image_tag(MyView::asset_url("top/ico_article_03.png")); ?><p>プロパンガス<br>会社一覧</p></li></a>
    </ul>

    <ul class="lower">
      <a href="/categories/lpgas/knowledge"><li class="curled-box"><i></i>
      <?= MyView::image_tag(MyView::asset_url("top/ico_article_04.png")); ?><p>基礎<br>知識</p></li></a>
      <a href="/categories/lpgas/estimate"><li class="curled-box"><i></i>
      <?= MyView::image_tag(MyView::asset_url("top/ico_article_05.png")); ?><p>見積もりの<br>コツ</p></li></a>
      <a href="/categories/lpgas/"><li class="curled-box"><i></i>
      <?= MyView::image_tag(MyView::asset_url("top/ico_article_06.png")); ?><p>すべての<br>記事</p></li></a>
    </ul>
  </div>
</div>

<div class="panel" id="reason">
  <div class="panel-inner">
  <div class="blue-color center">＼なぜプロパンガス会社を切り替えるといいの？／</div>
    <h2>
    <span class="blue-color">「知らない」</span>方は<br><?= MyView::image_tag(MyView::asset_url("top/img_otoku.png"), ["class" => 'goodbuy-img']); ?>になれる<span class="blue-color">3つの理由</span>をご紹介！</h2>

    <h3><?= MyView::image_tag(MyView::asset_url("top/ttl_goodvalue-reason1.png"), ["alt" => 'おトクになれる3つの理由1']); ?></h3>
    <div class="inner-area">
      <p class="lead">適正なガス料金で提供してもらえる！</p>

    <div class="example-contents">
      <div class="box margin">
        <?= MyView::image_tag(MyView::asset_url("top/img_reason1-1.png")); ?>
        <h4>例えば「水」の場合…
        同じ商品なのにお店によって値段が違う！</h4>
        <p>プロパンガス(LPガス)もお店で売られているような商品と同じく、ガス料金をガス会社ごとに自由に決めることができる、「自由料金設定」になっています。
        そのためガス料金も業者によってバラつきが出ます。</p>
      </div>

      <div class="arrow1"><?= MyView::image_tag(MyView::asset_url("top/ico-reason-arrow.png")); ?></div>

      <div class="box margin">
        <h4>ガスの質と量はまったく同じ！</h4>
        <?= MyView::image_tag(MyView::asset_url("top/img_reason1-2.png")); ?>
        <p>毎月の請求するガス料金の決め方は様々ですが、一番多い請求方法は、「基本料金」と「ガスの使用量」の合計金額です。このガス使用量の1㎥に当たる単価が業者によって異なる場合が多く、毎月の請求額に差が出てきます。</p>
      </div>

      <div class="arrow2"><?= MyView::image_tag(MyView::asset_url("top/ico-reason-arrow.png")); ?></div>

      <div class="box">
        <h4>ひと月にほぼ同じ量のガスを使用したとして</h4>
        <?= MyView::image_tag(MyView::asset_url("top/img_reason1-3.png")); ?>
        <p>そのため、ほぼ同じくらいの使用量なのにお隣さんと毎月のガス代が5,000円以上違っている！なんてことが起こります。</p>
        <!--<a href="#">具体的にどれくらい安くなる？▶</a>-->
      </div>
    </div>

      <h3 class="danger-list-title">【こんな業者はあやしい？】料金を自由に決められるからこそ要注意！</h3>
      <div class="danger-list-box">
        <div class="inner">
          <?= MyView::image_tag(MyView::asset_url("top/ico-danger.png")); ?>
            <ul>
              <li>ガス使用量はあまり変わらないのに、料金がどんどん高くなっている気がする</li>
              <li>前に住んでいたところよりも高額な料金を請求される</li>
            </ul>
        </div>
      </div>
    </div>

    <h3><?= MyView::image_tag(MyView::asset_url("top/ttl_goodvalue-reason2.png"), ["alt" => 'おトクになれる3つの理由2']); ?></h3>

    <div class="inner-area margin">
      <p class="lead">いざという時に駆け付けて対応してもらえる</p>

      <div class="example-contents">
        <div class="box margin">
          <h4>例えばこんな場合...</h4>
          <?= MyView::image_tag(MyView::asset_url("top/img_reason2-1.png")); ?>
          <p>プロパンガス(LPガス)は自宅にガスボンベを設置し、そこから家庭へガスを供給します。ボンベの中のガスが切れるとガスは使用できなくなります。例えば、生活に必要不可欠なガスが切れた場合…</p>
        </div>

        <div class="arrow1"><?= MyView::image_tag(MyView::asset_url("top/ico-reason-arrow.png")); ?></div>

        <div class="box margin">
          <h4>管理体制が万全なガス会社の場合</h4>
          <?= MyView::image_tag(MyView::asset_url("top/img_reason2-2_1.png")); ?>
          <h4>管理体制が無いガス会社の場合</h4>
          <?= MyView::image_tag(MyView::asset_url("top/img_reason2-2_2.png")); ?>
          <p>緊急を要するのに、連絡がつかなくて困った！なんて思いはしたくないですよね。ガス切れ以外にも、ガス漏れ・ガス機具の消し忘れなどの緊急対応をする場合、すぐに駆けつけられるような体制が整っている業者なら安心です。</p>
        </div>

        <div class="arrow2"><?= MyView::image_tag(MyView::asset_url("top/ico-reason-arrow.png")); ?></div>

        <div class="box">
          <h4>管理体制が万全なガス会社と契約していれば...</h4>
          <?= MyView::image_tag(MyView::asset_url("top/img_reason2-3.png")); ?>
          <p>体制が整っている会社であれば、夜間や休日に起きた緊急事態にもすぐに対応してくれるので安心です。また、日頃ガス点検をしていない会社の場合は大事故に繋がる可能性もあるので、きちんとした会社に依頼することが大切です。</p>
        </div>
      </div>

      <h3 class="danger-list-title">【こんな業者はあやしい？】日々の対応が雑な業者は要注意！</h3>
      <div class="danger-list-box">
        <div class="inner">
          <?= MyView::image_tag(MyView::asset_url("top/ico-danger.png")); ?>
            <ul>
              <li>ガス切れをよくおこす</li>
              <li>緊急時に連絡が繋がらないことがあった</li>
              <li>毎月のガス使用量に関する通知がなく不明。</li>
            </ul>
        </div>
      </div>
    </div>

    <h3><?= MyView::image_tag(MyView::asset_url("top/ttl_goodvalue-reason3.png"), ["alt"=> 'おトクになれる3つの理由3']); ?></h3>

    <div class="inner-area margin">
      <p class="lead">ライフスタイルに合ったサービスを受けられる</p>

      <div class="example-contents">
        <div class="box margin">
          <?= MyView::image_tag(MyView::asset_url("top/img_reason3-1.png")); ?>
          <p>プロパンガス(LPガス)の場合、小さい販売店などのガス支払い方法は集金が主流であることが多いです。そのため、基本夜しかいない場合や外出をしたいときなどは不便に感じることが多くなります。</p>
        </div>

        <div class="arrow1"><?= MyView::image_tag(MyView::asset_url("top/ico-reason-arrow.png")); ?></div>

        <div class="box margin">
          <h4>サービスが充実している会社の場合</h4>
          <?= MyView::image_tag(MyView::asset_url("top/img_reason3-2_1.png")); ?>
          <h4>サービスが充実していない会社の場合</h4>
          <?= MyView::image_tag(MyView::asset_url("top/img_reason3-2_2.png")); ?>
          <p>支払い方法が集金のみしか対応できない会社に対して、カード支払い、振り込み、口座引き落としなど幅広く対応できるガス会社も多く存在します。</p>
        </div>

        <div class="arrow2"><?= MyView::image_tag(MyView::asset_url("top/ico-reason-arrow.png")); ?></div>

        <div class="box">
          <h4>サービスが充実している会社と契約していれば...</h4>
          <?= MyView::image_tag(MyView::asset_url("top/img_reason3-3.png")); ?>
          <p>支払い方法の種類が多い会社であれば自分のお金の管理方法に合わせて支払いができるので、便利ですよね。また、ポイントを貯められるサービスもあるので、有効活用できます。</p>
        </div>
      </div>

      <h3 class="danger-list-title">【こんなときは見直しを！】支払いや対応に不便や不満を感じている</h3>
      <div class="danger-list-box">
        <div class="inner">
          <?= MyView::image_tag(MyView::asset_url("top/ico-danger.png")); ?>
            <ul>
              <li>ガス切れをよくおこす</li>
              <li>緊急時に連絡が繋がらないことがあった</li>
              <li>毎月のガス使用量に関する通知がなく不明。</li>
            </ul>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="panel" id="price-change-example">
  <div class="panel-inner">

    <h2><div class="balloon-img"><span class="text">プロパンガス会社を切り替えると...</span></div>毎月のガス代はこれくらい変わる！</h2>
    <div class="hidden_sp">
      <dl class="case-area-sp">
        <dt class="title_case_two">2人暮らしの場合</dt>
        <dd class="contents_case_two">
          <?= MyView::image_tag(MyView::asset_url("top/img_case2.png")); ?>
          <?= MyView::image_tag(MyView::asset_url("top/img_price-compare-2.png")); ?>

          <p class="benefit-txt">1ヶ月だと<span class="amount">3,600円</span>おトクに！<br>1年間では<span class="yearly-amount">43,200円</span>おトクに！</p>

          <?= MyView::link_to($new_simple_simulation_path, ["class" =>  "simulation-button with-arrow-right-icon"]); { ?>
            <div class="text">
              <span class="main">料金シミュレーションをする！</span>
            </div>
          <? } ?>
        </dd>
      </dl>

      <dl class="case-area-sp">
        <dt class="title_case_four">4人暮らしの場合</dt>
        <dd class="contents_case_four">
          <?= MyView::image_tag(MyView::asset_url("top/img_case4.png")); ?>
          <?= MyView::image_tag(MyView::asset_url("top/img_price-compare-4.png")); ?>

          <p class="benefit-txt">1ヶ月だと<span class="amount">4,500円</span>おトクに！<br>1年間では<span class="yearly-amount">54,000円</span>おトクに！</p>

          <?= MyView::link_to($new_simple_simulation_path, ["class" =>  "simulation-button with-arrow-right-icon"]); { ?>
            <div class="text">
              <span class="main">料金シミュレーションをする！</span>
            </div>
          <? } ?>
        </dd>
      </dl>

      <dl class="case-area-sp">
        <dt class="title_case_six">6人暮らしの場合</dt>
        <dd class="contents_case_six">
          <?= MyView::image_tag(MyView::asset_url("top/img_case6.png")); ?>
          <?= MyView::image_tag(MyView::asset_url("top/img_price-compare-6.png")); ?>

          <p class="benefit-txt">1ヶ月だと<span class="amount">8,700円</span>おトクに！<br>1年間では<span class="yearly-amount">104,400円</span>おトクに！</p>
          <?= MyView::link_to($new_simple_simulation_path, ["class" =>  "simulation-button with-arrow-right-icon"]); { ?>
            <div class="text">
              <span class="main">料金シミュレーションをする！</span>
            </div>
          <? } ?>
        </dd>
      </dl>
    </div>

    <div class="hidden_pc">
    <table class="case-area" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th class="title_case_two">2人暮らしの場合</th>
        <th class="title_case_four">4人暮らしの場合</th>
        <th class="title_case_six">6人暮らしの場合</th>
      </tr>
      <tr>
        <td class="contents_case_two">
          <?= MyView::image_tag(MyView::asset_url("top/img_case2.png")); ?>
          <?= MyView::image_tag(MyView::asset_url("top/img_price-compare-2.png")); ?>

          <p class="benefit-txt">1ヶ月だと<span class="amount">3,600円</span><br>おトクに！
          1年間では<br><span class="yearly-amount">43,200円</span>おトクに！</p>

          <?= MyView::link_to($new_simple_simulation_path, ["class" =>  "simulation-button with-arrow-right-icon"]); { ?>
            <div class="text">
              <span class="main"> 料金シミュレーションをする！</span>
            </div>
          <? } ?>
        </td>
        <td class="contents_case_four">
          <?= MyView::image_tag(MyView::asset_url("top/img_case4.png")); ?>
          <?= MyView::image_tag(MyView::asset_url("top/img_price-compare-4.png")); ?>

          <p class="benefit-txt">1ヶ月だと<span class="amount">4,500円</span><br>おトクに！
          1年間では<br><span class="yearly-amount">54,000円</span>おトクに！</p>

          <?= MyView::link_to($new_simple_simulation_path, ["class" =>  "simulation-button with-arrow-right-icon"]); { ?>
            <div class="text">
              <span class="main"> 料金シミュレーションをする！</span>
            </div>
          <? } ?>
        </td>
        <td class="contents_case_six">
          <?= MyView::image_tag(MyView::asset_url("top/img_case6.png")); ?>
          <?= MyView::image_tag(MyView::asset_url("top/img_price-compare-6.png")); ?>

          <p class="benefit-txt">1ヶ月だと<span class="amount">8,700円</span><br>おトクに！
          1年間では<br><span class="yearly-amount">104,400円</span>おトクに！</p>
          <?= MyView::link_to($new_simple_simulation_path, ["class" =>  "simulation-button with-arrow-right-icon"]); { ?>
            <div class="text">
              <span class="main"> 料金シミュレーションをする！</span>
            </div>
          <? } ?>
        </td>
      </table>
    </div>
  </div>
</div>

<div class="panel" id="secure-reason">
  <div class="panel-inner">
    <h2><div class="arrow-box"><span class="blue-txt">enepi</span>で</div>
    プロパンガス会社を切り替えると<span class="yellow-txt">安心なワケ</h2>
    <ul>
      <li>
        <?= MyView::image_tag(MyView::asset_url("top/ico_reason1.png")); ?>
        <p>これまでのガス代よりも<br>おトクになれる業者を<br>ご紹介します。</p>
      </li>
      <li>
        <?= MyView::image_tag(MyView::asset_url("top/ico_reason2.png")); ?>
        <p>しっかりした対応を<br>してくれる業者のみの<br>ご紹介が出来ます。</p>
      </li>
      <li>
        <?= MyView::image_tag(MyView::asset_url("top/ico_reason3.png")); ?>
        <p>ガス会社への<br>切り替えが必要な連絡は<br>エネピが行います。</p>
      </li>
    </ul>
  </div>
</div>

<div class="panel" id="flow">
  <div class="panel-inner">
    <h2>プロパンガス会社を<br>新しく切り替えるまでの流れ</h2>
    <div class="hidden_pc">
      <div class="flow-box">
        <div class="flow1">
          <p>enepiに加盟している<br>ガス会社へ<br>無料見積もり依頼！</p>
        </div>
          <?= MyView::image_tag(MyView::asset_url("top/img_arrow_flow_right.png"), ["class" => 'icon-right']); ?>
        <div class="flow2">
          <p>後日見積り書をメールにて送付。サービスや料金面から比較検討し気になる会社を決定。</p>
        </div>
          <?= MyView::image_tag(MyView::asset_url("top/img_arrow_flow_right.png"), ["class" => 'icon-right']); ?>
        <div class="flow3">
          <p>新ガス会社が訪問。<br>最終的な見積り提出後、<br>納得できれば申込み。</p>
        </div>
      </div>
      <div class="flow-box">
        <div class="flow6">
          <p>点火テスト後、これまで通り<br>ガスの利用が可能に！</p>
        </div>
        <?= MyView::image_tag(MyView::asset_url("top/img_arrow_flow_left.png"), ["class" => 'icon-left']); ?>
        <div class="flow5">
          <p>工事日を決定。ガスボンベと<br>メーターの切り替え工事<br>工事は30分〜1時間程度</p>
        </div>
        <?= MyView::image_tag(MyView::asset_url("top/img_arrow_flow_left.png"), ["class" => 'icon-left']); ?>
        <div class="flow4">
          <p>現ガス会社と新ガス会社の<br>交渉・調整はenepiが対応！</p>
        </div>
      </div>
    </div>

    <div class="hidden_sp">
      <div class="flow-box">
        <div class="flow1">
          <p>enepiに加盟している<br>ガス会社へ<br>無料見積もり依頼！</p>
        </div>
          <?= MyView::image_tag(MyView::asset_url("top/img_arrow_flow_under.png"), ["class" => 'icon-bottom']); ?>
        <div class="flow2">
          <p>後日見積り書をメールにて送付。<br>サービスや料金面から比較検討し<br>気になる会社を決定。</p>
        </div>
          <?= MyView::image_tag(MyView::asset_url("top/img_arrow_flow_under.png"), ["class" => 'icon-bottom']); ?>
        <div class="flow3">
          <p>新ガス会社が訪問。<br>最終的な見積り提出後、<br>納得できれば申込み。</p>
        </div>
          <?= MyView::image_tag(MyView::asset_url("top/img_arrow_flow_under.png"), ["class" => 'icon-bottom']); ?>
        <div class="flow4">
          <p>現ガス会社と新ガス会社の<br>交渉・調整はenepiが対応！</p>
        </div>
          <?= MyView::image_tag(MyView::asset_url("top/img_arrow_flow_under.png"), ["class" => 'icon-bottom']); ?>
        <div class="flow5">
          <p>工事日を決定。ガスボンベと<br>メーターの切り替え工事<br>工事は30分〜1時間程度</p>
        </div>
          <?= MyView::image_tag(MyView::asset_url("top/img_arrow_flow_under.png"), ["class" => 'icon-bottom']); ?>
        <div class="flow6">
          <p>点火テスト後、これまで通り<br>ガスの利用が可能に！</p>
        </div>
      </div>
    </div>

  </div>
</div>

<div class="panel" id="qa">
  <div class="panel-inner">
    <h2>プロパンガスにまつわる<?= MyView::image_tag(MyView::asset_url("top/ico_q.png"), ["class" => 'q-circle', "alt"=> 'Q']); ?>&<?= MyView::image_tag(MyView::asset_url("top/ico_a.png"), ["class" => 'a-circle', "alt"=> 'A']); ?></h2>
    <div id="accordion" class="accordionbox">
      <dl class="accordionlist">
        <dt class="clearfix">
          <h3 class="title"><i><?= MyView::image_tag(MyView::asset_url("top/ico_q.png")); ?></i>プロパンガスとLPガスは同じガスなの？</h3>
          <p class="accordion_icon active">
            <span></span><span></span>
          </p>
        </dt>
        <dd style="display: block;">
          <h4><i><?= MyView::image_tag(MyView::asset_url("top/ico_a.png")); ?></i>同じガスです。</h4>
          <p>まず「LPガス」という言葉は、英語で「Liquified Pretoleum Gas」と呼ばれており、頭文字を取って「LPガス(LPG)」と日本では呼ばれております。LPガスの成分はプロパン・ブタンを主成分として作られていることから、「プロパンガス」とも呼ばれるようになっています。</p>
        </dd>
      </dl>
    </div>

    <div id="accordion" class="accordionbox">
      <dl class="accordionlist">
        <dt class="clearfix">
          <h3 class="title"><i><?= MyView::image_tag(MyView::asset_url("top/ico_q.png")); ?></i>都市ガスとプロパンガスは違うガスなの？</h3>
          <p class="accordion_icon active">
            <span></span><span></span>
          </p>
        </dt>
        <dd style="display: block;">
          <h4><i><?= MyView::image_tag(MyView::asset_url("top/ico_a.png")); ?></i>違うガスです。</h4>
          <p>都市ガスはメタンを主な主成分とする液化天然ガス(LNG)で、プロパンガスはプロパン・ブタンを主成分とする液化石油ガス(LPG)というものになります。ガスの供給方法は都市ガスの場合はガス管を通して家庭に供給しますが、プロパンガスの場合は屋外にガスボンベを設置し、そこからガスを供給します。</p>
        </dd>
      </dl>
    </div>

    <div id="accordion" class="accordionbox">
      <dl class="accordionlist">
        <dt class="clearfix">
          <h3 class="title"><i><?= MyView::image_tag(MyView::asset_url("top/ico_q.png")); ?></i>LPガスは、電気代や都市ガスのような公共料金ではないの？</h3>
          <p class="accordion_icon active">
            <span></span><span></span>
          </p>
        </dt>
        <dd style="display: block;">
          <h4><i><?= MyView::image_tag(MyView::asset_url("top/ico_a.png")); ?></i>公共料金ではありません。</h4>
          <p>都市ガスはメタンを主な主成分とする液化天然ガス(LNG)で、プロパンガスはプロパン・ブタンを主成分とする液化石油ガス(LPG)というものになります。ガスの供給方法は都市ガスの場合はガス管を通して家庭に供給しますが、プロパンガスの場合は屋外にガスボンベを設置し、そこからガスを供給します。電気料金や都市ガス料金は、いわゆる公共料金という位置づけになるので、契約会社によって極端に料金が高くなったり安くなったりはせず、料金が値上げする場合もちゃんと事前に告知され、使用単価も明確に表記されています。一方LPガスの料金は、ガス会社によって、基本料金も使用する単価もすべて自由に決められるので、地域や業者によって料金に開きがあり、安い単価と比較すると、3倍以上の料金になる場合もあります。</p>
        </dd>
      </dl>
    </div>

    <div id="accordion" class="accordionbox">
      <dl class="accordionlist">
        <dt class="clearfix">
          <h3 class="title"><i><?= MyView::image_tag(MyView::asset_url("top/ico_q.png")); ?></i>うちのガス料金って高いと思うけど、相場はいくらくらいなの？</h3>
          <p class="accordion_icon">
            <span></span><span></span>
          </p>
        </dt>
        <dd>
          <h4><i><?= MyView::image_tag(MyView::asset_url("top/ico_a.png")); ?></i>地域や使用量によって異なります。</h4>
          <p>LPガス料金には、基本料金＋従量料金（使った分だけ払う料金）で構成されていますが、基本料金も従量料金も業者によってかなり開きがあります。全国平均で見ると基本料金は一戸建て住宅の場合1,600～1,800円前後で、従量単価は300～500円前後になっていて、これが集合住宅の場合は、基本料金、従量料金共に１割程度高くなります。配送コストが安い関東方面の料金は平均値よりも安めで、逆に配送コストがかかる北海道・東北・九州などは高めになっている傾向があります。基本料金や従量料金の単価は、料金表には記載していない業者が実際はかなり多いので、はっきり内訳がわからない場合は、まずはenepiお客様サポートにお問い合わせください。</p>
        </dd>
      </dl>
    </div>

    <div id="accordion" class="accordionbox">
      <dl class="accordionlist">
        <dt class="clearfix">
          <h3 class="title"><i><?= MyView::image_tag(MyView::asset_url("top/ico_q.png")); ?></i>他の業者さんに変えると料金は安くなるの？？</h3>
          <p class="accordion_icon">
            <span></span><span></span>
          </p>
        </dt>
        <dd>
          <h4><i><?= MyView::image_tag(MyView::asset_url("top/ico_a.png")); ?></i>安くなる可能性が高いです。</h4>
          <p>もともとLPガス料金は自由化されていて、適正価格を知らずに高い料金を払っていたり、気づかないうちに値上げされていたりするケースは非常に多くあり、それが業者を変えることで適正価格よりもさらに安く契約する事が出来ます。</p>
        </dd>
      </dl>
    </div>

    <div id="accordion" class="accordionbox">
      <dl class="accordionlist">
        <dt class="clearfix">
          <h3 class="title"><i><?= MyView::image_tag(MyView::asset_url("top/ico_q.png")); ?></i>今の業者さんに価格交渉して安くしてもらってはダメなの？</h3>
          <p class="accordion_icon">
            <span></span><span></span>
          </p>
        </dt>
        <dd>
          <h4><i><?= MyView::image_tag(MyView::asset_url("top/ico_a.png")); ?></i>信頼できるガス会社かどうか、見極めが必要です。</h4>
          <p>価格交渉すれば、業者さんによっては安くしてくれるところはありますが、業者さんの料金に対する考え方や、他のお客さんへの公平性を考えると、あまり好んでは値下げには応じてくれないケースが多くあります。一次出来に料金が値下げされたとしても、途中から様々な理由によって値上げされる可能性は高く、はじめから長期的に安い料金で提供してくれる業者さんとの契約の方がお得です。</p>
        </dd>
      </dl>
    </div>

    <div id="accordion" class="accordionbox">
      <dl class="accordionlist">
        <dt class="clearfix">
          <h3 class="title"><i><?= MyView::image_tag(MyView::asset_url("top/ico_q.png")); ?></i>集合住宅に住んでいる場合も簡単に変更できるの？</h3>
          <p class="accordion_icon">
            <span></span><span></span>
          </p>
        </dt>
        <dd>
          <h4><i><?= MyView::image_tag(MyView::asset_url("top/ico_a.png")); ?></i>大家さんの了承が必要です。</h4>
          <p>アパートやマンションなどの集合住宅の場合は、大家さんがまとめて業者さんと契約している場合がほとんどなので、まずは大家さんに相談してみることが必要です。直接個人が安い業者さんとの契約は出来なくても、大家さんに安い業者さんと契約するように勧めてみて、うまく安い業者さんと大家さんが契約してくれれば、自分の所のガス料金が安くなることも可能です。</p>
        </dd>
      </dl>
    </div>

    <div id="accordion" class="accordionbox">
      <dl class="accordionlist">
        <dt class="clearfix">
          <h3 class="title"><i><?= MyView::image_tag(MyView::asset_url("top/ico_q.png")); ?></i>ガス会社を変更すると設備の変更などは必要なの？</h3>
          <p class="accordion_icon">
            <span></span><span></span>
          </p>
        </dt>
        <dd>
          <h4><i><?= MyView::image_tag(MyView::asset_url("top/ico_a.png")); ?></i>ガスボンベとメーターのみ変更します。</h4>
          <p>建物の外にあるガスボンベと、使用量を確認するメーターの差し替えの作業が必要になります。ガス給湯器やガスコンロを使用している場合は、今使っている物を継続してそのまま使うことが出来るので、長時間の作業や大がかりの工事などは不要です。差し替えの工事の時間もおよそ30分程度なので、その間に契約書の記載をしていると、すべての手続きはそれだけで完了します。</p>
        </dd>
      </dl>
    </div>

    <div id="accordion" class="accordionbox">
      <dl class="accordionlist">
        <dt class="clearfix">
          <h3 class="title"><i><?= MyView::image_tag(MyView::asset_url("top/ico_q.png")); ?></i>都市ガスは切り替えすることができるの？</h3>
          <p class="accordion_icon">
            <span></span><span></span>
          </p>
        </dt>
        <dd>
          <h4><i><?= MyView::image_tag(MyView::asset_url("top/ico_a.png")); ?></i>2017年4月より切り替えが可能になります。</h4>
          <p>LPガス（プロパンガス）は既に小売自由化されていますが、都市ガスは2017年4月より小売全面自由化されます。詳しくは、各都市ガス事業者へお問い合わせ下さい。</p>
        </dd>
      </dl>
    </div>
  </div>
</div>

<div class="panel" id="cta">
  <div class="panel-inner">

    <div class="hidden_sp">
      <div class="cta-area-sp">
        <h2>プロパンガス会社の見直しでもっと<?= MyView::image_tag(MyView::asset_url("top/img_otoku.png"), ["class" => 'goodbuy-img']); ?>になる！</h2>
        <?= MyView::image_tag(MyView::asset_url("top/img-cta-balloon.png"), ["class" => 'goodbuy-img', "alt"=> 'まずはエネピに相談！']);  ?>
        <?= MyView::link_to("Rails.application.config.form_path", ["class" =>  "ctaarea-button with-arrow-right-icon btn-inner"]); { ?>
          <span class="free-txt">無料</span>
          <div class="text">
            <span class="main">プロパンガス代が<br>安くなるか確かめる！</span>
          </div>
        <? } ?>
      </div>
    </div>

    <div class="hidden_pc">
      <div class="cta-area">
        <?= MyView::link_to("Rails.application.config.form_path", ["class" =>  "ctaarea-button with-arrow-right-icon btn-inner", "onclick" =>  "ga('send', 'event', 'estimate-button', 'click', 'top3', 1);"]); { ?>
            <span class="free-txt">無料</span>
            <div class="text">
              <span class="main">プロパンガス代が<br>安くなるか確かめる！</span>
            </div>
        <? } ?>
      </div>
    </div>
  </div>
</div>

  <!-- <script>
  $(function(){
    $(".accordionbox dt").on("click", function() {
      $(this).next().slideToggle();
      // activeが存在する場合
      if ($(this).children(".accordion_icon").hasClass('active')) {
        // activeを削除
        $(this).children(".accordion_icon").removeClass('active');
      }
      else {
        // activeを追加
        $(this).children(".accordion_icon").addClass('active');
      }
    });
  });
  </script> -->
