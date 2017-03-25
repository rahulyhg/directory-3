<template>
    <div class="family-photo-wrap">

        <div v-if="loading" class="text-center">
            <i class="fa fa-cog fa-spin fa-3x fa-fw"></i>
        </div>

        <div v-else>
            <div v-if="set">
                <img v-bind:src="images.data.thumbnail">
                <a class="btn btn-delete" @click="removeFamilyPhoto"><i class="fa fa-times" aria-hidden="true"></i></a>
            </div>

            <div v-else>
                <div v-show="imgSrc" class="preview-window">
                    <img :src="imgSrc">
                    <a @click="clearThumbnail" class="btn btn-delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                </div>

                <label for="family-photo">
                    <i class="fa fa-upload" aria-hidden="true"></i><br />
                    <span>Upload a Photo</span>
                    <input type="file" name="photo" id="family-photo" accept="image/*" @change="previewThumbnail" class="hidden">
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
                'message': '',
                'imgSrc': ''
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
                        // console.log('no photo found');
                        this.loading = false;
                    }.bind(this));
            }, // checkIfSet()


            previewThumbnail: function(event) {
                // http://taha-sh.com/blog/quick-tip-how-to-use-vuejs-to-preview-images-before-uploading
                var input = event.target;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        this.imgSrc = e.target.result;
                    }.bind(this);

                    reader.readAsDataURL(input.files[0]);
                }
            }, // previewThumbnail()


            clearThumbnail: function() {
                this.imgSrc = '';
            }, // clearThumbnail()


            removeFamilyPhoto: function() {
                axios.delete('/family/' + this.slug + '/photo')

                    .then(function(response){
                        this.images = response.data;
                        this.loading = false;
                        this.set = false;
                    }.bind(this))

                    .catch(function(response){
                        // console.log('photo delete failed');
                        this.loading = false;
                    }.bind(this));
            }, // removeFamilyPhoto()

        },


    }
</script>
