<div class="form">
          <div class="form__item">
              <label class="form__label">
                  <span class="form__required">必須</span>
                  <span class="form__text">お名前</span>
              </label>
              <div class="form__wrap">
                [text* your-name-confirm class:form__input]
              </div>
          </div>

          <div class="form__item">
              <label class="form__label">
                <span class="form__required">必須</span>
                  <span class="form__text">メールアドレス</span>
              </label>
              <div class="form__wrap">
                [email* your-email-confirm class:form__input]
              </div>
          </div>

          <div class="form__item">
              <label class="form__label">郵便番号</label>
              <div class="form__wrap">
                [text zip-confirm class:form__input]
              </div>
          </div>

          <div class="form__item">
              <label class="form__label">
                <span class="form__required is-pc-tab">必須</span>
                  <span class="form__text">住所</span>
                  
              </label>
              <div class="form__wrap">
                <label class="form__label">
                  <span class="form__required is-sp">必須</span>
                  <span class="form__address-text">都道府県</span>
                </label>
<div class="form__select-wrap">
  [select* prefecture class:form__select "-- 選択してください --" "北海道" "青森県" "岩手県" "宮城県" "秋田県" "山形県" "福島県" "茨城県" "栃木県" "群馬県" "埼玉県" "千葉県" "東京都" "神奈川県" "新潟県" "富山県" "石川県" "福井県" "山梨県" "長野県" "岐阜県" "静岡県" "愛知県" "三重県" "滋賀県" "京都府" "大阪府" "兵庫県" "奈良県" "和歌山県" "鳥取県" "島根県" "岡山県" "広島県" "山口県" "徳島県" "香川県" "愛媛県" "高知県" "福岡県" "佐賀県" "長崎県" "熊本県" "大分県" "宮崎県" "鹿児島県" "沖縄県"]
