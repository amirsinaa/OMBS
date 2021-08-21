import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);
export const store = new Vuex.Store({
    state: {
        loadingStatus: "not_loading",
        images: [],
        images_mini: [],
        user_id: "",
        user_status: "",
        selected_gallery_id: 0,
        uploaded_images: [],
        older_uploaded_images: []
    },
    getters: {
        images: state => {
            return state.images;
        },
        images_mini: state => {
            return state.images_mini;
        },

        user_id: state => {
            return state.user_id;
        },

        user_status: state => {
            return state.user_status;
        },

        selected_gallery_id: state => {
            return state.selected_gallery_id;
        },

        uploaded_images: state => {
            return state.uploaded_images;
        },

        older_uploaded_images: state => {
            return state.older_uploaded_images;
        }
    },
    mutations: {
        SET_LOADING_STATUS(state, status) {
            state.loadingStatus = status;
        },
        SET_IMAGE_DATA(state, images) {
            state.images = images;
        },
        SET_USER_ID(state, user_id) {
            state.user_id = user_id;
        },
        SET_USER_STATUS(state, user_status) {
            state.user_status = user_status;
        }
    },
    actions: {
        loadImages(context, work_url) {
            context.commit("SET_LOADING_STATUS", "loading");
            var page = 1;
            if (typeof page === "undefined") {
                page = 1;
            }

            axios
                .post(
                    work_url +
                        "/image/index/" +
                        this.getters.selected_gallery_id
                )
                .then(response => {
                    context.commit("SET_LOADING_STATUS", "not_loading");

                    context.commit("SET_IMAGE_DATA", response.data.images);

                    context.commit(
                        "SET_USER_ID",
                        "_user_" + response.data.user_id
                    );

                    context.commit(
                        "SET_USER_STATUS",
                        response.data.user_status
                    );
                });
        }
    }
});
