<script>
export default {
    props: ['answer'],
    data () {
        return {
            editing: false,
            body: this.answer.body,
            bodyHtml: this.answer.body_html,
            id: this.answer.id,
            questionId: this.answer.question_id,
            beforeEditCache: null
        }
    },
    methods: {
        edit () {
            this.beforeEditCache = this.body;
            this.editing = true;
        },
        cancel () {
            this.body = this.beforeEditCache;
            this.editing = false;
        },
        update () {
            URL=`/stackoverflow/public/questions/${this.questionId}/answers/${this.id}`,
            axios.patch(URL, {
                body: this.body
            })
            .then(res => { 
                console.log(res);              
                this.editing = false;
                this.bodyHtml = res.data.body_html;
                this.$toast.success(res.data.message,"Success",{timeout:3000});
            })
            .catch(err => {
               this.$toast.error(err.response.data.message,"Error",{timeout:3000});               
            });
        },
        destroy()
        {
            this.$toast.question('Are you sure about that?',"confirm",{
    timeout: 20000,
    close: false,
    overlay: true,
    displayMode: 'once',
    id: 'question',
    zindex: 999,
    title: 'Hey',
    
    position: 'center',
    buttons: [
        ['<button><b>YES</b></button>',  (instance, toast) =>{
 
                 URL=`/stackoverflow/public/questions/${this.questionId}/answers/${this.id}`,
            axios.delete(URL)
            .then(res=>{
                $(this.$el).fadeOut(500,()=>{
                    this.$toast.success(res.data.message,"Success",{timeout:3000});
                })
            })
           
            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
 
        }, true],
        ['<button>NO</button>', function (instance, toast) {
 
            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
 
        }],
    ],
    
});
            
           
        }        
    },
    computed: {
        isInvalid () {
            return this.body.length < 10;
        }
    }
}
</script>