let $ = require('jquery')
let I18N = {
  en: require('./lang-en'),
  'zh-tw': require('./lang-zh-tw')
}
let nowIndex = 0
let isLoading = false
let LANG = 'zh-tw'

let changeLang = (lang) => {
  $('.twitch__header__title').text(I18N[lang]['title'])
  LANG = lang
  $('.twitch__content').empty()
  appendData(LANG)
}
$('.change_en').click(() => {
  changeLang('en')
})
$('.change_tw').click(() => {
  changeLang('zh-tw')
})
let getData = (lang, callback) => {
  let clientId = 'g52o5obmxfx9fjsr6w33tfepar7vc5'
  let game = 'League%20of%20Legends'
  let limit = 20
  isLoading = true
  $.ajax({
    url: `https://api.twitch.tv/kraken/streams/?game=${game}&limit=${limit}&offset=${nowIndex}&client_id=${clientId}&language=${lang}`,
    success: (response) => {
      callback(null, response)
    }
  })
}
let appendData = (lang) => {
  getData(lang, (err, data) => {
    const {
      streams
    } = data;
    const $content = $('.twitch__content')
    for (let stream of streams) {
      $content.append(getCard(stream))
    }
    nowIndex += 10
    isLoading = false
  })
}
$(document).ready(() => {
  appendData(LANG)
})
$(window).scroll(() => {
  if ($(window).scrollTop() + $(window).height() >= $(document).height() - 600) {
    if (!isLoading) {
      appendData(LANG)
    }
  }
})
let getCard = (data) => {
  return `
    <div class="twitch__content__card" onclick="location.href='${data.channel.url}'">
      <div class="twitch__content__card__video">
          <img class="video--placeholder">
          <img class="video--img" src="${data.preview.medium}" alt="video" onload="this.style.opacity=1">
      </div>
    <div class="twitch__content__card__info">
      <div class="twitch__content__card__info__avatar">
        <img class="avatar--img" src="${data.channel.logo}" alt="avatar" onload="this.style.opacity=1">
      </div>
      <div class="twitch__content__card__info__txt">
        <p class="twitch__content__card__info__channel">
        ${data.channel.status}
        </p>
        <p class="twitch__content__card__info__creator">
        ${data.channel.display_name}
        </p>
      </div>
    </div>
  </div>
  `
}