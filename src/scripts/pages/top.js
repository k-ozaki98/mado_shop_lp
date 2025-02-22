// ファイル選択クラス
export class TopPage {
  constructor() {
      this.init();
  }

  init() {
      this.initFileButtons();
  }

  initFileButtons() {
      document.addEventListener('click', (e) => {
          if (e.target.matches('.js-file-btn')) {
              const fileWrapper = e.target.closest('.window-info__file-wrapper');
              const fileInput = fileWrapper.querySelector('.form__file');
              
              fileInput.click();
          }
      });

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
}


export function initTop() {
  const topPage = new TopPage();
}