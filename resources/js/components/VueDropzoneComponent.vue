<template>
    <div class="justify-content-center">
        <div class="border-0 card">
            <div class="card-body">
                <vue-dropzone
                    ref="myVueDropzone"
                    id="dropzone"
                    :options="dropzoneOptions"
                    v-on:vdropzone-success="uploadSuccess"
                    :useCustomSlot="true"
                >
                    <div class="dropzone-custom-content">
                        <h3 class="dropzone-custom-title">
                            Click here you upload images
                        </h3>
                    </div>
                </vue-dropzone>
            </div>
        </div>
    </div>
</template>

<script>
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";
import VueToastr from "vue-toastr";

export default {
    props: ["workuri"],
    components: {
        vueDropzone: vue2Dropzone
    },
    data: function() {
        return {
            upload_image_arr: [],
            work_counter: 0,
            dropzoneOptions: {
                url: this.workuri + "/product/imagestore",
                headers: {
                    "X-CSRF-TOKEN": document.head.querySelector(
                        "[name=csrf-token]"
                    ).content
                }
            }
        };
    },

    methods: {
        uploadSuccess(file, response) {
            this.$refs.myVueDropzone.removeFile(file);

            this.upload_image_arr.push(response.image);

            if (
                this.work_counter +
                    this.$store.getters.older_uploaded_images.length <
                10
            ) {
                this.$store.state.uploaded_images = this.upload_image_arr;
            } else {
                this.$toastr.e("You can add 10 photos.");
                $("#dropzone").hide();
            }
            this.work_counter++;
        }
    },
    mounted() {}
};
</script>

<style>
#dropzone {
    background-color: rgba(252, 253, 254, 0.9);
    letter-spacing: 0.2px;
    color: #777;
    transition: background-color 0.2s linear;
}

#dropzone .dz-preview {
    width: 160px;
    display: inline-block;
}
#dropzone .dz-preview .dz-image {
    width: 80px;
    height: 80px;
    margin-left: 40px;
    margin-bottom: 10px;
}
#dropzone .dz-preview .dz-image > div {
    width: inherit;
    height: inherit;
    border-radius: 50%;
    background-size: contain;
}
#dropzone .dz-preview .dz-image > img {
    width: 100%;
}

#dropzone .dz-preview .dz-details {
    color: white;
    transition: opacity 0.2s linear;
    text-align: center;
}
#dropzone .dz-success-mark,
.dz-error-mark,
.dz-remove {
    display: none;
}
</style>
