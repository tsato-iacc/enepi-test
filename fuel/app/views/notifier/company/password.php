<p>
  <?= $user->company_name; ?><br>
  ご担当者様
</p>
<p>
  お世話になっております。
  enepi(エネピ)運営事務局でございます。
</p>
<p>
  この度は、エネピへのご加盟をいただき誠にありがとうございます。<br>
  下記に貴社専用の管理画面のログイン情報をお送りさせて頂きます。
</p>
<p>
  ログインID: <?= $user->email; ?><br>
  パスワード: <?= $password; ?><br>
  Enepi パートナー様管理画面: <a href="<?= \Uri::create('partner/login'); ?>"><?= \Uri::create('partner/login'); ?></a><br>
</p>
<p>
  <hr>
  ■今後の流れ
  <hr>
</p>

<ol>
  <li>メールでお見積り依頼が入った旨をお伝えさせていただきます</li>
  <li>貴社専用の管理画面にログインしていただき、詳細をご確認ください。</li>
  <li>各案件に対し、見積もりのご提示(送信)をお願い致します。</li>
  <li>ユーザーから切替意思が示された場合、改めてメールにてお伝えさせていただきます。</li>
  <li>切り替え意思が示されると、連絡先等の個人情報が開示されますので、そちらを元にご連絡、訪問、契約・工事へとお話を進めていただきます。</li>
  <li>工事予定日が決まりましたらご入力をお願いします。契約が完了しましたらご報告をお願いします。</li>
</ol>

<hr>

<p>
  ささいなことでも気軽にご質問、ご相談頂ければと思います。<br>
  この度は、ご参画ありがとうございます。<br>
  エネピを活用することにより、<br>
  貴社LPガス事業の発展の一躍を担えればと存じております。
</p>

<p>
  まだまだ、未整備な部分もあるかと存じますが、<br>
  その際には、忌憚なくご意見を頂ければ幸いでございます。
</p>

<p>
  今後とも何卒よろしくお願いいたします。
</p>
