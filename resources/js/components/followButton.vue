<!-- <template>
   <div >
      <button class="btn btn-primary">follow</button>
   </div>
 </template> 
  
 
<script>
export default {
    mounted() {
        console.log('Component mounted.')
    }
}
</script> -->



   <template>
     <div >

      <button class="btn btn-primary"  @click="handleFollow" :class="second" >{{ text }}</button>
   </div>
   </template>

   <script setup>
   import axios from 'axios'
   import {ref,toRef,reactive,computed,inject} from 'vue';

 
const props = defineProps(['userId','followss'])

const state = ref(props.followss);
const first = ref('')
const second = ref('')
 const text = ref(state.value ? first.value = 'unfollow' : first.value = 'follow');
 const classs = ref(state.value ? second.value = 'btn-secondary' : second.value = 'btn-primary');
console.log(props.followss);

 const buttonText = computed(()=>{
 return state.value ? text = 'follow' : 'unfollow'
 }) 
 function changeState(){
  state.value = !state.value;
  state.value ? text.value = 'unfollow' : text.value = 'follow'
  state.value ? second.value = 'btn-secondary' : second.value = 'btn-primary'

 }

    const  handleFollow = () => {
      const reversedMessage = props.userId;
      axios.post(`/follow/${props.userId}`)
        .then(response=>{
         
        console.log(response.data);  
      
        // state.value ? text = 'follow' : 'unfollow'
        console.log(state.value);
changeState()
   
      //  if(state.value) {
      //   text = 'follow'
      //  }
      //  else{
      //   text = 'unfollow'
      //  }
        })
        .catch(error=>{
          if(error.response.status == 401){
            window.location = '/login';
          }
        })
      }
      
    //   console.log(reversedMessage);
    // };

    // return { handleFollow };
 
  //  export default followButton;
   </script>
   