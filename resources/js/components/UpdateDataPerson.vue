<template>

                <div class="card card-default">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-7">

                                <VueSignaturePad
                                    width="500px"
                                    height="300px"
                                    ref="signaturePad"
                                />
                                <div>
                                    <button @click="undo" class="btn btn-danger">Borrar Firma</button>
                                </div>

                            </div>
                            <div class="col-lg-5">
                                <vue-cam ref="camera" width="300" height="300" />
                            </div>
                        </div>
                        <div class="row">
                            <button type="button" @click="takeData" class="btn btn-primary">CAPTURAR FOTO Y FIRMA</button>
                        </div>

                    </div>
                </div>

</template>
<script>

    import VueCam from "vue-html5-camera"
    
    import VueSignaturePad from 'vue-signature-pad';

    export default {
        name: "UpdateDataPerson",
        components: { VueCam,VueSignaturePad },
        data () {
            return {

            };
        },
        methods: {
            takeData () {

                  let rst= this.$refs.signaturePad.saveSignature();
                  let avatar=this.$refs.camera.click();
                  if(avatar==null){
                      alert("Debes capturar una foto");
                      return true;
                  }
                    if(rst.isEmpty ){
                      alert("Debes poner tu firma antes de continuar");
                      return true;
                  }

               const data = new FormData();
               data.append('avatar',  this.dataURLtoFile(avatar), 'avatar');
               data.append('signature',  this.dataURLtoFile(rst.data), 'signature');

                const config = {
                    headers: { 'Content-Type': 'multipart/form-data' }
                };
                axios.post('/upload-data', data, config).then(response => {
                    console.log(response.data);
                    alert(response.data);
                })


            },
            undo() {
                this.$refs.signaturePad.undoSignature();
            },

            dataURLtoFile: (dataurl) => {
                const arr = dataurl.split(',')
                const mime = arr[0].match(/:(.*?);/)[1]
                const bstr = atob(arr[1])
                let n = bstr.length
                const u8arr = new Uint8Array(n)
                while (n) {
                    u8arr[n-1] = bstr.charCodeAt(n-1);
                    n-=1;
                }
                return new File([u8arr], 'img.png', { type: mime })
            }
        }
    };
</script>

<style scoped>

</style>
