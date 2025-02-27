
<footer class="footer">
    <p class="copyright">© Kashiwaya Corporation All Rights Reserved.</p>
</footer>
<script>
document.addEventListener('DOMContentLoaded', function() {
  var windowCountInput = document.querySelector('input[name="window_count"]');
  if (windowCountInput) {
    var windowCount = windowCountInput.value;
    var windowInfos = document.querySelector('.window-infos');

    for (var i = 1; i <= windowCount; i++) {
      var windowHTML = `
        <div class="window-info" data-index="${i}">
          <h4 class="window-info__title">窓の情報（${i}）</h4>

          <div class="window-info__size">
              <label class="confirm__label">
                  <span class="confirm__text">サイズ</span>
              </label>
              <div class="window-info__wrap">
                <div class="window-info__size-inputs">
                    <div class="window-info__item">
                      <span class="window-info__label">高さ</span>
                      <p class="window-info__detail">
                        [multiform height-${i}]
                      </p>
                    </div>
                    <span>×</span>
                    <div class="window-info__item">
                      <span class="window-info__label">幅</span>
                      <div class="window-info__detail">
                        [multiform width-${i}]
                      </div>
                    </div>
                    <span>×</span>
                    <div class="window-info__item">
                      <span class="window-info__label">窓枠</span>
                      <div class="window-info__detail">
                        [multiform frame-${i}]
                      </div>
                    </div>
                </div>
              </div>
          </div>

          <div class="window-info__image">
              <label class="confirm__label">
                  写真画像
              </label>
              <div class="window-info__file-wrapper">
                  [multiform photo-${i}]
              </div>
          </div>
          <div class="window-info__count">
              <label class="confirm__label">
                  <span class="confirm__text">枚数</span>
              </label>
              <div class="window-info__wrap window-info__wrap--unit">
                [multiform count-${i}]
              </div>
          </div>

          <div class="window-info__place">
              <label class="confirm__label">
                  <span class="confirm__text">場所</span>
              </label>
              <div class="window-info__wrap">
                <div class="form__select-wrap">
                    [multiform place-${i}]
                </div>
              </div>
          </div>
        </div>
      `;
      windowInfos.insertAdjacentHTML('beforeend', windowHTML);
    }
  }
});
</script>

<?php wp_footer(); ?>
</div>
</body>
</html>