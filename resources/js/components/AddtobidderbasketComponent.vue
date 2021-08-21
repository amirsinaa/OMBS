<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="form-group">
                    <input
                        v-model="product_id"
                        type="hidden"
                        class="form-control"
                    />
                </div>
                <div class="form-group">
                    <input
                        v-model="admin_id"
                        type="hidden"
                        class="form-control"
                    />
                </div>
                <div class="form-group">
                    <input
                        v-model="member_id"
                        type="hidden"
                        class="form-control"
                    />
                </div>
                <div class="form-group">
                    <input v-model="bid" type="hidden" class="form-control" />
                </div>
                <div class="form-group">
                    <input v-model="email" type="hidden" class="form-control" />
                </div>
                <div class="form-group" id="addtobidderbasket_button">
                    <button
                        @click="basketAdd"
                        type="button"
                        class="btn btn-primary"
                    >
                        Add to Bidder's basket
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["workuri", "product_id", "admin_id", "member_id", "bid", "email"],

    data() {
        return {};
    },

    methods: {
        basketAdd() {
            axios
                .post(this.workuri + "/basket/add", {
                    product_id: this.product_id,
                    admin_id: this.admin_id,
                    member_id: this.member_id,
                    bid: this.bid,
                    email: this.email
                })
                .then(response => {
                    console.log(response.data);
                    $("#addtobidderbasket_button").hide();
                    $(".message_ok").show();
                    $(".message_ok").html(response.data);
                });
        }
    },

    mounted() {}
};
</script>
