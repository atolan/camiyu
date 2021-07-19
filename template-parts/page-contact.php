<?php
    /* 
    Template Name: Contact
    */
    get_header(); 
?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/assets/css/contact.css">
    <div class="main-content">


        <div class="inner">
            <p class="page-notice">
                top > お問い合わせ
            </p>
        </div>
        <section class="contact-content"　id="scroll-up">
            <div class="page-title" data-aos="fade-up">
                お問い合わせ
            </div>
            <div class="contact-des inner pc" data-aos="fade-up" data-aos-delay="300">
                内容によっては回答をさしあげるのにお時間をいただくこともございます。<br>
                また、休業日は翌営業日以降の対応となりますのでご了承ください。<br><br>
                
                <span class="mandatory">※必須</span> 項目は必ず入力して頂き、「確認画面へ」ボタンを押してください。
            </div>
            <div class="contact-des inner sp" data-aos="fade-up" data-aos-delay="300">
                内容によっては回答をさしあげるのにお時間をいただくこともございます。
                また、休業日は翌営業日以降の対応となりますのでご了承ください。<br><br>
                
                <span class="mandatory">※必須</span> 項目は必ず入力して頂き、「確認画面へ」ボタンを押してください。
            </div>
            <div class="contact-form inner" id="scroll-up">
                <?php echo do_shortcode('[contact-form-7 id="19" title="Contact form 1"]'); ?>
            </div>
        </section>
    </div>
    <script>
        observer.observe(document.querySelector('section.contact-content'));
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/validation.js"></script>
<?php get_footer(); ?>
<!-- <div class="input-data" id="inputData">
<div class="form-box" data-aos="fade-up">
   <label for="inquery_type">
       お問い合わせ内容 <span class="mandatory">※必須</span>
   </label>[select* inquery_type id:inquery_type class:inquery_type "ーーーーーー未選択ーーーーーー" "お仕事・新規案件について" "媒体への感想やお問い合わせ" "採用について" "その他お問い合わせ"]
</div>
<div class="form-box" data-aos="fade-up">
   <label for="">お名前<span class="mandatory">※必須</span>
   </label>[text* kana_name id:kana_name]
</div>
<div class="form-box" data-aos="fade-up">
    <label for="">会社名
    </label>[text company id:company]
</div>
<div class="form-box" data-aos="fade-up">
    <label for="phone">ご連絡先電話番号<span class="mandatory">※ハイフン無しでご入力ください。 </span></label>[tel* phone id:phone]
</div>
<div class="form-box" data-aos="fade-up">
    <label for="">メールアドレス<span class="mandatory">※必須</span></label>[email* email id:email]</div>
<div class="form-box" data-aos="fade-up">
    <label for="">お問い合わせ内容<span class="mandatory">※必須</span></label>[textarea* inquery_content id:inquery_content]
    <div class="notice"><span class="mandatory">※全角で1000文字まで入力できます。</span>（半角カタカナは使用しないでください。） 
    </div>
</div>
<div class="form-box" data-aos="fade-up">
    <label for="">個人情報の取り扱いについて<span class="mandatory step-input">※必須</span></label>
    <div class="privacy">株式会社 かみゆ（以下「当社」といいます）は、以下のとおり個人情報保護方針を定め、個人情報保護の仕組みを構築し、全従業員に個人情報保護の重要性の認識と取組みを徹底させることにより、個人情報の保護を推進致します。<br><br>■個人情報の管理<br>当社は、お客さまの個人情報を正確かつ最新の状態に保ち、個人情報への不正アクセス・紛失・破損・改ざん・漏洩などを防止するため、セキュリティシステムの維持・管理体制の整備・社員教育の徹底等の必要な措置を講じ、安全対策を実施し個人情報の厳重な管理を行ないます。<br><br>■個人情報の利用目的<br>お客さまからお預かりした個人情報は、当社からのご連絡や業務のご案内、ご質問に対する回答として、電子メールや資料のご送付に利用いたします。<br><br>■個人情報の第三者への開示・提供の禁止<br>当社は、お客さまよりお預かりした個人情報を適切に管理し、次のいずれかに該当する場合を除き、個人情報を第三者に開示いたしません。<br>・お客さまの同意がある場合<br>・お客さまが希望されるサービスを行なうために当社が業務を委託する業者に対して開示する場合<br>・法令に基づき開示することが必要である場合<br><br>■個人情報の安全対策<br>当社は、個人情報の正確性及び安全性確保のために、セキュリティに万全の対策を講じています。<br><br>■ご本人の照会<br>お客さまがご本人の個人情報の照会・修正・削除などをご希望される場合には、ご本人であることを確認の上、対応させていただきます。<br><br>■法令、規範の遵守と見直し<br>当社は、保有する個人情報に関して適用される日本の法令、その他規範を遵守するとともに、本ポリシーの内容を適宜見直し、その改善に努めます。<br><br>■お問い合せ<br>当社の個人情報の取扱に関するお問い合せは下記までご連絡ください。<br>株式会社かみゆ<br>〒160-0007 東京都新宿区荒木町11-2 北斗四谷ビル2階<br>TEL:03-6457-7660&nbsp;&nbsp;&nbsp;FAX:03-6457-7661<br>Mail:info@camiyu.jp</div>
<div class="agree-check" data-aos="fade-up">
<label class="container">上記の個人情報の取り扱いについてに同意する<span class="mandatory">※必須</span><input type="checkbox" name="agree" id="agree"><span class="checkmark"></span>
</label></div>
</div>
</div>
<div class="ensure-data" id="ensureData">
  <div class="input-group">
       <div class="input-title">お問い合わせ内容</div>
       <div id="inqueryType" class="input-text"></div>
  </div>
  <div class="input-group">
     <div class="input-title">お名前</div>
     <div id="name" class="input-text">お仕事・新規案件について
     </div>
  </div>
  <div class="input-group">
      <div class="input-title">会社名</div>
      <div id="companyName" class="input-text"></div>
  </div>
  <div class="input-group">
      <div class="input-title">ご連絡先電話番号</div>
      <div id="phoneNumber" class="input-text"></div>
  </div>
  <div class="input-group">
      <div class="input-title">メールアドレス</div>
      <div id="emailAddress" class="input-text"></div>
  </div>
  <div class="input-group">
      <div class="input-title">お問い合わせ内容</div>
      <div id="inqueryContent" class="input-text"></div>
  </div>
  <div class="input-group">
      <div class="input-title">個人情報の取り扱いについて</div>
      <div id="agreeCheck" class="input-text">チェック済</div>
  </div>
</div>
<div class="button-group">
   <div class="confirm-btn returnTo">前画面に戻る</div>
   <div class="confirm-btn goto-confirmBtn">確認画面へ</div>
   <div class="confirm-btn submit-btn" id="submitBtn">
      [submit id:emailConfirm "送信する"]
   </div>
</div> -->