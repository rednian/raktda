<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                      <content>This is a content</content>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['route'],
        data: function(){
            return {
                data: 1
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
