export function initConfirm() {
  /**
 * 確認画面のフォーム表示を改善するためのスクリプト
 */
document.addEventListener('DOMContentLoaded', function() {
  console.log('initConfirm関数が呼び出されました');
  // 確認画面かどうかを確認
  if (document.body.classList.contains('wrap--confirm')) {
    formatConfirmPage();
  }
});

/**
 * 確認画面のフォーマットを整える
 */
function formatConfirmPage() {
  // 未入力項目の処理
  handleEmptyValues();
  
  // 窓情報の表示/非表示設定
  toggleWindowInfoVisibility();
  
  // スタイルの微調整
  adjustConfirmPageStyles();
}

/**
 * 未入力項目の処理
 */
function handleEmptyValues() {
  // すべての multiform 要素を取得
  const multiformElements = document.querySelectorAll('.wpcf7-form-control-wrap.multiform');
  
  multiformElements.forEach(element => {
    // 内容が空か、スペースのみの場合
    if (!element.textContent.trim()) {
      const emptySpan = document.createElement('span');
      emptySpan.className = 'empty-value';
      emptySpan.textContent = '未入力';
      element.appendChild(emptySpan);
    }
  });
  
  // 特に窓情報のサイズ値をフォーマット
  const sizeInputs = document.querySelectorAll('.window-info__size-inputs .window-info__item');
  sizeInputs.forEach(item => {
    const valueElement = item.querySelector('.wpcf7-form-control-wrap.multiform');
    if (valueElement && valueElement.textContent.trim()) {
      // 数値の後に単位を追加
      const text = valueElement.textContent.trim();
      if (!isNaN(parseInt(text))) {
        valueElement.textContent = text + ' mm';
      }
    }
  });
}

/**
 * 窓情報の表示/非表示を設定
 */
function toggleWindowInfoVisibility() {
  // すべての窓情報セクションを取得
  const windowInfoSections = document.querySelectorAll('.window-info');
  
  windowInfoSections.forEach((section, index) => {
    // 最初のセクションは常に表示
    if (index === 0) return;
    
    // 枚数と場所が両方とも未入力の場合は非表示
    const countElement = section.querySelector('.window-info__count .wpcf7-form-control-wrap.multiform');
    const placeElement = section.querySelector('.window-info__place .wpcf7-form-control-wrap.multiform');
    
    const isEmpty = (!countElement || !countElement.textContent.trim() || countElement.textContent.trim() === '未入力') &&
                   (!placeElement || !placeElement.textContent.trim() || placeElement.textContent.trim() === '未入力');
    
    if (isEmpty) {
      section.style.display = 'none';
    }
  });
}

/**
 * 確認画面のスタイル微調整
 */
function adjustConfirmPageStyles() {
  // 必要に応じてDOMスタイルの微調整を行う
  
  // フォームのセレクトボックス値の表示改善
  const selectElements = document.querySelectorAll('.form__select-wrap .wpcf7-form-control-wrap.multiform');
  selectElements.forEach(element => {
    // 「-- 選択してください --」を表示しない
    if (element.textContent.trim() === '-- 選択してください --') {
      const emptySpan = document.createElement('span');
      emptySpan.className = 'empty-value';
      emptySpan.textContent = '未選択';
      element.textContent = '';
      element.appendChild(emptySpan);
    }
  });
  
  // 日付の表示改善
  const monthElement = document.querySelector('[name="preferred-month"]');
  const dayElement = document.querySelector('[name="preferred-day"]');
  
  if (monthElement && dayElement) {
    const monthWrap = monthElement.closest('.wpcf7-form-control-wrap');
    const dayWrap = dayElement.closest('.wpcf7-form-control-wrap');
    
    if (monthWrap && dayWrap && monthWrap.textContent.trim() && dayWrap.textContent.trim()) {
      // 数値の場合のみ処理
      const monthText = monthWrap.textContent.trim();
      const dayText = dayWrap.textContent.trim();
      
      if (!isNaN(parseInt(monthText)) && !isNaN(parseInt(dayText))) {
        monthWrap.textContent = monthText + '月';
        dayWrap.textContent = dayText + '日';
      }
    }
  }
  
  // 写真画像の表示改善
  const photoElements = document.querySelectorAll('.window-info__image .wpcf7-form-control-wrap.multiform');
  photoElements.forEach(element => {
    if (!element.textContent.trim()) {
      const emptySpan = document.createElement('span');
      emptySpan.className = 'empty-value';
      emptySpan.textContent = '添付なし';
      element.appendChild(emptySpan);
    } else {
      // 画像ファイル名がある場合はファイル名を整形
      const fileName = element.textContent.trim();
      
      // クリアなスタイルでファイル名を表示
      element.innerHTML = '';
      
      const fileIcon = document.createElement('span');
      fileIcon.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>';
      fileIcon.style.marginRight = '5px';
      fileIcon.style.display = 'inline-flex';
      fileIcon.style.verticalAlign = 'middle';
      fileIcon.style.color = '#007bff';
      
      const fileNameSpan = document.createElement('span');
      fileNameSpan.textContent = fileName;
      fileNameSpan.style.verticalAlign = 'middle';
      
      element.appendChild(fileIcon);
      element.appendChild(fileNameSpan);
    }
  });
}
}