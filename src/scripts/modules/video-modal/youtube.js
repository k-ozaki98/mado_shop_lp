let ytPlayer = null

/**
 * YouTube APIをロードする関数
 */
export const youtubeApiLoad = () => {
  const tag = document.createElement('script')
  tag.src = 'https://www.youtube.com/iframe_api'
  const firstScriptTag = document.getElementsByTagName('script')[0]
  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag)
}

/**
 * YouTubeプレーヤーを作成する関数
 * @returns {Object} YouTubeプレーヤーオブジェクト
 */
export const createYoutubePlayer = () => {
  const ytParam = {
    height: 540,
    width: 960,
    wmode: 'transparent',
    playerVars: {
      modestbranding: 1,
      rel: 0,
      showinfo: 0,
      controls: 1,
      autoplay: 0,
      enablejsapi: 1,
      version: 3,
      allowfullscreen: true,
      disablekb: 1,
      events: {
        onReady: () => {},
        onStateChange: (e) => {
          const status = e.data
          if (status === 0) {
            e.target.stopVideo()
          }
        }
      }
    }
  }

  const player = new window.YT.Player('v-modal__yt', {
    ...ytParam
  })

  return player
}

/**
 * YouTubeプレーヤーの再生内容を変更する関数
 * @param {string} id - YouTubeビデオのID
 */
export const changeYoutubePlayer = (id) => {
  if (ytPlayer === null) {
    ytPlayer = createYoutubePlayer()
  }
  ytPlayer.loadVideoById(id, 0)
}

/**
 * YouTubeプレーヤーの再生を停止する関数
 */
export const stopYoutubePlayer = () => {
  ytPlayer.stopVideo()
}

/**
 * YouTubeの初期化を行う関数
 */
export const initYoutube = () => {
  youtubeApiLoad()
  window.onYouTubeIframeAPIReady = () => {
    ytPlayer = createYoutubePlayer()
  }
}
