import './style.css'
import { changeYoutubePlayer, initYoutube, stopYoutubePlayer } from './youtube'

let activePlayerType = ''
let hasYoutube = false

/**
 * ビデオモーダルのHTMLを生成する関数
 */
const createModalHtml = () => {
  const vModal = document.createElement('div')
  vModal.className = 'v-modal'
  vModal.innerHTML = `
    <div class="v-modal__inner">
      <div class="v-modal__player-wrap">
        <div id="v-modal__yt" class="v-modal__player"></div>
        <iframe src="" id="v-modal__vimeo" class="v-modal__player" width="960" height="540" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
        <video src="" id="v-modal__video" class="v-modal__player" autoplay controls></video>
      </div>
      <div class="v-modal__close">×</div>
    </div>
    <div class="v-modal__layer"></div>
  `
  document.body.appendChild(vModal)
}

/**
 * YouTubeの動画を再生する関数
 * @param {string} id - YouTubeの動画ID
 */
const playYoutube = (id) => {
  changeYoutubePlayer(id)
  document.getElementById('v-modal__yt').style.display = 'block'
}

/**
 * YouTubeの動画を停止する関数
 */
const stopYoutube = () => {
  stopYoutubePlayer()
  document.getElementById('v-modal__yt').style.display = 'none'
}

/**
 * Vimeoの動画を再生する関数
 * @param {string} id - Vimeoの動画ID
 */
const playVimeo = (id) => {
  const vimeoPlayer = document.getElementById('v-modal__vimeo')
  vimeoPlayer.src = `https://player.vimeo.com/video/${id}?autoplay=1`
  vimeoPlayer.style.display = 'block'
}

/**
 * Vimeoの動画を停止する関数
 */
const stopVimeo = () => {
  const vimeoPlayer = document.getElementById('v-modal__vimeo')
  vimeoPlayer.src = ''
  vimeoPlayer.style.display = 'none'
}

/**
 * 動画を再生する関数
 * @param {string} path - 動画のパス
 */
const playVideo = (path) => {
  const videoPlayer = document.getElementById('v-modal__video')
  videoPlayer.src = path
  videoPlayer.style.display = 'block'
}

/**
 * 動画を停止する関数
 */
const stopVideo = () => {
  const videoPlayer = document.getElementById('v-modal__video')
  videoPlayer.src = ''
  videoPlayer.style.display = 'none'
}

/**
 * モーダルを開く関数
 * @param {Object} dataset - データセットオブジェクト
 */
const openModal = (dataset) => {
  activePlayerType = dataset.type
  const vModal = document.querySelector('.v-modal')
  vModal.classList.add('active')

  switch (activePlayerType) {
    case 'youtube': {
      const id = dataset.id
      playYoutube(id)
      break
    }
    case 'vimeo': {
      const id = dataset.id
      playVimeo(id)
      break
    }
    case 'video': {
      const path = dataset.path
      playVideo(path)
      break
    }
    default:
      break
  }
}

/**
 * モーダルを閉じる関数
 */
const closeModal = () => {
  const vModal = document.querySelector('.v-modal')
  vModal.classList.remove('active')

  switch (activePlayerType) {
    case 'youtube': {
      stopYoutube()
      break
    }
    case 'vimeo':
      stopVimeo()
      break
    case 'video':
      stopVideo()
      break
    default:
      break
  }

  activePlayerType = ''
}

/**
 * ビデオモーダルを初期化する関数。html要素にdata-type（youtube|vimeo|video）data-id（youtube,vimeoの場合） data-path（videoの場合）を指定します。
 * @param {string} className - モーダルを表示する要素のクラス名
 * @param {Object} params - パラメータオブジェクト (デフォルト値: {})
 */
export const videoModal = (className, params = {}) => {
  createModalHtml()

  const elements = document.querySelectorAll(className)
  elements.forEach((element) => {
    if (element.dataset.type === 'youtube') {
      hasYoutube = true
    }
  })

  if (hasYoutube) {
    initYoutube()
  }

  elements.forEach((element) => {
    element.addEventListener('click', function () {
      const dataset = this.dataset
      openModal(dataset)
    })
  })

  const vModalLayer = document.querySelector('.v-modal__layer')
  const vModalClose = document.querySelector('.v-modal__close')
  vModalLayer.addEventListener('click', closeModal)
  vModalClose.addEventListener('click', closeModal)
}
