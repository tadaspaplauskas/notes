<script>

export default {
  data() {
    return {
      notes: [],
      dirty: [],
    }
  },
  mounted() {
    this.loadNotes();
  },
  computed: {
  },
  methods: {
    loadNotes() {
      axios.get('/notes')
        .then(response => {
          this.notes = response.data.data
        })
        .catch(error => {
          console.log(error.response.data)
        })


    },
    addNote() {

      axios.post('/notes', data)
        .then(response => {
            this.notes.push({
              focus: true,
              content: `
                <p>
                </p>
            `
            });
        })
        .catch(error => {
            console.log(error.response.data)
        })
    },
    saveNotes() {


    },
  },

}
</script>
