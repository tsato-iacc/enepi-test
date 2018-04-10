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
	
	.modal-open .modal {
	    overflow-x: hidden;
	    overflow-y: auto;
	}

	.modal {
	    position: fixed;
	    top: 0;
	    right: 0;
	    bottom: 0;
	    left: 0;
	    width: 100%;
    	height: 100%;
	    z-index: 1050;
	    display: none;
	    overflow: hidden;
	    -webkit-overflow-scrolling: touch;
	    outline: 0;
		background-color: rgba(0,0,0,0.10);
		padding-top: 0;
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
	    left: 50px;
    }

    .modal-content {
    	border-radius: 6px;
    }

	.modal-header {
        font-size: 16px;
        border-radius: 4px 4px 0px 0px / 4px 4px 0px 0px;
        background-color: #00a0e9;
        color: #FFF;
	}

	.modal-title {
        font-size: 14px;
        font-weight: normal;
        margin: 0;
        padding: 0;
        background-color: #00a0e9;
	}



	.modal-body {
		padding: 15px;
	}

	.modal-body h3 {
		font-family: inherit;
	    font-weight: 500;
	    line-height: 1.1;
	    color: inherit;
        font-size: 20px;
		border-bottom: 2px solid #00a0e9;
		padding-bottom: 8px;
		position: relative;
	}

	.modal-body p {
	    margin: 0 0 10px;
	}

    .modal-body ul li {
    	list-style-type: disc;
    	list-style-position: inside;
    	margin-bottom: 16px;
    	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
		padding-left: 1em;
		text-indent: -1.3em;
    }

	.modal-body .responsible-address {
	    background-color: #dff5ff;
	    padding: 10px;
	}

	.modal-body .responsible-address a {
	    color: #333;
		text-decoration: none;
	}

	.modal-body .responsible-address a:hover {
		color: #00a0e9;
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