<template>
    <div class="d-flex">
        <div style="display: inline-flex;text-align:center">
            {{ $t("c.New picture(s)") }}:
            <div v-for="(image, index) in uploaded_images">
                <div style="display: inline-flex;">
                    <img
                        :src="workuri + '/uploads/products/originals/' + image"
                        style="width: 150px;height:85px;display: inline-flex;"
                    />
                    <button
                        @click="deleteImageModal(image, index)"
                        class="btn btn-danger"
                        style="display: inline-flex;"
                    >
                        {{ $t("c.Delete") }}
                    </button>
                </div>
            </div>
        </div>
        <!-- Delete Modal-->
        <div
            class="modal fade"
            id="delete-modal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            Delete
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
                        {{ $t("c.Close") }}
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
                            @click="deleteImage()"
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
    props: ["workuri"],

    data() {
        return {
            delete_image: "",
            delete_index: ""
        };
    },

    computed: {
        uploaded_images: {
            get: function() {
                return this.$store.getters.uploaded_images;
            }
        }
    },

    methods: {
        deleteImageModal(image, index) {
            // console.log("image: " + image);

            //let confirmBox = confirm("Do you really want to delete this?");
            this.delete_image = image;
            this.delete_index = index;

            $("#delete-modal").modal("show");
        },

        deleteImage() {
            //console.log("image : " +this.delete_image);

            axios
                .post(this.workuri + "/uploaded_image/delete_image", {
                    image: this.delete_image
                })
                .then(response => {
                    this.$delete(this.uploaded_images, this.delete_index);

                    $("#delete-modal").modal("hide");
                })
                .catch(error => {
                    // console.log("Could not delete for some reason ");
                });
        }
    },

    mounted() {
        // console.log('Component mounted.')
    }
};
</script>
