<?php
get_header('', ['pageId' => 'confirm']); 
?>

<main class="confirm-page">
  <div class="l-inner confirm-page__inner">
    <h1 class="heading-A confirm-page_ttl">お問い合わせ内容の確認</h1>
    
    <div class="form-container">
      <?php
      
      // Contact Form 7フォームを表示
      echo do_shortcode('[contact-form-7 id="f3f3d81" title="お問い合わせ_copy_確認画面"]');
      ?>
      
    </div>
  </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
  console.log('確認画面スクリプト開始');
  
  // 一度だけ実行するためのフラグ
  if (window.formattedConfirmPage) {
    console.log('既にフォーマット済みのためスキップします');
    return;
  }
  
  // スクリプトが実行されたことをマーク
  window.formattedConfirmPage = true;
  
  // 即時実行
  formatConfirmPage();
});

/**
 * 確認画面のフォーマットを行う
 */
function formatConfirmPage() {
  console.log('フォーマット処理を開始します');
  
  // 最初にスタイルを追加
  addEmptyValueStyle();
  
  // 未入力項目の処理
  handleEmptyValues();
  
  // 窓情報の表示/非表示設定
  toggleWindowInfoVisibility();
  
  // スタイルの微調整
  adjustConfirmPageStyles();
}

/**
 * 未入力表示用のスタイルを追加
 */
function addEmptyValueStyle() {
  const style = document.createElement('style');
  style.textContent = `
    .empty-value {
      color: #999;
      font-size: 14px;
    }
    
    .window-info {
      margin-bottom: 30px;
      border: 1px solid #eee;
      border-radius: 5px;
      overflow: hidden;
    }
    
    .window-info__title {
      background-color: #f8f9fa;
      padding: 10px 15px;
      margin: 0 0 15px;
      border-bottom: 1px solid #eee;
    }
    
    .window-info__size,
    .window-info__count,
    .window-info__place,
    .window-info__image {
      padding: 0 15px 15px;
    }
    
    .btn-wrap {
      display: flex;
      justify-content: center;
      gap: 20px;
      margin-top: 30px;
    }
    
    .file-info {
      display: flex;
      align-items: center;
    }
    
    .file-info svg {
      margin-right: 5px;
    }
  `;
  document.head.appendChild(style);
  console.log('スタイルを追加しました');
}

/**
 * 未入力項目に「未入力」を表示
 */
function handleEmptyValues() {
  console.log('未入力項目の処理を開始');
  
  // フォーム内のすべての空の要素を探す
  const emptyElements = [];
  
  // 1. confirm__wrap内の空のp, div要素をチェック
  document.querySelectorAll('.confirm__wrap p, .confirm__wrap div:not(.form__select-wrap):not(.window-info__wrap):not(.form__date):not(.confirm__address)').forEach(el => {
    // すでに処理済みかチェック
    if (el.getAttribute('data-processed')) return;
    
    if (el.textContent.trim() === '') {
      emptyElements.push(el);
    }
    el.setAttribute('data-processed', 'true');
  });
  
  // 2. window-info内の空の要素をチェック
  document.querySelectorAll('.window-info__detail').forEach(el => {
    // すでに処理済みかチェック
    if (el.getAttribute('data-processed')) return;
    
    if (el.textContent.trim() === '') {
      emptyElements.push(el);
    }
    el.setAttribute('data-processed', 'true');
  });
  
  // 3. form__select-wrap内の空の要素をチェック
  document.querySelectorAll('.form__select-wrap').forEach(el => {
    // すでに処理済みかチェック
    if (el.getAttribute('data-processed')) return;
    
    if (el.textContent.trim() === '' || el.textContent.trim() === '-- 選択してください --') {
      emptyElements.push(el);
    }
    el.setAttribute('data-processed', 'true');
  });
  
  console.log(`空の要素を ${emptyElements.length} 個見つけました`);
  
  // 未入力テキストを追加
  emptyElements.forEach(el => {
    const span = document.createElement('span');
    span.className = 'empty-value';
    
    // 要素のタイプに応じたテキスト
    if (el.closest('.form__select-wrap')) {
      span.textContent = '未選択';
    } else {
      span.textContent = '未入力';
    }
    
    // 既存の内容をクリアして未入力テキストを追加
    el.innerHTML = '';
    el.appendChild(span);
  });
  
  // 4. 写真画像の処理
  document.querySelectorAll('.window-info__file-wrapper').forEach(el => {
    // すでに処理済みかチェック
    if (el.getAttribute('data-processed')) return;
    
    // 内容に "no file selected" があるか空の場合
    const content = el.textContent.trim();
    
    if (content === '' || content.includes('no file selected')) {
      const span = document.createElement('span');
      span.className = 'empty-value';
      span.textContent = '添付なし';
      el.innerHTML = '';
      el.appendChild(span);
    } else if (!el.classList.contains('file-formatted')) {
      // ファイル名が存在する場合はフォーマット
      formatFileDisplay(el, content);
    }
    
    el.setAttribute('data-processed', 'true');
  });
  
  // サイズの単位を追加 (重複しないよう注意)
  document.querySelectorAll('.window-info__detail').forEach(el => {
    // すでに単位処理済みかチェック
    if (el.getAttribute('data-unit-added')) return;
    
    const text = el.textContent.trim();
    if (text && text !== '未入力' && !text.includes('cm') && !isNaN(parseInt(text))) {
      el.textContent = text + ' cm';
    }
    
    el.setAttribute('data-unit-added', 'true');
  });
  
  // 枚数表示の整形
  document.querySelectorAll('.window-info__count .window-info__wrap').forEach(el => {
    // すでに処理済みかチェック
    if (el.getAttribute('data-processed')) return;
    
    const text = el.textContent.trim();
    
    // 「枚」が重複している場合は修正
    if (text.includes('枚 枚')) {
      el.textContent = text.replace('枚 枚', '枚');
    } 
    // 数値のみの場合は単位を追加
    else if (!isNaN(parseInt(text)) && !text.includes('枚')) {
      el.textContent = text + ' 枚';
    }
    // 「未入力 枚」の場合は「未入力」だけに
    else if (text === '未入力 枚') {
      el.textContent = '未入力';
    }
    
    el.setAttribute('data-processed', 'true');
  });
}

