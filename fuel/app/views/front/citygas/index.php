<?= render partial: "front/citygas/panel" ?>

<div class="panel">
  <div class="panel-inner">
    <h2>都市ガス自由化とは</h2>

    <h3>都市ガス自由化により可能になること</h3>
    <?= MyView::image_tag(asset_url("citygas-liberalization.png") ?>

    <p>
      ガスは大きく分けて都市ガス・簡易ガス・プロパンガス(LPガス)の3タイプがありますが、2017年4月に自由化の対象となるのは、都市ガス・簡易ガスをご利用の家庭が対象です。
    </p>
    <p>
      ガスボンベで各家庭にガスが供給されているプロパンガスは、1996年にすでに自由化されています。簡易ガスとは、70戸以上の団地やマンションといった共同住宅で利用されているガス供給の仕組みです。
    </p>
    <p>
      これまでは、東京23区であれば東京ガス、京都市なら大阪ガスというように、ガスを利用する地域で、契約するガス会社が決まっていましたが、都市ガス自由化によって、住んでいる場所に関係なく、利用するガス会社を自由に選択できるようになります。
    </p>
  </div>
</div>

<div class="panel-2nd">
  <div class="panel-inner panel-citygas-schedule">
    <h3>都市ガス自由化の時期について</h3>

    <div class="text">
      <p>
        2017年4月1日に実施される都市ガス自由化は、家庭向けの小売り全面自由化です。ガスを家庭に届けるガス導管部門の法的分離は2022年を予定しており、今回の自由化はガス自由化の第1段階となります。
      </p>
      <p>
        工場や公共施設などガスを多く使用する施設では1995年からすでに自由化がはじまっており、ガス市場のうちすでに3分の2が自由化されていると言われています。
      </p>
      <p>
        具体的な新規参入業者、ガスの料金プランや新サービスなどは、電力自由化と同様に、2016年12月頃から発表され、年明けから予約受付が始まるのではないかと見られています。
      </p>
    </div>

    <?= MyView::image_tag(asset_url("citygas-schedule.png") ?>
  </div>
</div>

<div class="panel-2nd">
  <div class="panel-inner-very-narrow2 panel-citygas-merit-demerit">
    <h3>都市ガス自由化のメリット・デメリット</h3>

    <p>
      毎日の生活にかかせないガス、自由化によってどのようなメリット・デメリットがあるのでしょうか？<br>
      私達の生活に与える影響について、しっかり知っておきましょう。
    </p>

    <div class="merit">
      <h4><?= image_tag("circle-yellow.png") ?> メリット</h4>
      <ul>
        <li>競争によって料金が下がる</li>
        <li>多様なサービス・プランの登場</li>
        <li>導管網の整備が進められる</li>
      </ul>
    </div>
    <div class="demerit">
      <h4><?= image_tag("cross-yellow.png") ?> デメリット</h4>
      <ul>
        <li>価格が不安定になる可能性がある</li>
        <li>首都圏では選択肢が多く、<br>地方では選択できないことも</li>
      </ul>
    </div>
  </div>
</div>

<div class="panel-2nd">
  <div class="panel-inner-narrow">
    <h3>ガス自由化の背景と狙い</h3>

    <p>
      ガス自由化の狙いは料金低下とサービス向上です。電力自由化とあわせて、資源エネルギー庁が進める「エネルギーシステム改革」の一部ですが、具体的には下記のような目的で準備が進められています。
    </p>

    <div class="panel-note">
      <h4>天然ガスの安定供給の確保</h4>
      <p>ガス導管網の新規整備や相互接続により、災害時供給の強靱化を含め、天然ガスを安定的に供給する体制を整えます。</p>

      <h4>ガス料金を最大限抑制</h4>
      <p>天然ガスの調達や小売サービスの競争を通じ、ガス料金を最大限抑制し、国民生活を改善します。</p>

      <h4>利用メニューの多様化と事業拡大</h4>
      <p>利用者が、都市ガス会社や料金メニューを多様な選択肢から選べるようにし、他業種からの参入、都市ガス会社の他エリアへの事業拡大等を通じ、イノベーションを起こします。</p>

      <h4>天然ガスの利用方法の拡大</h4>
      <p>導管網の新規整備、潜在的なニーズを引き出すサービス、燃料電池やコージェネレーションなど新たな利用方法を提案できる事業者の参入を促します。</p>

      <cite>
        参照 : 資源エネルギー庁
        （<?= MyView::link_to("http://www.enecho.meti.go.jp/category/electricity_and_gas/energy_system_reform/", "http://www.enecho.meti.go.jp/category/electricity_and_gas/energy_system_reform/", target: "_blank" ?>）
    </cite>
    </div>
  </div>
</div>

<div class="panel-2nd">
  <div class="panel-inner-narrow">
    <h3>ガス自由化の海外事例</h3>

    <p>
      海外では、日本よりも早くガス自由化が開始されている国があります。電力自由化と同様に欧米地域で自由化が進んでおり、それぞれタイミングは違うものの、イギリス・アメリカ・イタリア・ドイツ・フランスなどで進められています。
    </p>

    <ul class="oversea-case-list">
      <li>
        <h4 class="title">イギリスでのガス自由化</h4>
        <div class="split">
          <?= MyView::image_tag(asset_url("gbr.png") ?>
          <div class="text">
            <p class="description">EU全体でのガス小売自由化に先立ち、1980年代から段階的な自由化が進み、1998年には家庭向けの小売事業が全面自由化されています。Big6と呼ばれる大手6事業者が99％のシェアを占め、ガス自由化後には料金が高騰していますが、消費者のスイッチング率は高く、ガス自由化に成功している国といえます。</p>
          </div>
        </div>
      </li>
      <li>
        <h4 class="title">アメリカでのガス自由化</h4>
        <div class="split">
          <?= MyView::image_tag(asset_url("usa.png") ?>
          <div class="text">
            <p class="description">アメリカにおけるガス自由化は州ごとに行われており、状況は州によって異なります。家庭用の小売り全面自由化を実施しているのは8州で、主なところではニューヨーク州・カリフォルニア州がありますが、それぞれ切り替え率が20％程度と1％程度と、州によって切り替えの状況も州によって様々です。</p>
          </div>
        </div>
      </li>
      <li>
        <h4 class="title">ドイツでのガス自由化</h4>

        <div class="split">
          <?= MyView::image_tag(asset_url("deu.png") ?>
          <div class="text">
            <p class="description">ドイツは大きな国営企業なども存在していなかったこともあり、1998年に電力とあわせて全面自由化が実施されました。ガス自由化後に切り替えを実施した消費者は2011年で18％と、比較的高くなっています。</p>
          </div>
        </div>
      </li>
      <li>
        <h4 class="title">イタリアでのガス自由化</h4>

        <div class="split">
          <?= MyView::image_tag(asset_url("ita.png") ?>
          <div class="text">
            <p class="description">イタリアでは2003年に家庭向け小売も含む全面自由化が実施されました。300を超える事業者が存在しており、上位5社がマーケットシェア61％を占めています。イタリアでは近年スイッチング率があがり、2011年では5％を超えています。</p>
          </div>
        </div>
      </li>
      <li>
        <h4>フランスでのガス自由化</h4>

        <div class="split">
          <?= MyView::image_tag(asset_url("fra.png") ?>
          <div class="text">
            <p class="description">2000年から順次自由化が開始され、2007年には家庭向けを含む全面自由化が実施されましたが、自由化後も総合エネルギー大手のGaz de France Suezが80％以上のシェアを占めています。</p>
          </div>
        </div>
      </li>
    </ul>
  </div>
</div>

<div class="panel-2nd">
  <div class="panel-inner panel-citygas-future">
    <h3>今後の展望</h3>

    <div class="text">
      <p>ガス・電力の自由化によって、これまでと異なる領域の事業者が参入したり、ガス・電力双方のサービスを提供する総合エネルギー企業が増えることが予想されます。</p>
      <p>それによって、ガス・電気それぞれで所有していた設備や消費者対応の点でシナジー効果が生まれ、効率的な事業の運営がされることにより、料金の値下げが期待されます。</p>
      <p>また、包括的にエネルギーを提供する会社が増えることで、提供プランの多様化やライフスタイルにあわせたセット割の選択などができるようになるでしょう。</p>
    </div>

    <?= MyView::image_tag(asset_url("citygas-future.png") ?>
  </div>
</div>

<div class="panel-2nd">
  <div class="panel-inner article-list">
    <h3>都市ガスの最新ニュース</h3>
    <ul>
      <?= render(
        partial: 'front/articles/list_item',
        collection: @news['articles'].take(4),
        as: :article,
        locals: {
          mini: false
        })
      ?>
    </ul>
  </div>
</div>

<div class="panel-2nd">
  <div class="panel-inner">
    <h3>事業者の種類</h3>
    <p>ガスの自由化で、これまでの大手ガス会社以外にどのような事業者が参入してくるのでしょうか？現在プロパンガス(LPガス)を販売している事業者が都市ガスにも参入したり、電力自由化に参入した通信会社などもガス事業参入を狙っていると言われています。</p>
    <p>しかし、最有力の事業者は東京電力や関西電力などの大手電力会社や、石油会社、大手総合商社などです。彼らは、発電やガソリンとしての提供などですでに大量のガスを取り扱っており、1995年以降段階的に進められてきた、大口需要家向けの自由化では販売量でも上位に位置しています。特に、関西電力・JX日鉱日石エネルギーや石油資源開発、国際石油開発帝石、中部電力、東京電力などが目立ちます。また、電力自由化と同様に、携帯電話やインターネットプロバイダ事業者も参入すると言われています。</p>

    <span class="citygas-players-header">＼ 他業種もぞくぞく参入! ／</span>
    <?= MyView::image_tag(asset_url("citygas-players.png") ?>
  </div>
</div>

<div class="panel-r panel-2nd">
  <div class="panel-inner-narrow">
    <h2>都市ガスの料金・料金比較について</h2>

    <h3>ガス料金のプラン</h3>

    <p class="h-pad">
      ガスの料金プランは複数あり、ガスコージェネレーションシステムや高性能な給湯器を導入することで割引されるプランが中心となっています。
    </p>

    <table>
      <tr>
        <th>一般料金</th>
        <td>ガスを利用すると自動的に適用される<br>（ガス料金＝基本料金＋（単位料金×ガスご使用量）※従量料金）</td>
      </tr>
      <tr>
        <th>湯ったりエコぷらん</th>
        <td>ecoジョーズ利用の方向け、年間を通じて3％割引</td>
      </tr>
      <tr>
        <th>暖らんぷらん</th>
        <td>ガス温水床暖房を利用の方向け、冬(12月〜4月)の料金が割引<br>（使用料が20㎥を超える場合に適用）</td>
      </tr>
      <tr>
        <th>エネファームで<br>発電エコぷらん</th>
        <td>
          燃料電池(エネファーム)利用の方向け、<br>
          冬(12月〜4月)の料金が割引、<br>
          その他シーズンの料金も使用料が20㎥を超える場合には<br>
          お得な料金プランが適用される
        </td>
      </tr>
      <tr>
        <th>エコウィルで<br>発電エコぷらん</th>
        <td>ガスエンジン式コージェネレーションシステム<br> (エコウィル)利用の方向け、冬(12月〜4月)の料金が割引</td>
      </tr>
    </table>
  </div>
</div>

<div class="panel-r panel-2nd">
  <div class="panel-inner-very-narrow">
    <h3>料金の確認方法</h3>
    <p>
      支払っているガス代を確認するには、都市ガスの場合には毎月届く検針票（ガスご使用量のお知らせ）に請求金額の記載があります。検針票には、それ以外にもお客様番号や契約者情報、ガス使用料、基本料金・単位料金(従量単価)などの金額内訳を確認することができます。また、東京ガスや大阪ガスのように、ウェブサイト上の会員ページで上記情報を確認できる会社もあります。
    </p>
  </div>
</div>

<div class="panel-r panel-2nd">
  <div class="panel-inner-narrow">
    <h3>料金の計算方法</h3>
    <p class="h-pad">
      毎月支払うガス料金は、固定の基本料金と、使用料に応じて支払う従量料金の合計金額となります。ここでは、一般的なガス機器を使用している場合の料金プランを例に、計算方法を紹介します。
    </p>
    <?= MyView::image_tag(asset_url("citygas-calc.png"), ["class" => 'gas-calc' ?>
    <p class="note">
      基本料金は、毎月のガス使用料から算出します。
    </p>
    <p class="note">
      ガス料金は1円未満を切り捨てます
    </p>
    <p class="note">
      東京ガスの場合、口座振替割引が適用される方は、計算結果から54円(税込)割引になります。
    </p>

    <div class="citygas-calc-example">
      <span class="citygas-calc-example-header">【計算例：1ヶ月のガス使用量が25㎥の場合】</span>
      <p class="citygas-calc-example-content">
        基本料金：ガス使用量が25㎥の場合、料金表Bの基本料金・単位料金を適用します。<br>
        ガス料金＝1036.80円＋（128.08円×25㎥）<br>
        ＝4,238.8円（1円未満切り捨て）<br>
        ＝4,238円<br>
      </p>
    </div>
    <p class="note">
      平成28年6月13日時点での東京地区の基本料金を反映しております。
    </p>
  </div>
</div>

<div class="panel panel-2nd">
  <div class="panel-inner-very-narrow2">
    <h2>都市ガスの基礎知識</h2>
    <h3>都市ガスとLPガスの違い</h3>
    <p>
      ほとんどの家庭が都市ガスとプロパンガス（LPガス）のどちらかを使用していますが、この2つにはいくつか異なる点があります。具体的には原料・供給方法・価格が大きく違います、それぞれの特徴を比較してみましょう。
    </p>

    <?= MyView::image_tag(asset_url("citygas-lpgas.png"), style: "text-align: center; display: block; margin: 20px auto;" ?>

    <p>
      プロパンガスの原料はブタンやプロパンを主成分に持つ液化石油ガス(LGP)です。供給方法は各家庭へそれぞれガスボンベで運ばれますが、低い圧力で液化するため、ボンベに充填して運搬しやすいのが理由で、ガス管が整備されていない郊外や地方での使用が多いです。
      一方都市ガスは、天然ガス(LNG)を主な成分としています。約マイナス160℃で液化するため、ボンベでの輸送に向いておらず、地中に整備されたガス管を通して、各家庭へ供給されています。
    </p>
    <p>
      一般的にプロパンガスの方が高いと言われていますが、ガスボンベ運搬や設備の点検などにかかる人件費がかかっているためです。
    </p>
  </div>
</div>
<div class="panel panel-2nd">
  <div class="panel-inner panel-citygas-selection" style="">
    <div class="text">
      <h3>会社の選び方・注意点</h3>
      <p>
        ガスの自由化に伴い、新規参入事業者が増え、どのガス会社を選択していいか
        わからない事態になる可能性もあります。会社を選ぶ際には、料金プランや
        お住まいの地域を基本条件として探しますが、ぜひ活用したいのがガス料金の
        セット割です。
      </p>
      <p>
        電力会社は「電気・ガスのセット割」、石油・ガソリンスタンド各社はガソリン
        とのセット割を提供することが見込まれており、他にも通信会社や携帯電話大手
        も電力自由化のときと同様に参入が予想されているため、自身のライフスタイル
        にある会社・プランを比較検討して決めましょう。
      </p>
    </div>
    <?= MyView::image_tag(asset_url("citygas-selection.png") ?>
  </div>
</div>

<div class="panel-r">
  <div class="panel-inner">
    <h2>よくあるご質問</h2>

    <ul class="faq-list">
      <li>
        <div class="q">
          <span class="inner">
            <span class="balloon">Q</span>
            新しいガス会社でも、ガスの質や安全性は問題ないですか？
          </span>
        </div>
        <div class="a">
          <span class="inner">
            <span class="balloon">A</span>
            契約するガス会社によって質や安全性が変わることはありません。<br>
            ガスが自由化されても、家庭にガスが提供される導管はこれまでのものをそのまま使用します。<br>
            ガス管の中を流れるガスの品質はガス管の管理事業者によって厳しくチェックされるため、<br>
            質の悪いガスが混ざることはありません。<br>
            また、ガス漏れなどのトラブルは、<br>
            従来通り地域の都市ガス会社が対応することになっているので、安全面も不安はありません。<br>
          </span>
        </div>
      </li>
      <li>
        <div class="q">
          <span class="inner">
            <span class="balloon">Q</span>
            マンション・アパート、賃貸でも切り替えられますか？
          </span>
        </div>
        <div class="a">
          <span class="inner">
            <span class="balloon">A</span>
            マンション・アパート・一戸建て・賃貸住宅にお住まいでも、
            自宅にガスメーターが設置されていれば切り替えができます。
            気になる方は、ガス会社切り替えの旨を管理会社・大家さんに相談してみましょう。
          </span>
        </div>
      </li>
      <li>
        <div class="q">
          <span class="inner">
            <span class="balloon">Q</span>
            ガス会社をかえる場合に、工事は必要ですか？
          </span>
        </div>
        <div class="a">
          <span class="inner">
            <span class="balloon">A</span>
            新しいガス事業者と契約しても、これまでのガス管を使用するので工事は不要です。
            その他ガス器具の交換も基本的にはいらないですが、都市ガスをLPガスに変更、LPガスを都市ガスに変更する場合は、
            ガス器具をそのまま使用することが出来ないので、交換が必要です。
          </span>
        </div>
      </li>
      <li>
        <div class="q">
          <span class="inner">
            <span class="balloon">Q</span>
            新しく契約したガス会社が倒産したらどうなるのですか？
          </span>
        </div>
        <div class="a">
          <span class="inner">
            <span class="balloon">A</span>
            契約したガス会社が倒産しても、ガスが止まってしまうことはありません。
            万が一新しいガス会社が倒産やガス供給事業からの撤退をしてしまっても、
            従来の地域のガス会社がかわりに供給を続けてくれます。
            ガス管を保有・管理する導管会社が「最終保証供給約款」を用意し、
            緊急事態にもガス供給をすることになっています。
          </span>
        </div>
      </li>
    </ul>
  </div>
</div>

<div class="article-list-v2-panel">
  <div class="panel-inner article-list-v2-panel-container">
    <ul>
      <?= render(
        partial: 'front/articles/list_item',
        collection: @news['articles'],
        as: :article,
        locals: {
          mini: false
        })
      ?>
    </ul>
    <div class="sidebar">
      <h3>人気記事ランキング</h3>
      <ul>
        <?= render(
          partial: 'front/articles/list_item',
          collection: @populars['articles'],
          as: :article,
          locals: {
            mini: true
          })
        ?>
      </ul>

      <h3>enepiおすすめ記事</h3>
      <ul>
        <? if pickup_articles_module_type('citygas') ?>
          <?= render(
            partial: 'front/articles/list_item',
            collection: pickup_articles_module_type('citygas')['items'],
            as: :article,
            locals: {
              mini: true
            })
          ?>
        <? } ?>
      </ul>

      <?= MyView::image_tag(asset_url("merit-banner.png") ?>

      <div class="fb-page" data-href="https://www.facebook.com/enepijp" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/enepijp"><a href="https://www.facebook.com/enepijp">エネピ（enepi）</a></blockquote></div></div>
    </div>
  </div>
  <div class="more_link">
    <?= MyView::link_to("都市ガスに関する記事を詳しくみる", category_path(CMS_CITYGAS) ?>
  </div>
</div>

<?= render 'front/welcome/panel' ?>
