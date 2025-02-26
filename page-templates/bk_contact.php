<div class="confirm">
          <div class="confirm__item">
              <label class="confirm__label">
                  <span class="confirm__text">お名前</span>
              </label>
              <div class="confirm__wrap">
                [multiform your-name-confirm]
              </div>
          </div>

          <div class="confirm__item">
              <label class="confirm__label">
                  <span class="confirm__text">メールアドレス</span>
              </label>
              <div class="confirm__wrap">
                [multiform your-email-confirm]
              </div>
          </div>

          <div class="confirm__item">
              <label class="confirm__label">郵便番号</label>
              <div class="confirm__wrap">
                [multiform zip-confirm]
              </div>
          </div>

          <div class="confirm__item">
              <label class="confirm__label">
                  <span class="confirm__text">住所</span>
                  
              </label>
              <div class="confirm__wrap">
                <div class="confirm__address">
                  <label class="confirm__label">
                    <span class="confirm__address-text">都道府県</span>
                  </label>
                  <div class="form__select-wrap">
                    [multiform prefecture]
                  </div>

                </div>
                
                  <div class="confirm__address">
                    <label class="confirm__label">
                      <span class="confirm__address-text">市区町村・番地</span>
                    </label>
                    <p>
                      [multiform city-confirm]
                    </p>
                  </div>
                  <div class="confirm__address">
                    <label class="confirm__label">
                      <span class="confirm__address-text">建物名・部屋番号</span>
                    </label>
                    <p>
                      [multiform building]
                    </p>
                  </div>
              </div>
          </div>

          <div class="confirm__item">
              <label class="confirm__label">
                  <span class="confirm__text">電話番号</span>
              </label>
              <div class="confirm__wrap">
                [multiform tel-confirm]
              </div>
          </div>

          <h3 class="form__subtitle">詳しいお問い合わせ内容</h3>

          <div class="confirm__item">
              <label class="confirm__label">
                  <span class="confirm__text">お住まいのタイプ</span>
              </label>
              <div class="form__select-wrap">
                  [multiform house-type]
              </div>
          </div>

          <div class="confirm__item">
              <label class="confirm__label">
                  <span class="confirm__text">リフォームしたい箇所</span>
              </label>
              <div class="form__select-wrap">
                  [multiform reform-place]
              </div>
          </div>

          <!-- 窓の情報 -->
          <div class="window-info" data-window-count="1">
              <h4 class="window-info__title">窓の情報（1）</h4>
              
              <div class="window-info__size">
                  <label class="confirm__label">
                      <span class="confirm__text">サイズ</span>
                  </label>
                  <div class="window-info__wrap">
                    <div class="window-info__size-inputs">
                        <div class="window-info__item">
                          <span class="window-info__label">高さ</span>
                          <p class="window-info__detail">
                            [multiform height-1]

                          </p>
                        </div>
                        <span>×</span>
                        <div class="window-info__item">
                          <span class="window-info__label">幅</span>
                          <div class="window-info__detail">
                            [multiform width-1]

                          </div>
                        </div>
                        <span>×</span>
                        <div class="window-info__item">
                          <span class="window-info__label">窓枠</span>
                          [multiform frame-1]
                        </div>
                    </div>
                  </div>
              </div>

              <div class="window-info__image">
                  <label class="confirm__label">
                      写真画像
                  </label>
                  <!-- ファイル入力を非表示にする -->
                  <div class="window-info__file-wrapper">
                      [multiform photo-1]
                  </div>
              </div>
              <div class="window-info__count">
                  <label class="confirm__label">
                      <span class="confirm__text">枚数</span>
                  </label>
                  <div class="window-info__wrap window-info__wrap--unit">
                    [multiform count-1]
                  </div>
              </div>

              <div class="window-info__place">
                  <label class="confirm__label">
                      <span class="confirm__text">場所</span>
                  </label>
                  <div class="window-info__wrap">
                    <div class="form__select-wrap">
                        [multiform place-1]
                    </div>
                  </div>
              </div>
          </div>
          <div class="window-info" data-window-count="2">
              <h4 class="window-info__title">窓の情報（2）</h4>
              
              <div class="window-info__size">
                  <label class="confirm__label">
                      <span class="confirm__text">サイズ</span>
                  </label>
                  <div class="window-info__wrap">
                    <div class="window-info__size-inputs">
                        <div class="window-info__item">
                          <span class="window-info__label">高さ</span>
                          [multiform height-2]
                        </div>
                        <span>×</span>
                        <div class="window-info__item">
                          <span class="window-info__label">幅</span>
                          [multiform width-2]
                        </div>
                        <span>×</span>
                        <div class="window-info__item">
                          <span class="window-info__label">窓枠</span>
                          [multiform frame-2]
                        </div>
                    </div>
                  </div>
              </div>

              <div class="window-info__image">
                  <label class="confirm__label">
                      写真画像
                  </label>
                  <!-- ファイル入力を非表示にする -->
                  <div class="window-info__file-wrapper">
                      [multiform photo-2]
                  </div>
              </div>
              <div class="window-info__count">
                  <label class="confirm__label">
                      <span class="confirm__text">枚数</span>
                  </label>
                  <div class="window-info__wrap window-info__wrap--unit">
                    [multiform count-2]
                  </div>
              </div>

              <div class="window-info__place">
                  <label class="confirm__label">
                      <span class="confirm__text">場所</span>
                  </label>
                  <div class="window-info__wrap">
                    <div class="form__select-wrap">
                        [multiform place-2]
                    </div>
                  </div>
              </div>
          </div>
          <div class="window-info" data-window-count="3" >
              <h4 class="window-info__title">窓の情報（3）</h4>
              
              <div class="window-info__size">
                  <label class="confirm__label">
                      <span class="confirm__text">サイズ</span>
                  </label>
                  <div class="window-info__wrap">
                    <div class="window-info__size-inputs">
                        <div class="window-info__item">
                          <span class="window-info__label">高さ</span>
                          [multiform height-3]
                        </div>
                        <span>×</span>
                        <div class="window-info__item">
                          <span class="window-info__label">幅</span>
                          [multiform width-3]
                        </div>
                        <span>×</span>
                        <div class="window-info__item">
                          <span class="window-info__label">窓枠</span>
                          [multiform frame-3]
                        </div>
                    </div>
                  </div>
              </div>

              <div class="window-info__image">
                  <label class="confirm__label">
                      写真画像
                  </label>
                  <!-- ファイル入力を非表示にする -->
                  <div class="window-info__file-wrapper">
                      [multiform photo-3]
                  </div>
              </div>
              <div class="window-info__count">
                  <label class="confirm__label">
                      <span class="confirm__text">枚数</span>
                  </label>
                  <div class="window-info__wrap window-info__wrap--unit">
                    [multiform count-3]
                  </div>
              </div>

              <div class="window-info__place">
                  <label class="confirm__label">
                      <span class="confirm__text">場所</span>
                  </label>
                  <div class="window-info__wrap">
                    <div class="form__select-wrap">
                        [multiform place-3]
                    </div>
                  </div>
              </div>
          </div>
          <div class="window-info" data-window-count="4" >
              <h4 class="window-info__title">窓の情報（4）</h4>
              
              <div class="window-info__size">
                  <label class="confirm__label">
                      <span class="confirm__text">サイズ</span>
                  </label>
                  <div class="window-info__wrap">
                    <div class="window-info__size-inputs">
                        <div class="window-info__item">
                          <span class="window-info__label">高さ</span>
                          [multiform height-4]
                        </div>
                        <span>×</span>
                        <div class="window-info__item">
                          <span class="window-info__label">幅</span>
                          [multiform width-4]
                        </div>
                        <span>×</span>
                        <div class="window-info__item">
                          <span class="window-info__label">窓枠</span>
                          [multiform frame-4]
                        </div>
                    </div>
                  </div>
              </div>

              <div class="window-info__image">
                  <label class="confirm__label">
                      写真画像
                  </label>
                  <!-- ファイル入力を非表示にする -->
                  <div class="window-info__file-wrapper">
                      [multiform photo-4]
                  </div>
              </div>
              <div class="window-info__count">
                  <label class="confirm__label">
                      <span class="confirm__text">枚数</span>
                  </label>
                  <div class="window-info__wrap window-info__wrap--unit">
                    [multiform count-4]
                  </div>
              </div>

              <div class="window-info__place">
                  <label class="confirm__label">
                      <span class="confirm__text">場所</span>
                  </label>
                  <div class="window-info__wrap">
                    <div class="form__select-wrap">
                        [multiform place-4]
                    </div>
                  </div>
              </div>
          </div>
          <div class="window-info" data-window-count="5">
              <h4 class="window-info__title">窓の情報（5）</h4>
              
              <div class="window-info__size">
                  <label class="confirm__label">
                      <span class="confirm__text">サイズ</span>
                  </label>
                  <div class="window-info__wrap">
                    <div class="window-info__size-inputs">
                        <div class="window-info__item">
                          <span class="window-info__label">高さ</span>
                          [multiform height-5]
                        </div>
                        <span>×</span>
                        <div class="window-info__item">
                          <span class="window-info__label">幅</span>
                          [multiform width-5]
                        </div>
                        <span>×</span>
                        <div class="window-info__item">
                          <span class="window-info__label">窓枠</span>
                          [multiform frame-5]
                        </div>
                    </div>
                  </div>
              </div>

              <div class="window-info__image">
                  <label class="confirm__label">
                      写真画像
                  </label>
                  <!-- ファイル入力を非表示にする -->
                  <div class="window-info__file-wrapper">
                      [multiform photo-5]
                  </div>
              </div>
              <div class="window-info__count">
                  <label class="confirm__label">
                      <span class="confirm__text">枚数</span>
                  </label>
                  <div class="window-info__wrap window-info__wrap--unit">
                    [multiform count-5]
                  </div>
              </div>

              <div class="window-info__place">
                  <label class="confirm__label">
                      <span class="confirm__text">場所</span>
                  </label>
                  <div class="window-info__wrap">
                    <div class="form__select-wrap">
                        [multiform place-5]
                    </div>
                  </div>
              </div>
          </div>

          <div class="confirm__item">
              <label class="confirm__label">
                  <span class="confirm__text">現地調査希望日</span>
              </label>
              <div class="confirm__wrap">
                <div class="form__date">
                  <div class="window-info__wrap window-info__wrap--unit  window-info__wrap--unit--month">
                    [multiform preferred-month]
                  </div>
                  <div class="window-info__wrap window-info__wrap--unit window-info__wrap--unit--date">
                    [multiform preferred-day]
                  </div>
                </div>
              </div>
          </div>

          <div class="confirm__item">
              <label class="confirm__label">その他</label>
              <div class="confirm__wrap">
                [multiform other]
              </div>
          </div>
<div class="form__submit">
　　　[previous previous-196 "戻る"]
    [submit class:form__button "送信"]
[multistep multistep-11 last_step send_email "/thanks/"]
  </div>
        </div>