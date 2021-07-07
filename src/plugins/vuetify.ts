import Vue from 'vue';
import Vuetify from 'vuetify/lib/framework';

import icons from '@/plugins/icons';
import light from '@/plugins/themes/light';

Vue.use(Vuetify);

export default new Vuetify({
  icons,
  theme: {
    options: {
      customProperties: true,
    },
    themes: {
      light,
    },
  },
});
