<?// ptengine ?>
    <script type="text/javascript">
        window._pt_lt = new Date().getTime();
        window._pt_sp_2 = [];
        _pt_sp_2.push('setAccount,25730495');
        var _protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
        (function() {
            var atag = document.createElement('script');
            atag.type = 'text/javascript';
            atag.async = true;
            atag.src = _protocol + 'js.ptengine.jp/pta.js';
            var stag = document.createElement('script');
            stag.type = 'text/javascript';
            stag.async = true;
            stag.src = _protocol + 'js.ptengine.jp/pts.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(atag, s);
            s.parentNode.insertBefore(stag, s);
        })();
    </script>

    <?// chamo ?>
        <script>
            var _chaq = _chaq || [];
            _chaq['_accountID'] = 1389;
            (function(D, s) {
                var ca = D.createElement(s),
                    ss = D.getElementsByTagName(s)[0];
                ca.type = 'text/javascript';
                ca.async = !0;
                ca.setAttribute('charset', 'utf-8');
                var sr = 'https://v1.chamo-chat.com/chamovps.js';
                ca.src = sr + '?' + parseInt((new Date) / 60000);
                ss.parentNode.insertBefore(ca, ss);
            })(document, 'script');
        </script>

    <?// tooltip ?>
        <script>
            $(document).ready(function() {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>