</div>
                <div class="form__address-detail">
                <label class="form__label">
                  <span class="form__required is-sp">必須</span>
                  <span class="form__address-text">市区町村・番地</span>
                </label>
                    [text* city-confirm class:form__input]
                  </div>
                  <div class="form__address-detail">
                  <label class="form__label">
                    <span class="form__required is-sp">必須</span>
                    <span class="form__address-text">建物名・部屋番号</span>
                  </label>
                    [text* building class:form__input ]
                </div>
              </div>
          </div>

          <div class="form__item">
              <label class="form__label">
                <span class="form__required">必須</span>
                  <span class="form__text">電話番号</span>
              </label>
              <div class="form__wrap">
                [tel* tel-confirm class:form__input]
              </div>
          </div>

          <h3 class="form__subtitle">詳しいお問い合わせ内容</h3>

          <div class="form__item">
              <label class="form__label">
                <span class="form__required">必須</span>
                  <span class="form__text">お住まいのタイプ</span>
              </label>
              <div class="form__select-wrap">
                  [select* house-type class:form__select "-- 選択してください --" "戸建て" "マンション"]
              </div>
          </div>

          <div class="form__item">
              <label class="form__label">
                <span class="form__required">必須</span>
                  <span class="form__text">リフォームしたい箇所</span>
              </label>
              <div class="form__select-wrap">
                  [select* reform-place class:form__select "-- 選択してください --" "窓" "玄関ドア"]
              </div>
          </div>

          <!-- 窓の情報 -->
          <div class="window-info" data-window-count="1">
              <h4 class="window-info__title">窓の情報（1）</h4>
              
              <div class="window-info__size">
                  <label class="form__label">
                    <span class="form__optional">任意</span>
                      <span class="form__text">サイズ</span>
                  </label>
                  <div class="window-info__wrap">
                    <div class="window-info__size-inputs">
                        <div class="window-info__item">
                          <span class="window-info__label">高さ</span>
                          [text height-1 class:form__input-s] 
                        </div>
                        <span>×</span>
                        <div class="window-info__item">
                          <span class="window-info__label">幅</span>
                          [text width-1 class:form__input-s] 
                        </div>
                        <span>×</span>
                        <div class="window-info__item">
                          <span class="window-info__label">窓枠</span>
                          [text frame-1 class:form__input-s]
                        </div>
                    </div>
                    <p class="window-info__note">窓枠は、窓のリフォームをご希望の方のみご記入ください。</p>
                    <div class="window-info__btn">
                      <a href="">窓の測り方</a>
                    </div>
                  </div>
              </div>

              <div class="window-info__image">
                  <label class="form__label">
                      <span class="form__optional">任意</span>
                      写真画像
                  </label>
                  <!-- ファイル入力を非表示にする -->
                  <div class="window-info__file-wrapper">
                      [file photo-1 class:form__file]
                      <span class="window-info__file-name"></span>
                      <button type="button" class="window-info__upload-btn js-file-btn">画像添付</button>
                      <p class="window-info__note">当該箇所の写真画像を添付していただくとよりスムーズです。</p>
                  </div>
              </div>
              <div class="window-info__count">
                  <label class="form__label">
                    <span class="form__required">必須</span>
                      <span class="form__text">枚数</span>
                  </label>
                  <div class="window-info__wrap window-info__wrap--unit">
                    [number* count-1 class:form__input-s min:1]
                  </div>
              </div>

              <div class="window-info__place">
                  <label class="form__label">
                    <span class="form__required">必須</span>
                      <span class="form__text">場所</span>
                  </label>
                  <div class="window-info__wrap">
                    <div class="form__select-wrap">
                        [select* place-1 class:form__select "-- 選択してください --" "LDK" "浴室" "和室"]
                    </div>
                  </div>
              </div>
          </div>
          <div class="window-info" data-window-count="2" style="display: none;">
              <h4 class="window-info__title">窓の情報（2）</h4>
              
              <div class="window-info__size">
                  <label class="form__label">
                    <span class="form__optional">任意</span>
                      <span class="form__text">サイズ</span>
                  </label>
                  <div class="window-info__wrap">
                    <div class="window-info__size-inputs">
                        <div class="window-info__item">
                          <span class="window-info__label">高さ</span>
                          [text height-2 class:form__input-s] 
                        </div>
                        <span>×</span>
                        <div class="window-info__item">
                          <span class="window-info__label">幅</span>
                          [text width-2 class:form__input-s] 
                        </div>
                        <span>×</span>
                        <div class="window-info__item">
                          <span class="window-info__label">窓枠</span>
                          [text frame-2 class:form__input-s]
                        </div>
                    </div>
                    <p class="window-info__note">窓枠は、窓のリフォームをご希望の方のみご記入ください。</p>
                    <div class="window-info__btn">
                      <a href="">窓の測り方</a>
                    </div>
                  </div>
              </div>

              <div class="window-info__image">
                  <label class="form__label">
                      <span class="form__optional">任意</span>
                      写真画像
                  </label>
                  <!-- ファイル入力を非表示にする -->
                  <div class="window-info__file-wrapper">
                      [file photo-2 class:form__file]
                      <span class="window-info__file-name"></span>
                      <button type="button" class="window-info__upload-btn js-file-btn">画像添付</button>
                      <p class="window-info__note">当該箇所の写真画像を添付していただくとよりスムーズです。</p>
                  </div>
              </div>
              <div class="window-info__count">
                  <label class="form__label">
                    <span class="form__required">必須</span>
                      <span class="form__text">枚数</span>
                  </label>
                  <div class="window-info__wrap window-info__wrap--unit">
                    [number count-2 class:form__input-s min:1]
                  </div>
              </div>

              <div class="window-info__place">
                  <label class="form__label">
                    <span class="form__required">必須</span>
                      <span class="form__text">場所</span>
                  </label>
                  <div class="window-info__wrap">
                    <div class="form__select-wrap">
                        [select place-2 class:form__select "-- 選択してください --" "LDK" "浴室" "和室"]
                    </div>
                  </div>
              </div>
          </div>
          <div class="window-info" data-window-count="3"  style="display: none;">
              <h4 class="window-info__title">窓の情報（3）</h4>
              
              <div class="window-info__size">
                  <label class="form__label">
                    <span class="form__optional">任意</span>
                      <span class="form__text">サイズ</span>
                  </label>
                  <div class="window-info__wrap">
                    <div class="window-info__size-inputs">
                        <div class="window-info__item">
                          <span class="window-info__label">高さ</span>
                          [text height-3 class:form__input-s] 
                        </div>
                        <span>×</span>
                        <div class="window-info__item">
                          <span class="window-info__label">幅</span>
                          [text width-3 class:form__input-s] 
                        </div>
                        <span>×</span>
                        <div class="window-info__item">
                          <span class="window-info__label">窓枠</span>
                          [text frame-3 class:form__input-s]
                        </div>
                    </div>
                    <p class="window-info__note">窓枠は、窓のリフォームをご希望の方のみご記入ください。</p>
                    <div class="window-info__btn">
                      <a href="">窓の測り方</a>
                    </div>
                  </div>
              </div>

              <div class="window-info__image">
                  <label class="form__label">
                      <span class="form__optional">任意</span>
                      写真画像
                  </label>
                  <!-- ファイル入力を非表示にする -->
                  <div class="window-info__file-wrapper">
                      [file photo-3 class:form__file]
                      <span class="window-info__file-name"></span>
                      <button type="button" class="window-info__upload-btn js-file-btn">画像添付</button>
                      <p class="window-info__note">当該箇所の写真画像を添付していただくとよりスムーズです。</p>
                  </div>
              </div>
              <div class="window-info__count">
                  <label class="form__label">
                    <span class="form__required">必須</span>
                      <span class="form__text">枚数</span>
                  </label>
                  <div class="window-info__wrap window-info__wrap--unit">
                    [number count-3 class:form__input-s min:1]
                  </div>
              </div>

              <div class="window-info__place">
                  <label class="form__label">
                    <span class="form__required">必須</span>
                      <span class="form__text">場所</span>
                  </label>
                  <div class="window-info__wrap">
                    <div class="form__select-wrap">
                        [select place-3 class:form__select "-- 選択してください --" "LDK" "浴室" "和室"]
                    </div>
                  </div>
              </div>
          </div>
          <div class="window-info" data-window-count="4" style="display: none;">
              <h4 class="window-info__title">窓の情報（4）</h4>
              
              <div class="window-info__size">
                  <label class="form__label">
                    <span class="form__optional">任意</span>
                      <span class="form__text">サイズ</span>
                  </label>
                  <div class="window-info__wrap">
                    <div class="window-info__size-inputs">
                        <div class="window-info__item">
                          <span class="window-info__label">高さ</span>
                          [text height-4 class:form__input-s] 
                        </div>
                        <span>×</span>
                        <div class="window-info__item">
                          <span class="window-info__label">幅</span>
                          [text width-4 class:form__input-s] 
                        </div>
                        <span>×</span>
                        <div class="window-info__item">
                          <span class="window-info__label">窓枠</span>
                          [text frame-4 class:form__input-s]
                        </div>
                    </div>
                    <p class="window-info__note">窓枠は、窓のリフォームをご希望の方のみご記入ください。</p>
                    <div class="window-info__btn">
                      <a href="">窓の測り方</a>
                    </div>
                  </div>
              </div>

              <div class="window-info__image">
                  <label class="form__label">
                      <span class="form__optional">任意</span>
                      写真画像
                  </label>
                  <!-- ファイル入力を非表示にする -->
                  <div class="window-info__file-wrapper">
                      [file photo-4 class:form__file]
                      <span class="window-info__file-name"></span>
                      <button type="button" class="window-info__upload-btn js-file-btn">画像添付</button>
                      <p class="window-info__note">当該箇所の写真画像を添付していただくとよりスムーズです。</p>
                  </div>
              </div>
              <div class="window-info__count">
                  <label class="form__label">
                    <span class="form__required">必須</span>
                      <span class="form__text">枚数</span>
                  </label>
                  <div class="window-info__wrap window-info__wrap--unit">
                    [number count-4 class:form__input-s min:1]
                  </div>
              </div>

              <div class="window-info__place">
                  <label class="form__label">
                    <span class="form__required">必須</span>
                      <span class="form__text">場所</span>
                  </label>
                  <div class="window-info__wrap">
                    <div class="form__select-wrap">
                        [select place-4 class:form__select "-- 選択してください --" "LDK" "浴室" "和室"]
                    </div>
                  </div>
              </div>
          </div>
          <div class="window-info" data-window-count="5" style="display: none;">
              <h4 class="window-info__title">窓の情報（5）</h4>
              
              <div class="window-info__size">
                  <label class="form__label">
                    <span class="form__optional">任意</span>
                      <span class="form__text">サイズ</span>
                  </label>
                  <div class="window-info__wrap">
                    <div class="window-info__size-inputs">
                        <div class="window-info__item">
                          <span class="window-info__label">高さ</span>
                          [text height-5 class:form__input-s] 
                        </div>
                        <span>×</span>
                        <div class="window-info__item">
                          <span class="window-info__label">幅</span>
                          [text width-5 class:form__input-s] 
                        </div>
                        <span>×</span>
                        <div class="window-info__item">
                          <span class="window-info__label">窓枠</span>
                          [text frame-5 class:form__input-s]
                        </div>
                    </div>
                    <p class="window-info__note">窓枠は、窓のリフォームをご希望の方のみご記入ください。</p>
                    <div class="window-info__btn">
                      <a href="">窓の測り方</a>
                    </div>
                  </div>
              </div>

              <div class="window-info__image">
                  <label class="form__label">
                      <span class="form__optional">任意</span>
                      写真画像
                  </label>
                  <!-- ファイル入力を非表示にする -->
                  <div class="window-info__file-wrapper">
                      [file photo-5 class:form__file]
                      <span class="window-info__file-name"></span>
                      <button type="button" class="window-info__upload-btn js-file-btn">画像添付</button>
                      <p class="window-info__note">当該箇所の写真画像を添付していただくとよりスムーズです。</p>
                  </div>
              </div>
              <div class="window-info__count">
                  <label class="form__label">
                    <span class="form__required">必須</span>
                      <span class="form__text">枚数</span>
                  </label>
                  <div class="window-info__wrap window-info__wrap--unit">
                    [number count-5 class:form__input-s min:1]
                  </div>
              </div>

              <div class="window-info__place">
                  <label class="form__label">
                    <span class="form__required">必須</span>
                      <span class="form__text">場所</span>
                  </label>
                  <div class="window-info__wrap">
                    <div class="form__select-wrap">
                        [select place-5 class:form__select "-- 選択してください --" "LDK" "浴室" "和室"]
                    </div>
                  </div>
              </div>
          </div>

          <div class="form__add-btn">
            <button type="button" class="form__add-window">窓を追加する</button>
          </div>

          <div class="form__item">
              <label class="form__label">
                <span class="form__optional">任意</span>
                  <span class="form__text">現地調査希望日</span>
              </label>
              <div class="form__wrap">
                <div class="form__date">
                  <div class="window-info__wrap window-info__wrap--unit  window-info__wrap--unit--month">
                    [number preferred-month class:form__input-s min:1 max:12] 
                  </div>
                  <div class="window-info__wrap window-info__wrap--unit window-info__wrap--unit--date">
                    [number preferred-day class:form__input-s min:1 max:31] 
                  </div>
                </div>
                <p class="form__note">ご希望の調査日時間帯を記載していただくとよりスムーズです。</p>
              </div>
          </div>

          <div class="form__item">
              <label class="form__label">その他</label>
              <div class="form__wrap">
                [textarea other class:form__textarea]
              </div>
          </div>
<div class="form__submit">
[submit class:form__button "入力内容を確認"]
[multistep multistep-967 first_step send_email "/confirm/"]
  </div>
        </div>