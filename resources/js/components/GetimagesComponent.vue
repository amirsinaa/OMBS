<template>
    <div class="container" style="margin-top:20px;">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                Earlier added picture(s):
                <br />

                <div v-for="(image, index) in saved_images">
                    <div style="margin-bottom:20px;">
                        <img
                            :src="
                                workuri +
                                    '/uploads/products/thumbs/small/' +
                                    image
                            "
                            style="width: 150px;"
                        />
                        <button
                            @click="deleteImageModal(image, index)"
                            class="btn btn-danger "
                        >
                            {{ $t("c.Delete") }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Modal-->
        <div
            class="modal fade"
            id="delete-modal-2"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            {{ $t("c.Delete") }}
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Do you really want to delete this?
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            {{ $t("c.Close") }}
                        </button>
                        <button
                            type="button"
                            class="btn btn-primary"
                            @click="deleteImageOlder()"
                        >
                            {{ $t("c.Delete") }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["workuri", "product_id"],

    data() {
        return {
            saved_images: [],
            delete_image: "",
            delete_index: ""
        };
    },

    methods: {
        deleteImageModal(image, index) {
            this.delete_image = image;
            this.delete_index = index;

            $("#delete-modal-2").modal("show");
        },

        deleteImageOlder() {
            axios
                .post(this.workuri + "/uploaded_image/delete_image_older", {
                    image: this.delete_image
                })
                .then(response => {
                    this.$delete(this.saved_images, this.delete_index);

                    $("#delete-modal-2").modal("hide");
                })
                .catch(error => {});
        },

        loadImages() {
            axios
                .get(this.workuri + "/product/getimages/" + this.product_id)
                .then(response => {
                    this.saved_images = response.data.images;

                    this.$store.state.older_uploaded_images =
                        response.data.images;
                });
        }
    },

    mounted() {
        this.loadImages();
    }
};
</script>
