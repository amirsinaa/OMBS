require("./bootstrap");

window.Vue = require("vue");

import VueInternationalization from "vue-i18n";
import Locale from "./vue-i18n-locales.generated";

Vue.use(VueInternationalization);

const lang = document.documentElement.lang.substr(0, 2);

const i18n = new VueInternationalization({
    locale: lang,
    messages: Locale
});

Vue.component(
    "vue-dropzone-component",
    require("./components/VueDropzoneComponent.vue").default
);
Vue.component(
    "imageupload-component",
    require("./components/ImageuploadComponent.vue").default
);
Vue.component(
    "imagelist-component",
    require("./components/ImagelistComponent.vue").default
);
Vue.component(
    "productadd-component",
    require("./components/ProductaddComponent.vue").default
);
Vue.component(
    "productedit-component",
    require("./components/ProducteditComponent.vue").default
);
Vue.component(
    "getimages-component",
    require("./components/GetimagesComponent.vue").default
);
Vue.component(
    "notificationmarkasread-component",
    require("./components/NotificationmarkasreadComponent.vue").default
);
Vue.component(
    "showmessages-component",
    require("./components/ShowmessagesComponent.vue").default
);
Vue.component(
    "basket-component",
    require("./components/BasketComponent.vue").default
);
Vue.component(
    "addtobidderbasket-component",
    require("./components/AddtobidderbasketComponent.vue").default
);

import { store } from "./store/store";

const app = new Vue({
    el: "#app",
    store,
    i18n
});
