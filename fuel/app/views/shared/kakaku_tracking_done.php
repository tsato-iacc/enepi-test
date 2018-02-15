<!-- ▼▼set catalyst▼▼ -->
<span style="display:none;">
  <!-- SiteCatalyst code version: H.8.
  Copyright 1997-2006 Omniture, Inc. More info available at
  http://www.omniture.com -->
  <script type="text/javascript">
    // PC/SPカタリスト初期化関数
  function activateCatalyst( deviceType ) {
    var script = document.createElement('script');
    script.type = 'text/javascript';
    var firstScript = document.getElementsByTagName('script')[0];
    if (deviceType == 'pc') {
      script.src = 'https://ssl.kakaku.com/script/analytics/s_code.js';
      firstScript.parentNode.insertBefore( script, firstScript );
      script.onload = function () {
        // PC向けカタリストコード
        s.pageName = "[gas]" + document.title;
        s.server = document.domain;
        s.channel = "ガス料金比較";
        s.prop17="[gas]プロパンガス";
        s.prop42="[energy]エネルギー";
        s.prop1 = "[gas]プロパンガス見積もり申込フォーム_完了";
        s.events = "event62"
        var s_code=s.t();if(s_code)document.write(s_code);
      }
    } else if (deviceType == 'sp') {
      script.src = 'https://ssl.kakaku.com/script/smartphone/analytics/s_code.js';
      firstScript.parentNode.insertBefore( script, firstScript );
      script.onload = function () {
        // SP向けカタリストコード
        s.pageName = "[gas]" + document.title;
        s.server = document.domain;
        s.channel = "ガス料金比較";
        s.prop17="[gas]プロパンガス";
        s.prop42="[energy]エネルギー";
        s.prop1 = "[gas]プロパンガス見積もり申込フォーム_完了";
        s.events = "event62"
        var s_code=s.t();if(s_code)document.write(s_code);
      }
    }
  }
// UA判別→カタリスト初期化実行
if(navigator.userAgent.match(/iPod|iPhone|Android.*Mobile|Windows\sPhone/i)){
  activateCatalyst('sp');
} else {
  activateCatalyst('pc');
}
  </script>
</span>
<!-- ▲▲set catalyst▲▲ -->
