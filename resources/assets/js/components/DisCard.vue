<template>
    <div class="disparity_grey" :id="cardData.card">
        <div class="card disparity_card">
            <p class="disparity_text">Страховка не соответствует Вашему запросу</p>
            <img :src="imgLink" alt="Logo Img" class="img_logo img_logo_disparity">
        </div>
    </div>
</template>
<style>

</style>
<script>
    export default {
        data() {
            return {
                imgLink: String,
            }
        },
        props: ['cardData'],
        mounted () {
            this.imgLink =  "/assets/img/logo-" + this.cardData.card + ".png";
        }
    }
</script>
