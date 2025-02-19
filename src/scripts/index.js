import { initHmbMenu } from './modules/hamburger-menu'
import { initPageTop } from './modules/page-top'
import { initCloneHeader } from './modules/header-clone'
import { PAGETOP_IN_TRIGGER } from './config'

import { initTop } from './pages/top'

import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'
import { initCommon } from './common'
import '../styles/style.scss'
gsap.registerPlugin(ScrollTrigger)

document.addEventListener('DOMContentLoaded', () => {
  initHmbMenu()
  initPageTop('js-pagetop', PAGETOP_IN_TRIGGER)
  initCloneHeader() // 不要なら削除してください  
  initCommon()
  const pageId = document.querySelector('body').getAttribute('data-pageid')
  const isTop = pageId === 'top';
  if (isTop) {
    initTop() // トップページ用スクリプト
  }
})
