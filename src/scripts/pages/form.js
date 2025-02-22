
export class FormHandler {
  constructor() {
      this.windowCount = 1;
      this.maxWindows = 5;
      this.init();
  }

  init() {
      // 追加ボタンのイベントリスナー
      const addButton = document.querySelector('.form__add-window');
      if (addButton) {
          addButton.addEventListener('click', () => this.addWindow());
      }

      // 削除ボタンとファイル選択のイベント委譲
      document.addEventListener('click', (e) => {
          if (e.target.matches('.window-info__remove')) {
              this.removeWindow(e.target.closest('.window-info'));
          }
          if (e.target.matches('.js-file-btn')) {
              const fileWrapper = e.target.closest('.window-info__file-wrapper');
              const fileInput = fileWrapper.querySelector('.form__file');
              fileInput.click();
          }
      });

      // ファイル選択時の処理
      document.addEventListener('change', (e) => {
          if (e.target.matches('.form__file')) {
              const fileWrapper = e.target.closest('.window-info__file-wrapper');
              const fileNameSpan = fileWrapper.querySelector('.window-info__file-name');
              if (e.target.files.length > 0) {
                  fileNameSpan.textContent = e.target.files[0].name;
              } else {
                  fileNameSpan.textContent = '';
              }
          }
      });
  }

  addWindow() {
      if (this.windowCount >= this.maxWindows) {
          alert('窓の追加は最大5つまでです');
          return;
      }

      this.windowCount++;
      const newWindow = this.createWindowTemplate(this.windowCount);
      
      const addButton = document.querySelector('.form__add-btn');
      addButton.insertAdjacentHTML('beforebegin', newWindow);

      if (this.windowCount >= this.maxWindows) {
          document.querySelector('.form__add-btn').style.display = 'none';
      }
  }

  removeWindow(windowElement) {
      windowElement.remove();
      this.windowCount--;

      // 窓情報の番号を振り直す
      const windowInfos = document.querySelectorAll('.window-info');
      windowInfos.forEach((info, index) => {
          const num = index + 1;
          info.querySelector('.window-info__title').textContent = `窓の情報（${num}）`;
          info.dataset.windowCount = num;
          
          // 各input要素のname属性を更新
          info.querySelectorAll('input, select').forEach(input => {
              input.name = input.name.replace(/\d+/, num);
          });
      });

      // 追加ボタンを再表示
      document.querySelector('.form__add-btn').style.display = 'block';
  }

  createWindowTemplate(num) {
    return `
        <div class="window-info" data-window-count="${num}">
            <h4 class="window-info__title">窓の情報（${num}）</h4>
            <button type="button" class="window-info__remove">×</button>
            
            <div class="window-info__size">
                <label class="form__label">
                    <span class="form__optional">任意</span>
                    <span class="form__text">サイズ</span>
                </label>
                <div class="window-info__wrap">
                    <div class="window-info__size-inputs">
                        <div class="window-info__item">
                            <span class="window-info__label">高さ</span>
                            <input type="text" name="height-${num}" class="form__input-s"> 
                        </div>
                        <span>×</span>
                        <div class="window-info__item">
                            <span class="window-info__label">幅</span>
                            <input type="text" name="width-${num}" class="form__input-s"> 
                        </div>
                        <span>×</span>
                        <div class="window-info__item">
                            <span class="window-info__label">窓枠</span>
                            <input type="text" name="frame-${num}" class="form__input-s">
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
                <div class="window-info__file-wrapper">
                    <input type="file" name="photo-${num}" class="form__file">
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
                    <input type="number" name="count-${num}" class="form__input-s" min="1" required>
                </div>
            </div>

            <div class="window-info__place">
                <label class="form__label">
                    <span class="form__required">必須</span>
                    <span class="form__text">場所</span>
                </label>
                <div class="window-info__wrap">
                    <div class="form__select-wrap">
                        <select name="place-${num}" class="form__select" required>
                            <option value="">-- 選択してください --</option>
                            <option value="リビング">リビング</option>
                            <option value="寝室">寝室</option>
                            <option value="キッチン">キッチン</option>
                            <option value="浴室">浴室</option>
                            <option value="トイレ">トイレ</option>
                            <option value="その他">その他</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    `;
}
}

export function initForm() {
  new FormHandler();
}