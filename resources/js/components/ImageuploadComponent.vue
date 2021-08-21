<template>
    <div
        class="container"
        :key="varThatChangesValue"
        style="margin-bottom:20px;"
    >
        <div v-if="loading">
            <img class="mx-auto rounded d-block" :src="image" alt="loader" />
        </div>
        <div class="my-2 col-sm-12">
            {{ $t("c.You can add 10 photos") }}
        </div>

        <div
            class="large-12 medium-12 small-12 filezone"
            v-if="current_older_uploaded_images_count < 10"
        >
            <input
                type="file"
                id="files"
                ref="files"
                multiple
                v-on:change="handleFiles()"
            />
            <p>
                Click here you upload images
            </p>
        </div>

        <div v-for="(file, key) in files" class="file-listing">
            <img class="preview" v-bind:ref="'preview' + parseInt(key)" />
            {{ file.name }}
            <div class="success-container" v-if="file.id > 0">
                {{ $t("c.Success") }}
                <input type="hidden" :name="input_name" :value="file.id" />
            </div>
            <div class="remove-container" v-else>
                <a class="remove" v-on:click="removeFile(key)">
                    {{ $t("c.Remove") }}
                </a>
            </div>
        </div>

        <div v-if="loading">
            <img class="mx-auto rounded d-block" :src="image" alt="loader" />
        </div>

        <a
            class="submit-button btn btn-primary btn-lg"
            v-on:click="submitFiles()"
            v-show="files.length > 0"
            style="cursor: pointer;height:100px;padding-top:40px;"
        >
            <span class="spinner-grow " role="status" aria-hidden="true"></span>
            <span class="sr-only">Loading...</span>
            {{ $t("c.Push this Button if you want to UPLOAD this picture(s)") }}
            <span class="spinner-grow " role="status" aria-hidden="true"></span>
            <span class="sr-only">Loading...</span>
        </a>

        <span v-show="files.length > 0">
            {{
                $t(
                    "c.When you click -Send the form - button the picture(s) will be added to the form"
                )
            }}
        </span>
    </div>
</template>

<script>
export default {
    props: ["input_name", "workuri"],
    data() {
        return {
            varThatChangesValue: 0,
            files: [],
            files_index: 0,
            work_counter: 0,
            uri: this.workuri,
            upload_status: "on",
            image: this.workuri + "/design/loader.gif",
            loading: false,
            upload_image_arr: [],
            toastr: (toastr.options = {
                positionClass: "toast-top-full-width"
            }),
            current_older_uploaded_images_count: 0
        };
    },
    methods: {
        removeFile(key) {
            this.files.splice(key, 1);
            this.getImagePreviews();
        },
        handleFiles() {
            this.current_older_uploaded_images_count = this.$store.getters.older_uploaded_images.length;
            console.log(
                "older uploaded picture count: " +
                    this.current_older_uploaded_images_count
            );

            let uploadedFiles = this.$refs.files.files;

            var realNumber = 0;

            if (
                uploadedFiles.length >
                10 - this.current_older_uploaded_images_count
            ) {
                realNumber = 10 - this.current_older_uploaded_images_count;
            } else {
                realNumber = uploadedFiles.length;
            }

            for (var i = 0; i < realNumber; i++) {
                this.files.push(uploadedFiles[i]);
            }
            this.getImagePreviews();
        },
        getImagePreviews() {
            for (let i = 0; i < this.files.length; i++) {
                if (/\.(jpe?g|png|gif)$/i.test(this.files[i].name)) {
                    let reader = new FileReader();
                    reader.addEventListener(
                        "load",
                        function() {
                            this.$refs["preview" + parseInt(i)][0].src =
                                reader.result;
                        }.bind(this),
                        false
                    );
                    reader.readAsDataURL(this.files[i]);
                }
            }
        },
        submitFiles() {
            this.worker();
            this.loading = true;

            $(".file-listing").remove();
        },
        worker() {
            let formData = new FormData();
            formData.append("file", this.files[this.files_index]);
            formData.append("gallery_id", this.selected_gallery_id);

            if (this.files[this.files_index] !== undefined) {
                axios
                    .post(this.uri + "/product/imagestore", formData, {
                        headers: {
                            "Content-Type": "multipart/form-data"
                        }
                    })
                    .then(
                        function(data) {
                            this.upload_image_arr.push(data["data"]["image"]);

                            if (data.data.error == "") {
                                toastr.success(data.data.info);
                                this.$root.$emit("loadImages");

                                if (this.files_index < this.files.length + 1) {
                                    this.files_index++;

                                    this.worker();
                                }
                            } else {
                                toastr.error(data.data.error);
                                this.$root.$emit("loadImages");
                                if (this.files_index < this.files.length + 1) {
                                    this.files_index++;
                                    this.worker();
                                }
                            }
                        }.bind(this)
                    );
            } else {
                if (this.files_index < this.files.length + 1) {
                    this.files_index++;
                    this.worker();
                }
            }
            this.work_counter++;
            if (this.work_counter > this.files.length) {
                this.files = [];
                this.files_index = 0;
                this.work_counter = 0;
                this.loading = false;
                this.$store.state.uploaded_images = this.upload_image_arr;
            }
        }
    },
    computed: {
        images: {
            get: function() {
                return this.$store.getters.images;
            }
        },
        selected_gallery_id: {
            get: function() {}
        },

        uploaded_images: {
            get: function() {
                return this.$store.getters.uploaded_images;
            }
        }
    },

    mounted() {}
};
</script>

<style scoped>
input[type="file"] {
    opacity: 0;
    width: 100%;
    height: 200px;
    position: absolute;
    cursor: pointer;
}
.filezone {
    outline: 2px dashed grey;
    outline-offset: -10px;
    background: #add8e6;
    color: dimgray;
    padding: 10px 10px;
    min-height: 200px;
    position: relative;
    cursor: pointer;
}
.filezone:hover {
    background: #6495ed;
}

.filezone p {
    font-size: 1.2em;
    text-align: center;
    padding: 50px 50px 50px 50px;
}
div.file-listing img {
    max-width: 90%;
}

div.file-listing {
    margin: auto;
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

div.file-listing img {
    height: 100px;
}
div.success-container {
    text-align: center;
    color: green;
}

div.remove-container {
    text-align: center;
}

div.remove-container a {
    color: red;
    cursor: pointer;
}

a.submit-button {
    display: block;
    margin: auto;
    text-align: center;
    padding: 10px;
    background-color: #6495ed;
    color: white;
    font-weight: bold;
    margin-top: 20px;
}

a.submit-button:hover {
    background: #4169e1;
}
</style>
