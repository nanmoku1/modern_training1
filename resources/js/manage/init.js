import alpinejs from 'alpinejs';
import axios from 'axios';
import * as popperjs from '@popperjs/core';

// breezeインストール時に自動作成されたページで使用されている
// 該当ページは、Alpineに依存しない形に書き換えたいが、そこそこ書き換え箇所が多く、書き換え作業は学習したい本筋と反れてしまう為、一旦保留
// リファクタリングするまではAlpineを使う
window.Alpine = alpinejs;
alpinejs.start();

window.Axios = axios;
window.Axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Popper = popperjs;
