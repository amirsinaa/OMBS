<template>
    <div class="container" style="margin-top:20px;">
        <ul class="nav nav-tabs nav-justified">
            <li class="nav-item">
                <a
                    class="nav-link"
                    @click.prevent="setActive('basket')"
                    :class="{ active: isActive('basket') }"
                    href="#basket"
                >
                    {{ $t("c.Basket") }}</a
                >
            </li>
            <li class="nav-item">
                <a
                    class="nav-link"
                    @click.prevent="setActive('address')"
                    :class="{ active: isActive('address') }"
                    href="#address"
                >
                    {{ $t("c.Address") }}</a
                >
            </li>
            <li class="nav-item">
                <a
                    class="nav-link"
                    @click.prevent="setActive('payment')"
                    :class="{ active: isActive('payment') }"
                    href="#payment"
                >
                    {{ $t("c.Payment") }}</a
                >
            </li>
            <li class="nav-item">
                <a
                    class="nav-link"
                    @click.prevent="setActive('summary')"
                    :class="{ active: isActive('summary') }"
                    href="#summary"
                >
                    {{ $t("c.Summary") }}</a
                >
            </li>
        </ul>
        <div class="py-3 tab-content" id="myTabContent">
            <div
                class="tab-pane fade"
                :class="{ 'active show': isActive('basket') }"
                id="basket"
            >
                <table class="table">
                    <thead>
                        <tr>
                            <td>
                                <b>Seller</b>
                            </td>
                            <td>
                                <b>Title</b>
                            </td>
                            <td>
                                <b>Final price</b>
                            </td>
                        </tr>
                    </thead>
                    <tbody v-for="(data, index) in product_data">
                        <tr>
                            <td>{{ data.owner_name }}</td>
                            <td>{{ data.title }}</td>
                            <td>{{ data.bid }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div
                class="tab-pane fade"
                :class="{ 'active show': isActive('address') }"
                id="address"
            >
                <input ref="order_information_type" type="hidden" value="1" />
                <h1>{{ $t("c.Delivery address") }}</h1>
                <div class="form-group">
                    <label for="name">{{ $t("c.First name") }}: </label>
                    <input
                        v-model="address_data.delivery_firstname"
                        type="text"
                        id="delivery_firstname"
                        class="form-control"
                    />
                </div>
                <div class="form-group">
                    <label for="name">{{ $t("c.Last name") }}: </label>
                    <input
                        v-model="address_data.delivery_lastname"
                        type="text"
                        id="delivery_lastname"
                        class="form-control"
                    />
                </div>
                <div class="form-group">
                    <label for="name">{{ $t("c.Street") }}: </label>
                    <input
                        v-model="address_data.delivery_street"
                        type="text"
                        id="delivery_street"
                        class="form-control"
                    />
                </div>

                <div class="form-group">
                    <label for="name">{{ $t("c.City") }}:</label>
                    <input
                        v-model="address_data.delivery_city"
                        type="text"
                        id="delivery_city"
                        class="form-control"
                    />
                </div>

                <div class="form-group">
                    <label for="name">{{ $t("c.Postal code") }}:</label>
                    <input
                        v-model="address_data.delivery_postal_code"
                        type="text"
                        id="delivery_postal_code"
                        class="form-control"
                    />
                </div>

                <div class="form-group">
                    <label for="name">{{ $t("c.Order message") }}:</label>
                    <textarea
                        class="form-control"
                        id="message"
                        rows="3"
                        v-model="address_data.message"
                    ></textarea>
                </div>

                <div class="form-group">
                    <button
                        @click="orderinformationEdit(1)"
                        type="button"
                        class="btn btn-primary"
                    >
                        {{ $t("c.Save") }}:
                    </button>
                </div>
            </div>
            <div
                class="tab-pane fade"
                :class="{ 'active show': isActive('payment') }"
                id="payment"
            >
                <input
                    ref="order_information_type"
                    type="hidden"
                    value="2"
                /><br />

                {{ $t("c.Please choose your payment method") }} <br />
                <div class="form-check">
                    <label class="form-check-label">
                        <input
                            type="radio"
                            class="form-check-input"
                            v-model="address_data.payment_type"
                            v-bind:value="2"
                        />
                        {{ $t("c.Cash on delivery") }}
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input
                            type="radio"
                            class="form-check-input"
                            v-model="address_data.payment_type"
                            v-bind:value="3"
                        />
                        Zarinpal
                    </label>
                </div>

                <div class="form-group">
                    <button
                        @click="orderinformationEdit(2)"
                        type="button"
                        class="btn btn-primary"
                        value="2"
                    >
                        {{ $t("c.Save") }}
                    </button>
                </div>
            </div>
            <div
                class="tab-pane fade"
                :class="{ 'active show': isActive('summary') }"
                id="summary"
            >
                <input ref="order_information_type" type="hidden" value="3" />
                <table class="table">
                    <thead>
                        <tr>
                            <td>
                                <b>Seller</b>
                            </td>
                            <td>
                                <b>Title</b>
                            </td>
                            <td>
                                <b>Final price</b>
                            </td>
                        </tr>
                    </thead>
                    <tbody v-for="(data, index) in product_data">
                        <tr>
                            <td>{{ data.owner_name }}</td>
                            <td>{{ data.title }}</td>
                            <td>{{ data.bid }}</td>
                        </tr>
                    </tbody>
                </table>
                <h1>{{ $t("c.Delivery address") }}</h1>
                <div class="form-group">
                    <label for="name">{{ $t("c.First name") }}: </label>
                    <input
                        v-model="address_data.delivery_firstname"
                        type="text"
                        id="delivery_firstname"
                        class="form-control"
                    />
                </div>
                <div class="form-group">
                    <label for="name">{{ $t("c.Last name") }}: </label>
                    <input
                        v-model="address_data.delivery_lastname"
                        type="text"
                        id="delivery_lastname"
                        class="form-control"
                    />
                </div>
                <div class="form-group">
                    <label for="name">{{ $t("c.Street") }}: </label>
                    <input
                        v-model="address_data.delivery_street"
                        type="text"
                        id="delivery_street"
                        class="form-control"
                    />
                </div>
                <div class="form-group">
                    <label for="name">{{ $t("c.City") }}:</label>
                    <input
                        v-model="address_data.delivery_city"
                        type="text"
                        id="delivery_city"
                        class="form-control"
                    />
                </div>
                <div class="form-group">
                    <label for="name">{{ $t("c.Postal code") }}:</label>
                    <input
                        v-model="address_data.delivery_postal_code"
                        type="text"
                        id="delivery_postal_code"
                        class="form-control"
                    />
                </div>
                <div class="form-group">
                    <label for="name">{{ $t("c.Order message") }}:</label>
                    <textarea
                        class="form-control"
                        id="message"
                        rows="3"
                        v-model="address_data.message"
                    ></textarea>
                </div>
                {{ $t("c.Please choose your payment method") }} |{{
                    address_data.payment_type
                }}|<br />

                <div class="form-check">
                    <label class="form-check-label">
                        <input
                            type="radio"
                            class="form-check-input"
                            v-model="address_data.payment_type"
                            v-bind:value="2"
                        />
                        {{ $t("c.Cash on delivery") }}
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input
                            type="radio"
                            class="form-check-input"
                            v-model="address_data.payment_type"
                            v-bind:value="3"
                        />
                        Zarinpal
                    </label>
                </div>
                <div class="form-group">
                    <label for="name">{{ $t("c.Order message") }}:</label>
                    <textarea
                        class="form-control"
                        id="message"
                        rows="3"
                        v-model="address_data.message"
                    ></textarea>
                </div>
                <div class="form-group">
                    <button
                        @click="orderinformationEdit(3)"
                        type="button"
                        class="btn btn-primary"
                        value="3"
                    >
                        {{ $t("c.Save") }}
                    </button>
                </div>
                <div class="form-group">
                    <button
                        @click="sendOrder"
                        type="button"
                        class="btn btn-primary"
                    >
                        {{ $t("c.Send order") }}
                    </button>
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
            activeItem: "basket",
            product_data: [],
            address_data: []
        };
    },

    methods: {
        isActive(menuItem) {
            return this.activeItem === menuItem;
        },
        setActive(menuItem) {
            this.activeItem = menuItem;
        },

        loadImages() {
            axios.get(this.workuri + "/basket_get/").then(response => {
                this.product_data = response.data;
            });
        },

        getAddress() {
            axios
                .get(this.workuri + "/orderinformation_get/")
                .then(response => {
                    if (response.data != null) {
                        this.address_data = response.data;
                    } else {
                        var defaddress = {
                            firstname: "",
                            lastname: "",
                            street: "",
                            city: "",
                            postal_code: "",
                            email: "",
                            delivery_firstname: "",
                            delivery_lastname: "",
                            delivery_street: "",
                            delivery_city: "",
                            delivery_postal_code: "",
                            message: "",
                            payment_type: ""
                        };
                        this.address_data = defaddress;
                    }
                });
        },

        orderinformationEdit(selected_value) {
            console.log("button value: " + selected_value);

            axios
                .post(this.workuri + "/orderinformation_edit", {
                    order_information_type: selected_value,
                    firstname: this.address_data.firstname,
                    lastname: this.address_data.lastname,
                    street: this.address_data.delivery_street,
                    city: this.address_data.delivery_city,
                    postal_code: this.address_data.postal_code,
                    email: this.address_data.email,
                    delivery_firstname: this.address_data.delivery_firstname,
                    delivery_lastname: this.address_data.delivery_lastname,
                    delivery_street: this.address_data.delivery_street,
                    delivery_city: this.address_data.delivery_city,
                    delivery_postal_code: this.address_data
                        .delivery_postal_code,
                    message: this.address_data.message,
                    payment_type: this.address_data.payment_type
                })
                .then(response => {
                    $(".message_ok").html(response.data);
                    if (response.data.substr(0, 2) == "OK") {
                        $("#components").hide();
                        $(".message_ok").show();
                        $(".message_ok").html(response.data.substr(2));
                    } else {
                        $(".message_error").show();
                        $(".message_error").html(response.data);
                        console.log(response.data);
                    }
                });
        },

        sendOrder() {
            axios.post(this.workuri + "/order", {}).then(response => {
                $(".message_ok").show();
                $(".message_ok").html(response.data);
            });
        }
    },

    mounted() {
        this.loadImages();
        this.getAddress();
    }
};
</script>