/**
 * ファイル表示を整形する
 */
function formatFileDisplay(element, fileName) {
  // ファイルアイコンと名前を表示
  element.innerHTML = '';
  element.classList.add('file-formatted');
  
  const fileInfo = document.createElement('div');
  fileInfo.className = 'file-info';
  
  // ファイルアイコン
  fileInfo.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>';
  
  // ファイル名
  const fileNameSpan = document.createElement('span');
  fileNameSpan.textContent = fileName;
  fileInfo.appendChild(fileNameSpan);
  
  element.appendChild(fileInfo);
}

/**
 * 窓情報の表示/非表示を設定
 */
function toggleWindowInfoVisibility() {
  console.log('窓情報の表示/非表示設定を開始');
  
  // すべての窓情報セクションを取得
  const windowInfoSections = document.querySelectorAll('.window-info');
  
  windowInfoSections.forEach((section, index) => {
    // 最初のセクションは常に表示
    if (index === 0) return;
    
    // セレクタを変更し、より広範囲に検索
    const countElement = section.querySelector('.window-info__count');
    const placeElement = section.querySelector('.window-info__place');
    
    // デバッグ用に詳細なログを追加
    console.log(`窓情報${index + 1} の詳細:`, {
      section: section,
      countElementHTML: countElement ? countElement.innerHTML : 'なし',
      placeElementHTML: placeElement ? placeElement.innerHTML : 'なし',
      countElementText: countElement ? countElement.textContent.trim() : 'なし',
      placeElementText: placeElement ? placeElement.textContent.trim() : 'なし'
    });
    
    // より柔軟な空判定
    const isCountEmpty = !countElement || 
        (countElement.textContent.trim() === '' || 
         countElement.textContent.trim() === '未入力' || 
         countElement.textContent.trim() === '未入力 枚' ||
         /^[0-9]+$/.test(countElement.textContent.trim()) === false);
    
    const isPlaceEmpty = !placeElement || 
        (placeElement.textContent.trim() === '' || 
         placeElement.textContent.trim() === '未選択' || 
         placeElement.textContent.trim() === '-- 選択してください --');
    
    console.log(`窓情報${index + 1}:`, {
      isCountEmpty,
      isPlaceEmpty,
      countText: countElement ? countElement.textContent.trim() : 'なし',
      placeText: placeElement ? placeElement.textContent.trim() : 'なし'
    });
    
    // 常に表示するよう変更（デバッグ用）
    section.style.display = 'block';
    
    // コメントアウトしていた非表示ロジック
    // if (isCountEmpty && isPlaceEmpty) {
    //   section.style.display = 'none';
    //   console.log(`窓情報${index + 1}を非表示にしました`);
    // } else {
    //   section.style.display = 'block';
    //   console.log(`窓情報${index + 1}を表示にしました`);
    // }
  });
}

/**
 * 確認画面のスタイル微調整
 */
function adjustConfirmPageStyles() {
  console.log('スタイル微調整を開始');
  
  // 日付の表示改善
  const monthElement = document.querySelector('.window-info__wrap--unit--month');
  const dayElement = document.querySelector('.window-info__wrap--unit--date');
  
  if (monthElement && dayElement) {
    // すでに処理済みかチェック
    if (!monthElement.getAttribute('data-processed')) {
      const monthText = monthElement.textContent.trim();
      
      // 未入力でなければ単位を追加
      if (monthText && monthText !== '未入力' && !monthText.includes('月')) {
        const monthValue = parseInt(monthText);
        if (!isNaN(monthValue)) {
          monthElement.textContent = monthValue + '月';
        }
      }
      
      monthElement.setAttribute('data-processed', 'true');
    }
    
    // すでに処理済みかチェック
    if (!dayElement.getAttribute('data-processed')) {
      const dayText = dayElement.textContent.trim();
      
      if (dayText && dayText !== '未入力' && !dayText.includes('日')) {
        const dayValue = parseInt(dayText);
        if (!isNaN(dayValue)) {
          dayElement.textContent = dayValue + '日';
        }
      }
      
      dayElement.setAttribute('data-processed', 'true');
    }
  }
}

console.log('確認ページスクリプトを読み込みました');
</script>

<?php get_footer(); ?>

