<template>
    <div class="family-photo-wrap">

        <div v-if="loading">
            <i class="fa fa-cog fa-spin fa-3x fa-fw"></i>
        </div>

        <div v-else>
            <div v-if="set">
                <img style="max-width: 100%;" v-bind:src="images.data.thumbnail">
                <a class="btn btn-delete" @click="removeFamilyPhoto"><i class="fa fa-times" aria-hidden="true"></i></a>
            </div>
            <div v-else>
                <label style="cursor:pointer; text-align:center; display:block; padding:10px; color:#CCC; font-weight:normal;" for="family-photo">
                    <i style="font-size:30px; margin:0;" class="fa fa-upload" aria-hidden="true"></i><br />
                    <span style="font-size:14px;">Upload a Photo</span>
                    <input type="file" name="photo" id="family-photo" accept="image/*" class="hidden">
                </label>
            </div>
        </div>

    </div>
</template>


<script>
    export default {
        props: ['slug'],

        data: function(){
            return {
                'images': [],
                'loading': true,
                'set': false,
                'errors': false,
                'message': ''
            }
        },

        created: function() {
            this.getFamilyPhoto();
        },

        methods: {

            getFamilyPhoto: function() {
                axios.get('/family/' + this.slug + '/photo')

                    .then(function(response){
                        this.images = response.data;
                        this.loading = false;
                        if(this.images.data.photo != '/public/directory/'){
                            this.set = true;
                        }
                    }.bind(this))

                    .catch(function(response){
                        console.log('no?')
                        this.loading = false;
                    }.bind(this));
            }, // checkIfSet()


            removeFamilyPhoto: function() {
                axios.delete('/family/' + this.slug + '/photo')

                    .then(function(response){
                        this.images = response.data;
                        this.loading = false;
                        this.set = false;
                    }.bind(this))

                    .catch(function(response){
                        console.log('no?')
                        this.loading = false;
                    }.bind(this));
            }, // removeFamilyPhoto()

        },


    }
</script>
