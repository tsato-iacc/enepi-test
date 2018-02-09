<style>
	.lpgas_contacts_index_footer {
	    padding: 20px 0 0;
	    background-color: #FFF;
	    border-top: 1px solid #CCC;
	    text-align: center;
	    color: #333;
	}

	.lpgas_contacts_index_footer ul li {
	    display: inline;
	    list-style: none;
	    padding: 0;
	}

	.lp004-footer-ul div {
		display: inline;
	    margin-left: 5px;
	    margin-right: 5px;
	}

	.lp004-footer-ul a {
		color: #333;
		text-decoration: none;
	}

	.lp004-footer-ul a:hover {
		color: #00a0e9;
	}

	.modal {
	    position: fixed;
	    top: 0;
	    right: 0;
	    bottom: 0;
	    left: 0;
	    z-index: 1050;
	    display: none;
	    overflow: hidden;
	    -webkit-overflow-scrolling: touch;
	    outline: 0;
		background-color: rgba(0,0,0,0.10);
	}

    .modal-dialog {
    	width: 600px;
    	margin: 30px auto;
        text-align: left;
        position: relative;
        transform: translate(0, 0);
	    font-size: 14px;
	    line-height: 1.42857143;
	    color: #333;
    }

	.modal-header {
        font-size: 16px;
        background-color: #00a0e9;
        border-radius: 0px;
        color: #FFF;
	}

	.modal-title {
        font-size: 14px;
        margin: 0;
        padding: 0;
        background-color: #00a0e9;
	}

	.modal-body h3 {
		padding-bottom: 8px;
        font-size: 20px;
		border-bottom: 2px solid #00a0e9;
		position: relative;
    	padding: 15px;
	}

	.modal-body p {
	    margin: 0 0 10px;
	}

	.modal-body .responsible-address {
	    background-color: #dff5ff;
	    padding: 10px;
	}
</style>



<div class="lpgas_contacts_index_footer">
	<ul class="lp004-footer-ul">
	  <li><a data-toggle="modal" data-target="#privacy_modal">利用規約</a></li><div>｜</div>
	  <li><a href="http://www.iacc.co.jp/privacy/" target="_blank">プライバシーポリシー</a></li><div>｜</div>
	  <li class="lp004-footer-last"><a href="http://www.iacc.co.jp/" target="_blank">運営会社</a></li>
	</ul>
</div>

<?= render('shared/lp_footer_privacy'); ?>