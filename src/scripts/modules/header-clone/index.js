/**
 * 指定したIDの要素をクローンし、そのクローン要素を返します。
 * 
 * @param {string} id - クローンしたい要素のID。
 * @return {HTMLElement} クローンされたヘッダー要素。
 */
const createCloneHeader = (id) => {
  const cloneHeader = document.getElementById(id).cloneNode(true)

  cloneHeader.id = `${id}-clone`
  cloneHeader.classList.add(`${id}--clone`)
  cloneHeader.classList.add('hidden')

  return cloneHeader
}

/**
 * 指定したIDの要素をクローンし、スクロール位置に基づいてクローン要素の表示・非表示を切り替えるイベントを設定します。
 * 
 * @param {string} [id='header'] - クローンおよび初期化したいヘッダー要素のID（デフォルトは'header'）。
 */
export const initCloneHeader = (id = 'header') => {
  const cloneHeader = createCloneHeader(id)
  const wrapElement = document.querySelector('.wrap')

  wrapElement.insertBefore(cloneHeader, wrapElement.firstChild)

  let prevScrollTop = 0
  window.addEventListener('scroll', function () {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop
    const headerHeight = document.getElementById(id).offsetHeight
    const isDown = scrollTop > prevScrollTop

    if (isDown) {
      cloneHeader.classList.add('hidden')
    } else {
      cloneHeader.classList.remove('hidden')
    }

    if (headerHeight > scrollTop) {
      cloneHeader.classList.add('is-top')
    } else {
      cloneHeader.classList.remove('is-top')
    }

    prevScrollTop = scrollTop
  })
}
