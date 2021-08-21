<template>
    <div class="row justify-content-center">
        <div class="form-group col-xs-12 col-md-3">
            <input
                v-model="product.title"
                type="text"
                placeholder="Name"
                id="name"
                class="form-control"
            />
        </div>
        <div class="form-group col-xs-12 col-md-3">
            <input
                v-model="product.LOT_number"
                type="text"
                placeholder="LOT number"
                id="LOT_number"
                class="form-control"
            />
        </div>
        <div class="form-group col-xs-12 col-md-3">
            <input
                v-model="product.UPC"
                type="text"
                placeholder="UPC"
                id="UPC"
                class="form-control"
            />
        </div>
        <div class="form-group col-xs-12 col-md-3">
            <datetime
                v-model="product.timelimit"
                placeholder="Medicine expire date"
                class="form-control"
            ></datetime>
        </div>
        <div class="form-group col-xs-12 col-md-3">
            <input
                v-model="product.pack_size"
                type="text"
                placeholder="Pack Size"
                id="pack_size"
                class="form-control"
            />
        </div>
        <div class="form-group col-xs-12 col-md-3">
            <input
                v-model="product.DIN"
                type="text"
                placeholder="DIN"
                id="DIN"
                class="form-control"
            />
        </div>
        <div class="form-group col-xs-12 col-md-3">
            <input
                v-model="product.med_quantity"
                type="text"
                placeholder="Quantity"
                id="med_quantity"
                class="form-control"
            />
        </div>
        <div class="form-group col-xs-12 col-md-3">
            <input
                v-model="product.brand_generic"
                type="text"
                placeholder="Brand generic"
                id="brand_generic"
                class="form-control"
            />
        </div>
        <div class="form-group col-xs-12 col-md-3">
            <input
                v-model="product.generic"
                type="text"
                placeholder="Generic"
                id="generic"
                class="form-control"
            />
        </div>
        <div class="form-group col-xs-12 col-md-3">
            <input
                v-model="product.description"
                type="text"
                id="description"
                placeholder="Description"
                class="form-control"
            />
        </div>
        <div class="form-group col-xs-12 col-md-3">
            <input
                v-model="product.opening_price"
                type="text"
                placeholder="Price"
                id="opening_price"
                class="form-control"
            />
        </div>
        <div class="form-group col-xs-12 col-md-3">
            <input
                v-model="product.medicine_manufacturer"
                type="text"
                placeholder="Medicine Manufacturer"
                id="medicine_manufacturer"
                class="form-control"
            />
        </div>
        <div class="form-group col-xs-12 col-md-3">
            <input
                v-model="product.route"
                type="text"
                id="route"
                placeholder="Route"
                class="form-control"
            />
        </div>
        <div class="form-group col-xs-12 col-md-3">
            <input
                v-model="product.form"
                placeholder="Form"
                type="text"
                id="form"
                class="form-control"
            />
        </div>
        <div class="form-group col-xs-12 col-md-3">
            <input
                v-model="product.dosage"
                type="text"
                id="dosage"
                placeholder="Dosage"
                class="form-control"
            />
        </div>
        <div class="form-group col-xs-12 col-md-3">
            <select class="form-control" v-model="currency_key">
                <option value=""> {{ $t("c.Select Currency") }}: </option>
                <option v-for="currency in currency_list" :value="currency.id">
                    [{{ currency.code }}] {{ currency.country }}</option
                >
            </select>
        </div>
        <div class="form-group col-xs-12 col-md-3" style="padding-top: 2.5em;">
            <span>Auto Bid : </span>
            <input type="radio" id="auto_bid_on" name="auto_bid" value="1" v-model="product.auto_bid"/>
            <label for="auto_bid_on">
                <font color="#00B01D"><i class="fa fa-check"></i>On</font>
            </label>
            <input type="radio" id="auto_bid_off" name="auto_bid" value="0" v-model="product.auto_bid" />
            <label for="auto_bid_off">
                <font color="#FF0000"><i class="fa fa-times"></i>Off</font>
            </label>
        </div>
        <div class="mt-4 form-group">
            <button
                @click="productAdd"
                type="button"
                class="btn btn-primary btn-lg btn-block"
            >
                {{ $t("c.Send the form") }}
            </button>
        </div>
    </div>
</template>

<script>
import { Datetime } from "vue-datetime";
import "vue-datetime/dist/vue-datetime.css";

export default {
    props: ["workuri", "currency_list_json", "mycurrency_id"],
    data() {
        return {
            product: {
                title: "",
                description: "",
                LOT_number: "",
                UPC: "",
                auto_bid: "",
                pack_size: "",
                DIN: "",
                med_quantity: "",
                brand_generic: "",
                dosage: "",
                form: "",
                route: "",
                medicine_manufacturer: "",
                generic: "",
                opening_price: "",
                timelimit: "",
                images_str: ""
            },
            currency_list: JSON.parse(this.currency_list_json),
            currency_key: this.mycurrency_id
            //mycurrency_id: this.mycurrency_id,
        };
    },
    methods: {
        testData() {
            console.log(
                "uploaded_images:" +
                    this.$store.getters.uploaded_images.join(",") +
                    ", time: " +
                    this.product.timelimit.substr(0, 10) +
                    ", medicine exp date: "
            );
        },
        productAdd() {
            console.log(
                this.product.title +
                    ", " +
                    this.product.description +
                    ",timelimit" +
                    this.product.timelimit +
                    "images_str:" +
                    this.$store.getters.uploaded_images.join(",")
            );

            axios
                .post(this.workuri + "/product/add", {
                    title: this.product.title,
                    description: this.product.description,
                    currency_id: this.currency_key,
                    LOT_number: this.product.LOT_number,
                    UPC: this.product.UPC,
                    auto_bid: this.product.auto_bid,
                    pack_size: this.product.pack_size,
                    DIN: this.product.DIN,
                    med_quantity: this.product.med_quantity,
                    dosage: this.product.dosage,
                    form: this.product.form,
                    route: this.product.route,
                    medicine_manufacturer: this.product.medicine_manufacturer,
                    brand_generic: this.product.brand_generic,
                    generic: this.product.generic,
                    opening_price: this.product.opening_price,
                    timelimit: this.product.timelimit.substr(0, 10),
                    images_str: this.$store.getters.uploaded_images.join(",")
                })
                .then(response => {
                    $(".message_ok").html(response.data);
                    if (response.data.substr(0, 2) == "OK") {
                        $("#components").hide();
                        $(".message_ok").show();
                        $(".message_ok").html(response.data.substr(2));
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                    } else {
                        $(".message_error").show();
                        $(".message_error").html(response.data);
                        console.log(response.data);
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                    }
                });
        }
    },
    components: {
        datetime: Datetime
    },
    mounted() {}
};
</script>
